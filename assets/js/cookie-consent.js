/**
 * Cookie preference consent manager (GenRocket).
 *
 * Single self-contained file. Handles:
 *   1. The consent banner + "Manage Preferences" modal (show/hide, toggles,
 *      focus trap, keyboard handling, persistence in localStorage).
 *   2. Conditional loading of third-party assets, gated by category:
 *        - ANALYTICS  -> Google Tag Manager (GTM-TNFNRK9), gtag.js
 *                        (G-0X5R36FF51, UA-32344187-1).
 *        - MARKETING  -> Google Ads (AW-10821579184), ZoomInfo, Insightful
 *                        Enterprise Intelligence, gtag_report_conversion().
 *        - FUNCTIONAL -> Google reCAPTCHA v3, Google Maps embeds, Vimeo / YouTube
 *                        embeds, and the Vimeo Player API.
 *      Essential cookies are always on and never gated.
 *
 * Nothing in a non-essential category is requested from the network until the
 * matching consent has been granted. Load this file in the <head> as early as
 * possible so existing theme scripts can be blocked before they execute.
 *
 * WordPress integration:
 *   - Remove analytics, marketing, reCAPTCHA, ZoomInfo, Insightful, Vimeo,
 *     and YouTube tags from the theme header/footer (this script injects them
 *     after consent).
 *   - Include include/cookie-consent.php before </body> in footer.php.
 */
