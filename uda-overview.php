<?php
/**
 * Template Name: UDA Overview
 */

get_header();

// ---------- Small helper: get an ACF field with a fallback default ----------
if ( ! function_exists( 'uda_field' ) ) {
	function uda_field( $name, $default = '' ) {
		$value = function_exists( 'get_field' ) ? get_field( $name ) : '';
		return ( $value !== null && $value !== '' && $value !== false ) ? $value : $default;
	}
}

// ---------- Small helper: get repeater rows with a fallback array ----------
if ( ! function_exists( 'uda_rows' ) ) {
	function uda_rows( $name, $fallback = array() ) {
		if ( function_exists( 'have_rows' ) && have_rows( $name ) ) {
			$rows = array();
			while ( have_rows( $name ) ) {
				the_row();
				$rows[] = get_row( true ); // true = return formatted values keyed by field NAME, not raw values keyed by field KEY
			}
			return $rows;
		}
		return $fallback;
	}
}

// ---------- Small helper: get a group field with fallback sub-values ----------
if ( ! function_exists( 'uda_group' ) ) {
	function uda_group( $name, $fallback = array() ) {
		$value = function_exists( 'get_field' ) ? get_field( $name ) : null;
		if ( is_array( $value ) && ! empty( $value ) ) {
			return array_merge( $fallback, array_filter( $value, function ( $v ) {
				return $v !== '' && $v !== null;
			} ) );
		}
		return $fallback;
	}
}
?>

