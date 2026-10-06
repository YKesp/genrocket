<?php
/* Template Name: The Data Quality Evolution Index Landing */
get_header();
?>

<style>
  :root {
    --blue: #27BFF0;
    --blue-deep: #23A6DE;
    --green: #A6D540;
    --green-deep: #6DBF42;
    --ink: #213C4B;
    --ink-deep: #162C38;
    --ink-soft: #2C4F62;
    --mist: #E9F0F3;
    --orange-1: #C04F15;
    --orange-2: #ED7D31;
    --amber: #FFC000;
    --purple: #5C3497;
  }

  .dqe-landing-wrapper {
    font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
    color: #213C4B;
    background: #fff;
    -webkit-font-smoothing: antialiased;
    line-height: 1.5;
  }

  .dqe-landing-wrapper a { color: var(--blue-deep); text-decoration: none; }
  .dqe-landing-wrapper a:hover { text-decoration: underline; }
  .dqe-landing-wrapper button { font-family: inherit; cursor: pointer; border: none; background: none; }

  .dqe-landing-wrapper section { padding: 64px 32px; border-bottom: 1px solid rgba(33,60,75,0.06); }
  @media (max-width: 700px) { .dqe-landing-wrapper section { padding: 40px 20px; } }
  .dqe-landing-wrapper .wrap { max-width: 1180px; margin: 0 auto; }
  .dqe-landing-wrapper .wrap-narrow { max-width: 920px; margin: 0 auto; }

  .dqe-landing-wrapper .eyebrow {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--blue-deep);
    margin-bottom: 16px;
  }

  .dqe-landing-wrapper h2 {
    font-size: clamp(26px, 3.6vw, 36px);
    font-weight: 700;
    line-height: 1.15;
    letter-spacing: -0.02em;
    color: var(--ink);
    margin-bottom: 20px;
    max-width: 820px;
  }

  .dqe-landing-wrapper h3 {
    font-size: 20px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
    letter-spacing: -0.01em;
  }

  .dqe-landing-wrapper .lede {
    font-size: 17px;
    line-height: 1.6;
    color: var(--ink);
    opacity: 0.88;
    max-width: 760px;
  }
  .dqe-landing-wrapper .lede strong { color: var(--ink); opacity: 1; font-weight: 700; }

  .dqe-landing-wrapper .bullet-list { list-style: none; padding: 0; margin: 0; }
  .dqe-landing-wrapper .bullet-list li {
    position: relative;
    padding: 6px 0 6px 24px;
    font-size: 15px;
    line-height: 1.55;
    color: var(--ink);
    opacity: 0.88;
  }
  .dqe-landing-wrapper .bullet-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 14px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--blue);
  }
  .dqe-landing-wrapper .bullet-list li strong { color: var(--ink); opacity: 1; font-weight: 700; }

  /* ---------- Hero ---------- */
  .dqe-landing-wrapper .hero {
    background:
      radial-gradient(ellipse 80% 60% at 72% 0%, rgba(39,191,240,0.20) 0%, transparent 55%),
      radial-gradient(ellipse 60% 50% at 8% 100%, rgba(166,213,64,0.12) 0%, transparent 50%),
      linear-gradient(160deg, #162C38 0%, #213C4B 52%, #132834 100%);
    padding: 84px 32px 72px;
    position: relative;
    overflow: hidden;
    color: #fff;
  }
  .dqe-landing-wrapper .hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
    background-size: 44px 44px;
    pointer-events: none;
  }
  .dqe-landing-wrapper .hero-grid {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 7fr 5fr;
    gap: 56px;
    align-items: center;
    max-width: 1180px;
    margin: 0 auto;
  }
  @media (max-width: 900px) { .dqe-landing-wrapper .hero-grid { grid-template-columns: 1fr; gap: 40px; } }

  .dqe-landing-wrapper .hero h1 {
    font-size: clamp(30px, 4.4vw, 46px);
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.025em;
    color: #fff;
    margin-bottom: 20px;
    max-width: 780px;
	  text-align:left !important;
  }
  .dqe-landing-wrapper .hero h1 .blue { color: var(--blue); }
  .dqe-landing-wrapper .hero h1 .green { color: var(--green); }
  .dqe-landing-wrapper .hero .eyebrow { color: var(--green); }
  .dqe-landing-wrapper .hero-sub {
    font-size: 17px;
    line-height: 1.6;
    color: rgba(255,255,255,0.84);
    margin-bottom: 24px;
    max-width: 650px;
  }
  .dqe-landing-wrapper .hero-sub strong { color: #fff; font-weight: 600; }
  .dqe-landing-wrapper .hero-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
  .dqe-landing-wrapper .pill {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.18);
    color: rgba(255,255,255,0.9);
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 500;
    backdrop-filter: blur(4px);
  }

  .dqe-landing-wrapper .cta-row { display: flex; flex-wrap: wrap; gap: 12px; }
  .dqe-landing-wrapper .btn {
    padding: 14px 26px;
    border-radius: 7px;
    font-weight: 600;
    font-size: 15px;
    transition: transform 0.15s, opacity 0.15s, box-shadow 0.15s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
  }
  .dqe-landing-wrapper .btn:hover { transform: translateY(-1px); text-decoration: none; }
  .dqe-landing-wrapper .btn-accent,
  .dqe-landing-wrapper .btn-primary {
    background: linear-gradient(135deg, #27BFF0 0%, #23A6DE 100%);
    color: #fff;
    box-shadow: 0 6px 18px rgba(39,191,240,0.25);
  }
  .dqe-landing-wrapper .btn-accent:hover { box-shadow: 0 8px 24px rgba(39,191,240,0.4); }
  .dqe-landing-wrapper .btn-ghost { background: transparent; color: var(--ink); border: 1px solid var(--ink); }
  .dqe-landing-wrapper .btn-green { background: var(--green-deep); color: #fff; }
  .dqe-landing-wrapper .hero .btn-ghost,
  .dqe-landing-wrapper .assess-cta .btn-ghost,
  .dqe-landing-wrapper .explorer .btn-ghost {
    color: #fff;
    border-color: rgba(255,255,255,0.38);
  }
  .dqe-landing-wrapper .hero .btn-ghost:hover,
  .dqe-landing-wrapper .assess-cta .btn-ghost:hover,
  .dqe-landing-wrapper .explorer .btn-ghost:hover {
    border-color: var(--blue);
    background: rgba(39,191,240,0.1);
  }

  /* Hero visual Maturity levels card */
  .dqe-landing-wrapper .hero-visual {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    padding: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35), 0 0 0 1px rgba(39,191,240,0.1);
  }
  .dqe-landing-wrapper .level-row-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    background: #f6fafc;
    border: 1px solid rgba(33,60,75,0.06);
    border-radius: 10px;
    margin-bottom: 10px;
    transition: transform 0.15s, background 0.15s;
  }
  .dqe-landing-wrapper .level-row-item:hover { background: #eef6fa; transform: translateX(3px); }
  .dqe-landing-wrapper .level-badge-num {
    width: 36px; height: 36px;
    border-radius: 50%;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }

  /* ---------- Problem Section ---------- */
  .dqe-landing-wrapper .problem {
    background:
      radial-gradient(ellipse 65% 45% at 95% 0%, rgba(39,191,240,0.08), transparent 55%),
      #ffffff;
  }
  .dqe-landing-wrapper .problem-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
  }
  @media (max-width: 800px) { .dqe-landing-wrapper .problem-grid { grid-template-columns: 1fr; gap: 32px; } }

  .dqe-landing-wrapper .ladder-step {
    background: #fff;
    border: 1px solid rgba(33,60,75,0.08);
    border-left: 4px solid var(--blue);
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 12px;
    box-shadow: 0 8px 22px rgba(33,60,75,0.06);
    transition: transform 0.18s ease, box-shadow 0.18s ease;
  }
  .dqe-landing-wrapper .ladder-step:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(33,60,75,0.1);
  }

  /* ---------- Dimensions Section (Accordion) ---------- */
  .dqe-landing-wrapper .dimensions {
    background:
      radial-gradient(ellipse 60% 45% at 12% 0%, rgba(39,191,240,0.12), transparent 55%),
      radial-gradient(ellipse 50% 45% at 90% 100%, rgba(166,213,64,0.10), transparent 55%),
      linear-gradient(160deg, #213C4B 0%, #162C38 100%);
    color: #fff;
  }
  .dqe-landing-wrapper .dimensions h2,
  .dqe-landing-wrapper .dimensions .lede { color: #fff; }
  .dqe-landing-wrapper .dimensions .eyebrow { color: var(--green); }

  .dqe-landing-wrapper .acc-item {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 10px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: border-color 0.2s;
  }
  .dqe-landing-wrapper .acc-head {
    width: 100%;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255,255,255,0.04);
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    text-align: left;
    transition: background 0.2s;
  }
  .dqe-landing-wrapper .acc-head:hover { background: rgba(255,255,255,0.08); }
  .dqe-landing-wrapper .acc-num {
    font-size: 13px;
    font-weight: 700;
    color: var(--blue);
    margin-right: 14px;
    letter-spacing: 0.05em;
  }
  .dqe-landing-wrapper .acc-title { flex: 1; color: #fff; }
  .dqe-landing-wrapper .acc-icon { font-size: 20px; font-weight: 400; color: var(--blue); transition: transform 0.2s; }
  .dqe-landing-wrapper .acc-item.open .acc-icon { transform: rotate(45deg); }

  .dqe-landing-wrapper .acc-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
  }
  .dqe-landing-wrapper .acc-body-inner { padding: 24px 24px 24px; }
  .dqe-landing-wrapper .acc-anchor { font-size: 15px; line-height: 1.6; color: rgba(255,255,255,0.85); margin-bottom: 18px; }
  .dqe-landing-wrapper .acc-level-row {
    background: rgba(255,255,255,0.07);
    border-left: 4px solid var(--blue);
    border-radius: 6px;
    padding: 10px 14px;
    margin-bottom: 8px;
  }
  .dqe-landing-wrapper .acc-level-tag { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 2px; }
  .dqe-landing-wrapper .acc-level-desc { font-size: 14px; line-height: 1.5; color: rgba(255,255,255,0.82); }

  /* ---------- Interactive Explorer ---------- */
  .dqe-landing-wrapper .explorer {
    background:
      radial-gradient(ellipse 65% 45% at 90% 0%, rgba(39,191,240,0.08), transparent 55%),
      #ffffff;
    color: #213C4B;
  }
  .dqe-landing-wrapper .explorer h2,
  .dqe-landing-wrapper .explorer .lede { color: #213C4B; }
  .dqe-landing-wrapper .explorer .eyebrow { color: var(--blue-deep); }

  .dqe-landing-wrapper .explorer-panel {
    background: #E9F0F3;
    border: 1px solid rgba(33,60,75,0.10);
    border-radius: 16px;
    padding: 28px;
    margin-top: 32px;
  }
  .dqe-landing-wrapper .explorer-controls {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
  }
  @media (max-width: 700px) { .dqe-landing-wrapper .explorer-controls { grid-template-columns: 1fr; } }

  .dqe-landing-wrapper .control-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #23A6DE;
    margin-bottom: 12px;
    display: block;
  }
  .dqe-landing-wrapper .dim-select {
    width: 100%;
    background: #fff;
    color: var(--ink);
    padding: 14px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: 1px solid rgba(33,60,75,0.15);
    outline: none;
    font-family: inherit;
    cursor: pointer;
  }

  .dqe-landing-wrapper .slider-wrap { padding: 8px 0; }
  .dqe-landing-wrapper .slider-track {
    position: relative;
    height: 8px;
    background: rgba(33,60,75,0.12);
    border-radius: 999px;
    margin: 8px 0 28px;
  }
  .dqe-landing-wrapper .slider-fill {
    position: absolute;
    top: 0; left: 0;
    height: 100%;
    background: linear-gradient(90deg, var(--orange-1), var(--orange-2), var(--amber), var(--green-deep), var(--blue));
    border-radius: 999px;
    transition: width 0.25s ease;
  }
  .dqe-landing-wrapper .slider-input {
    position: absolute;
    top: -8px; left: 0;
    width: 100%;
    height: 24px;
    opacity: 0;
    margin: 0;
    cursor: pointer;
    -webkit-appearance: none;
  }
  .dqe-landing-wrapper .slider-thumb {
    position: absolute;
    top: 50%;
    width: 24px; height: 24px;
    border-radius: 50%;
    background: #fff;
    border: 4px solid var(--blue);
    transform: translate(-50%, -50%);
    transition: left 0.25s ease, border-color 0.2s;
    pointer-events: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
  }
  .dqe-landing-wrapper .slider-ticks {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    margin-top: -12px;
  }
  .dqe-landing-wrapper .slider-tick {
    text-align: center;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(33,60,75,0.50);
    cursor: pointer;
    transition: color 0.2s;
  }
  .dqe-landing-wrapper .slider-tick.active { color: #213C4B; font-weight: 700; }

  .dqe-landing-wrapper .explorer-output {
    background: #ffffff;
    border-radius: 12px;
    padding: 28px;
    border-left: 4px solid var(--blue);
    box-shadow: 0 8px 24px rgba(33,60,75,0.06);
  }
  .dqe-landing-wrapper .output-head { display: flex; align-items: center; gap: 14px; margin-bottom: 14px; flex-wrap: wrap; }
  .dqe-landing-wrapper .output-badge { padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; color: #fff; }
  .dqe-landing-wrapper .output-dim-name { font-size: 16px; font-weight: 700; color: #213C4B; }
  .dqe-landing-wrapper .output-desc { font-size: 16px; line-height: 1.6; color: #213C4B; opacity: 0.92; }

  /* ---------- Methodology ---------- */
  .dqe-landing-wrapper .methodology {
    background:
      radial-gradient(ellipse 60% 50% at 88% 12%, rgba(39,191,240,0.14), transparent 55%),
      radial-gradient(ellipse 50% 45% at 8% 88%, rgba(166,213,64,0.11), transparent 55%),
      linear-gradient(160deg, #213C4B 0%, #162C38 100%);
    color: #fff;
  }
  .dqe-landing-wrapper .methodology .eyebrow { color: var(--green); }
  .dqe-landing-wrapper .methodology h2,
  .dqe-landing-wrapper .methodology .lede { color: #fff; }

  .dqe-landing-wrapper .meth-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 32px;
  }
  @media (max-width: 900px) { .dqe-landing-wrapper .meth-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 500px) { .dqe-landing-wrapper .meth-grid { grid-template-columns: 1fr; } }

  .dqe-landing-wrapper .meth-card {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(255,255,255,0.10);
    border-bottom: 3px solid #27BFF0;
    border-radius: 12px;
    padding: 24px 20px;
    transition: transform 0.2s, background 0.2s;
  }
  .dqe-landing-wrapper .meth-card:hover { transform: translateY(-3px); background: rgba(255,255,255,0.08); }
  .dqe-landing-wrapper .meth-step { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; color: #27BFF0; margin-bottom: 6px; }
  .dqe-landing-wrapper .meth-title { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 8px; letter-spacing: -0.01em; }
  .dqe-landing-wrapper .meth-desc { font-size: 13px; line-height: 1.5; color: rgba(255,255,255,0.76); }

  /* ---------- Outcomes ---------- */
  .dqe-landing-wrapper .outcomes {
    background:
      radial-gradient(ellipse 65% 45% at 95% 0%, rgba(166,213,64,0.10), transparent 55%),
      #ffffff;
  }
  .dqe-landing-wrapper .outcomes-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-top: 32px;
  }
  @media (max-width: 900px) { .dqe-landing-wrapper .outcomes-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 500px) { .dqe-landing-wrapper .outcomes-grid { grid-template-columns: 1fr; } }

  .dqe-landing-wrapper .outcome-card {
    background: #fff;
    border-radius: 12px;
    padding: 22px 20px;
    border: 1px solid rgba(33,60,75,0.08);
    border-top: 3px solid var(--blue);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .dqe-landing-wrapper .outcome-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(33,60,75,0.1); }
  .dqe-landing-wrapper .outcome-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: rgba(39,191,240,0.12);
    color: var(--blue-deep);
    font-size: 18px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 12px;
  }
  .dqe-landing-wrapper .outcome-title { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 6px; letter-spacing: -0.01em; line-height: 1.25; }
  .dqe-landing-wrapper .outcome-desc { font-size: 13px; line-height: 1.5; color: var(--ink); opacity: 0.78; }

  /* ---------- Assessment CTA ---------- */
  .dqe-landing-wrapper .assess-cta {
    background:
      radial-gradient(ellipse 60% 50% at 88% 12%, rgba(39,191,240,0.14), transparent 55%),
      radial-gradient(ellipse 50% 45% at 8% 88%, rgba(166,213,64,0.11), transparent 55%),
      linear-gradient(160deg, #213C4B 0%, #162C38 100%);
    color: #fff;
    padding: 72px 32px;
  }
  .dqe-landing-wrapper .assess-grid {
    display: grid;
    grid-template-columns: 7fr 5fr;
    gap: 48px;
    align-items: center;
    max-width: 1100px;
    margin: 0 auto;
  }
  @media (max-width: 800px) { .dqe-landing-wrapper .assess-grid { grid-template-columns: 1fr; } }
  .dqe-landing-wrapper .assess-cta h2 { color: #fff; }
  .dqe-landing-wrapper .assess-cta .eyebrow { color: var(--green); }
  .dqe-landing-wrapper .assess-cta p { font-size: 17px; line-height: 1.6; color: #fff; opacity: 0.9; margin-bottom: 24px; }

  .dqe-landing-wrapper .assess-visual {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 32px;
    text-align: center;
  }
  .dqe-landing-wrapper .assess-score { font-size: 88px; font-weight: 800; line-height: 1; color: var(--blue); letter-spacing: -0.04em; }
  .dqe-landing-wrapper .assess-score-out { font-size: 22px; color: rgba(255,255,255,0.5); }
  .dqe-landing-wrapper .assess-level {
    display: inline-block;
    margin-top: 16px;
    padding: 6px 16px;
    background: var(--green-deep);
    color: #fff;
    border-radius: 999px;
    font-weight: 700;
    font-size: 14px;
  }
  .dqe-landing-wrapper .assess-mini-label { font-size: 12px; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(255,255,255,0.6); margin-bottom: 12px; }

  /* ---------- Final CTA ---------- */
  .dqe-landing-wrapper .final-cta {
    background:
      radial-gradient(ellipse 70% 45% at 50% 0%, rgba(39,191,240,0.10), transparent 60%),
      linear-gradient(180deg, #ffffff 0%, #E9F0F3 100%);
    text-align: center;
  }
  .dqe-landing-wrapper .final-cta h2 { margin-left: auto; margin-right: auto; }
</style>

<div class="dqe-landing-wrapper">
  <!-- ===== HERO ===== -->
  <section class="hero">
    <div class="hero-grid">
      <div>
        <div class="eyebrow">A Maturity Model for Enterprise Synthetic Data</div>
        <h1>The Data Quality Evolution <span class="blue">Index</span></h1>
        <p class="hero-sub">
          A <strong>10-dimension, 5-level framework</strong> for benchmarking non-production data quality, eliminating privacy risk, and building a <strong>synthetic-data-first operating model</strong> for software engineering and AI.
        </p>

        <div class="hero-pills">
          <span class="pill">Technology-agnostic</span>
          <span class="pill">10 dimensions</span>
          <span class="pill">5 maturity levels</span>
          <span class="pill">Self-assessment ready</span>
        </div>

        <div class="cta-row">
          <?php
            $assessment_url = site_url('/data-quality-evolution-index-assessment/');
          ?>
          <a href="<?php echo esc_url($assessment_url); ?>" class="btn btn-accent">Take the assessment →</a>
          <a href="#dimensions" class="btn btn-ghost">Explore the framework</a>
        </div>
      </div>

      <div class="hero-visual">
        <div style="font-size:11px; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:var(--blue); margin-bottom:16px;">The 5 Maturity Levels</div>
        <div class="level-row-item">
          <div class="level-badge-num" style="background:var(--orange-1);">1</div>
          <div><strong style="color:var(--ink); font-size:14px;">Level 1 — Ad Hoc</strong><div style="font-size:12px; color:#555;">Production copy dependency & privacy risk accepted</div></div>
        </div>
        <div class="level-row-item">
          <div class="level-badge-num" style="background:var(--orange-2);">2</div>
          <div><strong style="color:var(--ink); font-size:14px;">Level 2 — Managed</strong><div style="font-size:12px; color:#555;">Basic guardrails, selective masking & manual repair</div></div>
        </div>
        <div class="level-row-item">
          <div class="level-badge-num" style="background:var(--amber);">3</div>
          <div><strong style="color:var(--ink); font-size:14px;">Level 3 — Engineered</strong><div style="font-size:12px; color:#555;">Intentional design & versioned synthetic definitions</div></div>
        </div>
        <div class="level-row-item">
          <div class="level-badge-num" style="background:var(--green-deep);">4</div>
          <div><strong style="color:var(--ink); font-size:14px;">Level 4 — Orchestrated</strong><div style="font-size:12px; color:#555;">Pipeline-native, API-driven & on-demand delivery</div></div>
        </div>
        <div class="level-row-item">
          <div class="level-badge-num" style="background:var(--blue);">5</div>
          <div><strong style="color:var(--ink); font-size:14px;">Level 5 — Optimized</strong><div style="font-size:12px; color:#555;">Continuous outcome-driven optimization at scale</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== PROBLEM SECTION ===== -->
  <section class="problem">
    <div class="wrap">
      <div class="problem-grid">
        <div>
          <div class="eyebrow">The Industry Challenge</div>
          <h2>Why traditional test data practices break down at scale.</h2>
          <p class="lede">
            For decades, software teams have relied on copying production data into lower environments. But modern delivery, privacy regulations, and AI workloads make this model unsustainable.
          </p>
          <ul class="bullet-list" style="margin-top:24px;">
            <li><strong>Severe Privacy Risk:</strong> Masking complex data models leaves residual re-identification risk and delays delivery cycles.</li>
            <li><strong>Data Scarcity:</strong> Production copies contain happy-path historical data, missing edge cases, failure modes, and synthetic variants.</li>
            <li><strong>Provisioning Bottlenecks:</strong> Waiting days or weeks for data refreshes halts CI/CD pipelines and increases infrastructure costs.</li>
          </ul>
        </div>
        <div>
          <div style="text-align:center; margin-bottom:12px; font-weight:700; font-size:12px; letter-spacing:0.12em; text-transform:uppercase; color:var(--ink); opacity:0.7;">The Evolution Ladder</div>
          <div class="ladder-step" style="border-left-color:var(--blue);">
            <div style="font-size:11px; font-weight:700; color:var(--blue); text-transform:uppercase; letter-spacing:0.12em;">Target Operating Model</div>
            <h3 style="font-size:17px; margin-top:2px;">Engineered Synthetic Data</h3>
            <p style="font-size:13px; color:var(--ink); opacity:0.8; margin-top:4px;">Data generated from versioned rules and stateful profiles — deterministic, privacy-safe, and provisioned in minutes.</p>
          </div>
          <div class="ladder-step" style="border-left-color:var(--amber);">
            <div style="font-size:11px; font-weight:700; color:var(--orange-2); text-transform:uppercase; letter-spacing:0.12em;">Transitional State</div>
            <h3 style="font-size:17px; margin-top:2px;">Hybrid Masking + Generation</h3>
            <p style="font-size:13px; color:var(--ink); opacity:0.8; margin-top:4px;">Selective production masking augmented with synthetic data generators for new test scenarios.</p>
          </div>
          <div class="ladder-step" style="border-left-color:var(--orange-1);">
            <div style="font-size:11px; font-weight:700; color:var(--orange-1); text-transform:uppercase; letter-spacing:0.12em;">Legacy Model</div>
            <h3 style="font-size:17px; margin-top:2px;">Production Copy & Refresh</h3>
            <p style="font-size:13px; color:var(--ink); opacity:0.8; margin-top:4px;">Bulk database copies, manual scrubbing, fragile referential integrity, and high compliance risk.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== DIMENSIONS SECTION (ACCORDION) ===== -->
  <section class="dimensions" id="dimensions">
    <div class="wrap">
      <div style="text-align:center; max-width:820px; margin:0 auto 48px;">
        <div class="eyebrow">The 10 Dimensions</div>
        <h2>A complete diagnostic of enterprise data quality readiness.</h2>
        <p class="lede" style="margin:0 auto;">
          The DQE Index evaluates maturity across 10 independent dimensions — from privacy risk and determinism to pipeline automation and enterprise scale.
        </p>
      </div>

      <div id="accordion"></div>
    </div>
  </section>

  <!-- ===== INTERACTIVE EXPLORER ===== -->
  <section class="explorer">
    <div class="wrap">
      <div style="text-align:center; max-width:800px; margin:0 auto;">
        <div class="eyebrow">Interactive Explorer</div>
        <h2>Explore maturity levels by dimension.</h2>
        <p class="lede" style="margin:0 auto;">Select any of the 10 dimensions and adjust the slider to see what maturity looks like at every level.</p>
      </div>

      <div class="explorer-panel">
        <div class="explorer-controls">
          <div>
            <label class="control-label" for="dimSelect">Select Dimension</label>
            <select id="dimSelect" class="dim-select"></select>
          </div>
          <div>
            <label class="control-label">Maturity Level</label>
            <div class="slider-wrap">
              <div class="slider-track">
                <div class="slider-fill" id="sliderFill"></div>
                <div class="slider-thumb" id="sliderThumb"></div>
                <input type="range" min="1" max="5" value="3" id="levelSlider" class="slider-input" />
              </div>
              <div class="slider-ticks">
                <div class="slider-tick" data-lvl="1">Level 1</div>
                <div class="slider-tick" data-lvl="2">Level 2</div>
                <div class="slider-tick active" data-lvl="3">Level 3</div>
                <div class="slider-tick" data-lvl="4">Level 4</div>
                <div class="slider-tick" data-lvl="5">Level 5</div>
              </div>
            </div>
          </div>
        </div>

        <div class="explorer-output">
          <div class="output-head">
            <div class="output-badge" id="outputBadge">Level 3 — Engineered</div>
            <div class="output-dim-name" id="outputDimName">Data Privacy & Risk Elimination</div>
          </div>
          <div class="output-desc" id="outputDesc">Non-production data strategies are defined and synthetic data is used for some use cases. Production data use is reduced but not eliminated.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== METHODOLOGY ===== -->
  <section class="methodology">
    <div class="wrap">
      <div style="text-align:center; max-width:820px; margin:0 auto 48px;">
        <div class="eyebrow">GenRocket Delivery Model</div>
        <h2>How GenRocket enables Data Quality Evolution.</h2>
        <p class="lede" style="margin:0 auto;">GenRocket's Synthetic Data Automation platform is designed to accelerate an organization's journey across all 10 dimensions of the DQE Index.</p>
      </div>

      <div class="meth-grid">
        <div class="meth-card">
          <div class="meth-step">STEP 01</div>
          <div class="meth-title">Model</div>
          <div class="meth-desc">Design data models, attributes, distributions, and referential relationships without extracting production record instances.</div>
        </div>
        <div class="meth-card">
          <div class="meth-step">STEP 02</div>
          <div class="meth-title">Design</div>
          <div class="meth-desc">Define stateful rules, edge cases, negative tests, and volume requirements using 700+ synthetic generators.</div>
        </div>
        <div class="meth-card">
          <div class="meth-step">STEP 03</div>
          <div class="meth-title">Deploy</div>
          <div class="meth-desc">Integrate data generation recipes directly into CI/CD pipelines, automated testing frameworks, and AI workflows.</div>
        </div>
        <div class="meth-card">
          <div class="meth-step">STEP 04</div>
          <div class="meth-title">Automate</div>
          <div class="meth-desc">Provision fit-for-purpose synthetic data on demand in seconds for thousands of developer and QA environments.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== OUTCOMES ===== -->
  <section class="outcomes">
    <div class="wrap">
      <div style="text-align:center; max-width:820px; margin:0 auto 48px;">
        <div class="eyebrow">Business Impact</div>
        <h2>The return on synthetic data maturity.</h2>
        <p class="lede" style="margin:0 auto;">Organizations advancing to Levels 4 and 5 achieve measurable improvements across speed, security, and quality.</p>
      </div>

      <div class="outcomes-grid">
        <div class="outcome-card">
          <div class="outcome-icon">🔒</div>
          <div class="outcome-title">Zero Privacy Risk</div>
          <div class="outcome-desc">100% synthetic data eliminates GDPR, HIPAA, and CCPA compliance exposure across non-production environments.</div>
        </div>
        <div class="outcome-card">
          <div class="outcome-icon">⚡</div>
          <div class="outcome-title">10x Faster Testing</div>
          <div class="outcome-desc">On-demand data provisioning in seconds removes pipeline wait times and accelerates release frequency.</div>
        </div>
        <div class="outcome-card">
          <div class="outcome-icon">🎯</div>
          <div class="outcome-title">100% Test Coverage</div>
          <div class="outcome-desc">Generate rare edge cases, negative flows, and complex transaction state permutations that don't exist in production data.</div>
        </div>
        <div class="outcome-card">
          <div class="outcome-icon">💰</div>
          <div class="outcome-title">Reduced TDM Costs</div>
          <div class="outcome-desc">Eliminate massive database storage copies and costly masking software maintenance.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ASSESSMENT CTA ===== -->
  <section class="assess-cta">
    <div class="assess-grid">
      <div>
        <div class="eyebrow">Self-Assessment Tool</div>
        <h2>Benchmark your organization in 3 minutes.</h2>
        <p>Take the free 10-dimension assessment to get your overall DQE Index score, radar profile, per-dimension diagnostic, and next-step recommendations.</p>
        <a href="<?php echo esc_url($assessment_url); ?>" class="btn btn-accent">Start the 3-minute assessment →</a>
      </div>
      <div class="assess-visual">
        <div class="assess-mini-label">Sample Result</div>
        <div class="assess-score">3.4 <span class="assess-score-out">/ 5.0</span></div>
        <div class="assess-level">Level 3 — Engineered</div>
      </div>
    </div>
  </section>

  <!-- ===== FINAL CTA ===== -->
  <section class="final-cta">
    <div class="wrap">
      <div class="eyebrow">Next Step</div>
      <h2>Ready to modernize your test data strategy?</h2>
      <p class="lede" style="margin:0 auto 32px;">Talk with a GenRocket synthetic data expert to review your DQE Index results and explore an enterprise roadmap.</p>
      <div class="cta-row" style="justify-content:center;">
        <a href="https://www.genrocket.com" target="_blank" rel="noopener" class="btn btn-accent">Request a Demo</a>
        <a href="<?php echo esc_url($assessment_url); ?>" class="btn btn-ghost">Take the DQE Index Assessment</a>
      </div>
    </div>
  </section>
</div>

<script>
(function() {
  const DIMENSIONS = [
    { id:"privacy", title:"Data Privacy & Risk Elimination",
      anchor:"The extent to which non-production data eliminates privacy, security, and regulatory risk by design rather than mitigation.",
      levels:[
        "Production data is copied into lower environments with minimal protection. Sensitive data appears in non-production systems and privacy risk is accepted as a trade-off for speed.",
        "Masking or obfuscation is applied selectively. Controls vary by system or team and residual re-identification risk remains.",
        "Non-production data strategies are defined and synthetic data is used for some use cases. Production data use is reduced but not eliminated.",
        "Privacy risk is systematically eliminated for non-production use. Production data is no longer required and controls are centrally enforced.",
        "Privacy risk elimination is intrinsic and continuous. Auditable proof of non-sensitivity exists and compliance no longer constrains delivery."
      ]},
    { id:"integrity", title:"Data Integrity & Validity",
      anchor:"The degree to which data accurately reflects real system behavior, relationships, and business rules.",
      levels:[
        "Broken relationships and invalid references are common and data failures obscure application defects.",
        "Basic referential integrity is preserved but complex rules are fragile or manually repaired.",
        "Data models and constraints are intentionally defined and most workflows behave correctly.",
        "All structural relationships and rules are enforced automatically and data behaves consistently and maintains proper state across environments.",
        "Integrity logic is reusable, versioned, and inherited and new systems adopt validity rules by default."
      ]},
    { id:"coverage", title:"Data Coverage & Completeness",
      anchor:"The breadth of structured and unstructured data, scenarios, and transaction flows represented relative to real-world and anticipated system and model behavior.",
      levels:[
        "Data reflects only historical or happy-path scenarios within individual systems or components.",
        "Some negative and boundary cases exist, but coverage is limited to isolated systems and manually constructed scenarios.",
        "Positive, negative, and edge cases are intentionally included, including basic integration scenarios across related systems.",
        "Coverage spans complex transaction flows, permutations, rare events, and failure modes across multiple integrated systems, including structured and unstructured data types at scale.",
        "Coverage evolves continuously based on defects, usage patterns, and model performance across systems and data types."
      ]},
    { id:"statistical", title:"Statistical Accuracy & Bias Control",
      anchor:"The extent to which data distributions are accurate relative to intent and free from unintended bias.",
      levels:[
        "Statistical characteristics are accidental or unknown.",
        "Basic similarity to production distributions exists but bias is not actively managed.",
        "Statistical profiles are defined and applied intentionally.",
        "Bias is detected, controlled, and tuned per scenario across structured and unstructured data distributions.",
        "Statistical behavior is continuously refined using system outcomes and model performance to maintain accuracy and control bias."
      ]},
    { id:"lifecycle", title:"Data Lifecycle Management",
      anchor:"The ability to manage data definitions and data instances across creation, reuse, change, and retirement in a controlled and consistent manner.",
      levels:[
        "Data is created, copied, and discarded informally. No distinction exists between data definitions and test or training datasets.",
        "Retention and cleanup practices exist for stored data, but lifecycle management remains focused on physical datasets rather than reusable definitions.",
        "Data definitions are versioned and reused intentionally. Data can be regenerated, though stored data is still relied upon in some cases.",
        "Data definitions are centrally managed and changes propagate consistently. Datasets are created on demand and refreshed through regeneration.",
        "Lifecycle management is definition-centric. Data instances are ephemeral, reproducible, and exist only as long as needed."
      ]},
    { id:"determinism", title:"Determinism & Repeatability",
      anchor:"The degree to which data is generated from explicitly defined criteria and can be recreated consistently and predictably across environments and over time.",
      levels:[
        "Data creation is uncontrolled and outcome-based. Datasets cannot be reliably reproduced.",
        "Some repeatability exists, but data outcomes vary due to inferred profiles, manual steps, or environment-specific dependencies.",
        "Data generation follows defined processes, but outcomes may vary due to probabilistic methods or indirect inference.",
        "Data generation is driven by explicitly defined rules and profiles. Outcomes are deterministic and regression-safe.",
        "Deterministic generation is standardized and automated enterprise-wide, enabling reproducible datasets for both testing and model training scenarios."
      ]},
    { id:"provisioning", title:"Data Provisioning Efficiency",
      anchor:"The speed, cost, and effort required to provision fit-for-purpose data at scale.",
      levels:[
        "Provisioning takes days or weeks and depends on specialized individuals.",
        "Provisioning speed improves but remains labor-intensive and costly.",
        "Provisioning is predictable and partially automated.",
        "On-demand provisioning is measured in minutes with minimal human involvement.",
        "Near-instant provisioning is achieved with minimal marginal cost."
      ]},
    { id:"pipeline", title:"Pipeline & Automation Readiness",
      anchor:"The extent to which data provisioning is integrated into automated development and delivery workflows.",
      levels:[
        "Data preparation is manual and disconnected from pipelines.",
        "Automation exists but is fragile and environment-specific.",
        "CI/CD integration is possible with customization and manual oversight.",
        "Data provisioning is pipeline-native and API-driven.",
        "Pipelines assume data availability by design with no manual intervention."
      ]},
    { id:"scalability", title:"Enterprise Scalability",
      anchor:"The ability to deploy, govern, evolve, and optimize data provisioning across large numbers of teams, environments, and data volumes.",
      levels:[
        "Data provisioning is localized to individual teams with little visibility into utilization or performance.",
        "Scaling is possible with coordination, but measurement and optimization are limited and manual.",
        "Dozens of teams can be supported within known limits, with consistent metrics for utilization, efficiency, and data volume scaling.",
        "Hundreds of teams can be supported with centralized policy enforcement, automated change propagation, and the ability to generate large-scale datasets across structured and unstructured formats.",
        "Enterprise scale is assumed for thousands of teams, with continuous optimization driven by utilization, efficiency, and ML-scale data demands."
      ]},
    { id:"ease", title:"Ease of Use & Accessibility",
      anchor:"The degree to which data design and provisioning can be used effectively across roles without specialized expertise.",
      levels:[
        "Only specialists can create or modify data.",
        "Limited self-service exists but experts are still required.",
        "Multiple roles can participate with training.",
        "Broad self-service exists across engineering and QA teams.",
        "Data capability is intuitive, shared, and embedded into daily workflows."
      ]}
  ];

  const LEVEL_LABELS = ["Ad Hoc","Managed","Engineered","Orchestrated","Optimized"];
  const LEVEL_COLORS = ["#C04F15","#ED7D31","#FFC000","#6DBF42","#27BFF0"];
  const esc = s => String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));

  function buildAccordion() {
    const root = document.getElementById("accordion");
    if (!root) return;
    root.innerHTML = DIMENSIONS.map((dim, idx) => `
      <div class="acc-item" data-idx="${idx}">
        <button class="acc-head" aria-expanded="false" aria-controls="acc-body-${idx}">
          <span class="acc-num">${String(idx + 1).padStart(2, "0")}</span>
          <span class="acc-title">${esc(dim.title)}</span>
          <span class="acc-icon" aria-hidden="true">+</span>
        </button>
        <div class="acc-body" id="acc-body-${idx}">
          <div class="acc-body-inner">
            <div class="acc-anchor">${esc(dim.anchor)}</div>
            <div class="acc-levels">
              ${dim.levels.map((desc, i) => `
                <div class="acc-level-row" style="border-left-color:${LEVEL_COLORS[i]}">
                  <div class="acc-level-tag" style="color:${LEVEL_COLORS[i]}">Level ${i+1} — ${LEVEL_LABELS[i]}</div>
                  <div class="acc-level-desc">${esc(desc)}</div>
                </div>
              `).join("")}
            </div>
          </div>
        </div>
      </div>
    `).join("");

    root.querySelectorAll(".acc-head").forEach(head => {
      head.addEventListener("click", () => {
        const item = head.closest(".acc-item");
        const body = item.querySelector(".acc-body");
        const isOpen = item.classList.contains("open");

        if (isOpen) {
          item.classList.remove("open");
          body.style.maxHeight = "0";
          head.setAttribute("aria-expanded", "false");
        } else {
          item.classList.add("open");
          body.style.maxHeight = body.scrollHeight + "px";
          head.setAttribute("aria-expanded", "true");
        }
      });
    });
  }

  function buildExplorer() {
    const select = document.getElementById("dimSelect");
    if (!select) return;
    select.innerHTML = DIMENSIONS.map((d, i) => `<option value="${i}">${esc(d.title)}</option>`).join("");

    const slider = document.getElementById("levelSlider");
    const fill = document.getElementById("sliderFill");
    const thumb = document.getElementById("sliderThumb");
    const ticks = document.querySelectorAll(".slider-tick");
    const outputBadge = document.getElementById("outputBadge");
    const outputDimName = document.getElementById("outputDimName");
    const outputDesc = document.getElementById("outputDesc");

    function update() {
      const dimIdx = parseInt(select.value, 10);
      const lvl = parseInt(slider.value, 10);
      const dim = DIMENSIONS[dimIdx];
      const desc = dim.levels[lvl - 1];

      const pct = ((lvl - 1) / 4) * 100;
      fill.style.width = pct + "%";
      thumb.style.left = pct + "%";
      thumb.style.borderColor = LEVEL_COLORS[lvl - 1];

      ticks.forEach(t => {
        const isActive = parseInt(t.dataset.lvl, 10) === lvl;
        t.classList.toggle("active", isActive);
      });

      outputBadge.textContent = `Level ${lvl} — ${LEVEL_LABELS[lvl-1]}`;
      outputBadge.style.background = LEVEL_COLORS[lvl - 1];
      outputDimName.textContent = dim.title;
      outputDesc.textContent = desc;
    }

    select.addEventListener("change", update);
    slider.addEventListener("input", update);
    ticks.forEach(t => {
      t.addEventListener("click", () => {
        slider.value = t.dataset.lvl;
        update();
      });
    });

    update();
  }

  function init() {
    buildAccordion();
    buildExplorer();
  }

  if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
</script>

<?php get_footer(); ?>