(function () {
	'use strict';

	var STORAGE_KEY = 'gr_cookie_consent';

	var GTM_ID = 'GTM-TNFNRK9';
	var GTAG_ANALYTICS = ['G-0X5R36FF51', 'UA-32344187-1'];
	var GTAG_MARKETING = ['AW-10821579184'];

	// Submit-click conversion (gtag_report_conversion in header.php).
	var LEAD_FORM_CONVERSION = 'AW-10821579184/g5E7CNq-8I8DELDjkKgo';

	// Thank-you page conversions from header.php (page_id → URL).
	// sendTo may be a string or array when multiple labels fire on one page.
	var THANKS_PAGE_CONVERSIONS = [
		{
			match: '/contact-form-thanks/',
			pageId: 7739,
			sendTo: [
				'AW-10821579184/KVWlCI2fnacDELDjkKgo',
				'AW-10821579184/QnWkCJP12NgDELDjkKgo'
			]
		},
		{
			match: '/thank-you/',
			pageId: 367,
			sendTo: 'AW-10821579184/QnWkCJP12NgDELDjkKgo'
		},
		{
			match: '/bc-lp2-dd-thanks/',
			pageId: 10085,
			sendTo: 'AW-10821579184/r6g-CMGO5-IYELDjkKgo'
		},
		{
			match: '/synthetic-test-data-generation-lp2-dd-thanks/',
			pageId: 10091,
			sendTo: 'AW-10821579184/i1gVCMH24eIYELDjkKgo'
		},
		{
			match: '/test-data-management-lp3-dd-thanks/',
			pageId: 10089,
			sendTo: 'AW-10821579184/HHzHCKfY3uIYELDjkKgo'
		}
	];

	var ZOOMINFO_KEY = '4f0ede23ab1695401559';
	var ZOOMINFO_SRC = 'https://js.zi-scripts.com/zi-tag.js';

	var INSIGHTFUL_SRC = 'https://secure.insightful-enterprise-intelligence.com/js/784131.js';
	var INSIGHTFUL_INTEGRITY = 'sha384-ZQPUKkvYGcKwque19AHC6JmZskQfjOFA1ZZdSxcwdzvMUrijaTbfbWzgnnoigs9r';

	var RECAPTCHA_SITEKEY = '6Lfo5LYUAAAAAMmXxxN19uXUdfNKmGA9GZFq0auL';
	var VIMEO_API_INTEGRITY = 'sha384-fYgai7z8Tr2FqnmPbT+J2mR66tN6O0vGzHRvtszof8FM4X9PhmqYJuhwVjCK5JDl';

	var BLOCKED_FLAG_ATTR = 'data-gr-cookie-blocked';
	var BLOCKED_SRC_ATTR = 'data-gr-cookie-src';

	var ANALYTICS_SRC_PATTERNS = [
		/googletagmanager\.com\/gtag\/js/i,
		/googletagmanager\.com\/gtm\.js/i
	];

	var MARKETING_SRC_PATTERNS = [
		/zi-scripts\.com/i,
		/insightful-enterprise-intelligence\.com/i
	];

	var FUNCTIONAL_SRC_PATTERNS = [
		/google\.com\/recaptcha\/api\.js/i,
		/player\.vimeo\.com\/api\/player\.js/i
	];

	var VIMEO_API_SRC = 'https://player.vimeo.com/api/player.js';

	var FUNCTIONAL_IFRAME_PATTERNS = [
		/player\.vimeo\.com\/video\//i,
		/youtube(?:-nocookie)?\.com\/embed\//i,
		/youtu\.be\//i,
		/google\.[^/]+\/maps\/embed/i
	];

	var bannerEl = null;
	var overlayEl = null;
	var modalEl = null;
	var analyticsInput = null;
	var marketingInput = null;
	var functionalInput = null;
	var lastFocusedElement = null;
	var observerStarted = false;

	var state = null;

	// ---------------------------------------------------------------------
	// Consent storage helpers
	// ---------------------------------------------------------------------
	function isValidConsent(data) {
		if (!data || typeof data !== 'object') {
			return false;
		}

		if (data.essential !== true) {
			return false;
		}

		if (typeof data.analytics !== 'boolean' ||
			typeof data.marketing !== 'boolean' ||
			typeof data.functional !== 'boolean') {
			return false;
		}

		var validChoices = ['custom', 'accepted_all', 'rejected_non_essential'];

		if (validChoices.indexOf(data.choice) === -1) {
			return false;
		}

		if (typeof data.timestamp !== 'string' || !data.timestamp) {
			return false;
		}

		return true;
	}

	function readStoredConsent() {
		try {
			var raw = localStorage.getItem(STORAGE_KEY);

			if (!raw) {
				return null;
			}

			var parsed = JSON.parse(raw);

			// Migrate legacy consent that used a separate social category.
			if (parsed && typeof parsed.social === 'boolean') {
				parsed.functional = !!parsed.functional || !!parsed.social;
				delete parsed.social;
			}

			if (!isValidConsent(parsed)) {
				return null;
			}

			return parsed;
		} catch (error) {
			return null;
		}
	}

	function saveConsent(consent) {
		state = consent;

		try {
			localStorage.setItem(STORAGE_KEY, JSON.stringify(consent));
		} catch (error) {
			// Storage may be unavailable; still dispatch for the current page view.
		}

		window.dispatchEvent(new CustomEvent('grConsentUpdated', {
			detail: consent
		}));
	}

	function buildConsent(analytics, marketing, functional, choice) {
		return {
			essential: true,
			analytics: !!analytics,
			marketing: !!marketing,
			functional: !!functional,
			choice: choice,
			timestamp: new Date().toISOString()
		};
	}

	function consentAllows(category) {
		var consent = state || readStoredConsent();
		return consent ? consent[category] === true : false;
	}

	function matchesPattern(value, patterns) {
		if (!value) {
			return false;
		}

		for (var i = 0; i < patterns.length; i++) {
			if (patterns[i].test(value)) {
				return true;
			}
		}

		return false;
	}

	function getInlineScriptText(node) {
		return (node.textContent || node.innerHTML || '').replace(/\s+/g, ' ');
	}

	function isAnalyticsInlineScript(text) {
		return (/gtag\s*\(|gtm\.js|googletagmanager\.com\/gtag/i.test(text)) &&
			!/zi-scripts|insightful-enterprise|recaptcha|grecaptcha|player\.vimeo|youtube\.com\/embed/i.test(text);
	}

	function isMarketingInlineScript(text) {
		return /zi-scripts|ZIProjectKey|insightful-enterprise-intelligence|gtag_report_conversion/i.test(text);
	}

	function isFunctionalInlineScript(text) {
		return /recaptcha\/api\.js|grecaptcha\.execute|grecaptcha\.ready|wpformsRecaptchaV3Execute|player\.vimeo\.com\/api\/player\.js/i.test(text);
	}

	function getScriptCategory(node) {
		if (!node || node.tagName !== 'SCRIPT') {
			return null;
		}

		if (matchesPattern(node.src || '', ANALYTICS_SRC_PATTERNS)) {
			return 'analytics';
		}

		if (matchesPattern(node.src || '', MARKETING_SRC_PATTERNS)) {
			return 'marketing';
		}

		if (matchesPattern(node.src || '', FUNCTIONAL_SRC_PATTERNS)) {
			return 'functional';
		}

		if (!node.src) {
			var text = getInlineScriptText(node);

			if (isMarketingInlineScript(text)) {
				return 'marketing';
			}

			if (isFunctionalInlineScript(text)) {
				return 'functional';
			}

			if (isAnalyticsInlineScript(text)) {
				return 'analytics';
			}
		}

		return null;
	}

	function disableScript(node) {
		if (!node || node.getAttribute(BLOCKED_FLAG_ATTR) === 'true') {
			return;
		}

		if (node.src) {
			node.setAttribute('data-gr-cookie-src', node.src);
			node.removeAttribute('src');
		}

		node.setAttribute('type', 'text/plain');
		node.setAttribute(BLOCKED_FLAG_ATTR, 'true');
	}

	function removeNode(node) {
		if (node && node.parentNode) {
			node.parentNode.removeChild(node);
		}
	}

	function getBlockedScriptSrc(pattern) {
		var blocked = document.querySelector('script[' + BLOCKED_FLAG_ATTR + '="true"][data-gr-cookie-src*="' + pattern + '"]');

		if (blocked) {
			return blocked.getAttribute('data-gr-cookie-src');
		}

		return '';
	}

	// ---------------------------------------------------------------------
	// Google Consent Mode
	// ---------------------------------------------------------------------
	function ensureGtagStub() {
		window.dataLayer = window.dataLayer || [];
		window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };
	}

	function initConsentModeDefaults() {
		if (window.grConsentModeInitialized) {
			return;
		}
		window.grConsentModeInitialized = true;

		ensureGtagStub();
		window.gtag('consent', 'default', {
			'ad_storage': 'denied',
			'analytics_storage': 'denied',
			'ad_user_data': 'denied',
			'ad_personalization': 'denied',
			'functionality_storage': 'denied',
			'personalization_storage': 'denied',
			'security_storage': 'granted'
		});
	}

	function updateConsentMode() {
		ensureGtagStub();

		window.gtag('consent', 'update', {
			'analytics_storage': consentAllows('analytics') ? 'granted' : 'denied',
			'ad_storage': consentAllows('marketing') ? 'granted' : 'denied',
			'ad_user_data': consentAllows('marketing') ? 'granted' : 'denied',
			'ad_personalization': consentAllows('marketing') ? 'granted' : 'denied',
			'functionality_storage': consentAllows('functional') ? 'granted' : 'denied',
			'personalization_storage': consentAllows('marketing') ? 'granted' : 'denied'
		});
	}

	function shouldLoadTracking() {
		return consentAllows('analytics') || consentAllows('marketing');
	}

	// ---------------------------------------------------------------------
	// ANALYTICS + MARKETING: Google Tag Manager + gtag.js
	// ---------------------------------------------------------------------
	function loadTracking() {
		if (!shouldLoadTracking()) {
			return;
		}

		updateConsentMode();

		if (window.grTrackingLoaded) {
			fireThanksPageConversions();
			return;
		}
		window.grTrackingLoaded = true;

		ensureGtagStub();

		var primaryId = consentAllows('analytics') ? GTAG_ANALYTICS[0] : GTAG_MARKETING[0];
		var gtagScript = document.createElement('script');
		gtagScript.async = true;
		gtagScript.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(primaryId);
		(document.head || document.documentElement).appendChild(gtagScript);

		window.gtag('js', new Date());

		if (consentAllows('analytics')) {
			for (var a = 0; a < GTAG_ANALYTICS.length; a++) {
				window.gtag('config', GTAG_ANALYTICS[a]);
			}
		}

		if (consentAllows('marketing')) {
			for (var m = 0; m < GTAG_MARKETING.length; m++) {
				window.gtag('config', GTAG_MARKETING[m]);
			}
		}

		if (!document.querySelector('script[src*="googletagmanager.com/gtm.js"]:not([' + BLOCKED_FLAG_ATTR + '="true"])')) {
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
				var f = d.getElementsByTagName(s)[0];
				var j = d.createElement(s);
				var dl = l !== 'dataLayer' ? '&l=' + l : '';
				j.async = true;
				j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, 'script', 'dataLayer', GTM_ID);
		}

		installGtagReportConversion();
		fireThanksPageConversions();
	}

	function revokeTracking() {
		window.grTrackingLoaded = false;

		var scripts = document.querySelectorAll(
			'script[src*="googletagmanager.com/gtag/js"], ' +
			'script[src*="googletagmanager.com/gtm.js"], ' +
			'script[data-gr-cookie-src*="googletagmanager.com"]'
		);

		for (var i = 0; i < scripts.length; i++) {
			removeNode(scripts[i]);
		}
	}

	function installGtagReportConversion() {
		window.gtag_report_conversion = function (url) {
			if (!consentAllows('marketing')) {
				if (typeof url !== 'undefined' && url) {
					window.location = url;
				}
				return false;
			}

			var callback = function () {
				if (typeof url !== 'undefined' && url) {
					window.location = url;
				}
			};

			ensureGtagStub();
			window.gtag('event', 'conversion', {
				send_to: LEAD_FORM_CONVERSION,
				event_callback: callback
			});

			return false;
		};
	}

	function fireThanksPageConversions() {
		if (!consentAllows('marketing')) {
			return;
		}

		var path = window.location.pathname || '';

		for (var i = 0; i < THANKS_PAGE_CONVERSIONS.length; i++) {
			var rule = THANKS_PAGE_CONVERSIONS[i];

			if (path.indexOf(rule.match) === -1) {
				continue;
			}

			var labels = Array.isArray(rule.sendTo) ? rule.sendTo : [rule.sendTo];

			for (var j = 0; j < labels.length; j++) {
				var sendTo = labels[j];
				var firedKey = 'grThanksFired_' + sendTo.replace(/\W+/g, '_');

				if (window[firedKey]) {
					continue;
				}

				ensureGtagStub();
				window.gtag('event', 'conversion', { send_to: sendTo });
				window[firedKey] = true;
			}
		}
	}

	// ---------------------------------------------------------------------
	// MARKETING: ZoomInfo + Insightful Enterprise Intelligence
	// ---------------------------------------------------------------------
	function loadZoomInfo() {
		if (!consentAllows('marketing')) {
			return;
		}

		if (document.querySelector('script[src*="zi-scripts.com"]:not([' + BLOCKED_FLAG_ATTR + '="true"])')) {
			return;
		}

		window.ZIProjectKey = ZOOMINFO_KEY;

		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.async = true;
		script.src = getBlockedScriptSrc('zi-scripts.com') || ZOOMINFO_SRC;

		if (document.readyState === 'complete') {
			(document.body || document.documentElement).appendChild(script);
		} else {
			window.addEventListener('load', function () {
				(document.body || document.documentElement).appendChild(script);
			});
		}
	}

	function loadInsightful() {
		if (!consentAllows('marketing')) {
			return;
		}

		if (document.querySelector('script[src*="insightful-enterprise-intelligence.com"]:not([' + BLOCKED_FLAG_ATTR + '="true"])')) {
			return;
		}

		var script = document.createElement('script');
		script.src = getBlockedScriptSrc('insightful-enterprise-intelligence.com') || INSIGHTFUL_SRC;
		script.integrity = INSIGHTFUL_INTEGRITY;
		script.crossOrigin = 'anonymous';
		(document.head || document.body || document.documentElement).appendChild(script);
	}

	function revokeMarketingExtras() {
		var scripts = document.querySelectorAll(
			'script[src*="zi-scripts.com"], ' +
			'script[src*="insightful-enterprise-intelligence.com"], ' +
			'script[data-gr-cookie-src*="zi-scripts.com"], ' +
			'script[data-gr-cookie-src*="insightful-enterprise-intelligence.com"]'
		);

		for (var i = 0; i < scripts.length; i++) {
			removeNode(scripts[i]);
		}

		var noscriptImg = document.querySelector('img[src*="insightful-enterprise-intelligence.com"]');

		if (noscriptImg && noscriptImg.parentNode) {
			noscriptImg.parentNode.removeChild(noscriptImg);
		}

		try {
			delete window.ZIProjectKey;
		} catch (error) {
			window.ZIProjectKey = undefined;
		}
	}

	function loadMarketing() {
		if (!consentAllows('marketing')) {
			return;
		}

		loadTracking();
		loadZoomInfo();
		loadInsightful();
	}

	// ---------------------------------------------------------------------
	// FUNCTIONAL: reCAPTCHA v3 (WPForms)
	// ---------------------------------------------------------------------
	function injectRecaptcha() {
		if (!consentAllows('functional')) {
			return;
		}

		if (window.grRecaptchaLoaded &&
			document.querySelector('script[src*="google.com/recaptcha/api.js"]:not([' + BLOCKED_FLAG_ATTR + '="true"])')) {
			return;
		}

		var existingApi = document.querySelector('script[src*="google.com/recaptcha/api.js"]:not([' + BLOCKED_FLAG_ATTR + '="true"])');

		if (existingApi) {
			window.grRecaptchaLoaded = true;
			return;
		}

		window.grRecaptchaLoaded = true;

		var api = document.createElement('script');
		api.src = getBlockedScriptSrc('google.com/recaptcha/api.js') ||
			('https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(RECAPTCHA_SITEKEY));
		api.id = 'wpforms-recaptcha-js';
		api.onload = function () {
			installWpformsRecaptchaHelpers();
		};
		(document.head || document.body || document.documentElement).appendChild(api);
	}

	function installWpformsRecaptchaHelpers() {
		if (window.grWpformsRecaptchaInstalled) {
			return;
		}
		window.grWpformsRecaptchaInstalled = true;

		window.wpformsDispatchEvent = window.wpformsDispatchEvent || function (el, ev, custom) {
			var e = document.createEvent(custom ? 'CustomEvent' : 'HTMLEvents');
			custom ? e.initCustomEvent(ev, true, true, false) : e.initEvent(ev, true, true);
			el.dispatchEvent(e);
		};

		window.wpformsRecaptchaV3Execute = function (callback) {
			if (!window.grecaptcha || typeof window.grecaptcha.execute !== 'function') {
				return;
			}

			window.grecaptcha.execute(RECAPTCHA_SITEKEY, { action: 'wpforms' }).then(function (token) {
				Array.prototype.forEach.call(document.getElementsByName('wpforms[recaptcha]'), function (el) {
					el.value = token;
				});

				if (typeof callback === 'function') {
					callback();
				}
			});
		};

		if (window.grecaptcha && typeof window.grecaptcha.ready === 'function') {
			window.grecaptcha.ready(function () {
				window.wpformsDispatchEvent(document, 'wpformsRecaptchaLoaded', true);
			});
		}
	}

	function resetRecaptcha() {
		window.grRecaptchaLoaded = false;
		window.grWpformsRecaptchaInstalled = false;

		var scripts = document.querySelectorAll(
			'script[src*="google.com/recaptcha/api.js"], ' +
			'script[data-gr-cookie-src*="google.com/recaptcha/api.js"], ' +
			'script[id="wpforms-recaptcha-js-after"]'
		);

		for (var i = 0; i < scripts.length; i++) {
			removeNode(scripts[i]);
		}

		try {
			delete window.grecaptcha;
		} catch (error) {
			window.grecaptcha = undefined;
		}
	}

	function syncRecaptchaDeniedClass() {
		document.documentElement.classList.toggle('gr-recaptcha-blocked', !consentAllows('functional'));
	}

	// ---------------------------------------------------------------------
	// FUNCTIONAL: Google Maps + Vimeo + YouTube embeds
	// ---------------------------------------------------------------------
	function isGoogleMapsEmbed(src) {
		return /google\.[^/]+\/maps\/embed/i.test(src || '');
	}

	function isFunctionalMediaIframe(iframe) {
		var src = iframe.getAttribute('src') || iframe.getAttribute(BLOCKED_SRC_ATTR) || '';

		return matchesPattern(src, FUNCTIONAL_IFRAME_PATTERNS);
	}

	function getFunctionalEmbedWrap(iframe) {
		return iframe.closest('.map-holder') ||
			iframe.closest('.gr-video-wrap') ||
			iframe.closest('.gr-intro-video-col') ||
			iframe.parentElement;
	}

	function blockFunctionalMediaIframes() {
		var iframes = document.getElementsByTagName('iframe');

		for (var i = 0; i < iframes.length; i++) {
			var iframe = iframes[i];

			if (iframe.getAttribute(BLOCKED_FLAG_ATTR) === 'true') {
				continue;
			}

			var src = iframe.getAttribute('src');

			if (src && isFunctionalMediaIframe(iframe)) {
				iframe.setAttribute(BLOCKED_SRC_ATTR, src);
				iframe.setAttribute(BLOCKED_FLAG_ATTR, 'true');
				iframe.removeAttribute('src');
				updateFunctionalEmbedPlaceholder(iframe, false);
			}
		}
	}

	function restoreFunctionalMediaIframes() {
		var iframes = document.querySelectorAll('iframe[' + BLOCKED_FLAG_ATTR + '="true"]');

		for (var i = 0; i < iframes.length; i++) {
			var iframe = iframes[i];
			var src = iframe.getAttribute(BLOCKED_SRC_ATTR);

			if (!src || !isFunctionalMediaIframe(iframe)) {
				continue;
			}

			iframe.setAttribute('src', src);
			iframe.removeAttribute(BLOCKED_SRC_ATTR);
			iframe.removeAttribute(BLOCKED_FLAG_ATTR);
			updateFunctionalEmbedPlaceholder(iframe, true);
		}
	}

	function updateFunctionalEmbedPlaceholder(iframe, allowed) {
		if (!iframe) {
			return;
		}

		var src = iframe.getAttribute('src') || iframe.getAttribute(BLOCKED_SRC_ATTR) || '';
		var isMap = isGoogleMapsEmbed(src);
		var wrap = getFunctionalEmbedWrap(iframe);

		if (!wrap) {
			return;
		}

		var blockedClass = isMap ? 'gr-map-blocked' : 'gr-video-blocked';
		var placeholderClass = isMap ? 'gr-map-cookie-placeholder' : 'gr-video-cookie-placeholder';
		var message = isMap ?
			'To view this map, please allow Functional cookies.' :
			'To watch this video, please allow Functional cookies.';
		var preferencesBtnClass = isMap ? 'gr-map-preferences-btn' : 'gr-video-preferences-btn';
		var placeholder = wrap.querySelector('.' + placeholderClass);

		if (allowed) {
			wrap.classList.remove(blockedClass);

			if (placeholder && placeholder.parentNode) {
				placeholder.parentNode.removeChild(placeholder);
			}
		} else {
			wrap.classList.add(blockedClass);

			if (!placeholder) {
				placeholder = document.createElement('div');
				placeholder.className = placeholderClass;
				placeholder.innerHTML =
					'<p>' + message + '</p>' +
					'<button type="button" class="gr-cookie-btn gr-cookie-btn--outline ' + preferencesBtnClass + '">Cookie Preferences</button>';
				wrap.appendChild(placeholder);
			}
		}
	}

	function updateAllFunctionalEmbedPlaceholders() {
		var iframes = document.querySelectorAll('iframe');

		for (var i = 0; i < iframes.length; i++) {
			if (isFunctionalMediaIframe(iframes[i])) {
				updateFunctionalEmbedPlaceholder(iframes[i], consentAllows('functional'));
			}
		}
	}

	function loadVimeoApi() {
		if (!consentAllows('functional')) {
			return;
		}

		if (document.querySelector('script[src*="player.vimeo.com/api/player.js"]:not([' + BLOCKED_FLAG_ATTR + '="true"])')) {
			return;
		}

		var script = document.createElement('script');
		script.src = getBlockedScriptSrc('player.vimeo.com/api/player.js') || VIMEO_API_SRC;
		script.integrity = VIMEO_API_INTEGRITY;
		script.crossOrigin = 'anonymous';
		(document.head || document.body || document.documentElement).appendChild(script);
	}

	function revokeFunctionalMedia() {
		blockFunctionalMediaIframes();

		var scripts = document.querySelectorAll(
			'script[src*="player.vimeo.com/api/player.js"], ' +
			'script[data-gr-cookie-src*="player.vimeo.com/api/player.js"]'
		);

		for (var i = 0; i < scripts.length; i++) {
			removeNode(scripts[i]);
		}
	}

	function loadFunctionalMedia() {
		if (!consentAllows('functional')) {
			blockFunctionalMediaIframes();
			updateAllFunctionalEmbedPlaceholders();
			return;
		}

		restoreFunctionalMediaIframes();
		loadVimeoApi();
		updateAllFunctionalEmbedPlaceholders();
	}

	// ---------------------------------------------------------------------
	// Block non-consented assets already in the page
	// ---------------------------------------------------------------------
	function blockCategoryAssets(category) {
		if (consentAllows(category)) {
			return;
		}

		var scripts = document.getElementsByTagName('script');

		for (var i = 0; i < scripts.length; i++) {
			if (getScriptCategory(scripts[i]) === category) {
				disableScript(scripts[i]);
			}
		}

		if (category === 'functional') {
			blockFunctionalMediaIframes();
			updateAllFunctionalEmbedPlaceholders();
			syncRecaptchaDeniedClass();
		}
	}

	function blockNonConsentedAssets() {
		blockCategoryAssets('analytics');
		blockCategoryAssets('marketing');
		blockCategoryAssets('functional');
	}

	function startAssetObserver() {
		if (observerStarted || typeof MutationObserver === 'undefined') {
			return;
		}
		observerStarted = true;

		var observer = new MutationObserver(function (mutations) {
			for (var i = 0; i < mutations.length; i++) {
				var added = mutations[i].addedNodes;

				for (var j = 0; j < added.length; j++) {
					var node = added[j];

					if (node.nodeType !== 1) {
						continue;
					}

					if (node.tagName === 'SCRIPT') {
						var scriptCategory = getScriptCategory(node);

						if (scriptCategory && !consentAllows(scriptCategory)) {
							disableScript(node);
						}
					}

					if (node.tagName === 'IFRAME' && !consentAllows('functional') && isFunctionalMediaIframe(node)) {
						var src = node.getAttribute('src');

						if (src) {
							node.setAttribute(BLOCKED_SRC_ATTR, src);
							node.setAttribute(BLOCKED_FLAG_ATTR, 'true');
							node.removeAttribute('src');
							updateFunctionalEmbedPlaceholder(node, false);
						}
					}

					if (node.querySelectorAll) {
						var nestedIframes = node.querySelectorAll('iframe[src]');

						for (var k = 0; k < nestedIframes.length; k++) {
							if (!consentAllows('functional') && isFunctionalMediaIframe(nestedIframes[k])) {
								var nestedSrc = nestedIframes[k].getAttribute('src');

								if (nestedSrc) {
									nestedIframes[k].setAttribute(BLOCKED_SRC_ATTR, nestedSrc);
									nestedIframes[k].setAttribute(BLOCKED_FLAG_ATTR, 'true');
									nestedIframes[k].removeAttribute('src');
									updateFunctionalEmbedPlaceholder(nestedIframes[k], false);
								}
							}
						}
					}
				}
			}

			syncRecaptchaDeniedClass();
		});

		var target = document.documentElement || document.body;

		if (target) {
			observer.observe(target, { childList: true, subtree: true });
		}
	}

	function isVideoPlayTrigger(target) {
		return !!target.closest('.btn-play1, .btn-play2, .btnVideo, #videobtn, .thumbnail-video a, .btn2-play');
	}

	function handleBlockedInteraction(event) {
		var preferencesBtn = event.target.closest('.gr-video-preferences-btn, .gr-map-preferences-btn, .gr-recaptcha-preferences-btn');

		if (preferencesBtn) {
			event.preventDefault();
			window.openCookiePreferences();
			return;
		}

		if (!consentAllows('functional') && event.target.closest('.map-holder.gr-map-blocked')) {
			event.preventDefault();
			window.openCookiePreferences();
			return;
		}

		if (!consentAllows('functional') && isVideoPlayTrigger(event.target)) {
			event.preventDefault();
			event.stopImmediatePropagation();
			window.openCookiePreferences();
		}
	}

	// ---------------------------------------------------------------------
	// Apply consent -> load whatever is now allowed
	// ---------------------------------------------------------------------
	function applyConsent() {
		updateConsentMode();
		syncRecaptchaDeniedClass();

		if (consentAllows('analytics') || consentAllows('marketing')) {
			try {
				loadTracking();
			} catch (error) {
				// Ignore: do not break the rest of the consent flow.
			}
		} else {
			revokeTracking();
		}

		if (consentAllows('marketing')) {
			try {
				loadZoomInfo();
				loadInsightful();
			} catch (error) {
				// Ignore: do not break the rest of the consent flow.
			}
		} else {
			revokeMarketingExtras();
		}

		if (consentAllows('functional')) {
			try {
				injectRecaptcha();
				loadFunctionalMedia();
			} catch (error) {
				// Ignore: do not break the rest of the consent flow.
			}
		} else {
			resetRecaptcha();
			revokeFunctionalMedia();
			blockCategoryAssets('functional');
		}

		fireThanksPageConversions();
	}

	// ---------------------------------------------------------------------
	// Banner + modal UI
	// ---------------------------------------------------------------------
	function getElements() {
		bannerEl = document.getElementById('gr-cookie-banner');
		overlayEl = document.getElementById('gr-cookie-overlay');
		modalEl = document.getElementById('gr-cookie-modal');
		analyticsInput = document.getElementById('gr-cookie-analytics');
		marketingInput = document.getElementById('gr-cookie-marketing');
		functionalInput = document.getElementById('gr-cookie-functional');
	}

	function setToggleDefaults() {
		if (analyticsInput) {
			analyticsInput.checked = false;
		}
		if (marketingInput) {
			marketingInput.checked = false;
		}
		if (functionalInput) {
			functionalInput.checked = false;
		}
	}

	function setTogglesFromConsent(consent) {
		if (!consent) {
			setToggleDefaults();
			return;
		}

		if (analyticsInput) {
			analyticsInput.checked = !!consent.analytics;
		}
		if (marketingInput) {
			marketingInput.checked = !!consent.marketing;
		}
		if (functionalInput) {
			functionalInput.checked = !!consent.functional;
		}
	}

	function showBanner() {
		if (!bannerEl) {
			return;
		}
		bannerEl.hidden = false;
		bannerEl.setAttribute('aria-hidden', 'false');
	}

	function hideBanner() {
		if (!bannerEl) {
			return;
		}
		bannerEl.hidden = true;
		bannerEl.setAttribute('aria-hidden', 'true');
	}

	function getFocusableElements(container) {
		if (!container) {
			return [];
		}

		return Array.prototype.slice.call(
			container.querySelectorAll(
				'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
			)
		);
	}

	function openModal() {
		if (!modalEl || !overlayEl) {
			return;
		}

		lastFocusedElement = document.activeElement;
		overlayEl.hidden = false;
		modalEl.hidden = false;
		document.body.classList.add('gr-cookie-modal-open');

		var focusable = getFocusableElements(modalEl);
		if (focusable.length) {
			focusable[0].focus();
		}
	}

	function closeModal() {
		if (!modalEl || !overlayEl) {
			return;
		}

		overlayEl.hidden = true;
		modalEl.hidden = true;
		document.body.classList.remove('gr-cookie-modal-open');

		if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
			lastFocusedElement.focus();
		}
	}

	function applyChoiceAndClose(consent) {
		saveConsent(consent);
		applyConsent();
		hideBanner();
		closeModal();
	}

	function acceptAll() {
		applyChoiceAndClose(buildConsent(true, true, true, 'accepted_all'));
	}

	function rejectNonEssential() {
		applyChoiceAndClose(buildConsent(false, false, false, 'rejected_non_essential'));
	}

	function savePreferences() {
		var analytics = analyticsInput ? analyticsInput.checked : false;
		var marketing = marketingInput ? marketingInput.checked : false;
		var functional = functionalInput ? functionalInput.checked : false;
		applyChoiceAndClose(buildConsent(analytics, marketing, functional, 'custom'));
	}

	function handleBannerAction(action) {
		if (action === 'accept-all') {
			acceptAll();
		} else if (action === 'reject-non-essential') {
			rejectNonEssential();
		} else if (action === 'manage-preferences') {
			setTogglesFromConsent(readStoredConsent());
			openModal();
		}
	}

	function handleModalAction(action) {
		if (action === 'accept-all') {
			acceptAll();
		} else if (action === 'reject-non-essential') {
			rejectNonEssential();
		} else if (action === 'save-preferences') {
			savePreferences();
		} else if (action === 'close') {
			closeModal();
		}
	}

	function handleKeydown(event) {
		if (!modalEl || modalEl.hidden) {
			return;
		}

		if (event.key === 'Escape') {
			event.preventDefault();
			closeModal();
			return;
		}

		if (event.key !== 'Tab') {
			return;
		}

		var focusable = getFocusableElements(modalEl);
		if (!focusable.length) {
			return;
		}

		var first = focusable[0];
		var last = focusable[focusable.length - 1];

		if (event.shiftKey && document.activeElement === first) {
			event.preventDefault();
			last.focus();
		} else if (!event.shiftKey && document.activeElement === last) {
			event.preventDefault();
			first.focus();
		}
	}

	function bindEvents() {
		if (bannerEl) {
			bannerEl.addEventListener('click', function (event) {
				var button = event.target.closest('[data-cookie-action]');
				if (button) {
					handleBannerAction(button.getAttribute('data-cookie-action'));
				}
			});
		}

		if (modalEl) {
			modalEl.addEventListener('click', function (event) {
				var button = event.target.closest('[data-cookie-modal-action]');
				if (button) {
					handleModalAction(button.getAttribute('data-cookie-modal-action'));
				}
			});
		}

		if (overlayEl) {
			overlayEl.addEventListener('click', closeModal);
		}

		document.addEventListener('keydown', handleKeydown);
		document.addEventListener('click', handleBlockedInteraction, true);
	}

	// ---------------------------------------------------------------------
	// Public API
	// ---------------------------------------------------------------------
	window.getGrCookieConsent = function () {
		return readStoredConsent();
	};

	window.hasGrConsent = function (category) {
		if (category === 'essential') {
			return true;
		}

		if (category !== 'analytics' &&
			category !== 'marketing' &&
			category !== 'functional') {
			return false;
		}

		return consentAllows(category);
	};

	window.openCookiePreferences = function () {
		getElements();
		setTogglesFromConsent(state || readStoredConsent());
		openModal();
	};

	// Backward-compatible alias used by some theme snippets.
	window.openCookiePreferencesModal = window.openCookiePreferences;

	// ---------------------------------------------------------------------
	// Init
	// ---------------------------------------------------------------------
	function onReady() {
		getElements();
		bindEvents();
		startAssetObserver();

		var consent = readStoredConsent();
		state = consent;

		if (consent) {
			setTogglesFromConsent(consent);
			applyConsent();
			hideBanner();
		} else {
			setToggleDefaults();
			blockNonConsentedAssets();
			showBanner();
		}

		syncRecaptchaDeniedClass();
		fireThanksPageConversions();
	}

	initConsentModeDefaults();
	syncRecaptchaDeniedClass();
	installGtagReportConversion();

	window.addEventListener('grConsentUpdated', function (event) {
		if (event.detail) {
			state = event.detail;
		}
		applyConsent();
	});

	if (!state && !readStoredConsent()) {
		blockNonConsentedAssets();
		startAssetObserver();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}
})();
