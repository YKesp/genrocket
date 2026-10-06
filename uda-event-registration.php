<?php
/**
 * Template Name: UDA Event Registration
 * Description: Live event registration landing page, content managed via ACF.
 *
 * Companion file:
 *  - acf-uda-event-registration.json  (place in your theme's /acf-json/ folder
 *    so ACF picks it up automatically and registers the fields used below)
 *
 * Branding: font (Catamaran) and color tokens (--gr-blue, --gr-navy, --gr-green,
 * etc.) are matched to uda-overview.php / genrocket.com so this page sits
 * consistently alongside the rest of the site.
 *
 * CSS is inlined below in a <style> block; move it into an enqueued file
 * whenever you're ready, if you'd rather not ship inline styles.
 */

get_header(); // remove this line if this template renders a fully standalone page

// ---- helpers -------------------------------------------------------------
if ( ! function_exists( 'gr_field' ) ) {
	function gr_field( $selector, $default = '', $post_id = null ) {
		$value = function_exists( 'get_field' ) ? get_field( $selector, $post_id ) : '';
		return ( $value !== null && $value !== '' ) ? $value : $default;
	}
}

$register_anchor = '#register';

// Hero
$hero_eyebrow          = gr_field( 'hero_eyebrow', 'Live event registration' );
$hero_title            = gr_field( 'hero_title', 'How to Get Realistic Documents for Testing and AI — Without the Privacy Risk' );
$hero_subtitle         = gr_field( 'hero_subtitle', 'From enterprise applications and intelligent document processing to AI and agentic systems' );
$hero_tags             = gr_field( 'hero_tags', array() );
$hero_description      = gr_field( 'hero_description', "The documents enterprises run on — claims, records, invoices, statements — are packed with PII, PHI, and other sensitive production data. That data cannot be handed to QA teams, AI trainers, or development environments. Yet those are exactly the teams that need realistic documents at volume to test applications and train models. The live discussion covers how teams close that gap." );
$hero_cta_label        = gr_field( 'hero_cta_label', 'Register for the live discussion' );
$hero_cta_link         = gr_field( 'hero_cta_link', $register_anchor );
$hero_secondary_label  = gr_field( 'hero_secondary_label', 'See the challenge ↓' );
$hero_host_line        = gr_field( 'hero_host_line', 'Hosted by Dave Zwicker, CMO, GenRocket · featuring Ullas Kumar, AI Practice Lead, GenRocket' );

// Challenge section
$challenge_eyebrow     = gr_field( 'challenge_eyebrow', 'The unstructured data challenge' );
$challenge_title       = gr_field( 'challenge_title', "The data teams need is the data they can't use" );
$challenge_intro       = gr_field( 'challenge_intro', 'Every enterprise runs on documents like these — and every one of them is a testing and privacy problem.' );
$challenge_image       = gr_field( 'challenge_image', '' );
$challenge_caption     = gr_field( 'challenge_caption', 'Claim forms · healthcare records · invoices · contracts · statements' );
$challenge_cards       = gr_field( 'challenge_cards', array() );
$callout_title         = gr_field( 'callout_title', 'Secure. Compliant. On-demand.' );
$callout_desc          = gr_field( 'callout_desc', 'The right data for development, testing, AI and beyond — generated, not copied.' );
$callout_cta_label     = gr_field( 'callout_cta_label', 'Register for the live discussion' );
$callout_cta_link      = gr_field( 'callout_cta_link', $register_anchor );

// Big picture section
$bigpicture_eyebrow    = gr_field( 'bigpicture_eyebrow', 'The big picture' );
$bigpicture_title      = gr_field( 'bigpicture_title', 'Learn How to Overcome These Challenges' );
$bigpicture_desc       = gr_field( 'bigpicture_desc', 'How to apply unstructured data redaction and unstructured synthetic data generation to make these critical production documents secure, available, and valuable for any test or training requirement.' );
$bigpicture_note       = gr_field( 'bigpicture_note', '45 minutes. Real answers. Bring your hardest questions.' );
$bigpicture_cta_label  = gr_field( 'bigpicture_cta_label', 'Register for the live discussion' );
$bigpicture_cta_link   = gr_field( 'bigpicture_cta_link', $register_anchor );

