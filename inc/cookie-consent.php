<?php
/**
 * Cookie consent banner markup and styles (GenRocket).
 *
 * WordPress theme integration:
 *   1. In header.php (inside <head>, as early as possible):
 *        <script src="<?php echo esc_url( get_template_directory_uri() . '/js/cookie-consent.js?v=1' ); ?>"></script>
 *   2. Remove analytics, marketing, and functional <script>/<link> tags from
 *      header.php and footer.php — cookie-consent.js injects them only after consent.
 *   3. Remove the GTM <noscript> iframe from header/body (cannot be gated when JS is off).
 *   4. Before </body> in footer.php:
 *        <?php get_template_part( 'include/cookie-consent' ); ?>
 *        — or —
 *        <?php require get_template_directory() . '/include/cookie-consent.php'; ?>
 */
?>
<style id="gr-cookie-consent-styles">
	.inner-dialog {
		max-height: calc(100vh - 245px);
		overflow-y: auto;
	}
	.gr-cookie-banner {
		position: fixed;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 10050;
		background: #fff;
		border-top: 4px solid #40c122;
		box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.15);
		font: 16px/24px Roboto, Catamaran, "Helvetica Neue", Arial, sans-serif;
		color: #1c1c1c;
	}

	.gr-cookie-banner[hidden],
	.gr-cookie-overlay[hidden],
	.gr-cookie-modal[hidden] {
		display: none !important;
	}

	.gr-cookie-banner:not([hidden]) {
		display: block !important;
	}

	.gr-cookie-overlay:not([hidden]) {
		display: block !important;
	}

	.gr-cookie-modal:not([hidden]) {
		display: flex !important;
	}

	.gr-cookie-banner__inner {
		max-width: 1140px;
		margin: 0 auto;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: space-between;
		gap: 20px;
		padding: 20px 15px;
	}

	.gr-cookie-banner__content {
		flex: 1 1 320px;
		min-width: 0;
	}

	.gr-cookie-banner__message {
		margin: 0;
	}

	.gr-cookie-banner__message a {
		color: #40c122;
		font-weight: 600;
		text-decoration: underline;
	}

	.gr-cookie-banner__message a:hover,
	.gr-cookie-banner__message a:focus {
		color: #359a1c;
	}

	.gr-cookie-banner__actions {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		flex: 0 1 auto;
	}

	.gr-cookie-btn {
		display: inline-block;
		font: 700 14px/18px Roboto, Catamaran, "Helvetica Neue", Arial, sans-serif;
		text-transform: uppercase;
		letter-spacing: 0.02em;
		padding: 12px 20px;
		border: 2px solid transparent;
		border-radius: 4px;
		cursor: pointer;
		transition: all 0.2s linear;
		white-space: nowrap;
	}

	.gr-cookie-btn--primary {
		background: #40c122;
		border-color: #40c122;
		color: #fff;
	}

	.gr-cookie-btn--primary:hover,
	.gr-cookie-btn--primary:focus {
		background: #fff;
		color: #40c122;
	}

	.gr-cookie-btn--secondary {
		background: #15181c;
		border-color: #15181c;
		color: #fff;
	}

	.gr-cookie-btn--secondary:hover,
	.gr-cookie-btn--secondary:focus {
		background: #fff;
		color: #15181c;
	}

	.gr-cookie-btn--outline {
		background: #fff;
		border-color: #40c122;
		color: #40c122;
	}

	.gr-cookie-btn--outline:hover,
	.gr-cookie-btn--outline:focus {
		background: #40c122;
		color: #fff;
	}

	.gr-cookie-overlay {
		position: fixed;
		inset: 0;
		z-index: 10060;
		background: rgba(0, 0, 0, 0.55);
	}

	.gr-cookie-modal {
		position: fixed;
		inset: 0;
		z-index: 10070;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 20px 15px;
		overflow-y: auto;
	}

	body.gr-cookie-modal-open {
		overflow: hidden;
	}

	.gr-cookie-modal__dialog {
		position: relative;
		width: 100%;
		max-width: 680px;
		max-height: 95vh;
		overflow-y: auto;
		background: #fff;
		color: #1c1c1c;
		padding: 48px 24px 24px;
		border-radius: 6px;
		box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
		font: 16px/24px Roboto, Catamaran, "Helvetica Neue", Arial, sans-serif;
	}

	.gr-cookie-modal__close {
		position: absolute;
		top: 12px;
		right: 12px;
		width: 36px;
		height: 36px;
		padding: 0;
		border: 1px solid #ccc;
		border-radius: 50%;
		background: #fff;
		color: #333;
		font-size: 22px;
		line-height: 1;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: background 0.2s linear, color 0.2s linear, border-color 0.2s linear;
	}

	.gr-cookie-modal__close:hover,
	.gr-cookie-modal__close:focus {
		background: #40c122;
		border-color: #40c122;
		color: #fff;
		outline: none;
	}

	.gr-cookie-modal__title {
		margin: 0 0 10px;
		padding-right: 40px;
		font: 700 24px/30px Roboto, Catamaran, "Helvetica Neue", Arial, sans-serif;
		color: #15181c;
	}

	.gr-cookie-modal__intro {
		margin: 0 0 24px;
	}

	.gr-cookie-category {
		border-top: 1px solid #e5e5e5;
		padding: 14px 0;
	}

	.gr-cookie-category:first-of-type {
		border-top: none;
		padding-top: 0;
	}

	.gr-cookie-category__header {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 12px;
		margin-bottom: 8px;
	}

	.gr-cookie-category__name {
		margin: 0;
		flex: 1 1 auto;
		font: 700 18px/24px Roboto, Catamaran, "Helvetica Neue", Arial, sans-serif;
	}

	.gr-cookie-category__status {
		font-size: 14px;
		font-weight: 600;
		color: #40c122;
		text-transform: uppercase;
	}

	.gr-cookie-category__desc {
		margin: 0;
		color: #444;
		font-size: 15px;
		line-height: 22px;
	}

	.gr-cookie-toggle {
		position: relative;
		display: inline-flex;
		align-items: center;
		flex-shrink: 0;
	}

	.gr-cookie-toggle__input {
		position: absolute;
		opacity: 0;
		width: 1px;
		height: 1px;
		margin: -1px;
		padding: 0;
		overflow: hidden;
		clip: rect(0, 0, 0, 0);
		white-space: nowrap;
		border: 0;
	}

	.gr-cookie-toggle__label {
		position: relative;
		display: block;
		width: 52px;
		height: 30px;
		background: #ccc;
		border-radius: 30px;
		cursor: pointer;
		transition: background 0.2s linear;
	}

	.gr-cookie-toggle__label::after {
		content: '';
		position: absolute;
		top: 3px;
		left: 3px;
		width: 24px;
		height: 24px;
		background: #fff;
		border-radius: 50%;
		transition: transform 0.2s linear;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	}

	.gr-cookie-toggle__input:checked + .gr-cookie-toggle__label {
		background: #40c122;
	}

	.gr-cookie-toggle__input:checked + .gr-cookie-toggle__label::after {
		transform: translateX(22px);
	}

	.gr-cookie-toggle__input:focus + .gr-cookie-toggle__label {
		outline: 2px solid #40c122;
		outline-offset: 2px;
	}

	.gr-cookie-toggle--locked .gr-cookie-toggle__label {
		background: #40c122;
		cursor: not-allowed;
		opacity: 0.85;
	}

	.gr-cookie-toggle--locked .gr-cookie-toggle__label::after {
		transform: translateX(22px);
	}

	.gr-cookie-sr-only {
		position: absolute;
		width: 1px;
		height: 1px;
		padding: 0;
		margin: -1px;
		overflow: hidden;
		clip: rect(0, 0, 0, 0);
		white-space: nowrap;
		border: 0;
	}

	.gr-cookie-modal__actions {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin-top: 24px;
	}

	.gr-recaptcha-blocked .grecaptcha-badge {
		display: none !important;
	}

	.gr-recaptcha-placeholder,
	.gr-video-cookie-placeholder,
	.gr-map-cookie-placeholder {
		background: #f8f9fa;
		border: 1px solid #dee2e6;
		border-radius: 4px;
		padding: 16px;
		text-align: center;
	}

	.gr-recaptcha-placeholder p,
	.gr-video-cookie-placeholder p,
	.gr-map-cookie-placeholder p {
		margin: 0 0 12px;
		font-size: 14px;
		line-height: 1.5;
		color: #333;
	}

	.gr-video-wrap.gr-video-blocked iframe,
	.map-holder.gr-map-blocked iframe {
		display: none !important;
	}

	.map-holder.gr-map-blocked {
		min-height: 330px;
	}

	.map-holder.gr-map-blocked .gr-map-cookie-placeholder {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		min-height: 330px;
		height: 330px;
		box-sizing: border-box;
	}

	.map-holder iframe {
		width: 100%;
		height: 330px;
	}

	@media (max-width: 767px) {
		.gr-cookie-banner__inner {
			flex-direction: column;
			align-items: stretch;
		}

		.gr-cookie-banner__actions,
		.gr-cookie-modal__actions {
			flex-direction: column;
		}

		.gr-cookie-btn {
			width: 100%;
			text-align: center;
			white-space: normal;
		}

		.gr-cookie-modal__dialog {
			padding: 44px 18px 18px;
		}
	}
