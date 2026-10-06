<?php /* Template Name: Enterprise Data Provisioning */ ?>
<?php get_header(); ?>
<style>
  #wrapper,#main{overflow:visible;}
.wrap{max-width:1160px;margin:0 auto;padding:0 24px;}
/* ---------------- NAV ---------------- */
.brand{display:flex;align-items:center;gap:10px;}
.brand-mark{width:30px;height:30px;flex-shrink:0;}
.brand-name{font-size:20px;font-weight:800;letter-spacing:-.02em;}
.brand-name .gen{color:#27BFF0;}
.brand-name .rocket{color:#6DBF42;}
@media (max-width:640px){
  .nav-cta{display:none;}
}
#wpforms-confirmation-12191 h3{color: #213C4B !important;font-weight: 700;}
/* ---------------- HERO ---------------- */
.hero{background:radial-gradient(1000px 500px at 85% -10%,rgba(39,191,240,.16) 0%,rgba(39,191,240,0) 60%),radial-gradient(800px 500px at 5% 110%,rgba(166,213,64,.16) 0%,rgba(166,213,64,0) 60%),#E9F0F3;padding:44px 0 56px;border-bottom:1px solid #dfe8ed;}
.hero-grid{display:grid;grid-template-columns:1fr 430px;gap:44px;align-items:start;}
#form .form-box{background:#213C4B;border-radius:30px;color:#fff;padding:26px;font-size:14px;position:sticky;top:150px;}
#form .form-box h3{font-size:clamp(18px,4vw,25px);color:#fff;}
#form .form-box h3 .text-primary{color:#27BFF0!important;}
#form .form-box label{font-size:12px!important;color:#fff;text-transform:uppercase!important;}
#form .form-box p:empty{display:none;}
#form .form-box br{display:none;}
#form .form-box .wpforms-field-medium{background:transparent!important;border:1px solid #fff!important;border-radius:5px!important;color:#fff!important;}
#form .form-box .wpforms-submit{background:#27BFF0!important;color:#fff!important;border-radius:5px!important;}
#form .form-box #wpforms-12191-field_2{border:1px solid #fff!important;list-style:none;padding:5px!important;border-radius:5px!important;position:relative;display:flex;}
#form .form-box #wpforms-12191-field_2 li{width:50%;padding:0!important;margin:0!important;}
#form .form-box #wpforms-12191-field_2 li:after,#form .form-box #wpforms-12191-field_2 li:before{display:none;}
#form .form-box #wpforms-12191-field_2 li input{position:fixed;left:-9999px;top:-9999px;}
#form .form-box #wpforms-12191-field_2 li label{color:#fff;width:100%;text-align:center;position:relative;z-index:99;display:block;line-height:36px;cursor:pointer;font-size:14px!important;text-transform:unset!important;}
#form .form-box #wpforms-12191-field_2:after{width:50%;border-radius:5px;background:#27BFF0;content:'';position:absolute;left:0;top:5px;bottom:5px;transition:all linear 0.2s;pointer-events:none;transform:translateX(5px);}
#form .form-box #wpforms-12191-field_2:has(#wpforms-12191-field_2_1:checked):after{transform:translateX(5px);}
#form .form-box #wpforms-12191-field_2:has(#wpforms-12191-field_2_2:checked):after{transform:translateX(97%);}
#form .form-box div.wpforms-container-full{margin:8px auto 10px;}
#form .form-box #wpforms-11760 + p{margin:0;}
#form .form-box div.wpforms-container-full ~ p.m-0.text-center{margin-top:0;font-size:14px;}
#wpforms-submit-12191{font-size:0!important;position:relative;height:38px;}
/* SHOW pseudo-element text */
#wpforms-submit-12191:before{content:"Request my live demo";font-size:14px!important;border-radius:5px!important;font-weight:600!important;position:absolute;left:0;right:0;text-align:center;top:9px;}
#wpforms-12191:has(#wpforms-12191-field_2_2:checked) #wpforms-submit-12191:before{content:'Request my POC';/* content: "Send me the 30-Min Demo Video →"; */}
/* eyebrow + bridge graphic */
.eyebrow{display:inline-flex;align-items:center;gap:8px;background:#ffffff;border:1px solid #cfe9f7;color:#23A6DE;font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;padding:7px 14px;border-radius:999px;margin-bottom:20px;}
.eyebrow svg{width:14px;height:14px;}
.bridge{display:flex;align-items:center;gap:12px;max-width:430px;margin:0 0 22px;}
.bridge-node{font-size:10.5px;font-weight:700;letter-spacing:.04em;padding:7px 12px;border-radius:8px;white-space:nowrap;}
.bridge-node.now{background:#213C4B;color:#fff;}
.bridge-node.next{background:rgba(166,213,64,.18);color:#5c8a12;border:1px solid rgba(166,213,64,.7);}
.bridge-line{flex:1;height:2px;position:relative;background:repeating-linear-gradient(90deg,#27BFF0 0,#27BFF0 6px,transparent 6px,transparent 12px);background-size:12px 2px;animation:travel 1.3s linear infinite;}
.bridge-line::after{content:"";position:absolute;right:-2px;top:-4px;border-top:5px solid transparent;border-bottom:5px solid transparent;border-left:7px solid #27BFF0;}
@keyframes travel{
  from{background-position:0 0;}
  to{background-position:12px 0;}
}
@media (prefers-reduced-motion:reduce){
  .bridge-line{animation:none;}
}
.hero h2{font-size:40px;margin-bottom:14px;font-weight:700;}
.hero h2 em{font-style:normal;color:#23A6DE;}
.hero .sub{font-size:17px;color:#5f7381;max-width:560px;margin-bottom:24px;line-height:1.4;}
/* compact video */
.video-card{background:#213C4B;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px rgba(33,60,75,.10);max-width:620px;}
.video-frame{position:relative;width:100%;aspect-ratio:16/9;background:linear-gradient(140deg,#213C4B 0%,#162b36 100%);display:flex;align-items:center;justify-content:center;}
.video-frame iframe,.video-frame video{position:absolute;inset:0;width:100%;height:100%;border:0;}
.play{width:60px;height:60px;border-radius:50%;background:#A6D540;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 8px 22px rgba(166,213,64,.4);}
.play svg{width:22px;height:22px;margin-left:4px;}
.video-ph{text-align:center;padding:20px;}
.video-ph .t{color:#fff;font-weight:700;font-size:16px;margin-bottom:3px;}
.video-ph .n{font-size:12px;color:#8fb0c1;}
.video-meta{display:flex;align-items:center;gap:12px;flex-wrap:wrap;padding:12px 18px;background:#1a3140;font-size:12.5px;color:#a9c3d1;}
.chip{font-size:10.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;background:rgba(39,191,240,.18);color:#27BFF0;padding:4px 10px;border-radius:999px;}
.video-meta strong{color:#fff;font-weight:600;}
.trust{display:flex;flex-wrap:wrap;gap:10px 22px;margin-top:22px;font-size:13px;color:#5f7381;min-width: 32%;}
.trust span{display:inline-flex;align-items:center;gap:7px;min-width: 32%;}
.trust svg{width:15px;height:15px;stroke:#6DBF42;flex-shrink:0;}
/* ---------------- FORM ---------------- */
.form-card{border:1px solid #dfe8ed;border-radius:18px;box-shadow:0 20px 50px rgba(33,60,75,.16);position:sticky;top:88px;}
.form-card h2{font-size:21px;margin-bottom:6px;}
.form-card .lede{font-size:13.5px;color:#5f7381;margin-bottom:20px;}
/* segmented request-type toggle */
.segmented{display:grid;grid-template-columns:1fr 1fr;gap:6px;background:#E9F0F3;padding:5px;border-radius:12px;margin-bottom:20px;}
.segmented input{position:absolute;opacity:0;pointer-events:none;}
.segmented label{display:flex;align-items:center;justify-content:center;gap:7px;font-size:13px;font-weight:600;color:#5f7381;padding:10px 8px;border-radius:9px;cursor:pointer;text-align:center;text-transform:none;letter-spacing:0;margin:0;transition:background .15s,color .15s,box-shadow .15s;}
.segmented input:checked + label{background:#ffffff;color:#213C4B;box-shadow:0 2px 6px rgba(33,60,75,.12);}
.segmented input:focus-visible + label{outline:2px solid #27BFF0;outline-offset:2px;}
/*.row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}*/
#formBody .field{margin-bottom:14px;}
#formBody label{display:block;font-size:12.5px;font-weight:600;color:#213C4B;margin-bottom:6px;}
#formBody label .opt{color:#5f7381;font-weight:500;}
#formBody input,#formBody select{width:100%;padding:12px 13px;font-size:15px;font-family:inherit;color:#213C4B;border:1.5px solid #cfdae1;border-radius:10px;background:#ffffff;transition:border-color .15s,box-shadow .15s;}
#formBody input::placeholder{color:#9aacb7;}
#formBody select{appearance:none;padding-right:36px;background-image:url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=!string!viewBox=!string!fill=!string!stroke=!string!stroke-width=!string!stroke-linecap=!string!%3E%3Cpath d=!string!/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;background-size:16px;}
#formBody input:focus,#formBody select:focus{outline:none;border-color:#27BFF0;box-shadow:0 0 0 3px rgba(39,191,240,.22);}
#formBody input.invalid,#formBody select.invalid{border-color:#d94b3d;background-color:#fdf4f3;}
.err{display:none;font-size:12px;color:#c0392b;margin-top:5px;font-weight:500;}
.err.show{display:block;}
.submit{width:100%;margin-top:6px;border:0;cursor:pointer;background:#A6D540;color:#213C4B;font-family:inherit;font-weight:800;font-size:15.5px;letter-spacing:-.01em;padding:15px 20px;border-radius:11px;box-shadow:0 6px 16px rgba(166,213,64,.38);transition:transform .12s,background .15s,box-shadow .15s;}
.submit:hover{background:#b4e04f;box-shadow:0 8px 20px rgba(166,213,64,.45);}
.submit:active{transform:translateY(1px);}
.submit:focus-visible{outline:3px solid #213C4B;outline-offset:2px;}
.micro{font-size:11.5px;color:#5f7381;margin-top:13px;text-align:center;line-height:1.5;}
.micro a{color:#23A6DE;}
.success{display:none;text-align:center;padding:26px 4px;}
.success.show{display:block;}
.success .check{width:56px;height:56px;border-radius:50%;background:rgba(166,213,64,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;}
.success .check svg{width:26px;height:26px;stroke:#6DBF42;}
.success h3{font-size:19px;margin-bottom:8px;}
.success p{font-size:14px;color:#5f7381;}
/* ---------------- BELOW THE FOLD ---------------- */
.section{padding:60px 0;}
.section.alt{background:#E9F0F3;}
.sec-head{max-width:720px;margin-bottom:34px;}
.sec-head .tag{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:#23A6DE;margin-bottom:10px;}
.sec-head h2, .title2{font-size:29px;margin-bottom:12px;font-weight:700;}
.sec-head p{font-size:16px;color:#5f7381;line-height:1.4;}
.pull{border-left:4px solid #A6D540;background:#ffffff;padding:20px 24px;border-radius:0 12px 12px 0;font-size:17px;font-weight:600;color:#213C4B;max-width:760px;margin:0 0 32px;box-shadow:0 10px 30px rgba(33,60,75,.10);}
.cards{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.card{background:#ffffff;border:1px solid #dfe8ed;border-radius:14px;padding:22px;transition:transform .15s,box-shadow .15s;}
.card:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(33,60,75,.10);}
.card .ico{width:38px;height:38px;border-radius:10px;background:#E9F0F3;display:flex;align-items:center;justify-content:center;margin-bottom:14px;}
.card .ico svg{width:19px;height:19px;stroke:#23A6DE;}
.card h3{font-size:15.5px;margin-bottom:7px;font-weight:700;}
.card p{font-size:13.5px;color:#5f7381;line-height:1.55;}
.split{display:grid;grid-template-columns:1fr 1fr;gap:44px;align-items:center;}
.split ul{list-style:none;padding:0;margin:0;}
.split li{display:flex;gap:12px;padding:13px 0;border-bottom:1px solid #dfe8ed;font-size:15px;}
.split li:last-child{border-bottom:0;}
.split li svg{width:18px;height:18px;stroke:#6DBF42;flex-shrink:0;margin-top:3px;}
.split li b{color:#213C4B;}
/* final CTA */
.final{background:linear-gradient(135deg,#213C4B 0%,#16303e 100%);color:#fff;padding:52px 0;text-align:center;position:relative;overflow:hidden;}
.final::after{content:'http://www.w3.org/2000/svg';position:absolute;right:-100px;top:-100px;width:420px;height:420px;background:radial-gradient(circle,rgba(39,191,240,.22) 0%,rgba(39,191,240,0) 70%);}
.final .wrap{position:relative;z-index:2;}
.final h2{font-size:27px;margin-bottom:10px;font-weight:700;}
.final p{color:#b3cad6;font-size:16px;margin-bottom:24px;}
.btn-ghost{display:inline-flex;align-items:center;gap:9px;background:#A6D540;color:#213C4B;font-weight:800;font-size:15.5px;padding:14px 28px;border-radius:11px;text-decoration:none;box-shadow:0 6px 18px rgba(166,213,64,.35);transition:background .15s;}
.btn-ghost:hover{background:#b4e04f;}
.btn-ghost svg{width:17px;height:17px;}
/* ---------------- RESPONSIVE ---------------- */
@media (max-width:1000px){
  .hero-grid{grid-template-columns:1fr;gap:32px;}
  .form-card{position:static;max-width:560px;}
  .cards{grid-template-columns:repeat(2,1fr);}
  .split{grid-template-columns:1fr;gap:28px;}
  .hero h2{font-size:32px;}
}
@media (max-width:640px){
  .hero{padding:32px 0 40px;}
  .hero h2{font-size:27px;}
  .hero .sub{font-size:15.5px;}
  .cards{grid-template-columns:1fr;}
  .row{grid-template-columns:1fr;}
  .bridge-node{font-size:9.5px;padding:6px 9px;}
  .sec-head h2, .title2{font-size:23px;}
  .section{padding:44px 0;}
}
</style>
<main id="main">
  <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <?php //the_content(); ?>
    <!-- ============ HERO: VIDEO + FORM SIDE BY SIDE ============ -->
<section class="hero">
  <div class="wrap hero-grid">

    <!-- LEFT -->
    <div>
      <div class="eyebrow">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 12h18M3 12l4-4M3 12l4 4"/></svg>
        The Bridge in Action
      </div>

      <div class="bridge">
        <span class="bridge-node now">MASKED TODAY</span>
        <span class="bridge-line"></span>
        <span class="bridge-node next">SYNTHETIC-FIRST TOMORROW</span>
      </div>

      <h2>See In-Place Masking run on a  <em>production database</em></h2>
      <p class="sub">If your security team restricted production data access tomorrow, could your QA and AI teams still do their jobs? See how In-Place Masking replaces sensitive production data with 100% secure synthetic data—directly within your production database—while preserving referential integrity and business logic.</p>

      <div class="video-card">
        <div class="video-frame">
          <!-- Replace with the IPM demo embed:
               <iframe src="https://player.vimeo.com/video/XXXXXXX" allowfullscreen title="In-Place Masking demo"></iframe> -->
			<iframe src="https://player.vimeo.com/video/1188429481" allowfullscreen title="In-Place Masking demo"></iframe>
<!--           <div class="video-ph">
            <div class="play"><svg viewBox="0 0 24 24" fill="#213C4B"><path d="M8 5v14l11-7z"/></svg></div>
            <div class="t">In-Place Masking — Product Demo</div>
            <div class="n">Embed the IPM demo video here</div>
          </div> -->
        </div>
<!--         <div class="video-meta">
          <span class="chip">Demo</span>
          <strong>3 min watch</strong>
          <span>No slides. The platform running on real schemas.</span>
        </div> -->
      </div>

      <div class="trust">
        <span><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>No PII is ever exposed</span>
        <span><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Full database masking</span>
        <span><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Production data subsetting</span>
        <span><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>File masking capabilities</span>
      </div>
    </div>

    <!-- RIGHT: FORM -->
    <aside class="form-card" id="form">
      <div class="form-box">
  <h3>Register for a live demo or POC</h3>
  <p class="m-0">Tell us what you need and a GenRocket engineer will get back to you within one business day.</p>
  
  <div class="wpforms-container wpforms-container-full" id="wpforms-11760">
		<?php echo do_shortcode('[wpforms id="12191" title="false"]'); ?>
  </div>

  <p class="m-0 text-center micro" style="font-size: 12px; margin-top: 10px !important;">
    We'll only use your details to arrange this session and share related Enterprise Data Provisioning updates. 
    <a href="https://www.genrocket.com/privacy">Privacy notice</a>
  </p>
</div>

      <div class="success" id="successMsg">
        <div class="check">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        </div>
        <h3>Request received</h3>
        <p>A GenRocket engineer will reach out within one business day to schedule your session. In the meantime, the demo above is yours to watch.</p>
      </div>
    </aside>

  </div>
</section>

<!-- ============ WHY ============ -->
<section class="section">
  <div class="wrap">
    <div class="sec-head">
      <span class="tag">The problem</span>
      <h2>Production data has become a compliance liability</h2>
      <p>As privacy regulations tighten and AI adoption accelerates, organizations can no longer justify exposing sensitive production data across development, testing, analytics, and AI environments. Every non-production copy containing PII increases compliance obligations, audit complexity, and security risk.</p>
    </div>
    <div class="pull">The objective isn’t to reduce the number of copies. It’s to eliminate sensitive production data from lower environments—without disrupting software delivery or AI development.</div>

    <div class="cards">
      <div class="card">
        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h10M4 17h7"/></svg></div>
        <h3>Subsetting</h3>
        <p>Copy only the data each use case requires, reducing storage, provisioning time, and unnecessary exposure</p>
      </div>
      <div class="card">
        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></div>
        <h3>In-Place Masking</h3>
        <p>Replace sensitive production data with deterministic synthetic data directly within existing databases while preserving referential integrity and business logic.</p>
      </div>
      <div class="card">
        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 14h6"/></svg></div>
        <h3>Redaction</h3>
        <p>Protect sensitive information in documents, contracts, images, and other unstructured content while maintaining usability for downstream processes.</p>
      </div>
      <div class="card">
        <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M7 12h10"/></svg></div>
        <h3>Synthetic data</h3>
        <p>Generate privacy-safe datasets from metadata, business rules, and statistical models—without inheriting sensitive information from production.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ DEMO CONTENTS ============ -->
<section class="section alt">
  <div class="wrap split">
    <div>
      <span class="tag" style="display:inline-block;font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:#23A6DE;margin-bottom:10px;">What you'll see</span>
      <h2 class="title2">GenRocket’s In-Place Masking Solution</h2>
      <p style="font-size:16px;line-height:1.4;color:var(--muted);">Data masking is the first stage of GenRocket’s TDM bridge strategy. It delivers the speed and safety you need today and creates the foundation for a synthetic-first future.</p>
      <p>Learn how this solution can bring security, speed, and savings to your data provisioning environment.</p>
    </div>
    <ul>
      <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>PII Discovery</b> — Automatically determine sensitive fields contained in your production data environment.</span></li>
      <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Synthetic data replacement</b> — Replace sensitive production data with synthetic data—the most secure method of data protection that prevents re-identification of sensitive data.</span></li>
      <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Referential integrity</b> — Relationships across tables and systems stay intact, so tests behave like production.</span></li>
      <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>The path forward</b> — How In-Place Masking becomes the on-ramp to a synthetic-first future, one application at a time.</span></li>
    </ul>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="final">
  <div class="wrap">
    <h2>Experience the Benefits of In-Place Masking</h2>
    <p>Book a live demo or POC and see how In-Place Masking delivers security, <br class="d-none d-md-inline-block"> speed, and savings for your team.</p>
    <a class="btn-ghost" href="#form">
      Register now
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><path d="M9 6l6 6-6 6"/></svg>
    </a>
  </div>
</section>
<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>

<?php if(get_field('additional_editor')): ?>
  <?php echo get_field('additional_editor');?>
<?php endif; ?>
</main>
<?php get_footer();