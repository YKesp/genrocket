<?php
/**
 * Template Name: Booth Quiz
 * Description: Interactive GenRocket Booth Quiz with WPForms lead capture & email results
 */


// Template header


get_header();
?>

<style>
  :root {
    --cyan: #27BFF0;
    --blue: #00B0F0;
    --lime: #A6D540;
    --navy: #213C4B;
    --navy2: #152A36;
    --navy3: #0F2028;
    --mute: #9BB9C6;
    --card: rgba(255, 255, 255, 0.06);
    --line: rgba(39, 191, 240, 0.30);
  }

  .booth-quiz-page {
    background: radial-gradient(900px 600px at 80% -5%, #24596e 0%, var(--navy) 45%, var(--navy2) 80%, var(--navy3) 100%);
    background-attachment: fixed;
    min-height: 85vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 15px 60px;
    font-family: -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    color: #fff;
    -webkit-font-smoothing: antialiased;
  }

  .booth-quiz-wrap {
    width: 100%;
    max-width: 520px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
  }

  .booth-quiz-top {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    text-align: center;
  }
  .booth-quiz-top .logo-text {
    font-size: 32px;
    font-weight: 900;
    letter-spacing: -0.02em;
    line-height: 1;
  }
  .booth-quiz-top .logo-text .gen { color: var(--cyan); }
  .booth-quiz-top .logo-text .rocket { color: var(--lime); }
  .verdict {
  text-align: center;
  font-size: 24px;
  font-weight: 900;
  margin-top: 16px;
}
  .booth-quiz-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 22px;
    padding: 32px 24px;
    margin-top: 10px;
    box-shadow: 0 16px 40px rgba(15, 32, 40, 0.4);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: all 0.3s ease;
  }

  .booth-quiz-kick {
    color: var(--cyan);
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 13px;
    text-align: center;
  }

  .booth-quiz-title {
    font-size: 34px;
    font-weight: 900;
    line-height: 1.12;
    text-align: center;
    margin-top: 10px;
    color: #ffffff;
  }
  .booth-quiz-title span {
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
  }

  .booth-quiz-sub {
    color: #dcecf3;
    font-size: 15.5px;
    text-align: center;
    margin-top: 14px;
    line-height: 1.55;
  }

  .booth-quiz-meta {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin-top: 18px;
    flex-wrap: wrap;
  }

  .booth-quiz-pill {
    background: rgba(166, 213, 64, 0.12);
    border: 1px solid rgba(166, 213, 64, 0.45);
    color: #eaf6d8;
    font-size: 12.5px;
    font-weight: 700;
    padding: 7px 13px;
    border-radius: 100px;
  }

  .booth-quiz-btn {
    display: block;
    width: 100%;
    border: 0;
    cursor: pointer;
    font-family: inherit;
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    color: #0b1a22;
    font-size: 18px;
    font-weight: 900;
    padding: 16px 20px;
    border-radius: 100px;
    margin-top: 22px;
    box-shadow: 0 10px 25px rgba(39, 191, 240, 0.28);
    transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s ease;
    text-align: center;
    text-decoration: none;
  }
  .booth-quiz-btn:hover {
    color: #0b1a22;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(39, 191, 240, 0.38);
  }
  .booth-quiz-btn:active {
    transform: translateY(1px);
  }
  .booth-quiz-btn[disabled] {
    opacity: 0.45;
    box-shadow: none;
    cursor: not-allowed;
    transform: none;
  }

  /* Progress Bar */
  .booth-quiz-prog {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
    margin-bottom: 8px;
  }
  .booth-quiz-bar {
    flex: 1;
    height: 8px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.10);
    overflow: hidden;
  }
  .booth-quiz-bar i {
    display: block;
    height: 100%;
    width: 0;
    border-radius: 8px;
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    transition: width 0.35s ease;
  }
  .booth-quiz-count {
    font-size: 13px;
    color: var(--mute);
    font-weight: 700;
    white-space: nowrap;
  }

  .booth-quiz-qkick {
    color: var(--cyan);
    font-weight: 800;
    font-size: 13.5px;
    letter-spacing: 1px;
    text-transform: uppercase;
  }
  .booth-quiz-qtext {
    font-size: 21px;
    font-weight: 800;
    line-height: 1.3;
    margin-top: 10px;
    color: #ffffff;
  }
  .booth-quiz-fun {
    display: inline-block;
    background: rgba(166, 213, 64, 0.15);
    border: 1px solid rgba(166, 213, 64, 0.5);
    color: #eaf6d8;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 1px;
    padding: 4px 10px;
    border-radius: 100px;
    margin-bottom: 8px;
  }

  .booth-quiz-opts {
    margin-top: 18px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .booth-quiz-opt {
    text-align: left;
    width: 100%;
    background: rgba(255, 255, 255, 0.05);
    border: 1.5px solid rgba(255, 255, 255, 0.14);
    color: #fff;
    font-family: inherit;
    font-size: 16px;
    font-weight: 600;
    padding: 14px 16px;
    border-radius: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: border-color 0.15s, background 0.15s, transform 0.1s ease;
  }
  .booth-quiz-opt:hover {
    background: rgba(255, 255, 255, 0.09);
    border-color: rgba(39, 191, 240, 0.4);
    transform: translateY(-1px);
  }
  .booth-quiz-opt .k {
    width: 30px;
    height: 30px;
    flex: none;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.10);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 14px;
    color: #cfe0e8;
    transition: all 0.15s ease;
  }
  .booth-quiz-opt.sel {
    border-color: var(--cyan);
    background: rgba(39, 191, 240, 0.16);
  }
  .booth-quiz-opt.sel .k {
    background: linear-gradient(135deg, var(--cyan), var(--lime));
    color: #0b1a22;
  }

  /* WPForms embedded styling in Booth Challenge */
  .booth-wpforms-box {
    margin-top: 14px;
  }
  .booth-wpforms-box .wpforms-field-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .booth-wpforms-box .wpforms-field {
    padding: 0 !important;
    margin: 0 !important;
  }
  .booth-wpforms-box label.wpforms-field-label {
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    color: #dcecf3;
    margin-bottom: 6px;
  }
  .booth-wpforms-box label.wpforms-field-label .wpforms-required-label {
    color: var(--lime);
    font-weight: 800;
  }
  .booth-wpforms-box input[type="text"],
  .booth-wpforms-box input[type="email"],
  .booth-wpforms-box input[type="tel"],
  .booth-wpforms-box input[type="number"],
  .booth-wpforms-box select,
  .booth-wpforms-box textarea {
    width: 100% !important;
    background: rgba(255, 255, 255, 0.07) !important;
    border: 1.5px solid rgba(255, 255, 255, 0.18) !important;
    border-radius: 12px !important;
    color: #ffffff !important;
    font-size: 15.5px !important;
    font-family: inherit !important;
    padding: 13px 15px !important;
    outline: none !important;
    transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
    box-sizing: border-box !important;
  }
  .booth-wpforms-box input::placeholder,
  .booth-wpforms-box textarea::placeholder {
    color: #7f97a3 !important;
  }
  .booth-wpforms-box input:focus,
  .booth-wpforms-box select:focus,
  .booth-wpforms-box textarea:focus {
    border-color: var(--cyan) !important;
    box-shadow: 0 0 0 3px rgba(39, 191, 240, 0.25) !important;
  }
  .booth-wpforms-box .wpforms-submit-container {
    padding: 0 !important;
    margin-top: 18px !important;
  }
  .booth-wpforms-box button[type="submit"],
  .booth-wpforms-box .wpforms-submit {
    display: block !important;
    width: 100% !important;
    border: 0 !important;
    cursor: pointer !important;
    font-family: inherit !important;
    background: linear-gradient(90deg, var(--cyan), var(--lime)) !important;
    color: #0b1a22 !important;
    font-size: 18px !important;
    font-weight: 900 !important;
    padding: 16px 20px !important;
    border-radius: 100px !important;
    box-shadow: 0 10px 25px rgba(39, 191, 240, 0.28) !important;
    transition: transform 0.15s ease, box-shadow 0.15s ease !important;
    text-align: center !important;
  }
  .booth-wpforms-box button[type="submit"]:hover,
  .booth-wpforms-box .wpforms-submit:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 32px rgba(39, 191, 240, 0.38) !important;
  }
  .booth-wpforms-box em.wpforms-error,
  .booth-wpforms-box label.wpforms-error {
    color: #ff9aa6 !important;
    font-size: 12.5px !important;
    margin-top: 5px !important;
    display: block !important;
  }
  /* Hide automated booth quiz hidden fields containers */
  #wpforms-12790-field_5-container,
  #wpforms-12790-field_9-container,
  #wpforms-12790-field_11-container,
  .wpforms-field-hidden {
    display: none !important;
  }

  /* Score & Results */
  .booth-quiz-score {
    font-size: 72px;
    font-weight: 900;
    text-align: center;
    line-height: 1;
    margin-top: 6px;
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
  }
  .booth-quiz-scorelbl {
    text-align: center;
    color: var(--mute);
    font-weight: 700;
    margin-top: 4px;
    font-size: 13.5px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }
  .booth-quiz-thanks {
    text-align: center;
    font-size: 15.5px;
    color: #dcecf3;
    margin-top: 16px;
    line-height: 1.55;
  }

  .booth-quiz-foot {
    margin-top: 20px;
    padding-top: 16px;
    text-align: center;
    color: var(--mute);
    font-size: 12.5px;
  }
  .booth-quiz-foot a {
    color: var(--cyan);
    text-decoration: none;
    font-weight: 700;
  }
  .booth-quiz-foot a:hover {
    text-decoration: underline;
  }

  .booth-quiz-note {
    color: var(--mute);
    font-size: 12px;
    text-align: center;
    margin-top: 14px;
    line-height: 1.45;
  }

  .booth-quiz-hidden {
    display: none !important;
  }
  @media screen and (max-width:1024px){
  .sticky-bar{ display: none !important;}
    }