</style>

<div id="gr-cookie-banner" class="gr-cookie-banner" role="region" aria-label="Cookie consent" hidden>
	<div class="gr-cookie-banner__inner">
		<div class="gr-cookie-banner__content">
			<p class="gr-cookie-banner__message">
			We use essential cookies for core website functionality, security, and form protection. With your consent, we may also use analytics and functional cookies to improve our site and optional features. <br>
				Read our <a href="https://www.genrocket.com/privacy-policy/">Privacy Policy</a> | <a href="https://www.genrocket.com/cookie-policy/">Cookie Policy</a> | <a href="https://www.genrocket.com/donotsell-my-info/">DoNotSell My Info</a>
			</p>
		</div>
		<div class="gr-cookie-banner__actions">
			<button type="button" class="gr-cookie-btn gr-cookie-btn--primary" data-cookie-action="accept-all">Accept All</button>
			<button type="button" class="gr-cookie-btn gr-cookie-btn--secondary" data-cookie-action="reject-non-essential">Reject Non-Essential</button>
			<button type="button" class="gr-cookie-btn gr-cookie-btn--outline" data-cookie-action="manage-preferences">Manage Preferences</button>
		</div>
	</div>
</div>

<div id="gr-cookie-overlay" class="gr-cookie-overlay" hidden></div>

