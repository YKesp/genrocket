<?php /* Template Name: DataConnect */ ?>
<?php get_header(); ?>
<style>
:root {
    --gr-blue: #27BFF0;
    --gr-blue-dark: #213C4B;
    --gr-navy: #0F2742;
    --gr-green: #8DC63F;
    --gr-green-dark: #6FA02F;
    --ink: #1A2233;
    --bg-band: #E9F0F3;
}

:root {
    --gr-blue: #27BFF0;
    --gr-blue-dark: #213C4B;
    --gr-navy: #0F2742;
    --gr-green: #8DC63F;
    --gr-green-dark: #6FA02F;
    --ink: #1A2233;
    --bg-band: #E9F0F3;
}

.bg-band {
    background: var(--bg-band);
}

.custom-section .subheading,
.banner.hero .subheading {
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--gr-blue);
    margin-bottom: 14px;
}

.custom-section .ico {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    background: linear-gradient(135deg, rgba(0, 183, 228, 0.18), rgba(0, 183, 228, 0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gr-blue-dark);
    margin-bottom: 14px;
}

.custom-section .ico svg {
    width: 20px;
    height: 20px;
    color: var(--gr-blue);
}

.section-head {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 38px;
}

.custom-section h3 {
    color: var(--dark) !important;
    font-size: 16px;
    font-weight: 600;
    color: var(--gr-navy);
    margin-bottom: 6px;
    line-height: 1.3;
}

.custom-section h4 {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 4px;
}

.custom-section .case {
    background: var(--bg-band);
    border-left: 3px solid var(--gr-green);
    border-radius: 5px;
    padding: 14px 16px;
}

.custom-section .case .label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gr-green-dark);
    margin-bottom: 5px;
}

.custom-section .case h4 {
    font-size: 14px;
    color: var(--gr-navy);
    font-weight: 600;
    margin-bottom: 6px;
    line-height: 1.3;
}

.custom-section .col-12 .inner {
	background: #fff;
	border: 1px solid #E4E9EF;
	border-radius: 14px;
	padding: 28px 24px;
	transition: all 0.25s ease;
	height: calc(100% - 20px);
	margin-bottom: 20px;
}
.check-list{
    list-style: none;
    padding: 0;
    margin: 0;
}
.check-list li{
    position: relative;
    padding-left: 20px;
    margin-bottom: 5px;
}
.check-list li:before{
    position: absolute;
    left: 0;
    top:0;
    content:'✔';
}
.bd-section {
    background: #213C4B;
    color: #fff;
}

.bd-section h2 {
    color: #fff !important;
}

.banner.hero {
    background: radial-gradient(ellipse at top right, rgba(0, 183, 228, 0.14), transparent 60%), radial-gradient(ellipse at bottom left, rgba(141, 198, 63, 0.08), transparent 55%), linear-gradient(180deg, #0F2742 0%, #1B3556 100%);
    color: #fff;
    padding: 60px 0 64px;
    position: relative;
    overflow: hidden;
}

.hero h1 {
    font-size: 44px;
    line-height: 1.1;
    font-weight: 700;
    letter-spacing: -0.02em;
    margin-bottom: 18px;
    text-align: left !important;
}

@media screen and (max-width:767px) {
    .banner.hero {
        padding: 0;
    }
}

.banner.hero:before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
}

.banner .caption {
    background: none !important;
    position: static;
}

.solution .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    position: relative;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.solution .inner .stage-num {
    position: absolute;
    top: 0;
    transform: translateY(-50%);
    left: 24px;
    background: var(--gr-blue);
    color: #fff;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0, 183, 228, 0.4);
}

.solution .inner h4 {
    font-size: 18px;
    color: var(--gr-blue-dark);
    font-weight: 700;
    margin: 14px 0 10px;
    letter-spacing: -0.01em;
}

.approach .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.why-section .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.why-section .ind-ico {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    background: linear-gradient(135deg, rgba(0, 183, 228, 0.18), rgba(0, 183, 228, 0.05));
}

.corecap-section, .primaryuse-section {
    background: #213c4b;
}
.corecap-section .section-head, .primaryuse-section .section-head{color: #fff;}
.primaryuse-section .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.howworks-section .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    position: relative;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.howworks-section .inner .stage-num {
    position: absolute;
    top: 0;
    transform: translateY(-50%);
    left: 24px;
    background: var(--gr-blue);
    color: #fff;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 4px 10px rgba(0, 183, 228, 0.4);
}

.howworks-section .inner h4 {
    font-size: 18px;
    color: var(--gr-blue-dark);
    font-weight: 700;
    margin: 14px 0 10px;
    letter-spacing: -0.01em;
}

.pricing .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.enterprise .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.supported .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.bigger .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}
.competitive-section table {
	border-radius: 10px !important;
	border-collapse: separate;
    margin-bottom:30px;
}
.competitive-section table th {
    background: var(--gr-blue-dark);
    color: #fff;
    border-radius: 10px 0 0 0;
    border: 0 !important;
	  padding: 0.75rem 30px;
}