// Speakers
$speakers_eyebrow      = gr_field( 'speakers_eyebrow', "Who you'll hear from" );
$speakers_title        = gr_field( 'speakers_title', 'Two perspectives on the same shift' );
$speakers              = gr_field( 'speakers', array() );
$speakers_meta_line    = gr_field( 'speakers_meta_line', '~45 min + live Q&A · Live video call (recorded)' );
$speakers_cta_label    = gr_field( 'speakers_cta_label', 'Register for the live discussion →' );
$speakers_cta_link     = gr_field( 'speakers_cta_link', $register_anchor );

// Register CTA section
$register_eyebrow      = gr_field( 'register_eyebrow', 'Register now' );
$register_title        = gr_field( 'register_title', 'Ready to Join the Conversation?' );
$register_desc         = gr_field( 'register_desc', "Save your seat for the live discussion — or register anyway and we'll send you the recording." );
$register_boxes        = gr_field( 'register_boxes', array() );
$register_note         = gr_field( 'register_note', "Either way, you'll get the full conversation." );
$register_cta_label    = gr_field( 'register_cta_label', 'Register for the live discussion →' );
$register_cta_link     = gr_field( 'register_cta_link', $register_anchor );

// Fallbacks so the page still reads correctly before any ACF data is entered
if ( empty( $hero_tags ) ) {
	$hero_tags = array(
		array( 'tag_label' => 'Live — virtual discussion', 'tag_muted' => false ),
		array( 'tag_label' => 'Recorded — podcast release', 'tag_muted' => true ),
	);
}
if ( empty( $challenge_cards ) ) {
	$challenge_cards = array(
		array( 'card_number' => '01', 'card_title' => 'Production documents are a liability', 'card_text' => 'Claims, records, invoices, and statements are packed with PII and PHI. Every copy that reaches a development, test, or training environment is exposure.' ),
		array( 'card_number' => '02', 'card_title' => 'Redaction has to be intelligent — and irreversible', 'card_text' => 'Sensitive values have to be found wherever they hide in a document, then replaced in a way that cannot be reversed, so the document is immediately safe to use.' ),
		array( 'card_number' => '03', 'card_title' => 'Redaction alone is not the answer', 'card_text' => 'Synthetic generation replaces the values with controlled data, giving teams the precise cases they need for testing and model training — at any volume.' ),
	);
}
if ( empty( $speakers ) ) {
	$speakers = array(
		array(
			'speaker_photo' => '',
			'speaker_name'  => 'Ullas Kumar',
			'speaker_role'  => 'AI Practice Lead, GenRocket',
			'speaker_bio_1' => 'As AI Practice Lead at GenRocket, Ullas focuses on secure enterprise data access for AI, data, QE, and security teams — the sanitization, synthesis, and provisioning of structured and unstructured data across financial services, insurance, and healthcare.',
			'speaker_bio_2' => 'From enterprise systems and quality engineering at Infosys to product initiatives at Google, and as Co-Founder of GritWorks.ai, he brings a practical view of how enterprise data architectures are evolving for intelligent document processing, AI, and agentic applications.',
		),
		array(
			'speaker_photo' => '',
			'speaker_name'  => 'Dave Zwicker',
			'speaker_role'  => 'CMO, GenRocket',
			'speaker_bio_1' => 'Dave has spent his career at the intersection of enterprise technology, product strategy, and market development, including Vice President of Solutions Marketing roles at large global technology companies and growth leadership at emerging ones.',
			'speaker_bio_2' => 'For the past decade at GenRocket he has led both marketing and product management across test data management, synthetic data generation, data privacy, and enterprise data provisioning — a broad view of how data requirements are shifting across testing, IDP, AI, and agentic systems.',
		),
	);
}
if ( empty( $register_boxes ) ) {
	$register_boxes = array(
		array( 'box_title' => 'Join live', 'box_text' => 'Ask your questions in real time during the live Q&A.' ),
		array( 'box_title' => "Can't attend live?", 'box_text' => "Register anyway and we'll email you the recording afterward." ),
	);
}
?>

