<?php /* Template Name: DataConnect Calculator */ ?>
<?php get_header(); ?>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --navy: #0c1e35;
    --navy-deep: #07141f;
    --slate: #44566c;
    /*--teal: #0f9d8d;*/
    --siteblue: #2abdf0;
    --teal-bright: #2cd9c5;
    /*--amber: #f0a23a;*/
    --amber: #2abdf0;
    --paper: #f4f6f8;
    --card: #ffffff;
    --line: #e2e8ee;
    --ink: #16263b;
    --muted: #6b7c93;
    --pagefont : "Catamaran", sans-serif;
    /*--pagefont : "IBM Plex Mono", monospace;*/
  }
  .mono{ font-family:var(--pagefont); }
  /* ---------- Layout ---------- */
  .panel{
    background: var(--card);
    border:1px solid var(--line);
    border-radius:16px;
    box-shadow: 0 18px 40px -28px rgba(12,30,53,0.45);
    padding: 28px 30px;
    margin-bottom: 26px;
  }
  .panel h2{
    font-size:19px;
    margin-bottom: 4px;
  }
  .panel .sub{
    color: var(--muted);
    font-size: 18px;
    margin-bottom: 22px;
  }
  .section-num{
    font-family:var(--pagefont);
    font-size:16px;
    color: var(--siteblue);
    letter-spacing:.12em;
    text-transform:uppercase;
    margin-bottom:8px;
    font-weight:600;
  }
  /* ---------- Inputs ---------- */
  .inputs-grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
  }
  @media (max-width: 920px){
    .inputs-grid{ grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 540px){
    .inputs-grid{ grid-template-columns: 1fr; }
  }
  .field label{
    display:block;
    font-size:16px;
    font-weight:600;
    color: var(--navy);
    margin-bottom:6px;
  }
  .field .hint{
    font-size:14px;
    color: var(--muted);
    margin-bottom:10px;
  }
  .field input[type="number"]{
    width:100%;
    padding:11px 13px;
    font-size:16px;
    font-family:var(--pagefont);
    border:1.5px solid var(--line);
    border-radius:10px;
    background:#fbfcfd;
    color: var(--ink);
    transition: border-color .15s, box-shadow .15s;
  }
  .field input[type="number"]:focus{
    outline:none;
    border-color: var(--siteblue);
    box-shadow: 0 0 0 4px rgba(15,157,141,0.12);
    background:#fff;
  }
  .field input[type="range"]{
    width:100%;
    margin-top:10px;
    accent-color: var(--siteblue);
  }
  .field .range-row{
    display:flex; justify-content:space-between;
    font-size:11px; color:var(--muted); margin-top:4px;
    font-family:var(--pagefont);
  }
  /* ---------- Profile callout ---------- */
  .profile-grid{
    display:grid;
    grid-template-columns: 1.1fr 1fr 1fr;
    gap: 18px;
    margin-top: 4px;
  }
  @media (max-width: 760px){
    .profile-grid{ grid-template-columns: 1fr; }
  }
  .stat{
    border:1px solid var(--line);
    border-radius:12px;
    padding:18px 18px;
    background: #fafcfd;
  }
  .stat .stat-label{
    font-size:12px; color: var(--muted);
    text-transform:uppercase; letter-spacing:.08em;
    font-weight:600; margin-bottom:8px;
  }
  .stat .stat-value{
    font-family:'Catamaran', sans-serif;
    font-size:26px; font-weight:700; color: var(--navy);
  }
  .stat .stat-value .unit{
    font-size:14px; font-weight:600; color: var(--muted); margin-left:4px;
  }
  .stat.highlight{
    background: linear-gradient(135deg, rgba(15,157,141,0.08), rgba(44,217,197,0.04));
    border-color: rgba(15,157,141,0.3);
  }
  .stat.highlight .stat-value{ color: var(--siteblue); }
  .stat .stat-foot{
    margin-top:6px; font-size:14px; color: var(--muted);
  }
  /* ---------- Comparison table ---------- */
  table.compare{
    width:100%;
    border-collapse: collapse;
    margin-top: 6px;
    font-size: 14.5px;
  }
  table.compare th, table.compare td{
    padding: 14px 14px;
    text-align: right;
    border-bottom: 1px solid var(--line);
  }
  table.compare th:first-child, table.compare td:first-child{ text-align:left; }
  table.compare thead th{
    font-size:14px; text-transform:uppercase; letter-spacing:.07em;
    color: var(--muted); font-weight:700;
    border-bottom: 2px solid var(--navy);
    padding-bottom:10px;
  }
  table.compare tbody tr:hover{ background: #fafcfd; }
  table.compare td.vol{
    font-family:'Catamaran', sans-serif;
    font-weight:700; color: var(--navy); font-size:15.5px;
  }
  table.compare td.llm{ color:#b5651d; font-family:var(--pagefont); }
  table.compare td.dc{ color: var(--siteblue); font-weight:600; font-family:var(--pagefont); }
  table.compare td.save{ font-family:var(--pagefont); font-weight:700; }
  table.compare td.savepct{ font-family:var(--pagefont); }
  .pill{
    display:inline-block;
    background: rgba(15,157,141,0.12);
    color: var(--siteblue);
    border-radius:999px;
    padding:3px 10px;
    font-weight:700;
    font-size:13px;
  }
  tr.you td{ background: rgba(42,189,240,0.06); }
  tr.you td:first-child{ border-left: 3px solid var(--amber); }
  .you-tag{
    font-size:10.5px; text-transform:uppercase; letter-spacing:.08em;
    color: var(--amber); font-weight:700; margin-left:8px;
    border:1px solid rgba(240,162,58,0.4);
    padding:2px 6px; border-radius:6px;
  }
  .cap-note{
    font-size:14px; color: var(--muted); font-weight:500;
  }
  /* ---------- Chart ---------- */
  .chart-wrap{ margin-top: 8px; }
  .legend{
    display:flex; gap:22px; align-items:center; margin-bottom:18px;
    font-size:13px; color: var(--slate); flex-wrap:wrap;
  }
  .legend .key{ display:flex; align-items:center; gap:7px; }
  .legend .swatch{ width:13px; height:13px; border-radius:3px; }
  .sw-llm{ background:#e8a15c; }
  .sw-dc{ background: #a6d540; }
  .sw-you{ background: var(--amber); border-radius:50%; width:9px; height:9px; }
  /* ---------- Footnotes ---------- */
  .assumptions{
    color: var(--muted);
    border-top:1px solid var(--line);
    padding-top: 18px;
    margin-top: 6px;
  }
  .assumptions ul{ margin: 8px 0 0; padding-left: 20px; }
  .assumptions li{ margin-bottom: 4px; }
  .assumptions code{
    background:#eef2f6; padding:1px 5px; border-radius:4px;
    font-family:var(--pagefont); font-size:12px;
  }
    .banner .caption{background:radial-gradient(circle at 18% 28%,rgba(39,191,240,0.25) 0%,transparent 42%),radial-gradient(circle at 82% 72%,rgba(166,213,64,0.22) 0%,transparent 38%);opacity:0.9;}
    .banner .caption h1{color:#fff!important;font:700 45px/1 'Catamaran',sans-serif!important;text-align:center;}
    .banner .caption h1.title span{color:#a6d540!important;}
  .eyebrow{display:inline-flex;align-items:center;gap:7px;padding:5px 11px;background:rgba(39,191,240,0.15);border:1px solid rgba(39,191,240,0.35);border-radius:999px;margin-bottom:16px;}
  .eyebrow .dot{width:6px;height:6px;border-radius:999px;background:#a6d540;animation:pulse 2s ease-in-out infinite;}
      .newblock{padding:65px 0;font:18px/26px Catamaran,sans-serif;color:#53696f;}
</style>
<?php 
$page_banner = get_field('page_banner');
$banner_caption = get_field('banner_caption');
$banner_class = get_field('banner_class');
?>
<div class="banner no-print <?php echo get_field('banner_class'); ?>">
  <?php 
  $image = get_field('page_banner');
  $mobile = 'medium';
  $tablet = 'large';
  $full = 'full';
  ?>
  <?php if(get_field('page_banner')): ?>
    <picture>
        <source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">
        <source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
        <source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $size); ?>">
        <img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket - Test Data Management">
      </picture>
  <?php endif; ?>
  <?php if(get_field('banner_caption')): ?>
    <div class="caption">
      <div class="container text-center">
        <div class="inner">
          <?php echo get_field('banner_caption'); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<main id="main">
  <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <div class="newblock">
    <div class="container">
      <!-- INPUTS -->
      <section class="panel">
        <div class="section-num">01 · Your Testing Profile</div>
        <h2>Tell us about your test program</h2>
        <div class="sub">These inputs estimate how much synthetic data your QA organization generates each year. They don't change the unit economics — they show you where your program lands on the cost curve.</div>
        <div class="inputs-grid">
          <div class="field">
            <label for="teams">Number of Scrum Teams</label>
            <div class="hint">Teams actively generating test data</div>
            <input type="number" class="restrict-number" id="teams" min="1" max="500" value="20" step="1">
            <input type="range" id="teamsRange" min="1" max="200" value="20" step="1">
            <div class="range-row"><span>1</span><span>200</span></div>
          </div>
          <div class="field">
            <label for="freq">Tests per Team, per Day</label>
            <div class="hint">Average test-run frequency</div>
            <input type="number" class="restrict-number" id="freq" min="1" max="500" value="48" step="1">
            <input type="range" id="freqRange" min="1" max="200" value="48" step="1">
            <div class="range-row"><span>1</span><span>200</span></div>
          </div>
          <div class="field">
            <label for="tokenCost">Average LLM Token Cost</label>
            <div class="hint">$ per 1M input + output tokens</div>
            <input type="number" class="restrict-number" id="tokenCost" min="0.1" max="30" value="4.25" step="0.05">
            <input type="range" id="tokenCostRange" min="0.5" max="20" value="4.25" step="0.05">
            <div class="range-row"><span>$0.50</span><span>$25.00</span></div>
          </div>
          <div class="field">
            <label for="datasetSize">Dataset Size per Test Run</label>
            <div class="hint">Synthetic data generated per run</div>
            <input type="number" class="restrict-number" id="datasetSize" min="100" max="1000" value="250" step="10">
            <input type="range" id="datasetSizeRange" min="100" max="1000" value="250" step="10">
            <div class="range-row"><span>100 KB</span><span>1 MB</span></div>
          </div>
        </div>
      </section>
      <!-- YOUR PROFILE -->
      <section class="panel">
        <div class="section-num">02 · Your Numbers</div>
        <h2>Your estimated annual data footprint</h2>
        <div class="sub">Based on <span class="mono" id="runsPerYearLabel">249,600</span> test runs per year across your scrum teams, at <span class="mono" id="datasetSizeLabel">~250 KB</span> of synthetic data per run.</div>
        <div class="profile-grid">
          <div class="stat">
            <div class="stat-label">Estimated Annual Volume</div>
            <div class="stat-value"><span id="yourVolume">62.4</span><span class="unit">GB / year</span></div>
            <div class="stat-foot"><span id="datasetSizeFoot">1,000 rows × 25 columns × 10 chars per test run</span></div>
          </div>
          <div class="stat">
            <div class="stat-label">LLM Cost at Your Volume</div>
            <div class="stat-value">$<span id="yourLLM">71,136</span></div>
            <div class="stat-foot">$<span id="yourLLMperGB">1,140</span> / GB</div>
          </div>
          <div class="stat highlight">
            <div class="stat-label">GenRocket DataConnect Cost at Your Volume</div>
            <div class="stat-value">$<span id="yourDC">15,600</span></div>
            <div class="stat-foot">Save <span id="yourSavePct">78%</span> · $<span id="yourSaveAmt">55,536</span> / year</div>
            <div class="stat-foot" id="yourCapacityNote">Billed at 75 GB capacity</div>
          </div>
        </div>
      </section>
      <!-- COMPARISON TABLE -->
      <section class="panel">
        <div class="section-num">03 · Cost Comparison</div>
        <h2>Annual cost: LLM-generated data vs. GenRocket DataConnect</h2>
        <div class="sub">GenRocket DataConnect pricing reflects MSRP capacity tiers from the official DaaS API pricing schedule. Larger volumes unlock a lower per-GB rate. The Table below reflects your calculated volume and is priced in increments of 25 GB.</div>
        <div class="table-responsive">
        <table class="compare">
          <thead>
            <tr>
              <th>Annual Data Volume</th>
              <th>LLM Cost / Year</th>
              <th>GenRocket DataConnect Cost / Year</th>
              <th>Annual Savings</th>
              <th>Savings %</th>
            </tr>
          </thead>
          <tbody id="compareBody">
            <!-- rows injected by JS -->
          </tbody>
        </table>
        </div>
      </section>
      <!-- CHART -->
      <section class="panel">
        <div class="section-num">04 · The Cost Curve</div>
        <h2>Cost grows linearly with an LLM. With GenRocket DataConnect, it doesn't.</h2>
        <div class="legend">
          <div class="key"><span class="swatch sw-llm"></span> LLM token cost</div>
          <div class="key"><span class="swatch sw-dc"></span> GenRocket DataConnect (MSRP)</div>
          <div class="key"><span class="swatch sw-you"></span> Your estimated volume</div>
        </div>
        <div class="chart-wrap">
          <svg id="chartSvg" viewBox="0 0 760 320" width="100%" height="320" preserveAspectRatio="xMidYMid meet" role="img" aria-label="Bar chart comparing LLM and GenRocket DataConnect annual cost across data volumes"></svg>
        </div>
      </section>
      <!-- ASSUMPTIONS -->
      <section class="panel">
        <div class="section-num">05 · Methodology</div>
        <h2>How this calculator works</h2>
        <div class="assumptions">
          <ul>
            <li><strong>Dataset unit:</strong> each test run produces a configurable amount of synthetic data — from <code>100 KB</code> to <code>1 MB</code> per run (the default <code>250 KB</code> reflects 1,000 rows × 25 columns × 10 characters, a conservative average across unit, component, and basic API testing).</li>
            <li><strong>LLM token load per run:</strong> output tokens scale with dataset size at ~4 characters per token (e.g. 250&nbsp;KB ≈ 62,500 output tokens), plus a fixed 5,000 input tokens for prompt / schema / rule-definition overhead — billed at your blended <code>$ / 1M token</code> rate.</li>
            <li><strong>LLM cost per GB</strong> is a function of token price and dataset size: smaller datasets carry proportionally more fixed prompt-overhead tokens, making LLM generation relatively more expensive per GB at smaller run sizes.</li>
            <li><strong>GenRocket DataConnect cost per GB</strong> is taken directly from the GenRocket DaaS API Pricing Schedule (GenRocket MSRP column), which steps down as committed capacity increases: $500/GB at 10GB, $300/GB at 25–75GB, $250/GB at 100–175GB, $200/GB at 200GB+.</li>
            <li><strong>Capacity is purchased in blocks:</strong> a 10GB starter tier covers volumes up to 10GB; beyond that, capacity must be purchased in 25GB increments (25, 50, 75, 100…). A calculated volume of 62GB, for example, requires a 75GB capacity purchase, billed at the 75GB rate.</li>
            <li>Your testing profile (scrum teams × test frequency × 260 testing days/year) estimates your annual volume for context — it does not change either platform's per-GB rate.</li>
            <li>This tool is intended as a directional, conservative estimate for planning discussions — not a vendor quote.</li>
          </ul>
        </div>
      </section>
    </div>
    </div>
  <?php endwhile; endif; wp_reset_query(); ?>
</main>
<script>
  // ---------- Fixed model constants ----------
  const INPUT_TOKENS_PER_RUN = 5000;     // fixed prompt / schema / rule-definition overhead
  const CHARS_PER_TOKEN = 4;             // ~4 characters per token
  const TESTING_DAYS = 260;
  // GenRocket MSRP Price/GB by capacity tier (GB -> $/GB), from DaaS API Pricing Schedule
  const MSRP_TIERS = [
    {cap: 10,  rate: 500},
    {cap: 25,  rate: 300},
    {cap: 50,  rate: 300},
    {cap: 75,  rate: 300},
    {cap: 100, rate: 250},
    {cap: 125, rate: 250},
    {cap: 150, rate: 250},
    {cap: 175, rate: 250},
    {cap: 200, rate: 200},
    {cap: 225, rate: 200},
    {cap: 250, rate: 200},
    {cap: 275, rate: 200},
    {cap: 300, rate: 200},
  ];
  const BREAKPOINTS = [10, 25, 50, 100];
  function dcRateForVolume(gb){
    for(const tier of MSRP_TIERS){
      if(gb <= tier.cap) return tier.rate;
    }
    return MSRP_TIERS[MSRP_TIERS.length - 1].rate;
  }
  // GenRocket DataConnect is purchased in capacity blocks: a 10GB starter tier,
  // then every block above 10GB must be purchased in 25GB increments
  // (e.g. a 62GB requirement rounds up to a 75GB capacity purchase).
  function purchasedCapacityGB(gb){
    if(gb <= 10) return 10;
    return Math.ceil(gb / 25) * 25;
  }
  // Annual GenRocket DataConnect cost = purchased capacity x MSRP rate for that capacity tier
  function dataConnectCost(gb){
    const cap = purchasedCapacityGB(gb);
    return cap * dcRateForVolume(cap);
  }
  function fmtUSD(n){
    return Math.round(n).toLocaleString('en-US');
  }
  function fmtNum(n, dec=1){
    return Number(n).toLocaleString('en-US', {minimumFractionDigits: dec, maximumFractionDigits: dec});
  }
  const els = {
    teams: document.getElementById('teams'),
    teamsRange: document.getElementById('teamsRange'),
    freq: document.getElementById('freq'),
    freqRange: document.getElementById('freqRange'),
    tokenCost: document.getElementById('tokenCost'),
    tokenCostRange: document.getElementById('tokenCostRange'),
    datasetSize: document.getElementById('datasetSize'),
    datasetSizeRange: document.getElementById('datasetSizeRange'),
  };
  function syncPair(numEl, rangeEl){
    numEl.addEventListener('input', () => {
      rangeEl.value = numEl.value;
      recalc();
    });
    rangeEl.addEventListener('input', () => {
      numEl.value = rangeEl.value;
      recalc();
    });
  }
  syncPair(els.teams, els.teamsRange);
  syncPair(els.freq, els.freqRange);
  syncPair(els.tokenCost, els.tokenCostRange);
  syncPair(els.datasetSize, els.datasetSizeRange);
  function recalc(){
    const teams = parseFloat(els.teams.value) || 0;
    const freq = parseFloat(els.freq.value) || 0;
    const tokenCost = parseFloat(els.tokenCost.value) || 0;
    const datasetSizeKB = parseFloat(els.datasetSize.value) || 0;
    // Derived dataset assumptions
    const datasetGBPerRun = datasetSizeKB / 1e6;             // KB -> GB (1 GB = 1e6 KB)
    const outputTokensPerRun = datasetSizeKB * 1000 / CHARS_PER_TOKEN; // bytes / 4
    const tokensPerRun = outputTokensPerRun + INPUT_TOKENS_PER_RUN;
    // LLM $ / GB -- depends on token cost & dataset size assumptions
    const llmCostPerGB = (tokensPerRun / 1e6) * tokenCost / datasetGBPerRun;
    // Your annual volume
    const runsPerYear = teams * freq * TESTING_DAYS;
    const yourVolumeGB = runsPerYear * datasetGBPerRun;
    const yourLLM = yourVolumeGB * llmCostPerGB;
    const yourCapacity = purchasedCapacityGB(yourVolumeGB);
    const yourDC = dataConnectCost(yourVolumeGB);
    const yourSave = yourLLM - yourDC;
    const yourSavePct = yourLLM > 0 ? (yourSave / yourLLM) * 100 : 0;
    document.getElementById('runsPerYearLabel').textContent = fmtUSD(runsPerYear);
    const dsLabel = datasetSizeKB >= 1000
    ? fmtNum(datasetSizeKB/1000, 2) + ' MB'
    : fmtNum(datasetSizeKB, 0) + ' KB';
    document.getElementById('datasetSizeLabel').textContent = '~' + dsLabel;
    document.getElementById('datasetSizeFoot').textContent =
    dsLabel + ' per test run · ' + fmtUSD(tokensPerRun) + ' tokens/run';
    document.getElementById('yourVolume').textContent = fmtNum(yourVolumeGB, yourVolumeGB < 10 ? 2 : 1);
    document.getElementById('yourLLM').textContent = fmtUSD(yourLLM);
    document.getElementById('yourLLMperGB').textContent = fmtUSD(llmCostPerGB);
    document.getElementById('yourDC').textContent = fmtUSD(yourDC);
    document.getElementById('yourSavePct').textContent = fmtNum(yourSavePct, 0) + '%';
    document.getElementById('yourSaveAmt').textContent = fmtUSD(yourSave);
    document.getElementById('yourCapacityNote').textContent =
    'Billed at ' + yourCapacity + ' GB capacity';
    // ---------- Comparison table ----------
    const tbody = document.getElementById('compareBody');
    tbody.innerHTML = '';
    // Build rows: fixed breakpoints + "your volume" row inserted in sorted position
    const rows = BREAKPOINTS.map(gb => ({gb, isYou:false}));
    rows.push({gb: yourVolumeGB, isYou:true});
    rows.sort((a,b) => a.gb - b.gb);
    rows.forEach(r => {
      const gb = r.gb;
      const llm = gb * llmCostPerGB;
      const dc = dataConnectCost(gb);
      const save = llm - dc;
      const savePct = llm > 0 ? (save/llm)*100 : 0;
      const tr = document.createElement('tr');
      if(r.isYou) tr.className = 'you';
      let volLabel;
      if(r.isYou){
        const cap = purchasedCapacityGB(gb);
        const capNote = cap !== Math.round(gb) ? ` <span class="cap-note">→ billed as ${cap} GB</span>` : '';
        volLabel = `${fmtNum(gb, gb < 10 ? 2 : 1)} GB${capNote} <span class="you-tag">Your volume</span>`;
      } else {
        volLabel = `${gb} GB`;
      }
      tr.innerHTML = `
        <td class="vol">${volLabel}</td>
        <td class="llm">$${fmtUSD(llm)}</td>
        <td class="dc">$${fmtUSD(dc)}</td>
        <td class="save">$${fmtUSD(save)}</td>
        <td class="savepct"><span class="pill">${fmtNum(savePct,0)}%</span></td>
      `;
      tbody.appendChild(tr);
    });
    drawChart(llmCostPerGB, yourVolumeGB);
  }
  function drawChart(llmCostPerGB, yourVolumeGB){
    const svg = document.getElementById('chartSvg');
    svg.innerHTML = '';
    const W = 760, H = 320;
    const padL = 60, padR = 20, padT = 24, padB = 46;
    const plotW = W - padL - padR;
    const plotH = H - padT - padB;
    const data = BREAKPOINTS.map(gb => ({
      gb,
      llm: gb * llmCostPerGB,
      dc: gb * dcRateForVolume(gb)
    }));
    const maxVal = Math.max(...data.map(d => Math.max(d.llm, d.dc))) * 1.12;
    const groupW = plotW / data.length;
    const barW = groupW * 0.30;
    const gap = groupW * 0.06;
    const ns = 'http://www.w3.org/2000/svg';
    function el(tag, attrs){
      const e = document.createElementNS(ns, tag);
      for(const k in attrs) e.setAttribute(k, attrs[k]);
        return e;
    }
    // gridlines + y labels
    const ticks = 4;
    for(let i=0; i<=ticks; i++){
      const val = maxVal * i / ticks;
      const y = padT + plotH - (val/maxVal)*plotH;
      svg.appendChild(el('line', {x1:padL, x2:W-padR, y1:y, y2:y, stroke:'#e2e8ee', 'stroke-width':1}));
      const t = el('text', {x: padL-10, y: y+4, 'text-anchor':'end', 'font-size':11, fill:'#6b7c93', 'font-family':"var(--pagefont)"});
      t.textContent = '$' + Math.round(val/1000) + 'k';
      svg.appendChild(t);
    }
    data.forEach((d, i) => {
      const groupX = padL + i*groupW;
      const center = groupX + groupW/2;
      // LLM bar
      const llmH = (d.llm/maxVal)*plotH;
      const llmX = center - barW - gap/2;
      svg.appendChild(el('rect', {
        x: llmX, y: padT + plotH - llmH, width: barW, height: Math.max(llmH,1),
        fill:'#e8a15c', rx:4
      }));
      const llmLabel = el('text', {x: llmX + barW/2, y: padT + plotH - llmH - 8, 'text-anchor':'middle', 'font-size':11.5, fill:'#b5651d', 'font-family':"var(--pagefont)", 'font-weight':600});
      llmLabel.textContent = '$' + fmtUSD(d.llm);
      svg.appendChild(llmLabel);
      // DC bar
      const dcH = (d.dc/maxVal)*plotH;
      const dcX = center + gap/2;
      svg.appendChild(el('rect', {
        x: dcX, y: padT + plotH - dcH, width: barW, height: Math.max(dcH,1),
        fill:'#a6d540', rx:4
      }));
      const dcLabel = el('text', {x: dcX + barW/2, y: padT + plotH - dcH - 8, 'text-anchor':'middle', 'font-size':11.5, fill:'#a6d540', 'font-family':"var(--pagefont)", 'font-weight':600});
      dcLabel.textContent = '$' + fmtUSD(d.dc);
      svg.appendChild(dcLabel);
      // x axis label
      const xLabel = el('text', {x: center, y: H-16, 'text-anchor':'middle', 'font-size':13, fill:'#16263b', 'font-family':"'Catamaran', sans-serif", 'font-weight':600});
      xLabel.textContent = d.gb + ' GB';
      svg.appendChild(xLabel);
    });
    // "your volume" marker — vertical dashed line + dot at nearest position along x-axis scale
    // Map yourVolumeGB onto the x-axis using a simple piecewise scale across breakpoint centers
    if(yourVolumeGB > 0){
      const gbs = data.map(d=>d.gb);
      const centers = data.map((d,i)=> padL + i*groupW + groupW/2);
      let markerX;
      if(yourVolumeGB <= gbs[0]){
        markerX = centers[0] - (groupW/2)*( (gbs[0]-yourVolumeGB)/gbs[0] );
      } else if(yourVolumeGB >= gbs[gbs.length-1]){
        const extra = Math.min((yourVolumeGB - gbs[gbs.length-1]) / gbs[gbs.length-1], 1);
        markerX = centers[centers.length-1] + (groupW/2)*extra;
      } else {
        for(let i=0;i<gbs.length-1;i++){
          if(yourVolumeGB >= gbs[i] && yourVolumeGB <= gbs[i+1]){
            const frac = (yourVolumeGB - gbs[i]) / (gbs[i+1]-gbs[i]);
            markerX = centers[i] + frac*(centers[i+1]-centers[i]);
            break;
          }
        }
      }
      markerX = Math.max(padL, Math.min(W-padR, markerX));
      svg.appendChild(el('line', {x1:markerX, x2:markerX, y1:padT-6, y2:padT+plotH, stroke:'#2abdf0', 'stroke-width':2, 'stroke-dasharray':'4 4'}));
      svg.appendChild(el('circle', {cx:markerX, cy:padT-6, r:5, fill:'#2abdf0'}));
      const yl = el('text', {x:markerX, y:padT-12, 'text-anchor':'middle', 'font-size':10.5, fill:'#2abdf0', 'font-family':"var(--pagefont)", 'font-weight':700});
      yl.textContent = 'YOU';
      svg.appendChild(yl);
    }
  }
  recalc();
</script>
<script>
document.querySelectorAll('input[type="number"]').forEach(el => {
    // Store the last valid value
    let lastValidValue = el.value;
    
    // Prevent invalid characters from being typed
    el.addEventListener('keydown', function(e) {
        const isDecimal = this.id === 'tokenCost' || (this.step && this.step.includes('.'));
        const key = e.key;
        
        // Allow: backspace, delete, tab, escape, enter, arrow keys, home, end
        const controlKeys = ['Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 
                            'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
                            'Home', 'End', 'Meta', 'Control', 'Shift'];
        
        if (controlKeys.includes(key) || key.startsWith('F')) {
            return; // Allow these keys
        }
        
        // For decimal inputs: allow digits and dot
        if (isDecimal) {
            if (!/^[0-9.]$/.test(key)) {
                e.preventDefault();
                // Show a subtle feedback (optional)
                this.style.borderColor = 'red';
                setTimeout(() => {
                    if (this.style.borderColor === 'red') {
                        this.style.borderColor = '';
                    }
                }, 500);
            }
        } else {
            // For whole numbers: only allow digits
            if (!/^[0-9]$/.test(key)) {
                e.preventDefault();
                this.style.borderColor = 'red';
                setTimeout(() => {
                    if (this.style.borderColor === 'red') {
                        this.style.borderColor = '';
                    }
                }, 500);
            }
        }
    });
    
    // Handle paste events
    el.addEventListener('paste', function(e) {
        e.preventDefault();
        const pasteData = (e.clipboardData || window.clipboardData).getData('text');
        const isDecimal = this.id === 'tokenCost' || (this.step && this.step.includes('.'));
        
        // Clean the pasted data
        let cleaned = pasteData.replace(isDecimal ? /[^0-9.]/g : /[^0-9]/g, '');
        
        // Prevent multiple decimals
        if (isDecimal && (cleaned.match(/\./g) || []).length > 1) {
            cleaned = cleaned.replace(/(\..*?)\./g, '$1');
        }
        
        if (cleaned) {
            // Insert at cursor position
            const start = this.selectionStart;
            const end = this.selectionEnd;
            this.value = this.value.substring(0, start) + cleaned + this.value.substring(end);
            this.setSelectionRange(start + cleaned.length, start + cleaned.length);
        }
        
        // Validate
        validateInput(this);
    });
    
    // Clean up on input (for any edge cases)
    el.addEventListener('input', function() {
        const isDecimal = this.id === 'tokenCost' || (this.step && this.step.includes('.'));
        
        // Remove any invalid characters that slipped through
        const cleaned = this.value.replace(isDecimal ? /[^0-9.]/g : /[^0-9]/g, '');
        
        // Prevent multiple decimals
        let finalValue = cleaned;
        if (isDecimal && (cleaned.match(/\./g) || []).length > 1) {
            const parts = cleaned.split('.');
            finalValue = parts[0] + '.' + parts.slice(1).join('');
        }
        
        if (finalValue !== this.value) {
            this.value = finalValue;
        }
        
        // Store last valid value (but don't enforce min/max yet)
        if (finalValue && !isNaN(parseFloat(finalValue))) {
            lastValidValue = finalValue;
        }
    });
    
    // Validate on blur (when user leaves the field)
    el.addEventListener('blur', function() {
        validateInput(this);
    });
    
    // Validation function
    function validateInput(input) {
        const val = parseFloat(input.value);
        
        if (!input.value) {
            // If empty, set to min or 0
            if (input.min) {
                input.value = input.min;
                input.style.borderColor = '';
                input.title = '';
            }
            return;
        }
        
        if (!isNaN(val)) {
            // Apply min/max
            if (input.min && val < parseFloat(input.min)) {
                input.value = input.min;
                input.style.borderColor = 'orange';
                input.title = `Minimum value is ${input.min}`;
            } else if (input.max && val > parseFloat(input.max)) {
                input.value = input.max;
                input.style.borderColor = 'orange';
                input.title = `Maximum value is ${input.max}`;
            } else {
                input.style.borderColor = 'green';
                input.title = '';
                // Format to match step (optional)
                if (input.step) {
                    const step = parseFloat(input.step);
                    const rounded = Math.round(val / step) * step;
                    if (Math.abs(val - rounded) < 0.0001) {
                        // It's already a valid step
                    }
                }
            }
        } else {
            // Invalid - revert to last valid value or min
            if (lastValidValue && !isNaN(parseFloat(lastValidValue))) {
                input.value = lastValidValue;
            } else if (input.min) {
                input.value = input.min;
            }
            input.style.borderColor = 'red';
            input.title = 'Please enter a valid number';
        }
    }
});
</script>
<?php get_footer(); ?>