.competitive-section table th:nth-child(2) {
    border-radius: 0;
}

.competitive-section table th:nth-child(3) {
    border-radius: 0;
}

.competitive-section table th:nth-child(4) {
    border-radius: 0 10px 0 0;
    background: var(--gr-green);
    color: #fff;
    border-radius: 0 10px 0 0;
    border: 0 !important;
      padding: 0.75rem 30px;
}

.competitive-section table {
    border-radius: 30px;
    border: 1px solid #dee2e6;
}

.competitive-section table td {
    background: #fff;
}

.competitive-section table td:nth-child(1) {
    background: #fff;
}

.competitive-section table td:nth-child(2) {
    background: #fff;
}

.competitive-section table td:nth-child(3) {
    background: #fff;
}

.competitive-section table td:nth-child(4) {
    background: #edf7d9;
}

.tick {
    color: var(--gr-green-dark);
    font-weight: 700;
    margin-right: 9px;
    font-size: 15px;
}

.benefits {
    row-gap: 30px;
}

.benefit {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--radius);
    padding: 18px 18px;
    border-radius: 14px;
    height: 100%;
}

.delivery-block {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.14);
    border-radius: var(--radius-lg);
    padding: 28px;
    border-radius: 14px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.delivery-block code {
    background: rgba(0, 0, 0, 0.4);
    color: var(--gr-blue);
    padding: 3px 9px;
    border-radius: 4px;
    font-family: "SF Mono", Monaco, Consolas, monospace;
    font-size: 13px;
}

.delivery-block .pipeline {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 18px;
    background: rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    padding: 14px;
}

.delivery-block h3 {
    color: #fff !important;
    font-size: 28px;
    font-weight: 700;
}

.delivery-block .pipe-step {
    flex: 1;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 6px;
    padding: 12px;
    text-align: center;
}

.delivery-block .pipe-step .title {
    color: #fff;
    font-weight: 600;
    font-size: 13.5px;
}

.delivery-block .pipe-step .desc {
    color: #c8d4e1;
    font-size: 11.5px;
    margin-top: 2px;
}

.btn-primary-outline {
    min-width: 186px;
    padding: 11px 20px 9px 20px;
    line-height: 30px;
    border-radius: 10px;
    font-size: clamp(14px, 2vw, 18px);
    font-weight: 700;
    text-transform: uppercase;
    border: 2px solid #24ace3;
    color: #fff !important;
}

.btn-primary-outline:hover {
    background: #24ace3;
}

.cta-section .btn-primary-outline {
    color: #24ace3 !important;
}

.cta-section .btn-primary-outline:hover {
    color: #fff !important;
}

.btn-primary {
    min-width: 186px;
    padding: 13px 20px 9px 20px;
    line-height: 30px;
    border-radius: 10px;
    font-size: clamp(14px, 2vw, 18px);
    font-weight: 700;
    text-transform: uppercase;
    background: #24ace3;
    border: none;
}

.btn-primary:hover {
    background: #24ace3 !important;
}

@media screen and (max-width:991px) {

    .competitive-section table,
    .competitive-section table td,
    .competitive-section table tbody,
    .competitive-section table tr {
        display: block;
        width: 100%;
        border-radius: 0;
    }

    .competitive-section table th,
    .competitive-section table thead {
        display: none;
    }
}

/* Hero visual */
.hero-visual {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
    color: var(--ink);
    transform: perspective(1200px) rotateY(-4deg) rotateX(2deg);
}

.hero-visual .doc-title {
    font-size: 11px;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 12px;
    padding-bottom: 9px;
    border-bottom: 2px solid var(--gr-blue);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.hero-visual .doc-title .status {
    color: var(--gr-green-dark);
    font-weight: 700;
}

.hero-visual .doc-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.hero-visual .field {
    border: 1px solid #E4E9EF;
    border-radius: 4px;
    padding: 7px 9px;
    font-size: 11px;
}

.hero-visual .field .lbl {
    color: #475569;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 3px;
    font-weight: 600;
}

.hero-visual .field .val {
    font-weight: 500;
}

.redacted {
    background: var(--ink);
    color: var(--ink);
    user-select: none;
    border-radius: 2px;
    display: inline-block;
    padding: 0 6px;
    animation: redactPulse 3s ease-in-out infinite;
}

@keyframes redactPulse {

    0%,
    100% {
        box-shadow: 0 0 0 0 rgba(0, 183, 228, 0);
    }

    50% {
        box-shadow: 0 0 0 3px rgba(0, 183, 228, 0.25);
    }
}

.field.flag {
    border-color: var(--gr-blue);
    background: rgba(0, 183, 228, 0.04);
}

.doc-foot {
    margin-top: 12px;
    padding-top: 10px;
    border-top: 1px solid #E4E9EF;
    display: flex;
    justify-content: space-between;
    font-size: 10px;
    color: #475569;
}

.doc-foot strong {
    color: var(--gr-green-dark);
}

/* ====== HERO (~1 scroll) ====== */
.hero h1 .accent {
    color: #a6d540 !important;
}

.purpose-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 26px;
}