<style>
/* =========================================================
   GenRocket — Live Event Registration
   Brand tokens matched to uda-overview.php (Catamaran + blue/green/navy palette)
   ========================================================= */
@import url('https://fonts.googleapis.com/css2?family=Catamaran:wght@400;500;600;700;800&display=swap');

.gr-page{
  --gr-blue:        #27BFF0;  /* bright accent blue (on dark) */
  --gr-blue-btn:    #24ace3;  /* primary button blue */
  --gr-blue-btn-hover: #1b96c9;
  --gr-blue-dark:   #213C4B;  /* accent blue on light backgrounds */
  --gr-navy:        #0F2742;  /* darkest brand navy */
  --gr-navy-2:      #1B3556;  /* navy gradient stop */
  --gr-green:       #8DC63F;
  --gr-green-dark:  #6FA02F;
  --gr-ink:         #1A2233;  /* body text on light */
  --gr-gray:        #5B6B82;  /* secondary text on light */
  --gr-bg-band:     #E9F0F3;  /* alternate light section */
  --gr-line:        #E4E9EF;  /* hairline borders on light */
  --gr-white:       #FFFFFF;
  --gr-muted-on-dark-1: #C9D6E8; /* body text on navy */
  --gr-muted-on-dark-2: #9FB3CC; /* secondary text on navy */
  --gr-border-dark: rgba(255,255,255,0.14);
  --gr-border-light: rgba(15,39,66,0.1);
}

.gr-page,
.gr-page *{ margin:0; padding:0; box-sizing:border-box; }
.gr-page a{ text-decoration:none; }
.gr-page img{ max-width:100%; }

.gr-page{
  font-family:'Catamaran', sans-serif;
  background: var(--gr-navy);
  color: var(--gr-ink);
  width:100%;
}

/* ---------- shared ---------- */
.gr-eyebrow{
  font-family:'Catamaran', sans-serif;
  font-size:13px;
  font-weight:700;
  letter-spacing:0.12em;
  text-transform:uppercase;
  color: var(--gr-blue);
  margin-bottom:24px;
  display:inline-block;
}