<div id="gr-cookie-modal"
	class="gr-cookie-modal"
	role="dialog"
	aria-modal="true"
	aria-labelledby="gr-cookie-modal-title"
	aria-describedby="gr-cookie-modal-desc"
	hidden>
	<div class="gr-cookie-modal__dialog">
		<div class="gr-cookie-modal-header">
			<button type="button" class="gr-cookie-modal__close" data-cookie-modal-action="close" aria-label="Close cookie preferences">
			<span aria-hidden="true">&times;</span>
		</button>
		<h2 id="gr-cookie-modal-title" class="gr-cookie-modal__title">Cookie Preferences</h2>
		</div>	
		<div class="inner-dialog">
		<p id="gr-cookie-modal-desc" class="gr-cookie-modal__intro">
			Choose which cookies you allow. Essential cookies are always active because they are required for the site to work.
		</p>

		<div class="gr-cookie-category">
			<div class="gr-cookie-category__header">
				<h3 class="gr-cookie-category__name">Essential Cookies</h3>
				<span class="gr-cookie-toggle gr-cookie-toggle--locked" aria-hidden="true">
					<input type="checkbox"
						id="gr-cookie-essential"
						class="gr-cookie-toggle__input"
						checked
						disabled
						aria-disabled="true"
						aria-label="Essential cookies always enabled">
					<label for="gr-cookie-essential" class="gr-cookie-toggle__label">
						<span class="gr-cookie-sr-only">Essential cookies always enabled</span>
					</label>
				</span>
				<span class="gr-cookie-category__status" aria-live="polite">Always enabled</span>
			</div>
			<p class="gr-cookie-category__desc">Required for core website functionality, security, session handling, and form protection.</p>
		</div>

		<div class="gr-cookie-category">
			<div class="gr-cookie-category__header">
				<h3 class="gr-cookie-category__name">Analytics Cookies</h3>
				<span class="gr-cookie-toggle">
					<input type="checkbox"
						id="gr-cookie-analytics"
						class="gr-cookie-toggle__input"
						aria-describedby="gr-cookie-analytics-desc">
					<label for="gr-cookie-analytics" class="gr-cookie-toggle__label">
						<span class="gr-cookie-sr-only">Enable analytics cookies</span>
					</label>
				</span>
			</div>
			<p id="gr-cookie-analytics-desc" class="gr-cookie-category__desc">
				Help us understand website usage and improve performance.
			</p>
		</div>

		<div class="gr-cookie-category">
			<div class="gr-cookie-category__header">
				<h3 class="gr-cookie-category__name">Marketing Cookies</h3>
				<span class="gr-cookie-toggle">
					<input type="checkbox"
						id="gr-cookie-marketing"
						class="gr-cookie-toggle__input"
						aria-describedby="gr-cookie-marketing-desc">
					<label for="gr-cookie-marketing" class="gr-cookie-toggle__label">
						<span class="gr-cookie-sr-only">Enable marketing cookies</span>
					</label>
				</span>
			</div>
			<p id="gr-cookie-marketing-desc" class="gr-cookie-category__desc">
				Allow advertising and conversion tracking technologies that help us measure the effectiveness of our ads and campaigns.
			</p>
		</div>

		<div class="gr-cookie-category">
			<div class="gr-cookie-category__header">
				<h3 class="gr-cookie-category__name">Functional Cookies</h3>
				<span class="gr-cookie-toggle">
					<input type="checkbox"
						id="gr-cookie-functional"
						class="gr-cookie-toggle__input"
						aria-describedby="gr-cookie-functional-desc">
					<label for="gr-cookie-functional" class="gr-cookie-toggle__label">
						<span class="gr-cookie-sr-only">Enable functional cookies</span>
					</label>
				</span>
			</div>
			<p id="gr-cookie-functional-desc" class="gr-cookie-category__desc">
			Enable optional third-party functionality such as accessibility widgets or embedded services.
			</p>
		</div>

		</div>

		<div class="gr-cookie-modal__actions">
			<button type="button" class="gr-cookie-btn gr-cookie-btn--primary" data-cookie-modal-action="save-preferences">Save Preferences</button>
			<button type="button" class="gr-cookie-btn gr-cookie-btn--secondary" data-cookie-modal-action="accept-all">Accept All</button>
			<button type="button" class="gr-cookie-btn gr-cookie-btn--outline" data-cookie-modal-action="reject-non-essential">Reject Non-Essential</button>
		</div>
	</div>
</div>