</style>

<div class="booth-quiz-page">
  <div class="booth-quiz-wrap">
    
    <!-- Top Header Logo -->
    <div class="booth-quiz-top">
      <div class="logo-text"><span class="gen">Gen</span><span class="rocket">Rocket</span></div>
    </div>

    <!-- SCREEN 1: INTRO -->
    <section id="screen-intro">
      <div class="booth-quiz-card">
        <div class="booth-quiz-kick">The GenRocket Challenge</div>
        <h1 class="booth-quiz-title">Think you know <span style="display:block;">synthetic data?</span></h1>
        <p class="booth-quiz-sub">6 quick questions. One is just for fun. Beat the booth in about 60 seconds. 🚀</p>
        <div class="booth-quiz-meta">
          <span class="booth-quiz-pill">6 questions</span>
          <span class="booth-quiz-pill">~60 seconds</span>
          <span class="booth-quiz-pill">Instant score</span>
        </div>
        <button class="booth-quiz-btn" onclick="startQuiz()">Start the challenge →</button>
      </div>
      <div class="booth-quiz-foot">Design-Driven Synthetic Data · <a href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a></div>
    </section>

    <!-- SCREEN 2: QUIZ INTERACTION -->
    <section id="screen-quiz" class="booth-quiz-hidden">
      <div class="booth-quiz-prog">
        <div class="booth-quiz-bar"><i id="bar"></i></div>
        <div class="booth-quiz-count" id="count">1 / 6</div>
      </div>
      <div class="booth-quiz-card">
        <div id="funtag" class="booth-quiz-fun booth-quiz-hidden">JUST FOR FUN ⚡</div>
        <div class="booth-quiz-qkick" id="qkick"></div>
        <div class="booth-quiz-qtext" id="qtext"></div>
        <div class="booth-quiz-opts" id="opts"></div>
        <button class="booth-quiz-btn" id="nextBtn" disabled onclick="nextQuestion()">Next →</button>
      </div>
      <div class="booth-quiz-foot">Design-Driven Synthetic Data · <a href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a></div>
    </section>

    <!-- SCREEN 3: LEAD FORM GATE (WPForms) -->
    <section id="screen-form" class="booth-quiz-hidden">
      <div class="booth-quiz-card">
        <div class="booth-quiz-kick">One last step</div>
        <h2 class="booth-quiz-title">See your <span>score</span></h2>
        <p class="booth-quiz-sub" style="font-size:14.5px; margin-top:8px;">Pop in your details and we'll reveal your result.</p>

        <!-- WPForms Container -->
        <div class="booth-wpforms-box">
          <div id="wpforms-booth-slot">
            <?php echo do_shortcode('[wpforms id="12790" title="false"]'); ?>
          </div>
        </div>

        <p class="booth-quiz-note">We'll only use this to share your score and relevant GenRocket resources. No spam.</p>
      </div>
      <div class="booth-quiz-foot">Design-Driven Synthetic Data · <a href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a></div>
    </section>

    <!-- SCREEN 4: RESULTS & SCORE -->
    <section id="screen-result" class="booth-quiz-hidden">
      <div class="booth-quiz-card">
        <div class="booth-quiz-kick" style="text-align:center;">Your result</div>
        <div class="booth-quiz-score" id="score">0 / 6</div>
        <div class="booth-quiz-scorelbl" id="scorelbl">GenRocket knowledge score</div>
        <div class="verdict" id="verdict">Now you're in the know 👀</div>
        <div class="booth-quiz-thanks" id="thanks"></div>
        
        <!-- Resource Hub Download Button -->
        <a href="https://www.genrocket.com/wp-content/uploads/2026/09/GenRocket-Resource-Hub-2609-01.pdf" target="_blank" download="GenRocket-Resource-Hub-2609-01.pdf" class="booth-quiz-btn" style="margin-top:22px; background: linear-gradient(90deg, var(--cyan), var(--lime)); color: #0b1a22 !important; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 900;">📥 Download Resource Hub (PDF) →</a>
        
        <button class="booth-quiz-btn" onclick="window.open('https://www.genrocket.com')" style="margin-top:12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #fff;">Explore GenRocket →</button>
        <a href="<?php echo esc_url(site_url('/booth-quiz-leaderboard/')); ?>" class="booth-quiz-btn" style="margin-top:12px; background: rgba(39,191,240,0.12); border: 1.5px solid var(--cyan); color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">🏆 View Live Leaderboard →</a>
      </div>
      <div class="booth-quiz-foot">Thanks for stopping by our booth 💙 · <a href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a></div>
    </section>

  </div>
