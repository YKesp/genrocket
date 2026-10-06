<?php /* Template Name: UDA Webpage */ ?>
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

.custome-section .subheading,
.banner.hero .subheading {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--gr-blue);
    margin-bottom: 14px;
}

.custome-section .ico {
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

.custome-section .ico svg {
    width: 20px;
    height: 20px;
    color: var(--gr-blue);
}

.section-head {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 38px;
}

.custome-section h3 {
    color: var(--dark) !important;
    font-size: 16px;
    font-weight: 600;
    color: var(--gr-navy);
    margin-bottom: 6px;
    line-height: 1.3;
}

.custome-section h4 {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 4px;
}

.custome-section .case {
    background: var(--bg-band);
    border-left: 3px solid var(--gr-green);
    border-radius: 5px;
    padding: 14px 16px;
}

.custome-section .case .label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--gr-green-dark);
    margin-bottom: 5px;
}

.custome-section .case h4 {
    font-size: 14px;
    color: var(--gr-navy);
    font-weight: 600;
    margin-bottom: 6px;
    line-height: 1.3;
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

.keycap-section .inner {
    background: #fff;
    border: 1px solid #E4E9EF;
    border-radius: 14px;
    padding: 28px 24px;
    transition: all 0.25s ease;
    height: calc(100% - 20px);
    margin-bottom: 20px;
}

.indus-section .inner {
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

.indus-section .ind-ico {
    width: 40px;
    height: 40px;
    border-radius: 9px;
    background: linear-gradient(135deg, rgba(0, 183, 228, 0.18), rgba(0, 183, 228, 0.05));
}

.challenges-section table th {
    background: var(--gr-blue-dark);
    color: #fff;
    border-radius: 10px 0 0 0;
    border: 0 !important;
	  padding: 0.75rem 30px;
}

.challenges-section table th:nth-child(2) {
    border-radius: 0 10px 0 0;
}

.challenges-section table {
    border-radius: 30px;
    border: 1px solid #dee2e6;
}

.challenges-section table td {
    background: #fff;
}

.challenges-section table td:nth-child(1) {
    background: var(--bg-band);
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

    .challenges-section table,
    .challenges-section table td,
    .challenges-section table tbody,
    .challenges-section table tr {
        display: block;
        width: 100%;
        border-radius: 0;
    }

    .challenges-section table th,
    .challenges-section table thead {
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

/* .cta-section .btn, .banner.hero .btn{display:inline-block;padding:11px 22px;border-radius:6px;font-weight:600;font-size:14.5px;text-decoration:none;transition:all 0.2s ease;border:2px solid transparent;cursor:pointer;} */
.cta-section {
    color: var(--gr-blue-dark);
}
</style>
<div class="banner hero">
    <?php 
		$claims_document = get_field('claims_document');
		$banner_caption = get_field('banner_caption')

	?>

    <?php if($banner_caption): ?>
    <div class="caption">
        <div class="container">
            <div class="inner">
                <?php //echo get_field('banner_caption'); ?>
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <?php echo $banner_caption; ?>
                        <!-- <span class="subheading">Unstructured Data Accelerator</span>
                        <h1>Unlock unstructured data <span class="accent">for TDM, AI Model Training, and Agentic
                                AI</span> — without exposing PII.</h1>
                        <p class="lede">UDA-Redact uses deep learning to permanently remove PII and PHI from PDFs and
                            images — producing clean, structurally intact data your QA, AI, and Agentic AI teams can
                            actually use.</p>
                        <div class="purpose-pills">
                            <span class="pill">Application TDM</span>
                            <span class="pill">AI Model Training</span>
                            <span class="pill">Agentic AI Training</span>
                        </div>
                        <div class="hero-cta">
                            <a href="#cta" class="btn btn-primary">Request a Demo</a>
                            <a href="#workflow" class="btn btn-primary-outline">See How It Works</a>
                        </div> -->
                    </div>
                    <div class="col-lg-6">
                        <?php if($claims_document): ?>
                        <?php echo $claims_document;?>
                        <?php endif; ?>
                        <!-- <div class="hero-visual" aria-hidden="true">
                            <div class="doc-title">
                                <span>Claims Document — Page 1</span>
                                <span class="status">● PROCESSED</span>
                            </div>
                            <div class="doc-grid">
                                <div class="field flag">
                                    <div class="lbl">Social Security #</div>
                                    <div class="val"><span class="redacted">XXX-XX-XXXX</span></div>
                                </div>
                                <div class="field flag">
                                    <div class="lbl">Patient Name</div>
                                    <div class="val"><span class="redacted">REDACTED&nbsp;&nbsp;&nbsp;</span></div>
                                </div>
                                <div class="field">
                                    <div class="lbl">Claim ID</div>
                                    <div class="val">CL-48201-2025</div>
                                </div>
                                <div class="field">
                                    <div class="lbl">Date of Service</div>
                                    <div class="val">03 / 14 / 2025</div>
                                </div>
                                <div class="field flag">
                                    <div class="lbl">Address</div>
                                    <div class="val"><span class="redacted">REDACTED&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="lbl">Provider NPI</div>
                                    <div class="val">1750398421</div>
                                </div>
                                <div class="field flag">
                                    <div class="lbl">Account #</div>
                                    <div class="val"><span class="redacted">XXXXXXX</span></div>
                                </div>
                                <div class="field">
                                    <div class="lbl">Diagnosis Code</div>
                                    <div class="val">ICD-10 J45.40</div>
                                </div>
                            </div>
                            <div class="doc-foot">
                                <span>Confidence <strong>98.7%</strong></span>
                                <span>Operator <strong>Approved</strong></span>
                                <span>Hash <strong>a3f2…</strong></span>
                            </div>
                        </div> -->
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
		$bottleneck_solve = get_field('bottleneck_solve');
		$howworkssection = get_field('howworks-section');
		$key_capabilities = get_field('key_capabilities');
		$industry_applications = get_field('industry_applications');
		$challenges_solve = get_field('challenges_solve');
		$benefits_delivery = get_field('benefits_delivery');
		$cta_section = get_field('cta-section');
	 ?>
	<?php if($bottleneck_solve) {?>
		<?php echo $bottleneck_solve; ?>
	<?php } ?>
	<?php if($howworkssection) {?>
		<?php echo $howworkssection; ?>
	<?php } ?>
	<?php if($key_capabilities) {?>
		<?php echo $key_capabilities; ?>
	<?php } ?>
	<?php if($industry_applications) {?>
		<?php echo $industry_applications; ?>
	<?php } ?>
	<?php if($challenges_solve) {?>
		<?php echo $challenges_solve; ?>
	<?php } ?>
	<?php if($benefits_delivery) {?>
		<?php echo $benefits_delivery; ?>
	<?php } ?>
	<?php if($cta_section) {?>
		<?php echo $cta_section; ?>
	<?php } ?>
	<?php /* ?>
    <section class="block custome-section">
        <div class="container text-center">
            <div class="section-head text-center">
                <span class="subheading">The Bottleneck We Solve</span>
                <h2>The data your AI and QA teams need is the data your compliance team can't release.</h2>
            </div>
            <p class="para">Every enterprise building AI Models, Agentic AI systems, or modern document-processing applications faces
                the same problem: the unstructured data those systems need — PDFs, scanned forms, images — is exactly
                the data loaded with PII. Manual redaction is slow and inconsistent. Rules-based tools miss non-standard
                fields. <strong>The result: AI and QA teams are starved of the realistic, diverse data they
                    need.</strong></p>
            <p class="para">UDA-Redact breaks this bottleneck with a three-stage workflow — deep learning auto-detection,
                human-in-the-loop operator review, and pixel-level permanent redaction — all inside a single Docker
                container with zero data egress.</p>
        </div>
    </section>
    <section class="block custome-section howworks-section bg-band">
        <div class="container">
            <div class="section-head text-center">
                <span class="subheading">How It Works</span>
                <h2>Three stages. One Docker container. Zero data egress.</h2>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="stage-num">1</div>
                        <h4>Detect</h4>
                        <p class="para">The deep learning model scans the document and identifies PII regions with per-field
                            confidence scores. No rules. No regex. The model understands document structure
                            semantically.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="stage-num">2</div>
                        <h4>Review &amp; Redact</h4>
                        <p class="para">The operator confirms, rejects, or adds manual redactions for anything the model missed.
                            Every decision is logged. Nothing is applied without explicit approval.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="stage-num">3</div>
                        <h4>Export &amp; Train</h4>
                        <p class="para">A pixel-level redacted PDF is saved — clean, structurally intact, safe for AI Model and
                            Agentic AI training. SHA-256 audit log and governance CSV come standard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block custome-section keycap-section">
        <div class="container">
            <div class="section-head text-center">
                <span class="subheading">Key Capabilities</span>
                <h2>Built for QA leaders, AI teams, and the CISOs who sign off.</h2>
            </div>
            <div class="row gap-4">
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m21 21-4.3-4.3" />
                            </svg></div>
                        <h3>ML Auto-Detection &amp; Continuous Learning</h3>
                        <p class="para">Deep learning trained on enterprise document formats identifies SSNs, EINs, names,
                            addresses, account numbers, dates — and improves with every operator correction.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2" />
                            </svg></div>
                        <h3>Human-in-the-Loop Review</h3>
                        <p class="para">Every detection is reviewed and approved by an operator before permanent change is
                            applied. Operators can add manual redactions for anything the model missed.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="10" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg></div>
                        <h3>Pixel-Level Permanent Redaction</h3>
                        <p class="para">Sensitive content is irreversibly removed from the underlying pixels — not overlaid with
                            masks that can be stripped. What's removed stays removed.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2 4 5v7c0 5 3.5 9.5 8 10 4.5-.5 8-5 8-10V5l-8-3z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg></div>
                        <h3>Immutable Audit Log &amp; Governance CSV</h3>
                        <p class="para">SHA-256 chain-of-custody hashing on every redaction. Export a structured CSV with entity
                            type, source, confidence score, operator, timestamp, and file hashes.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="6" rx="1" />
                                <rect x="2" y="14" width="20" height="6" rx="1" />
                                <path d="M6 7h.01M6 17h.01" />
                            </svg></div>
                        <h3>Batch Processing</h3>
                        <p class="para">Drop multiple PDFs or images at once for concurrent processing. Download redacted outputs
                            as a single ZIP. Built for high-volume enterprise workflows.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                            </svg></div>
                        <h3>100% Offline. Zero Data Egress.</h3>
                        <p class="para">Runs entirely inside a single Docker container. No external APIs, no LLMs, no network
                            egress. Deploy on-premise, private cloud, or fully air-gapped.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block custome-section indus-section bg-band">
        <div class="container">
            <div class="section-head text-center">
                <span class="subheading">Industry Applications</span>
                <h2>Built for industries where a single PII leak is a regulatory event.</h2>
            </div>
            <div class="row gap-4">
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="inside">
                            <span class="ind-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="2" x2="12" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg></span>
                            <h3>Financial Services</h3>

                            <p class="para">Automates PII removal from W-2s, pay stubs, loan applications, mortgage packets, and
                                trade confirmations — enabling safe prep for AI training and audit submission under
                                GDPR, CCPA, GLBA, and SOX.</p>
                        </div>
                        <div class="case">
                            <div class="label">Use Case</div>
                            <h4>Mortgage Processing Automation</h4>
                            <p class="para">A regional bank automated PII redaction across tens of thousands of mortgage
                                applications in hours rather than weeks — producing a clean, auditable corpus for
                                training a document classification model.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="inside">
                            <span class="ind-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z" />
                                </svg></span>
                            <h3>Healthcare</h3>

                            <p class="para">Removes PHI and PII from patient intake forms, insurance claims, EOBs, and lab reports
                                with pixel-level permanence — enabling clinical informatics, EHR vendors, and healthcare
                                AI developers to work with realistic samples without HIPAA exposure.</p>
                        </div>
                        <div class="case">
                            <div class="label">Use Case</div>
                            <h4>AI Training for Claims Adjudication</h4>
                            <p class="para">A large healthcare payer processed thousands of historical claims through UDA-Redact,
                                removing all PHI. The corpus enabled full AI Model training coverage — and became
                                the foundation for their Agentic AI claims-routing pipeline.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="inner">
                        <div class="inside">
                            <span class="ind-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3" />
                                </svg></span>
                            <h3>Banking &amp; Insurance</h3>

                            <p class="para">Handles mixed-format documents — policy applications, claims packets, underwriting files,
                                identity documents — identifying PII across structured fields and free-form text regions
                                with high accuracy.</p>
                        </div>
                        <div class="case">
                            <div class="label">Use Case</div>
                            <h4>Insurance Claims Pipeline</h4>
                            <p class="para">A national carrier used UDA-Redact to automate PII removal from thousands of
                                historical claims, producing a diverse test corpus for their OCR and ML
                                classification pipeline — with a full compliance audit record.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="block custome-section challenges-section">
        <div class="container">
            <div class="section-head text-center">
                <span class="subheading">Challenges We Solve</span>
                <h2>The problems QA leaders, AI teams, and compliance officers actually hit.</h2>
            </div>
            <table class="table" width="100%">
                <thead>
                    <th>The Challenge</th>
                    <th>How UDA-Redact Solves It</th>
                </thead>
                <tr>
                    <td>Production unstructured data contains PII that blocks TDM, AI Model training, Agentic AI
                        development, and cross-team sharing.</td>
                    <td><span class="tick">✓</span>Permanently removes PII at the pixel level — producing clean,
                        structurally intact data
                        safe for every downstream pipeline.</td>
                </tr>
                <tr>
                    <td>Rules-based tools miss PII in non-standard fields and produce no auditable record.</td>
                    <td><span class="tick">✓</span>Deep learning detects PII semantically, not just by pattern — and
                        logs every action with
                        SHA-256 chain-of-custody proof.</td>
                </tr>
                <tr>
                    <td>Compliance teams cannot prove what was redacted, when, and by whom.</td>
                    <td><span class="tick">✓</span>Governance CSV export captures entity type, source, confidence score,
                        operator,
                        timestamp, and file hashes per region.</td>
                </tr>
                <tr>
                    <td>Cloud-based redaction services create unacceptable data sovereignty risk.</td>
                    <td><span class="tick">✓</span>100% offline, Docker-native. No external APIs, no LLMs, no network
                        egress. Runs entirely
                        inside your infrastructure.</td>
                </tr>
            </table>
        </div>
    </section>
    <section class="block custome-section bd-section">
        <div class="container">
            <div class="section-head text-center">
                <span class="subheading">Benefits & Delivery</span>
                <h2>What changes when unstructured data is no longer a blocker.</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="row benefits">
                        <div class="col-md-6">
                            <div class="benefit">
                                <div class="b-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg></div>
                                <h4>Compliance &amp; Privacy</h4>
                                <p class="para">Replace PII-dense production documents with permanently redacted, auditable
                                    outputs.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit">
                                <div class="b-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polyline>
                                    </svg></div>
                                <h4>Automation at Scale</h4>
                                <p class="para">Documents redacted in seconds. Thousands of files via batch mode.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit">
                                <div class="b-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 11l3 3L22 4"></path>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                        </path>
                                    </svg></div>
                                <h4>Audit-Ready</h4>
                                <p class="para">Cryptographic proof for every redaction — satisfying GDPR, HIPAA, CCPA, SOX.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="benefit">
                                <div class="b-ico ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4">
                                        </path>
                                    </svg></div>
                                <h4>AI, Agentic &amp; TDM Ready</h4>
                                <p class="para">Feed redacted output into AI pipelines — or into UDA for unlimited synthetic
                                    variants.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="delivery-block">
                        <h3>Redact, then Generate.</h3>
                        <p class="para">Deploy UDA-Redact as a standalone platform — or as stage one of GenRocket's complete
                            document pipeline. Pair with the Unstructured Data Accelerator to turn each redacted
                            document into hundreds of synthetic variants for TDM and AI training.</p>
                        <p style="margin-bottom: 0;">A single <code>docker run</code> deploys the full platform.
                            No GPU required, no external dependencies, no internet access needed.</p>
                        <div class="pipeline">
                            <div class="pipe-step">
                                <div class="title">UDA-Redact</div>
                                <div class="desc">Remove PII permanently</div>
                            </div>
                            <div class="pipe-arrow">→</div>
                            <div class="pipe-step">
                                <div class="title">UDA Generate</div>
                                <div class="desc">Synthetic variants at scale</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section text-center block" id="cta">
        <div class="container text-center">
            <h2>See UDA-Redact on your documents.</h2>
            <p class="para">Bring a sample workload. We'll show you detection accuracy, audit output, and how UDA-Redact fits
                into your TDM, AI Model training, or Agentic AI pipeline.</p>
            <div class="hero-cta justify-content-center">
                <a href="#" class="btn btn-primary">Request a Demo</a>
                <a href="#" class="btn btn-primary-outline">Download the Data Sheet</a>
            </div>
        </div>
    </section>
	<?php */?>
    <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
    <?php if(get_field('additional_editor')): ?>
    <?php echo get_field('additional_editor');?>
    <?php endif; ?>
</main>
<?php get_footer();