.pill {
    background: rgba(0, 183, 228, 0.14);
    border: 1px solid rgba(0, 183, 228, 0.35);
    color: #fff;
    padding: 6px 13px;
    border-radius: 18px;
    font-size: 13px;
    font-weight: 500;
}

.cta-section .hero-cta,
.banner.hero .hero-cta {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.global {
	background: #213C4B;
}
/* .cta-section .btn, .banner.hero .btn{display:inline-block;padding:11px 22px;border-radius:6px;font-weight:600;font-size:14.5px;text-decoration:none;transition:all 0.2s ease;border:2px solid transparent;cursor:pointer;} */
.cta-section {
    color: var(--gr-blue-dark);
}
</style>
<div class="banner hero">
    <?php $banner_caption = get_field('banner_caption'); ?>
    <?php if($banner_caption): ?>
    <div class="caption">
        <div class="container">
            <div class="inner">
                <?php //echo get_field('banner_caption'); ?>
                <div class="row">
                    <div class="col-12">
                        <?php echo $banner_caption; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<main id="main">
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <?php //the_content();
		$problem = get_field('problem');
		$solution = get_field('solution');
		$approach = get_field('approach');
		$why_genrocket = get_field('why_genrocket');
        $core_capabilities = get_field('core_capabilities');
        $howworkssection = get_field('howworks-section');
        $pricing = get_field('pricing');
        $enterprise = get_field('enterprise');
        $bigger = get_field('bigger');
        $primaryusesection = get_field('primaryuse-section');
        $supported = get_field('supported');
		$competitivesection = get_field('competitive-section');
		$ecosystem = get_field('ecosystem');
		$cta_section = get_field('cta_section');
	 ?>
	<?php if($problem) {?>
		<?php echo $problem; ?>
	<?php } ?>
	<?php if($solution) {?>
		<?php echo $solution; ?>
	<?php } ?>
	<?php if($approach) {?>
		<?php echo $approach; ?>
	<?php } ?>
	<?php if($why_genrocket) {?>
		<?php echo $why_genrocket; ?>
    <?php } ?>
    <?php if($core_capabilities) {?>
        <?php echo $core_capabilities; ?>
	<?php } ?>
    <?php if($howworkssection) {?>
        <?php echo $howworkssection; ?>
    <?php } ?>
    <?php if($pricing) {?>
        <?php echo $pricing; ?>
    <?php } ?>
    <?php if($enterprise) {?>
        <?php echo $enterprise; ?>
    <?php } ?>
    <?php if($bigger) {?>
        <?php echo $bigger; ?>
    <?php } ?>
    <?php if($primaryusesection) {?>
        <?php echo $primaryusesection; ?>
    <?php } ?>
    <?php if($supported) {?>
        <?php echo $supported; ?>
    <?php } ?>
	<?php if($competitivesection) {?>
		<?php echo $competitivesection; ?>
	<?php } ?>
	<?php if($ecosystem) {?>
		<?php echo $ecosystem; ?>
        <div class="global">
            <div class="container">
            <div class="global-carousel slider-carousel">
                <div class="mask">
                    <ul class="global-logoes">
                        <?php
                            if ( have_rows( 'global_integrators_images' ) ):
                            while ( have_rows( 'global_integrators_images' ) ):
                            the_row();
                            $image = get_sub_field( 'image' ); 
                        ?>
                        <li><img src="<?php echo $image['url']; ?>" alt="GenRocket Test Data Management - Partners">
                        </li>
                        <?php endwhile;
                            endif; 
                        ?>
                    </ul>
                </div>
                <a href="#" class="btn-prev">
                        <svg width="20" height="45" style="fill: #ffffff;" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                        <path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z" />
                    </svg>
                </a>
            <a href="#" class="btn-next">
                    <svg width="20" height="45" style="fill: #ffffff;" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                    <path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z" />
                </svg>
            </a>
            </div>
            </div>
        </div>
	<?php } ?>
	<?php if($cta_section) {?>
		<?php echo $cta_section; ?>
	<?php } ?>
	<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
    <?php if(get_field('additional_editor')): ?>
    <?php echo get_field('additional_editor');?>
    <?php endif; ?>
</main>
<?php get_footer();