</div>

<script>
(function() {
  var QUESTIONS = [
    { 
      kick: "Question 1 · The basics",
      q: "GenRocket creates test data using…",
      opts: ["Copies of masked production data", "GANs, VAEs & LLMs", "Design-Driven Synthetic Data", "A very fast intern ☕"],
      answer: 2 
    },
    { 
      kick: "Question 2 · Show me the money",
      q: "Switching from legacy TDM to GenRocket typically cuts data costs by…",
      opts: ["5–10%", "20–30%", "50–75%", "You actually pay more"],
      answer: 2 
    },
    { 
      fun: true, 
      kick: "Question 3 · Booth energy check",
      q: "What's your power-up right now? (No wrong answers ⚡)",
      opts: ["☕ Coffee, keep it coming", "🍫 The chocolate stash", "🎧 Lo-fi + focus mode", "🚀 Pure adrenaline"],
      answer: -1 
    },
    { 
      kick: "Question 4 · Scale it up",
      q: "How many intelligent data generators does GenRocket ship with?",
      opts: ["Around 50", "Around 200", "780+", "One big magic button"],
      answer: 2 
    },
    { 
      kick: "Question 5 · Privacy superpower",
      q: "GenRocket's #1 privacy advantage is…",
      opts: ["Military-grade encryption", "It never touches production data", "It deletes data after each run", "It hides data behind a login"],
      answer: 1 
    },
    { 
      kick: "Question 6 · Beyond the database",
      q: "Besides database rows, GenRocket can also generate…",
      opts: ["Only plain CSV files", "PDFs, images & documents too", "Nothing but numbers", "Your morning coffee ☕"],
      answer: 1 
    }
  ];

  var idx = 0;
  var selected = null;
  var score = 0;
  var picks = [];
  var startTime = 0;
  var endTime = 0;
  var elapsedDurationStr = "00:00:000";
  var elapsedMs = 0;
  var LETTERS = ["A", "B", "C", "D"];
  var ajaxUrl = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";

  // Helper to format millisecond difference into mm:ss:SSS
  function formatTimeMs(diffMs) {
    if (!diffMs || diffMs < 0) diffMs = 0;
    var mins = Math.floor(diffMs / 60000);
    var secs = Math.floor((diffMs % 60000) / 1000);
    var ms = diffMs % 1000;

    var mStr = (mins < 10 ? "0" : "") + mins;
    var sStr = (secs < 10 ? "0" : "") + secs;
    var msStr = (ms < 100 ? (ms < 10 ? "00" : "0") : "") + ms;

    return mStr + ":" + sStr + ":" + msStr;
  }

  function showScreen(id) {
    ["intro", "quiz", "form", "result"].forEach(function(s) {
      var el = document.getElementById("screen-" + s);
      if (el) {
        el.classList.toggle("booth-quiz-hidden", s !== id);
      }
    });
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  window.startQuiz = function() {
    idx = 0;
    score = 0;
    picks = [];
    startTime = Date.now();
    endTime = 0;
    elapsedDurationStr = "00:00:000";
    elapsedMs = 0;
    showScreen("quiz");
    renderQuestion();
  };

  function renderQuestion() {
    var it = QUESTIONS[idx];
    var funtag = document.getElementById("funtag");
    if (funtag) funtag.classList.toggle("booth-quiz-hidden", !it.fun);

    document.getElementById("qkick").textContent = it.kick;
    document.getElementById("qtext").textContent = it.q;
    document.getElementById("bar").style.width = ((idx) / QUESTIONS.length * 100) + "%";
    document.getElementById("count").textContent = (idx + 1) + " / " + QUESTIONS.length;
    
    var box = document.getElementById("opts");
    box.innerHTML = "";
    selected = null;

    it.opts.forEach(function(o, i) {
      var b = document.createElement("button");
      b.type = "button";
      b.className = "booth-quiz-opt";
      b.innerHTML = '<span class="k">' + LETTERS[i] + '</span><span>' + o + '</span>';
      b.onclick = function() { pickOption(i, b); };
      box.appendChild(b);
    });

    var nb = document.getElementById("nextBtn");
    nb.disabled = true;
    nb.textContent = (idx === QUESTIONS.length - 1) ? "Finish →" : "Next →";
  }

  function pickOption(i, el) {
    selected = i;
    document.querySelectorAll(".booth-quiz-opt").forEach(function(o) {
      o.classList.remove("sel");
    });
    el.classList.add("sel");
    document.getElementById("nextBtn").disabled = false;
  }

  window.nextQuestion = function() {
    var it = QUESTIONS[idx];
    picks.push({
      q: it.q,
      choice: it.opts[selected],
      correct: it.fun || selected === it.answer
    });

    if (it.fun || selected === it.answer) {
      score++;
    }

    if (idx < QUESTIONS.length - 1) {
      idx++;
      renderQuestion();
    } else {
      // Quiz ended right before form gate: calculate exact difference in milliseconds
      endTime = Date.now();
      elapsedMs = (startTime > 0) ? (endTime - startTime) : 0;
      elapsedDurationStr = formatTimeMs(elapsedMs);

      document.getElementById("bar").style.width = "100%";
      prepareFormGate();
      showScreen("form");
    }
  };

  // Helper to extract clean company name from participant email domain
  function extractCompanyFromEmail(email) {
    if (!email || typeof email !== "string" || email.indexOf("@") === -1) return "";
    var parts = email.split("@");
    if (parts.length < 2) return "";
    var domain = parts[1].toLowerCase().trim();
    var domainParts = domain.split(".");
    if (domainParts.length < 1) return "";

    var main = domainParts[0];
    if (!main) return "";

    var knownUpper = ["ibm", "aws", "sap", "hcl", "tcs", "hp", "ey", "pwc", "ge", "it", "qa"];
    var words = main.split(/[-_.]/).filter(Boolean);
    return words.map(function(w) {
      if (knownUpper.indexOf(w.toLowerCase()) !== -1) {
        return w.toUpperCase();
      }
      return w.charAt(0).toUpperCase() + w.slice(1);
    }).join(" ");
  }

  function prepareFormGate() {
    var form = document.querySelector("#wpforms-booth-slot form.wpforms-form");
    if (!form) return;

    var scoreStr = score + " / " + QUESTIONS.length;
    var finalTimeStr = elapsedDurationStr || (startTime > 0 ? formatTimeMs(Date.now() - startTime) : "00:00:000");

    // Helper to safely set hidden inputs
    function setHiddenInput(name, value) {
      var input = form.querySelector('input[name="' + name + '"]');
      if (!input) {
        input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        form.appendChild(input);
      }
      input.value = value;
    }

    // 1. Populate registered WPForms Field #5 (Score)
    var field5 = form.querySelector('input[name="wpforms[fields][5]"], #wpforms-12790-field_5');
    if (field5) { field5.value = scoreStr; }
    setHiddenInput('booth_quiz_score', scoreStr);
    setHiddenInput('wpforms[fields][5]', scoreStr);

    // 2. Populate registered WPForms Field #9 (Time Taken with Milliseconds mm:ss:SSS)
    var field9 = form.querySelector('input[name="wpforms[fields][9]"], #wpforms-12790-field_9');
    if (field9) { field9.value = finalTimeStr; }
    setHiddenInput('time_taken', finalTimeStr);
    setHiddenInput('booth_quiz_time_taken', finalTimeStr);
    setHiddenInput('wpforms[fields][9]', finalTimeStr);
    setHiddenInput('quiz_start_time', startTime);
    setHiddenInput('quiz_end_time', endTime);
    setHiddenInput('quiz_duration_ms', elapsedMs);

    // 3. Automatically listen to email input to identify company & populate Hidden Field #11
    var emailInput = form.querySelector('input[type="email"], #wpforms-12790-field_3, input[name="wpforms[fields][3]"]');
    var companyField11 = form.querySelector('input[name="wpforms[fields][11]"], #wpforms-12790-field_11');

    function syncCompanyFromEmail() {
      if (!emailInput || !emailInput.value) return;
      var detectedCompany = extractCompanyFromEmail(emailInput.value);
      if (detectedCompany) {
        if (companyField11) {
          companyField11.value = detectedCompany;
        }
        setHiddenInput('wpforms[fields][11]', detectedCompany);
        setHiddenInput('booth_quiz_company', detectedCompany);
        setHiddenInput('company', detectedCompany);
      }
    }

    if (emailInput) {
      emailInput.addEventListener("blur", syncCompanyFromEmail);
      emailInput.addEventListener("input", syncCompanyFromEmail);
      emailInput.addEventListener("keyup", syncCompanyFromEmail);
      emailInput.addEventListener("change", syncCompanyFromEmail);
      if (emailInput.value) {
        syncCompanyFromEmail();
      }
    }

    // Intercept form submit to prevent page reload & show results smoothly
    form.addEventListener("submit", function(e) {
      // Validate required inputs first
      var isValid = form.checkValidity ? form.checkValidity() : true;
      if (!isValid) {
        return; // Allow browser/WPForms to show validation errors
      }

      // Check if email input has value
      if (emailInput && !emailInput.value.trim()) {
        return;
      }

      syncCompanyFromEmail();

      // Re-ensure Field 9 and Field 5 are set on submit
      if (field9) { field9.value = finalTimeStr; }
      setHiddenInput('wpforms[fields][9]', finalTimeStr);
      setHiddenInput('time_taken', finalTimeStr);

      if (field5) { field5.value = scoreStr; }
      setHiddenInput('wpforms[fields][5]', scoreStr);

      e.preventDefault();
      handleFormSubmitted(form);

      // Submit via Fetch/AJAX in background to record entry
      try {
        var formData = new FormData(form);
        fetch(form.action || window.location.href, {
          method: 'POST',
          body: formData,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).catch(function(){});
      } catch(err) {}

      // Immediately show results on page without page reload
      window.showResults();
    });
  }

  function handleFormSubmitted(form) {
    var emailInput = form ? form.querySelector('input[type="email"], #wpforms-12790-field_3') : null;
    var emailVal = emailInput ? emailInput.value.trim() : '';

    var nameInput = form ? form.querySelector('#wpforms-12790-field_2, input[name="wpforms[fields][2]"], input[name*="[first]"], input[name*="name"], input[type="text"]') : null;
    var nameVal = nameInput ? nameInput.value.trim() : 'Participant';

    // Read Designation (Field #4 or inputs with designation/title/role/job)
    var designationInput = form ? form.querySelector('#wpforms-12790-field_4, input[name="wpforms[fields][4]"], input[name*="designation"], input[name*="title"], input[name*="role"], input[name*="job"]') : null;
    var designationVal = designationInput ? designationInput.value.trim() : '';

    // Read Contact / Phone Number
    var phoneInput = form ? form.querySelector('#wpforms-12790-field_6, #wpforms-12790-field_7, #wpforms-12790-field_8, #wpforms-12790-field_10, input[type="tel"], input[name*="phone"], input[name*="contact"], input[name*="mobile"], .wpforms-field-phone input') : null;
    var phoneVal = phoneInput ? phoneInput.value.trim() : '';

    // Read from Hidden Field #11 or auto-derive from email domain
    var companyInput = form ? form.querySelector('input[name="wpforms[fields][11]"], #wpforms-12790-field_11, input[name*="company"]') : null;
    var companyVal = companyInput ? companyInput.value.trim() : '';
    if (!companyVal && emailVal) {
      companyVal = extractCompanyFromEmail(emailVal);
    }

    var timeTaken = elapsedDurationStr || (startTime > 0 ? formatTimeMs(Date.now() - startTime) : "00:00:000");

    // Direct AJAX trigger to save to leaderboard and send email
    if (emailVal) {
      var ajaxPayload = {
        action: 'send_booth_quiz_email',
        email: emailVal,
        name: nameVal,
        phone: phoneVal,
        designation: designationVal,
        company: companyVal,
        score: score + ' / ' + QUESTIONS.length,
        time_taken: timeTaken
      };

      if (window.jQuery && window.jQuery.ajax) {
        window.jQuery.ajax({
          url: ajaxUrl,
          type: 'POST',
          data: ajaxPayload
        });
      } else {
        var formData = new FormData();
        for (var k in ajaxPayload) {
          if (ajaxPayload.hasOwnProperty(k)) {
            formData.append(k, ajaxPayload[k]);
          }
        }
        fetch(ajaxUrl, { method: 'POST', body: formData }).catch(function(){});
      }
    }
  }

  window.showResults = function() {
    showScreen("result");
    document.getElementById("score").textContent = score + " / " + QUESTIONS.length;
    document.getElementById("scorelbl").textContent = "GenRocket knowledge score";
    document.getElementById("thanks").innerHTML = "<b>Thank you</b> for taking the challenge and visiting our booth! Your result has been submitted. Download your Resource Hub guide below and come say hi to our team to learn more about Design-Driven Synthetic Data.";
  };

  // Always start fresh quiz on page load / page refresh
  function initPage() {
    idx = 0;
    score = 0;
    picks = [];
    showScreen("intro");
  }

  // Listen for WPForms AJAX completion
  if (window.jQuery) {
    window.jQuery(document).on('wpformsSubmitSuccess wpformsAjaxSubmitSuccess', function(event, response, $form) {
      handleFormSubmitted($form ? $form[0] : null);
      window.showResults();
    });
  }

  // Observe WPForms slot for dynamic confirmation injection
  var slot = document.getElementById('wpforms-booth-slot');
  if (slot && window.MutationObserver) {
    var observer = new MutationObserver(function(mutations) {
      var confirm = slot.querySelector('.wpforms-confirmation-container');
      if (confirm) {
        confirm.style.display = 'none';
        window.showResults();
      }
    });
    observer.observe(slot, { childList: true, subtree: true });
  }

  if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", initPage);
  } else {
    initPage();
  }

})();
</script>

<?php get_footer(); ?>