.gr-btn{
  display:inline-block;
  font-weight:700;
  font-size:13.5px;
  text-transform:uppercase;
  letter-spacing:0.03em;
  border-radius:8px;
  text-align:center;
  border:none;
  cursor:pointer;
  transition:background-color .15s ease, color .15s ease, border-color .15s ease;
}
.gr-btn--primary{ background:var(--gr-blue-btn); color:#fff; }
.gr-btn--primary:hover{ background:var(--gr-blue-btn-hover); }
.gr-btn--dark{ background:var(--gr-navy); color:#fff; }
.gr-btn--dark:hover{ background:var(--gr-navy-2); }
.gr-link-arrow{ color:var(--gr-navy); font-weight:700; }

.gr-container{ max-width:1240px; margin:0 auto; padding-left:32px; padding-right:32px; }

/* ---------- hero ---------- */
.gr-hero{
  position:relative; overflow:hidden;
  padding:70px 0 78px;
  background:
    radial-gradient(ellipse at top right, rgba(39,191,240,.14), transparent 60%),
    radial-gradient(ellipse at bottom left, rgba(141,198,63,.08), transparent 55%),
    linear-gradient(180deg, var(--gr-navy) 0%, var(--gr-navy-2) 100%);
}
.gr-hero::before{
  content:""; position:absolute; inset:0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size:48px 48px;
  pointer-events:none;
}
.gr-hero__inner{
  position:relative; z-index:1;
  max-width:1240px; margin:0 auto; padding:0 32px;
  text-align:left !important;
}
.gr-hero__title{
  font-weight:700;
  font-size:clamp(32px,4.4vw,54px); line-height:1.16; letter-spacing:-0.01em;
  margin:0 0 22px; color:#fff; text-align:left !important; text-wrap:wrap;
}
.gr-hero__subtitle{ font-size:18px; line-height:1.5; color:var(--gr-muted-on-dark-1); margin:0 0 32px; text-wrap:pretty; }
.gr-tags{ display:flex; flex-wrap:wrap; gap:12px; margin-bottom:30px; }
.gr-tag{
  font-size:13.5px; font-weight:700; letter-spacing:0.02em;
  padding:8px 18px; border:1px solid rgba(255,255,255,.28); border-radius:30px;
  color:#fff; background:rgba(255,255,255,.06);
}
.gr-tag--muted{ color:var(--gr-muted-on-dark-2); }
.gr-hero__desc{ font-size:16px; line-height:1.6; color:var(--gr-muted-on-dark-1); margin:0 0 36px; text-wrap:pretty; max-width:100% !important; }
.gr-hero__actions{ display:flex; flex-wrap:wrap; gap:12px; align-items:center; margin-bottom:30px; }
.gr-hero__actions .gr-btn--primary{ padding:14px 26px; font-size:14px; }
.gr-hero__secondary{
  color:var(--gr-muted-on-dark-1); font-weight:700; font-size:14px; padding:14px 4px;
  border-bottom:1px solid rgba(255,255,255,.4);
}
.gr-hero__host{ font-size:14px; color:var(--gr-muted-on-dark-2); line-height:1.6; }

/* ---------- challenge (light) section ---------- */
.gr-challenge{ background:var(--gr-white); color:var(--gr-ink); padding:80px 32px 90px; }
.gr-challenge__head{
  display:flex; flex-direction:column; gap:18px; margin-bottom:48px;
}
.gr-challenge__title{
  font-weight:700; font-size:clamp(24px,3vw,40px);
  line-height:1.2; letter-spacing:-0.01em; margin:0; color:var(--gr-navy);
  white-space:nowrap;
}
@media (max-width:640px){
  .gr-challenge__title{ white-space:normal; font-size:28px; }
}
.gr-challenge__intro{ max-width:70ch; font-size:16px; line-height:1.55; color:var(--gr-gray); margin:0; white-space:nowrap; }
@media (max-width:900px){
  .gr-challenge__intro{ white-space:normal; }
}

.gr-figure{ margin:0 0 56px; display:flex; flex-direction:column; gap:14px; }
.gr-figure__frame{
  background:var(--gr-white); border:1px solid var(--gr-line);
  border-radius:14px; padding:8px; overflow:hidden;
  box-shadow:0 12px 30px rgba(16,30,51,.06);
}
.gr-figure__frame img{ display:block; width:100%; height:auto; }
.gr-figure__caption{
  font-size:12.5px; letter-spacing:0.02em; font-style:italic;
  color:var(--gr-gray);
}

.gr-cards{
  list-style:none; margin:0; padding:0;
  display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
  gap:20px;
}
.gr-card{
  background:var(--gr-white); border:1px solid var(--gr-line); border-radius:14px;
  padding:28px 30px 32px; display:flex; flex-direction:column; gap:12px;
  box-shadow:0 14px 34px rgba(16,30,51,.06); border-top:4px solid var(--gr-blue);
}
.gr-card:nth-child(2){ border-top-color:var(--gr-green); }
.gr-card:nth-child(3){ border-top-color:var(--gr-blue); }
.gr-card__num{ font-weight:800; font-size:13px; letter-spacing:.1em; color:var(--gr-blue-dark); }
.gr-card__title{ font-weight:700; font-size:20px; line-height:1.25; letter-spacing:-0.01em; color:var(--gr-navy); }
.gr-card__text{ font-size:15px; line-height:1.6; color:var(--gr-gray); text-wrap:pretty; }

.gr-callout{
  margin-top:36px; background:var(--gr-bg-band); border:1px solid var(--gr-line);
  border-radius:14px; padding:28px 32px; display:flex; flex-wrap:wrap; gap:24px; align-items:center; justify-content:space-between;
}
.gr-callout__copy{ flex:1 1 420px; }
.gr-callout__title{ font-weight:700; font-size:19px; letter-spacing:-0.01em; margin-bottom:8px; color:var(--gr-navy); }
.gr-callout__desc{ font-size:15px; line-height:1.6; color:var(--gr-gray); }
.gr-callout .gr-btn{ padding:13px 22px; font-size:13px; }

/* ---------- big picture (dark) section ---------- */
.gr-bigpicture{
  padding:90px 32px;
  background:
    radial-gradient(ellipse at top right, rgba(39,191,240,.12), transparent 60%),
    radial-gradient(ellipse at bottom left, rgba(141,198,63,.1), transparent 55%),
    linear-gradient(180deg, var(--gr-navy) 0%, var(--gr-navy-2) 100%);
}
.gr-bigpicture__inner{ max-width:1240px; margin:0 auto; display:flex; flex-direction:column; gap:56px; }
.gr-bigpicture__copy{ max-width:860px; }
.gr-bigpicture__title{
  font-weight:700; font-size:clamp(30px,3.8vw,46px);
  line-height:1.18; letter-spacing:-0.01em; margin:0 0 24px; color:#fff; text-wrap:balance;
}
.gr-bigpicture__desc{ font-size:17px; line-height:1.55; color:var(--gr-muted-on-dark-1); margin:0 0 28px; text-wrap:pretty; }
.gr-bigpicture__note{ font-size:14px; font-weight:700; letter-spacing:0.02em; color:#fff; margin:0 0 28px; }
.gr-bigpicture .gr-btn{ padding:14px 26px; font-size:14px; }

/* ---------- speakers (white) section ---------- */
.gr-speakers{ background:var(--gr-white); color:var(--gr-ink); padding:80px 32px 90px; }
.gr-speakers__head{ margin-bottom:56px; }
.gr-speakers__title{
  font-weight:700; font-size:clamp(30px,3.6vw,42px);
  line-height:1.2; letter-spacing:-0.01em; margin:0; color:var(--gr-navy);
}
.gr-speakers__grid{
  display:grid; grid-template-columns:repeat(auto-fit,minmax(400px,1fr));
  gap:24px;
}
.gr-speaker{
  background:var(--gr-white); border:1px solid var(--gr-line); border-radius:14px;
  padding:28px 30px; display:flex; flex-direction:column; gap:22px;
  box-shadow:0 14px 34px rgba(16,30,51,.06);
}
.gr-speaker__top{ display:flex; gap:20px; align-items:center; }
.gr-speaker__photo{
  flex:0 0 84px; width:84px; height:84px; border-radius:50%;
  border:3px solid var(--gr-blue);
  background-image:repeating-linear-gradient(135deg, rgba(15,39,66,.06) 0 8px, transparent 8px 16px);
  display:flex; align-items:center; justify-content:center;
  font-size:9px; font-weight:700; color:var(--gr-gray);
  text-align:center; line-height:1.3; overflow:hidden;
}
.gr-speaker__photo img{ width:100%; height:100%; object-fit:cover; border-radius:50%; }
.gr-speaker__name{ font-weight:700; font-size:22px; letter-spacing:-0.01em; line-height:1.25; color:var(--gr-navy); }
.gr-speaker__role{ font-size:12px; font-weight:800; letter-spacing:0.08em; text-transform:uppercase; color:var(--gr-blue-dark); margin-top:6px; }
.gr-speaker__bio{ font-size:15px; line-height:1.6; color:var(--gr-gray); margin:0; text-wrap:pretty; }

.gr-speakers__footer{
  margin-top:48px; padding-top:26px; border-top:1px solid var(--gr-line);
  display:flex; flex-wrap:wrap; gap:20px; align-items:center; justify-content:space-between;
}
.gr-speakers__meta{ font-size:13px; font-weight:600; color:var(--gr-gray); }

/* ---------- register CTA (band) section ---------- */
.gr-register{ background:var(--gr-bg-band); color:var(--gr-ink); padding:90px 32px; }
.gr-register__inner{ max-width:1000px; margin:0 auto; text-align:center; }
.gr-register__title{
  font-weight:700; font-size:clamp(30px,4vw,46px);
  line-height:1.18; letter-spacing:-0.01em; margin:0 0 18px; color:var(--gr-navy); text-wrap:balance;
}
.gr-register__desc{ font-size:17px; line-height:1.55; color:var(--gr-gray); margin:0 auto 44px; max-width:56ch; text-wrap:pretty; }
.gr-register__grid{
  display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:22px; text-align:left; margin-bottom:40px;
}
.gr-register__box{ background:var(--gr-white); border:1px solid var(--gr-line); border-radius:14px; padding:28px; }
.gr-register__box-title{ font-size:17px; font-weight:700; margin-bottom:8px; color:var(--gr-navy); }
.gr-register__box-text{ font-size:14.5px; line-height:1.55; color:var(--gr-gray); }
.gr-register__note{ font-size:13px; font-weight:600; letter-spacing:0.02em; color:var(--gr-gray); margin:0 0 24px; font-style:italic; }
.gr-register .gr-btn{ padding:15px 30px; font-size:14.5px; }
</style>

<div class="gr-page">

	<section class="gr-hero" data-screen-label="Hero">
		<div class="gr-hero__inner">
			<div class="gr-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></div>
			<h1 class="gr-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="gr-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>

			<div class="gr-tags">
				<?php foreach ( $hero_tags as $tag ) : ?>
					<span class="gr-tag<?php echo ! empty( $tag['tag_muted'] ) ? ' gr-tag--muted' : ''; ?>"><?php echo esc_html( $tag['tag_label'] ); ?></span>
				<?php endforeach; ?>
			</div>

			<p class="gr-hero__desc"><?php echo esc_html( $hero_description ); ?></p>

			<div class="gr-hero__actions">
				<a href="<?php echo esc_url( $hero_cta_link ); ?>" class="gr-btn gr-btn--primary"><?php echo esc_html( $hero_cta_label ); ?></a>
				<a href="#cover" class="gr-hero__secondary"><?php echo esc_html( $hero_secondary_label ); ?></a>
			</div>

			<div class="gr-hero__host"><?php echo esc_html( $hero_host_line ); ?></div>
		</div>
	</section>

	<section id="cover" class="gr-challenge" data-screen-label="The challenge">
		<div class="gr-container">

			<div class="gr-challenge__head">
				<div class="gr-challenge__head-main">
					<div class="gr-eyebrow"><?php echo esc_html( $challenge_eyebrow ); ?></div>
					<h2 class="gr-challenge__title"><?php echo esc_html( $challenge_title ); ?></h2>
				</div>
				<p class="gr-challenge__intro"><?php echo esc_html( $challenge_intro ); ?></p>
			</div>

			<figure class="gr-figure">
				<div class="gr-figure__frame">
					<?php if ( $challenge_image ) : ?>
						<img src="<?php echo esc_url( is_array( $challenge_image ) ? $challenge_image['url'] : $challenge_image ); ?>" alt="Insurance claim form, healthcare record, invoice, contract, and bank statement">
					<?php else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/hero_image.png' ); ?>" alt="Insurance claim form, healthcare record, invoice, contract, and bank statement">
					<?php endif; ?>
				</div>
				<figcaption class="gr-figure__caption"><?php echo esc_html( $challenge_caption ); ?></figcaption>
			</figure>

			<ol class="gr-cards">
				<?php foreach ( $challenge_cards as $card ) : ?>
					<li class="gr-card">
						<span class="gr-card__num"><?php echo esc_html( $card['card_number'] ); ?></span>
						<span class="gr-card__title"><?php echo esc_html( $card['card_title'] ); ?></span>
						<span class="gr-card__text"><?php echo esc_html( $card['card_text'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>

			<div class="gr-callout">
				<div class="gr-callout__copy">
					<div class="gr-callout__title"><?php echo esc_html( $callout_title ); ?></div>
					<div class="gr-callout__desc"><?php echo esc_html( $callout_desc ); ?></div>
				</div>
				<a href="<?php echo esc_url( $callout_cta_link ); ?>" class="gr-btn gr-btn--dark"><?php echo esc_html( $callout_cta_label ); ?></a>
			</div>

		</div>
	</section>

	<section class="gr-bigpicture" data-screen-label="The big picture">
		<div class="gr-bigpicture__inner">
			<div class="gr-bigpicture__copy">
				<div class="gr-eyebrow"><?php echo esc_html( $bigpicture_eyebrow ); ?></div>
				<h2 class="gr-bigpicture__title"><?php echo esc_html( $bigpicture_title ); ?></h2>
				<p class="gr-bigpicture__desc"><?php echo esc_html( $bigpicture_desc ); ?></p>
				<p class="gr-bigpicture__note"><?php echo esc_html( $bigpicture_note ); ?></p>
				<a href="<?php echo esc_url( $bigpicture_cta_link ); ?>" class="gr-btn gr-btn--primary"><?php echo esc_html( $bigpicture_cta_label ); ?></a>
			</div>
		</div>
	</section>

	<section class="gr-speakers" data-screen-label="Speakers">
		<div class="gr-container">
			<div class="gr-speakers__head">
				<div class="gr-eyebrow"><?php echo esc_html( $speakers_eyebrow ); ?></div>
				<h2 class="gr-speakers__title"><?php echo esc_html( $speakers_title ); ?></h2>
			</div>

			<div class="gr-speakers__grid">
				<?php foreach ( $speakers as $speaker ) : ?>
					<article class="gr-speaker">
						<div class="gr-speaker__top">
							<div class="gr-speaker__photo">
								<?php if ( ! empty( $speaker['speaker_photo'] ) ) :
									$photo = $speaker['speaker_photo'];
									?>
									<img src="<?php echo esc_url( is_array( $photo ) ? $photo['url'] : $photo ); ?>" alt="<?php echo esc_attr( $speaker['speaker_name'] ); ?>">
								<?php else : ?>
									head<br>shot
								<?php endif; ?>
							</div>
							<div>
								<div class="gr-speaker__name"><?php echo esc_html( $speaker['speaker_name'] ); ?></div>
								<div class="gr-speaker__role"><?php echo esc_html( $speaker['speaker_role'] ); ?></div>
							</div>
						</div>
						<?php if ( ! empty( $speaker['speaker_bio_1'] ) ) : ?>
							<p class="gr-speaker__bio"><?php echo esc_html( $speaker['speaker_bio_1'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $speaker['speaker_bio_2'] ) ) : ?>
							<p class="gr-speaker__bio"><?php echo esc_html( $speaker['speaker_bio_2'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="gr-speakers__footer">
				<div class="gr-speakers__meta"><?php echo esc_html( $speakers_meta_line ); ?></div>
				<a href="<?php echo esc_url( $speakers_cta_link ); ?>" class="gr-link-arrow"><?php echo esc_html( $speakers_cta_label ); ?></a>
			</div>
		</div>
	</section>

	<section id="register" class="gr-register" data-screen-label="Register now">
		<div class="gr-register__inner">
			<div class="gr-eyebrow"><?php echo esc_html( $register_eyebrow ); ?></div>
			<h2 class="gr-register__title"><?php echo esc_html( $register_title ); ?></h2>
			<p class="gr-register__desc"><?php echo esc_html( $register_desc ); ?></p>

			<div class="gr-register__grid">
				<?php foreach ( $register_boxes as $box ) : ?>
					<div class="gr-register__box">
						<div class="gr-register__box-title"><?php echo esc_html( $box['box_title'] ); ?></div>
						<div class="gr-register__box-text"><?php echo esc_html( $box['box_text'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>

			<p class="gr-register__note"><?php echo esc_html( $register_note ); ?></p>
			<a href="<?php echo esc_url( $register_cta_link ); ?>" class="gr-btn gr-btn--dark"><?php echo esc_html( $register_cta_label ); ?></a>
		</div>
	</section>

</div>

<?php get_footer(); // remove this line if this template renders a fully standalone page ?>