<style>
:root{
    --gr-blue:#27BFF0;
    --gr-blue-dark:#213C4B;
    --gr-navy:#0F2742;
    --gr-green:#8DC63F;
    --gr-green-dark:#6FA02F;
    --ink:#1A2233;
    --gray:#5B6B82;
    --bg-band:#E9F0F3;
    --line:#E4E9EF;
  }
  .uda-overview *{box-sizing:border-box;}
  .uda-overview{
    margin:0; padding:0;
    font-family:'Catamaran', sans-serif;
    color:var(--ink);
    background:#fff;
    font-size:16px;
    line-height:1.6;
  }
  .uda-overview img{max-width:100%; display:block;}
  .uda-overview a{text-decoration:none; color:inherit;}
  .uda-overview .container{max-width:1140px; margin:0 auto; padding:0 24px;}
  .uda-overview h1, .uda-overview h2, .uda-overview h3, .uda-overview h4{margin:0;}

  /* ---- Buttons ---- */
  .uda-overview .btn-primary, .uda-overview .btn-primary-outline{
    display:inline-block !important; min-width:0 !important; width:auto !important;
    padding:10px 18px !important; line-height:1.3 !important;
    border-radius:8px !important; font-size:13.5px !important; font-weight:700 !important; text-transform:uppercase;
    text-align:center; cursor:pointer; border:none;
  }
  .uda-overview .btn-primary{background:#24ace3; color:#fff;}
  .uda-overview .btn-primary:hover{background:#1b96c9;}
  .uda-overview .btn-primary-outline{padding:8px 16px !important; border:2px solid #24ace3 !important; color:#fff; background:transparent;}
  .uda-overview .btn-primary-outline:hover{background:#24ace3;}
  .uda-overview .btn-primary-outline.on-light{border-color:var(--gr-blue-dark); color:var(--gr-blue-dark);}
  .uda-overview .btn-primary-outline.on-light:hover{background:var(--gr-blue-dark); color:#fff;}
  .uda-overview .btn-primary.green{background:var(--gr-green-dark);}
  .uda-overview .btn-primary.green:hover{background:#5c8a28;}
  .uda-overview .hero-cta{display:flex; gap:12px; flex-wrap:wrap; align-items:center;}
  .uda-overview .hero-cta.justify-content-center{justify-content:center;}
  .uda-overview .link-tertiary{color:#C9D6E8; font-size:14px; font-weight:700; border-bottom:1px solid rgba(255,255,255,.4); padding-bottom:4px;}

  /* ---- Section generic ---- */
  .uda-overview section.block{padding:70px 0;}
  .uda-overview .bg-band{background:var(--bg-band);}
  .uda-overview .section-head{text-align:center; max-width:760px; margin:0 auto 38px;}
  .uda-overview .subheading{font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:.12em; color:var(--gr-blue); margin-bottom:14px; display:block;}
  .uda-overview h2{font-size:32px; font-weight:700; letter-spacing:-.01em; line-height:1.25;}
  .uda-overview .para{color:#4B5B6B; font-size:16px; margin:0 0 16px;}
  .uda-overview .text-center{text-align:center;}
  .uda-overview .row{display:flex; flex-wrap:wrap; margin:0 -12px;}
  .uda-overview .row.align-center{align-items:center;}
  .uda-overview .col-lg-4{flex:0 0 33.3333%; max-width:33.3333%; padding:0 12px; box-sizing:border-box;}
  .uda-overview .col-lg-5{flex:0 0 41.6666%; max-width:41.6666%; padding:0 12px; box-sizing:border-box;}
  .uda-overview .col-lg-6{flex:0 0 50%; max-width:50%; padding:0 12px; box-sizing:border-box;}
  .uda-overview .col-lg-7{flex:0 0 58.3333%; max-width:58.3333%; padding:0 12px; box-sizing:border-box;}
  @media (max-width:900px){
    .uda-overview .col-lg-4, .uda-overview .col-lg-5, .uda-overview .col-lg-6, .uda-overview .col-lg-7{flex:0 0 100%; max-width:100%; margin-bottom:24px;}
  }

  /* ---- Hero ---- */
  .uda-overview .banner.hero{
    background:
      radial-gradient(ellipse at top right, rgba(0,183,228,.14), transparent 60%),
      radial-gradient(ellipse at bottom left, rgba(141,198,63,.08), transparent 55%),
      linear-gradient(180deg, #0F2742 0%, #1B3556 100%);
    color:#fff; padding:70px 0 74px; position:relative; overflow:hidden;
  }
  .uda-overview .banner.hero:before{
    content:""; position:absolute; inset:0;
    background-image:linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size:48px 48px; pointer-events:none;
  }
  .uda-overview .banner.hero .container{position:relative; text-align:left;}
  .uda-overview .hero .subheading{text-align:left !important;}
  .uda-overview .hero h1{font-size:42px; line-height:1.18; font-weight:700; letter-spacing:-.02em; margin-bottom:18px; max-width:760px; text-align:left !important;}
  .uda-overview .hero .lede{font-size:18px; color:#C9D6E8; margin:0 0 26px; max-width:680px; text-align:left !important;}
  .uda-overview .path-pills{display:flex; flex-wrap:wrap; gap:12px; margin-bottom:30px;}
  .uda-overview .pill{
    border:1px solid rgba(255,255,255,.28); padding:8px 18px; border-radius:30px; font-size:13.5px;
    font-weight:700; color:#fff; background:rgba(255,255,255,.06);
  }
  .uda-overview .pill.dot-blue::before{content:"● "; color:var(--gr-blue);}
  .uda-overview .pill.dot-green::before{content:"● "; color:var(--gr-green);}

  /* ---- Problem / custom section cards ---- */
  .uda-overview .custome-section .ico{
    width:40px; height:40px; border-radius:9px;
    background:linear-gradient(135deg, rgba(0,183,228,.18), rgba(0,183,228,.05));
    display:flex; align-items:center; justify-content:center; color:var(--gr-blue-dark); margin-bottom:14px;
  }
  .uda-overview .stat-badge{
    display:inline-block; background:var(--gr-navy); color:#fff; font-weight:800; font-size:15px;
    padding:10px 18px; border-radius:8px; margin-bottom:22px;
  }
  .uda-overview .stat-badge .num{color:var(--gr-green); font-size:19px;}
  .uda-overview .img-card{background:#fff; border:1px solid var(--line); border-radius:14px; padding:20px; box-shadow:0 12px 30px rgba(16,30,51,.06);}

  /* Constrain the Problem-section image so it doesn't dominate the row —
     scoped to col-lg-7 (used only by the Problem section on this page) */
  .uda-overview .col-lg-7 .img-card{display:flex; align-items:center; justify-content:center; max-width:480px; margin:0 auto;}
  .uda-overview .col-lg-7 .img-card img{max-height:280px; max-width:100%; width:auto; margin:0 auto; object-fit:contain;}
  .uda-overview .caption{font-size:12.5px; color:var(--gray); margin-top:10px; text-align:center; font-style:italic;}

  /* ---- Two paths ---- */
  .uda-overview .paths{display:flex; gap:28px; margin-bottom:44px; flex-wrap:wrap;}
  .uda-overview .path-card{
    flex:1; min-width:320px; background:#fff; border:1px solid var(--line); border-radius:14px; padding:32px 28px;
    box-shadow:0 14px 34px rgba(16,30,51,.06); position:relative;
  }
  .uda-overview .path-card.redact{border-top:4px solid var(--gr-blue);}
  .uda-overview .path-card.generate{border-top:4px solid var(--gr-green);}
  .uda-overview .path-tag{font-size:12px; font-weight:800; letter-spacing:.1em; margin-bottom:10px;}
  .uda-overview .path-card.redact .path-tag{color:var(--gr-blue-dark);}
  .uda-overview .path-card.generate .path-tag{color:var(--gr-green-dark);}
  .uda-overview .path-card h3{font-size:22px; margin:0 0 12px; color:var(--gr-navy);}
  .uda-overview .path-card p.desc{color:var(--gray); font-size:15px; margin-bottom:22px;}
  .uda-overview .path-card ul{list-style:none; margin:0 0 26px; padding:0;}
  .uda-overview .path-card li{font-size:14.5px; color:var(--ink); padding-left:24px; position:relative; margin-bottom:11px;}
  .uda-overview .path-card.redact li::before{content:"✓"; position:absolute; left:0; color:var(--gr-blue); font-weight:800;}
  .uda-overview .path-card.generate li::before{content:"✓"; position:absolute; left:0; color:var(--gr-green); font-weight:800;}
  .uda-overview .path-card .go{font-weight:800; font-size:14px; display:inline-block; text-decoration:none; cursor:pointer;}
  .uda-overview .path-card .go:hover{text-decoration:underline;}
  .uda-overview .path-card.redact .go{color:var(--gr-blue-dark);}
  .uda-overview .path-card.generate .go{color:var(--gr-green-dark);}

  /* Doc mockups (dark) reused from hero style */
  .uda-overview .doc-mock{background:#0F2742; border-radius:14px; padding:20px 22px; margin-bottom:24px; color:#fff;}
  .uda-overview .doc-mock.green-tone{background:#12331F;}
  .uda-overview .doc-mock .doc-head{display:flex; justify-content:space-between; font-size:11.5px; color:#9FB3CC; margin-bottom:14px; padding-bottom:10px; border-bottom:1px solid rgba(255,255,255,.12);}
  .uda-overview .doc-mock .doc-head .status{color:var(--gr-green); font-weight:700;}
  .uda-overview .doc-row{display:flex; justify-content:space-between; font-size:11.5px; padding:6px 0; border-bottom:1px dashed rgba(255,255,255,.08);}
  .uda-overview .doc-row .label{color:#8CA0BA;}
  .uda-overview .doc-row .val{font-weight:700;}
  .uda-overview .doc-row .val.redacted{background:#3A4A63; color:#3A4A63; border-radius:3px; padding:1px 8px;}
  .uda-overview .doc-row .val.ok{color:#fff;}

  /* ---- Redact -> Generate visual sequence ---- */
  .uda-overview .evo-flow{display:flex; align-items:center; gap:20px; flex-wrap:wrap; justify-content:center;}
  .uda-overview .evo-step{flex:1; min-width:300px; max-width:490px;}
  .uda-overview .evo-arrow{flex:0 0 40px; text-align:center; font-size:28px; color:var(--gray); font-weight:300;}
  .uda-overview .evo-tag{display:inline-block; font-weight:800; font-size:12px; letter-spacing:.08em; padding:7px 14px; border-radius:20px; margin-bottom:14px;}
  .uda-overview .evo-tag.blue{background:rgba(0,183,228,.12); color:var(--gr-blue-dark);}
  .uda-overview .evo-tag.green{background:rgba(141,198,63,.14); color:var(--gr-green-dark);}
  .uda-overview .evo-caption{font-size:13px; color:var(--gray); margin-top:12px; line-height:1.5;}

  /* ---- Workflow (5 stage) ---- */
  .uda-overview .workflow-steps{display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:34px; flex-wrap:wrap; gap:20px;}
  .uda-overview .wf-step{flex:1; min-width:120px; text-align:center; position:relative; padding:0 8px;}
  .uda-overview .wf-step .circle{
    width:52px; height:52px; border-radius:50%; background:#fff; border:3px solid var(--gr-blue);
    color:var(--gr-blue-dark); font-weight:800; font-size:18px; display:flex; align-items:center; justify-content:center;
    margin:0 auto 16px; position:relative; z-index:2;
  }
  .uda-overview .wf-step:nth-child(2) .circle, .uda-overview .wf-step:nth-child(4) .circle{border-color:var(--gr-green); color:var(--gr-green-dark);}
  .uda-overview .wf-step .connector{
    position:absolute; top:26px; left:calc(-50% + 26px); width:calc(100% - 52px); height:3px;
    background:linear-gradient(90deg, var(--gr-blue), var(--gr-green)); z-index:1;
  }
  .uda-overview .wf-step:first-child .connector{display:none;}
  .uda-overview .wf-step .wf-title{font-weight:800; font-size:14.5px; margin-bottom:6px; color:var(--gr-navy);}
  .uda-overview .wf-step .wf-desc{font-size:12.5px; color:var(--gray); padding:0 6px;}

  .uda-overview .fidelity-cards{display:flex; gap:20px; flex-wrap:wrap;}
  .uda-overview .fid-card{flex:1; min-width:220px; background:#fff; border:1px solid var(--line); border-radius:14px; padding:24px 26px;}
  .uda-overview .fid-label{font-weight:800; font-size:13px; letter-spacing:.1em; color:var(--gr-blue-dark); margin-bottom:8px;}
  .uda-overview .fid-card p{font-size:14.5px; color:var(--gray); margin:0;}

  /* ---- When to Use What (guide table) ---- */
  .uda-overview .guide-table{border:1px solid var(--line); border-radius:12px; overflow:hidden; background:#fff; margin-bottom:20px;}
  .uda-overview .guide-row{display:flex; flex-wrap:wrap; border-bottom:1px solid var(--line);}
  .uda-overview .guide-row:last-child{border-bottom:none;}
  .uda-overview .guide-row.guide-head{background:var(--gr-navy);}
  .uda-overview .guide-row.guide-head .guide-situation,
  .uda-overview .guide-row.guide-head .guide-use{color:#fff; font-weight:800; font-size:12px; letter-spacing:.08em; padding:16px 28px;}
  .uda-overview .guide-situation{flex:1; min-width:220px; padding:15px 28px; font-size:15px; color:var(--ink); display:flex; align-items:center;}
  .uda-overview .guide-use{flex:0 0 240px; padding:15px 28px; display:flex; align-items:center; border-left:1px solid var(--line);}
  .uda-overview .guide-row.guide-head .guide-use{border-left-color:rgba(255,255,255,.15);}
  .uda-overview .use-tag{font-weight:800; font-size:12.5px; padding:7px 14px; border-radius:20px; white-space:nowrap;}
  .uda-overview .use-tag.blue{background:rgba(0,183,228,.12); color:var(--gr-blue-dark);}
  .uda-overview .use-tag.green{background:rgba(141,198,63,.14); color:var(--gr-green-dark);}
  .uda-overview .use-tag.combo{background:var(--gr-navy); color:#fff;}
  .uda-overview .rule-of-thumb{font-size:15px; color:var(--gray); text-align:center; font-style:italic;}
  .uda-overview .rule-of-thumb strong{color:var(--ink); font-style:normal;}
  @media (max-width:700px){
    .uda-overview .guide-use{border-left:none; border-top:1px solid var(--line);}
  }

  /* ---- Compare ---- */
  .uda-overview .compare{display:flex; flex-wrap:wrap; border:1px solid var(--line); border-radius:14px; overflow:hidden;}
  .uda-overview .compare .side{flex:1; min-width:280px; padding:40px 36px;}
  .uda-overview .compare .side.blue{background:var(--gr-navy); color:#fff;}
  .uda-overview .compare .side.green{background:#F2F9EC;}
  .uda-overview .compare h4{font-size:19px; margin:0 0 12px;}
  .uda-overview .compare .side.blue h4{color:#fff;}
  .uda-overview .compare .side.green h4{color:var(--gr-green-dark);}
  .uda-overview .compare p{font-size:15px; margin:0;}
  .uda-overview .compare .side.blue p{color:#C9D6E8;}
  .uda-overview .compare .side.green p{color:#3E5C2E;}
  .uda-overview .compare-foot{padding:24px 36px; font-size:15px; color:var(--gray); text-align:center; background:#fff;}

  /* ---- Connect data diagram ---- */
  .uda-overview .connect-diagram{display:flex; align-items:center; justify-content:center; gap:24px; margin-top:40px; flex-wrap:wrap;}
  .uda-overview .cd-box{
    background:#fff; border:1px solid var(--line); border-radius:14px; padding:26px 30px; text-align:center;
    box-shadow:0 10px 24px rgba(16,30,51,.05); min-width:190px;
  }
  .uda-overview .cd-box .ic{
    width:44px; height:44px; border-radius:50%; background:var(--bg-band); color:var(--gr-blue-dark);
    font-weight:800; font-size:13px; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;
  }
  .uda-overview .cd-result .ic{background:var(--gr-green); color:#fff;}
  .uda-overview .cd-box .t{font-weight:800; font-size:14px; color:var(--gr-navy);}
  .uda-overview .cd-box .s{font-size:12px; color:var(--gray); margin-top:4px;}
  .uda-overview .cd-op{font-size:26px; color:var(--gray); font-weight:300;}
  .uda-overview .cd-result{background:var(--gr-navy); color:#fff;}
  .uda-overview .cd-result .t{color:#fff;}
  .uda-overview .cd-result .s{color:#C9D6E8;}

  /* ---- Case studies ---- */
  .uda-overview .cs-grid{display:flex; gap:24px; flex-wrap:wrap;}
  .uda-overview .cs-card{
    flex:1; min-width:300px; background:#fff; border:1px solid var(--line); border-radius:14px; overflow:hidden;
    box-shadow:0 10px 24px rgba(16,30,51,.05); display:block; text-decoration:none; color:inherit;
    transition:transform .18s ease, box-shadow .18s ease;
  }
  .uda-overview a.cs-card-link{cursor:pointer;}
  .uda-overview a.cs-card-link:hover{
    transform:translateY(-3px); box-shadow:0 16px 32px rgba(16,30,51,.12); text-decoration:none; color:inherit;
  }
  .uda-overview .cs-hero{height:130px; background:linear-gradient(135deg, var(--gr-navy), #1B3556); position:relative; display:flex; align-items:flex-end; padding:16px;}
  .uda-overview .cs-pill{display:inline-block; font-size:11px; font-weight:800; letter-spacing:.06em; color:#fff; padding:6px 12px; border-radius:20px; background:rgba(0,0,0,.35);}
  .uda-overview .cs-pill.blue{background:#0E85BC;}
  .uda-overview .cs-pill.green{background:var(--gr-green-dark);}
  .uda-overview .cs-pill.combo{background:var(--gr-navy);}
  .uda-overview .cs-body{padding:22px 24px 26px;}
  .uda-overview .cs-industry{font-size:11.5px; font-weight:800; letter-spacing:.06em; color:var(--gray); margin-bottom:10px; text-transform:uppercase;}
  .uda-overview .cs-card h4{font-size:17px; margin:0 0 12px; line-height:1.3; color:var(--gr-navy);}
  .uda-overview .cs-card p{font-size:13.5px; color:var(--gray); margin:0 0 14px;}
  .uda-overview .cs-result{font-size:13px; color:var(--ink); background:var(--bg-band); border-radius:8px; padding:12px 14px;}
  .uda-overview .cs-result strong{color:var(--gr-green-dark);}

  /* ---- Provisioning dark band ---- */
  .uda-overview .provision{background:var(--gr-navy); color:#fff; text-align:center; padding:68px 0;}
  .uda-overview .provision .container{max-width:840px;}
  .uda-overview .provision h2{color:#fff;}
  .uda-overview .provision p{color:#C9D6E8; font-size:17px; margin-bottom:14px;}
  .uda-overview .provision .tagline{
    margin-top:26px; display:inline-block; border:1px solid rgba(255,255,255,.25); border-radius:30px;
    padding:10px 26px; font-weight:700; font-size:14px; color:var(--gr-green);
  }

  /* ---- Closing CTA ---- */
  .uda-overview .closing{padding:70px 0; text-align:center;}
  .uda-overview .closing h2{margin-bottom:10px;}
  .uda-overview .closing .subhead{margin:0 auto 32px; color:var(--gray); font-size:17px; max-width:640px;}
  .uda-overview .closing-cards{display:flex; gap:22px; max-width:900px; margin:0 auto 36px; flex-wrap:wrap;}
  .uda-overview .closing-card{flex:1; min-width:260px; border:1px solid var(--line); border-radius:14px; padding:28px 26px; text-align:left;}
  .uda-overview .closing-card.blue{border-top:4px solid var(--gr-blue);}
  .uda-overview .closing-card.green{border-top:4px solid var(--gr-green);}
  .uda-overview .closing-card h4{margin:0 0 8px; font-size:18px; color:var(--gr-navy);}
  .uda-overview .closing-card p{margin:0; font-size:14.5px; color:var(--gray);}
  .uda-overview .together-line{font-size:15px; color:var(--gray); margin:20px 0 26px; max-width:640px; margin-left:auto; margin-right:auto;}
</style>

<div class="uda-overview">

<!-- HERO -->
<div class="banner hero">
	<div class="container">
		<span class="subheading"><?php echo esc_html( uda_field( 'hero_subheading', 'Unstructured Data Accelerator' ) ); ?></span>
		<h1><?php echo esc_html( uda_field( 'hero_heading', 'Unlock Unstructured Data for Application Testing and AI Training' ) ); ?></h1>
		<p class="lede"><?php echo esc_html( uda_field( 'hero_lede', "Enterprise applications and AI systems increasingly depend on documents, images, text, and other unstructured data — but much of the most valuable real-world data can't be safely shared. UDA gives you two complementary paths to compliant, high-quality unstructured data." ) ); ?></p>
		<div class="path-pills">
			<div class="pill dot-blue"><?php echo esc_html( uda_field( 'hero_pill_blue', 'UDA-REDACT — Start with real data' ) ); ?></div>
			<div class="pill dot-green"><?php echo esc_html( uda_field( 'hero_pill_green', 'UDA-GENERATE — Create from scratch' ) ); ?></div>
		</div>
		<div class="hero-cta">
			<a href="<?php echo esc_url( uda_field( 'hero_btn_redact_link', '#redact' ) ); ?>" class="btn-primary-outline"><?php echo esc_html( uda_field( 'hero_btn_redact_label', 'Explore UDA-Redact' ) ); ?></a>
			<a href="<?php echo esc_url( uda_field( 'hero_btn_generate_link', '#generate' ) ); ?>" class="btn-primary green"><?php echo esc_html( uda_field( 'hero_btn_generate_label', 'Explore UDA-Generate' ) ); ?></a>
			<a href="<?php echo esc_url( uda_field( 'hero_link_url', '#cta' ) ); ?>" class="link-tertiary"><?php echo esc_html( uda_field( 'hero_link_label', 'Request a Discovery Session →' ) ); ?></a>
		</div>
	</div>
</div>

<main>
	<!-- PROBLEM -->
	<section class="block custome-section">
		<div class="container">
			<div class="row align-center">
				<div class="col-lg-5">
					<span class="subheading"><?php echo esc_html( uda_field( 'problem_subheading', 'The Challenge' ) ); ?></span>
					<h2><?php echo esc_html( uda_field( 'problem_heading', 'The Unstructured Data Problem Is Growing' ) ); ?></h2>
					<div class="stat-badge">Up to <span class="num"><?php echo esc_html( uda_field( 'problem_stat_number', '90%' ) ); ?></span> <?php echo esc_html( uda_field( 'problem_stat_suffix', 'of enterprise data is unstructured*' ) ); ?></div>
					<p class="para"><?php echo esc_html( uda_field( 'problem_para_1', 'AI, Agentic AI, machine learning, and increasingly automated application workflows require larger and more diverse collections of real-world data.' ) ); ?></p>
					<p class="para"><?php echo esc_html( uda_field( 'problem_para_2', 'At the same time, privacy regulation, enterprise security policy, data sovereignty rules, and distributed teams are making production data harder to access than ever.' ) ); ?></p>
					<p class="para" style="color:var(--ink); font-weight:700;"><?php echo esc_html( uda_field( 'problem_para_3', 'The result: a growing gap between the data teams need and the production data enterprises can safely provide.' ) ); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="img-card">
						<img src="<?php echo esc_url( uda_field( 'problem_image', get_stylesheet_directory_uri() . '/assets/image4.png' ) ); ?>" alt="Structured vs unstructured data iceberg">
					</div>
					<div class="caption"><?php echo esc_html( uda_field( 'problem_caption', '*IDC Research — structured data is only the visible tip; unstructured documents, images and media make up the vast majority of enterprise data.' ) ); ?></div>
				</div>
			</div>
		</div>
	</section>

	<!-- TWO PATHS -->
	<section class="block bg-band" id="redact">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'paths_subheading', 'Two Paths, One Platform' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'paths_heading', 'Two Paths to Compliant Unstructured Data' ) ); ?></h2>
				<p class="para"><?php echo esc_html( uda_field( 'paths_intro', 'Pick based on what you have and what you need — or combine both for an end-to-end workflow that evolves production data into scalable synthetic data.' ) ); ?></p>
			</div>

			<div class="paths">
				<?php
				$redact_fallback = array(
					'tag'        => 'UDA-REDACT',
					'title'      => 'Start with Real Data',
					'desc'       => "Use the fidelity of existing production documents while permanently removing the PII/PHI that prevents them from being safely used.",
					'cta_label'  => 'Explore UDA-Redact →',
					'doc_title'  => 'Claims Document — Page 1',
					'doc_status' => '● PROCESSED',
				);
				$redact_card    = uda_group( 'redact_card', $redact_fallback );
				$redact_list    = ( ! empty( $redact_card['list_items'] ) ) ? wp_list_pluck( $redact_card['list_items'], 'item' ) : array(
					'Maximum fidelity to production documents',
					'Existing layouts, formats and naturally occurring edge cases',
					'Auditable, on-prem PII/PHI removal',
					'Production-derived data for testing or AI training',
				);
				$redact_docrows = ( ! empty( $redact_card['doc_rows'] ) ) ? $redact_card['doc_rows'] : array(
					array( 'label' => 'Social Security #', 'value' => 'XXXXXXXXX', 'redacted' => true ),
					array( 'label' => 'Patient Name', 'value' => 'XXXXXXXXX', 'redacted' => true ),
					array( 'label' => 'Claim ID', 'value' => 'CL-48201-2025', 'redacted' => false ),
					array( 'label' => 'Address', 'value' => 'XXXXXXXXX', 'redacted' => true ),
					array( 'label' => 'Provider NPI', 'value' => '1750398421', 'redacted' => false ),
				);
				?>
				<div class="path-card redact">
					<div class="doc-mock">
						<div class="doc-head"><span><?php echo esc_html( $redact_card['doc_title'] ); ?></span><span class="status"><?php echo esc_html( $redact_card['doc_status'] ); ?></span></div>
						<?php foreach ( $redact_docrows as $i => $row ) :
							$is_last = ( $i === count( $redact_docrows ) - 1 );
							?>
							<div class="doc-row" <?php echo $is_last ? 'style="border-bottom:none;"' : ''; ?>>
								<span class="label"><?php echo esc_html( $row['label'] ); ?></span>
								<span class="val <?php echo ! empty( $row['redacted'] ) ? 'redacted' : 'ok'; ?>"><?php echo esc_html( ! empty( $row['redacted'] ) ? str_repeat( 'X', 9 ) : $row['value'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="path-tag"><?php echo esc_html( $redact_card['tag'] ); ?></div>
					<h3><?php echo esc_html( $redact_card['title'] ); ?></h3>
					<p class="desc"><?php echo esc_html( $redact_card['desc'] ); ?></p>
					<ul>
						<?php foreach ( $redact_list as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="go" href="<?php echo esc_url( uda_field( 'hero_btn_redact_link', '#redact' ) ); ?>"><?php echo esc_html( $redact_card['cta_label'] ); ?></a>
				</div>

				<?php
				$generate_fallback = array(
					'tag'        => 'UDA-GENERATE',
					'title'      => 'Create the Data You Need',
					'desc'       => 'Move beyond what happens to exist in production — generate documents, images and unstructured content with fully controlled conditions.',
					'cta_label'  => 'Explore UDA-Generate →',
					'doc_title'  => 'Synthetic Template',
					'doc_status' => '● UNLIMITED VARIANTS',
				);
				$generate_card    = uda_group( 'generate_card', $generate_fallback );
				$generate_list    = ( ! empty( $generate_card['list_items'] ) ) ? wp_list_pluck( $generate_card['list_items'], 'item' ) : array(
					'Unlimited data volume on demand',
					'Positive and negative scenarios',
					"Rare edge cases that don't exist in production",
					'Structured and unstructured data stay logically connected',
				);
				$generate_docrows = ( ! empty( $generate_card['doc_rows'] ) ) ? $generate_card['doc_rows'] : array(
					array( 'label' => 'Volume', 'value' => 'On demand', 'redacted' => false ),
					array( 'label' => 'Scenarios', 'value' => 'Positive + Negative', 'redacted' => false ),
					array( 'label' => 'Edge cases', 'value' => 'Fully controlled', 'redacted' => false ),
					array( 'label' => 'Referential integrity', 'value' => 'Preserved', 'redacted' => false ),
				);
				?>
				<div class="path-card generate" id="generate">
					<div class="doc-mock green-tone">
						<div class="doc-head" style="border-bottom-color:rgba(255,255,255,.12);"><span><?php echo esc_html( $generate_card['doc_title'] ); ?></span><span class="status"><?php echo esc_html( $generate_card['doc_status'] ); ?></span></div>
						<?php foreach ( $generate_docrows as $i => $row ) :
							$is_last = ( $i === count( $generate_docrows ) - 1 );
							?>
							<div class="doc-row" <?php echo $is_last ? 'style="border-bottom:none;"' : ''; ?>>
								<span class="label"><?php echo esc_html( $row['label'] ); ?></span>
								<span class="val ok"><?php echo esc_html( $row['value'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="path-tag"><?php echo esc_html( $generate_card['tag'] ); ?></div>
					<h3><?php echo esc_html( $generate_card['title'] ); ?></h3>
					<p class="desc"><?php echo esc_html( $generate_card['desc'] ); ?></p>
					<ul>
						<?php foreach ( $generate_list as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="go" href="<?php echo esc_url( uda_field( 'hero_btn_generate_link', '#generate' ) ); ?>"><?php echo esc_html( $generate_card['cta_label'] ); ?></a>
				</div>
			</div>

			<?php
			$evo_fallback = array(
				array(
					'tag'     => 'STEP 1 · UDA-REDACT',
					'image'   => get_stylesheet_directory_uri() . '/assets/redact_w2_form.png',
					'caption' => 'Sensitive fields — SSN, name, address, control number — are permanently removed from a real document, leaving a safe, reusable template with the original layout intact.',
				),
				array(
					'tag'     => 'STEP 2 · UDA-GENERATE',
					'image'   => get_stylesheet_directory_uri() . '/assets/image7.png',
					'caption' => 'That template is combined with Design-Driven structured data to generate unlimited realistic variants at scale — no two documents exactly alike.',
				),
			);
			$evo_steps  = uda_rows( 'evo_steps', $evo_fallback );
			$evo_colors = array( 'blue', 'green' );
			?>
			<div class="evo-flow">
				<?php foreach ( $evo_steps as $i => $step ) : ?>
					<?php if ( $i > 0 ) : ?><div class="evo-arrow">→</div><?php endif; ?>
					<div class="evo-step">
						<div class="evo-tag <?php echo esc_attr( $evo_colors[ $i % 2 ] ); ?>"><?php echo esc_html( $step['tag'] ); ?></div>
						<div class="img-card">
							<img src="<?php echo esc_url( $step['image'] ); ?>" alt="<?php echo esc_attr( $step['tag'] ); ?>">
						</div>
						<p class="evo-caption"><?php echo esc_html( $step['caption'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- WHEN TO USE WHAT -->
	<section class="block bg-band">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'guide_subheading', 'A Simple Decision Guide' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'guide_heading', 'When to Use What' ) ); ?></h2>
				<p class="para"><?php echo esc_html( uda_field( 'guide_intro', 'Picking the right path — Redact, Generate, or both — depends on what you have and what you need.' ) ); ?></p>
			</div>
			<?php
			$guide_fallback = array(
				array( 'situation' => 'You have real production documents but PII/PHI blocks usage', 'use_type' => 'blue', 'use_label' => 'UDA-REDACT' ),
				array( 'situation' => "You need volume, edge cases, or negative scenarios that don't exist in production", 'use_type' => 'green', 'use_label' => 'UDA-GENERATE' ),
				array( 'situation' => 'You need realistic and scaled data — fidelity plus volume', 'use_type' => 'combo', 'use_label' => 'REDACT → GENERATE' ),
				array( 'situation' => 'No source data exists (new product, new market, new document type)', 'use_type' => 'green', 'use_label' => 'UDA-GENERATE' ),
				array( 'situation' => 'Cross-border data movement is blocked but you need to test offshore', 'use_type' => 'blue', 'use_label' => 'UDA-REDACT' ),
				array( 'situation' => 'Training AI/ML models that need realistic distributions at scale', 'use_type' => 'combo', 'use_label' => 'REDACT → GENERATE' ),
			);
			$guide_rows = uda_rows( 'guide_rows', $guide_fallback );
			?>
			<div class="guide-table">
				<div class="guide-row guide-head">
					<div class="guide-situation">YOUR SITUATION</div>
					<div class="guide-use">USE</div>
				</div>
				<?php foreach ( $guide_rows as $row ) : ?>
					<div class="guide-row">
						<div class="guide-situation"><?php echo esc_html( $row['situation'] ); ?></div>
						<div class="guide-use"><span class="use-tag <?php echo esc_attr( $row['use_type'] ); ?>"><?php echo esc_html( $row['use_label'] ); ?></span></div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="rule-of-thumb"><strong>Rule of thumb:</strong> <?php echo esc_html( uda_field( 'guide_rule', 'Redact gives fidelity to reality. Generate gives scale and edge cases. Together, you get both.' ) ); ?></div>
		</div>
	</section>

	<!-- WORKFLOW -->
	<section class="block">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'workflow_subheading', 'The End-to-End Workflow' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'workflow_heading', 'Redact → Generate: The Combined Workflow' ) ); ?></h2>
				<p class="para"><?php echo esc_html( uda_field( 'workflow_intro', "Use real data as a seed. Expand it synthetically. Get a corpus that's both realistic and limitless." ) ); ?></p>
			</div>

			<?php
			$wf_fallback = array(
				array( 'title' => 'Real Prod Documents', 'desc' => 'PII/PHI inside' ),
				array( 'title' => 'UDA-Redact', 'desc' => 'Strips PII/PHI, keeps layout' ),
				array( 'title' => 'Seed Dataset', 'desc' => 'Real structure, no PII' ),
				array( 'title' => 'UDA-Generate', 'desc' => 'Volume, variants, negative scenarios' ),
				array( 'title' => 'Test & Training Corpus', 'desc' => 'Realistic + scaled' ),
			);
			$wf_steps = uda_rows( 'workflow_steps', $wf_fallback );
			?>
			<div class="workflow-steps">
				<?php foreach ( $wf_steps as $i => $step ) : ?>
					<div class="wf-step">
						<?php if ( $i > 0 ) : ?><div class="connector"></div><?php endif; ?>
						<div class="circle"><?php echo esc_html( $i + 1 ); ?></div>
						<div class="wf-title"><?php echo esc_html( $step['title'] ); ?></div>
						<div class="wf-desc"><?php echo esc_html( $step['desc'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php
			$fid_fallback = array(
				array( 'label' => 'FIDELITY', 'text' => 'Real layouts, real edge cases — preserved by Redact.' ),
				array( 'label' => 'SCALE', 'text' => 'Unlimited volume and variants — added by Generate.' ),
				array( 'label' => 'COMPLIANCE', 'text' => 'On-prem throughout. No PII ever leaves your boundary.' ),
			);
			$fid_cards       = uda_rows( 'fidelity_cards', $fid_fallback );
			$fid_label_colors = array( '', 'var(--gr-green-dark)', 'var(--ink)' );
			?>
			<div class="fidelity-cards">
				<?php foreach ( $fid_cards as $i => $card ) : ?>
					<div class="fid-card">
						<div class="fid-label" <?php echo ! empty( $fid_label_colors[ $i ] ) ? 'style="color:' . esc_attr( $fid_label_colors[ $i ] ) . ';"' : ''; ?>><?php echo esc_html( $card['label'] ); ?></div>
						<p><?php echo esc_html( $card['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- COMPARE -->
	<section class="block bg-band">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'compare_subheading', 'Two Philosophies, One Goal' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'compare_heading', "Preserve Reality — Or Design What Doesn't Exist" ) ); ?></h2>
			</div>
			<div class="compare">
				<div class="side blue">
					<h4><?php echo esc_html( uda_field( 'compare_blue_title', 'UDA-Redact' ) ); ?></h4>
					<p><?php echo esc_html( uda_field( 'compare_blue_text', 'Preserves what production has already given you — real layouts, real edge cases, real structure — safely.' ) ); ?></p>
				</div>
				<div class="side green">
					<h4><?php echo esc_html( uda_field( 'compare_green_title', 'UDA-Generate' ) ); ?></h4>
					<p><?php echo esc_html( uda_field( 'compare_green_text', 'Creates what production cannot — unlimited volume, rare scenarios, and conditions designed on demand.' ) ); ?></p>
				</div>
			</div>
			<div class="compare-foot"><?php echo esc_html( uda_field( 'compare_foot', 'Together, they let enterprises move from dependency on production data toward controlled, reusable, and scalable unstructured data provisioning.' ) ); ?></div>
		</div>
	</section>

	<!-- CONNECT STRUCTURED / UNSTRUCTURED -->
	<section class="block">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'connect_subheading', 'Works With Your Structured Data' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'connect_heading', 'Connect Unstructured and Structured Data' ) ); ?></h2>
				<p class="para"><?php echo esc_html( uda_field( 'connect_intro', "Enterprise workflows rarely operate on a document alone. UDA-Generate combines unstructured templates with GenRocket's Design-Driven structured synthetic data so related information stays consistent across a complete test or AI training scenario." ) ); ?></p>
			</div>
			<?php
			$connect_fallback = array(
				array( 'icon_text' => 'DOC', 'title' => 'Unstructured Template', 'subtitle' => 'Document / image / text', 'is_result' => false ),
				array( 'icon_text' => 'SYN', 'title' => 'Design-Driven Data', 'subtitle' => 'Structured, conditioned synthetic records', 'is_result' => false ),
				array( 'icon_text' => '✓', 'title' => 'Consistent Scenario', 'subtitle' => 'Referential integrity, end to end', 'is_result' => true ),
			);
			$connect_boxes = uda_rows( 'connect_boxes', $connect_fallback );
			$connect_ops   = array( '+', '=' );
			?>
			<div class="connect-diagram">
				<?php foreach ( $connect_boxes as $i => $box ) : ?>
					<?php if ( $i > 0 ) : ?><div class="cd-op"><?php echo esc_html( $connect_ops[ $i - 1 ] ?? '+' ); ?></div><?php endif; ?>
					<div class="cd-box<?php echo ! empty( $box['is_result'] ) ? ' cd-result' : ''; ?>">
						<div class="ic"><?php echo esc_html( $box['icon_text'] ); ?></div>
						<div class="t"><?php echo esc_html( $box['title'] ); ?></div>
						<div class="s"><?php echo esc_html( $box['subtitle'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CASE STUDIES -->
	<section class="block bg-band">
		<div class="container">
			<div class="section-head text-center">
				<span class="subheading"><?php echo esc_html( uda_field( 'case_studies_subheading', 'Proven in Production' ) ); ?></span>
				<h2><?php echo esc_html( uda_field( 'case_studies_heading', 'Real Results, Real Enterprises' ) ); ?></h2>
				<p class="para"><?php echo esc_html( uda_field( 'case_studies_intro', 'How Fortune 100 and Fortune 500 organizations use UDA-Redact, UDA-Generate, and the combined workflow today.' ) ); ?></p>
			</div>
			<?php
			$cs_fallback = array(
				array(
					'image' => '',
					'pill_type' => 'blue',
					'pill_label' => 'UDA-REDACT',
					'industry' => 'Health Insurance & Healthcare Services · Fortune 100',
					'title' => 'Unlocking Handwritten Clinical Data for Agentic AI Testing',
					'body' => "Physician notes held valuable test signal but also PHI that couldn't enter AI testing environments — and fully synthetic text couldn't replicate real handwriting and clinical complexity. UDA-Redact de-identified typed and handwritten PHI while preserving handwriting, terminology, and structure.",
					'result' => 'A reusable, privacy-safe corpus for testing retrieval, reasoning, and compliance behavior in a live agentic AI platform.',
				),
				array(
					'image' => '',
					'pill_type' => 'green',
					'pill_label' => 'UDA-GENERATE',
					'industry' => 'Diagnostic Information Services · Fortune 500',
					'title' => 'Expanding Laboratory Requisition OCR Test Coverage',
					'body' => 'OCR systems had to hold up against faxes, blur, stains, and handwriting on scanned lab requisitions — without training on PHI-laden production samples. UDA-Generate produced production-faithful synthetic requisitions plus 30+ negative variants with known expected values.',
					'result' => 'Systematic, repeatable OCR regression testing across real-world document conditions, with zero PHI exposure.',
				),
				array(
					'image' => '',
					'pill_type' => 'combo',
					'pill_label' => 'REDACT + GENERATE',
					'industry' => 'Housing Finance · Fortune 100',
					'title' => 'Securing Loan Document Testing at Scale',
					'body' => 'Mortgage notes, deeds of trust, credit reports, and appraisals carried NPI that blocked reuse for QA — and generic templates lacked production realism. UDA-Redact turned real loan documents into reusable templates; UDA-Generate populated them with realistic synthetic values at scale.',
					'result' => "Realistic, compliant loan-document sets for QA testing, with NPI never leaving the organization's environment.",
				),
			);
			$case_studies = uda_rows( 'case_studies', $cs_fallback );
			?>
			<div class="cs-grid">
				<?php foreach ( $case_studies as $cs ) :
					$cs_image      = ! empty( $cs['image'] ) ? $cs['image'] : '';
					$cs_hero_style = $cs_image
						? sprintf(
							'background-image:linear-gradient(180deg, rgba(15,39,66,.15), rgba(15,39,66,.6)), url(%s); background-size:cover; background-position:center;',
							esc_url( $cs_image )
						)
						: '';
					$cs_link = ! empty( $cs['pdf_link'] ) ? $cs['pdf_link'] : '';
					$tag_open  = $cs_link ? '<a class="cs-card cs-card-link" href="' . esc_url( $cs_link ) . '" target="_blank" rel="noopener">' : '<div class="cs-card">';
					$tag_close = $cs_link ? '</a>' : '</div>';
					echo $tag_open;
					?>
						<div class="cs-hero" <?php echo $cs_hero_style ? 'style="' . esc_attr( $cs_hero_style ) . '"' : ''; ?>><span class="cs-pill <?php echo esc_attr( $cs['pill_type'] ); ?>"><?php echo esc_html( $cs['pill_label'] ); ?></span></div>
						<div class="cs-body">
							<div class="cs-industry"><?php echo esc_html( $cs['industry'] ); ?></div>
							<h4><?php echo esc_html( $cs['title'] ); ?></h4>
							<p><?php echo esc_html( $cs['body'] ); ?></p>
							<div class="cs-result"><strong>Result:</strong> <?php echo esc_html( $cs['result'] ); ?></div>
						</div>
					<?php echo $tag_close; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ENTERPRISE PROVISIONING -->
	<div class="provision">
		<div class="container">
			<span class="subheading" style="color:var(--gr-green);"><?php echo esc_html( uda_field( 'provision_subheading', 'The Bigger Picture' ) ); ?></span>
			<h2><?php echo esc_html( uda_field( 'provision_heading', 'From Production Dependency to Enterprise Data Provisioning' ) ); ?></h2>
			<p><?php echo esc_html( uda_field( 'provision_para_1', "GenRocket's Unstructured Data Accelerator extends Enterprise Data Provisioning beyond structured databases." ) ); ?></p>
			<p><?php echo esc_html( uda_field( 'provision_para_2', 'Organizations can begin with production-derived documents made safe through UDA-Redact, transition those documents into reusable templates, and ultimately create controlled synthetic data with UDA-Generate.' ) ); ?></p>
			<div class="tagline"><?php echo esc_html( uda_field( 'provision_tagline', 'The right data. The right characteristics. The right volume. Without depending on unrestricted production access.' ) ); ?></div>
		</div>
	</div>

	<!-- CLOSING CTA -->
	<section class="closing block" id="cta">
		<div class="container">
			<span class="subheading" style="text-align:center; display:block;"><?php echo esc_html( uda_field( 'closing_subheading', 'Get Started' ) ); ?></span>
			<h2><?php echo esc_html( uda_field( 'closing_heading', 'Ready to Put Your Unstructured Data to Work?' ) ); ?></h2>
			<p class="subhead" style="text-align:center;"><?php echo esc_html( uda_field( 'closing_subhead', 'Use either solution independently — or combine them into one end-to-end workflow.' ) ); ?></p>
			<div class="closing-cards">
				<div class="closing-card blue">
					<h4><?php echo esc_html( uda_field( 'closing_blue_title', 'UDA-Redact' ) ); ?></h4>
					<p><?php echo esc_html( uda_field( 'closing_blue_text', 'Make real-world unstructured data safe to use.' ) ); ?></p>
				</div>
				<div class="closing-card green">
					<h4><?php echo esc_html( uda_field( 'closing_green_title', 'UDA-Generate' ) ); ?></h4>
					<p><?php echo esc_html( uda_field( 'closing_green_text', 'Create the unstructured data production cannot provide.' ) ); ?></p>
				</div>
			</div>
			<div class="together-line"><?php echo esc_html( uda_field( 'closing_together_line', 'Or use them together: redact production data, transform it into reusable templates, and generate unlimited synthetic variations.' ) ); ?></div>
			<a href="<?php echo esc_url( uda_field( 'closing_cta_link', 'https://www.genrocket.com/demo-request/' ) ); ?>" class="btn-primary"><?php echo esc_html( uda_field( 'closing_cta_label', 'Request a UDA Discovery Session →' ) ); ?></a>
		</div>
	</section>
</main>

</div><!-- /.uda-overview -->

<?php get_footer(); ?>
