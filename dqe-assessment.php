<?php
/* Template Name: Data Quality Evolution Index Assessment */

// Attach DQE Assessment Report data to WPForms Entries & Notifications
add_filter('wpforms_process_filter', function($fields, $entry, $form_data) {
    if (isset($form_data['id']) && (int)$form_data['id'] === 12223) {
        if (!empty($_POST['dqe_overall_score'])) {
            $fields[991] = array(
                'name'  => 'DQE Index Score',
                'value' => sanitize_text_field($_POST['dqe_overall_score']),
                'id'    => 991,
                'type'  => 'text'
            );
        }
        if (!empty($_POST['dqe_maturity_level'])) {
            $fields[992] = array(
                'name'  => 'Maturity Level',
                'value' => sanitize_text_field($_POST['dqe_maturity_level']),
                'id'    => 992,
                'type'  => 'text'
            );
        }
        if (!empty($_POST['dqe_share_url'])) {
            $fields[993] = array(
                'name'  => 'Report Share Link',
                'value' => esc_url_raw($_POST['dqe_share_url']),
                'id'    => 993,
                'type'  => 'url'
            );
        }
    }
    return $fields;
}, 10, 3);

// Retrieve server-stored session if ?id=... is present in URL
$server_session = null;
if (!empty($_GET['id'])) {
    $share_id_clean = sanitize_text_field($_GET['id']);
    $server_session = get_option('dqe_session_' . $share_id_clean);
    if (!$server_session) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'dqe_reports';
        $report_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE share_id = %s", $share_id_clean));
        if ($report_row) {
            $server_session = array(
                'reportUnlocked' => true,
                'contact'        => array('name' => $report_row->user_name, 'email' => $report_row->user_email, 'company' => $report_row->company),
                'score'          => $report_row->overall_score,
                'level'          => $report_row->maturity_level,
                'pdf_url'        => $report_row->pdf_url
            );
        }
    }
}

get_header();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  window.DQE_SERVER_SESSION = <?php echo json_encode($server_session); ?>;
</script>

<style>
  :root {
    --blue: #27BFF0;
    --blue-deep: #23A6DE;
    --green: #A6D540;
    --green-deep: #6DBF42;
    --ink: #213C4B;
    --mist: #E9F0F3;
    --orange-1: #C04F15;
    --orange-2: #ED7D31;
    --amber: #FFC000;
  }

  .dqe-assessment-wrapper {
    font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
    color: #213C4B;
    -webkit-font-smoothing: antialiased;
    background:
      radial-gradient(circle at top right, rgba(39,191,240,0.08), transparent 28%),
      linear-gradient(180deg, #eef5f7 0%, #dde9ee 100%);
    min-height: 80vh;
  }

  .dqe-assessment-wrapper button { font-family: inherit; cursor: pointer; border: none; background: none; }
  .dqe-assessment-wrapper input { font-family: inherit; }
  .dqe-assessment-wrapper a { color: var(--blue-deep); }

  /* ---------- App Header (Sub-header) ---------- */
  .dqe-assessment-wrapper .app-header {
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    padding: 18px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--mist);
  }
  .dqe-assessment-wrapper .logo { display: flex; align-items: center; gap: 12px; }
  .dqe-assessment-wrapper .logo-text { font-size: 22px; font-weight: 700; letter-spacing: -0.02em; line-height: 1; }
  .dqe-assessment-wrapper .logo-text .gen { color: var(--blue); }
  .dqe-assessment-wrapper .logo-text .rocket { color: var(--green-deep); }
  .dqe-assessment-wrapper .header-link { color: var(--ink); font-size: 14px; font-weight: 500; text-decoration: none; }
  .dqe-assessment-wrapper .header-link:hover { text-decoration: underline; }

  /* Hide automated DQE report details container inside WPForms UI on front-end */
  #wpforms-12223-field_5-container { display: none !important; }

  /* ---------- Buttons ---------- */
  .dqe-assessment-wrapper .btn {
    padding: 14px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    letter-spacing: 0.01em;
    transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
  }
  .dqe-assessment-wrapper .btn:hover:not(:disabled) { transform: translateY(-1px); text-decoration: none; }
  .dqe-assessment-wrapper .btn:disabled { opacity: 0.4; cursor: not-allowed; }
  .dqe-assessment-wrapper .btn-primary { background: var(--ink); color: #fff; }
  .dqe-assessment-wrapper .btn-accent { background: var(--blue); color: #fff; }
  .dqe-assessment-wrapper .btn-green { background: var(--green-deep); color: #fff; }
  .dqe-assessment-wrapper .btn-ghost { background: transparent; color: var(--ink); border: 1px solid var(--ink); }
  .dqe-assessment-wrapper .btn-light { background: linear-gradient(145deg, #ffffff, #f5fafc); color: var(--ink); border: 1px solid var(--mist); }

  /* ---------- Landing ---------- */
  .dqe-assessment-wrapper .landing main { max-width: 1200px; margin: 0 auto; padding: 64px 24px; }
  .dqe-assessment-wrapper .landing-grid { display: grid; grid-template-columns: 7fr 5fr; gap: 48px; align-items: start; }
  @media (max-width: 900px) { .dqe-assessment-wrapper .landing-grid { grid-template-columns: 1fr; } }

  .dqe-assessment-wrapper .badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    color: var(--blue-deep);
    border: 1px solid var(--blue);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-bottom: 24px;
  }
  .dqe-assessment-wrapper h1.hero {
    font-size: clamp(40px, 6vw, 60px);
    font-weight: 700;
    line-height: 1.05;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 24px;
      text-align:left !important;
  }
  .dqe-assessment-wrapper h1.hero .blue { color: var(--blue); }
  .dqe-assessment-wrapper h1.hero .green { color: var(--green-deep); }

  .dqe-assessment-wrapper .hero-sub {
    font-size: 18px;
    line-height: 1.6;
    color: var(--ink);
    opacity: 0.85;
    margin-bottom: 32px;
    max-width: 580px;
  }

  .dqe-assessment-wrapper .cta-row { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 48px; }

  .dqe-assessment-wrapper .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; padding-top: 32px; border-top: 1px solid rgba(33,60,75,0.13); }
  .dqe-assessment-wrapper .stat-num { font-size: 40px; font-weight: 700; color: var(--blue); letter-spacing: -0.02em; }
  .dqe-assessment-wrapper .stat-lbl { font-size: 14px; color: var(--ink); opacity: 0.7; margin-top: 4px; }

  .dqe-assessment-wrapper .level-card { background: linear-gradient(145deg, #ffffff, #f5fafc); border-radius: 16px; padding: 32px; border: 1px solid rgba(33,60,75,0.1); }
  .dqe-assessment-wrapper .level-card-title { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--blue-deep); margin-bottom: 16px; }
  .dqe-assessment-wrapper .level-row { display: flex; align-items: center; gap: 16px; margin-bottom: 14px; }
  .dqe-assessment-wrapper .level-row:last-child { margin-bottom: 0; }
  .dqe-assessment-wrapper .level-num {
    width: 40px; height: 40px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 700; font-size: 14px;
    flex-shrink: 0;
  }
  .dqe-assessment-wrapper .level-name { font-weight: 600; color: var(--ink); font-size: 14px; }
  .dqe-assessment-wrapper .level-desc { font-size: 13px; color: var(--ink); opacity: 0.7; line-height: 1.4; }

  .dqe-assessment-wrapper .deliverables {
    background: var(--ink);
    color: #fff;
    border-radius: 16px;
    padding: 28px;
    margin-top: 24px;
  }
  .dqe-assessment-wrapper .deliverables-title { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--green); margin-bottom: 14px; }
  .dqe-assessment-wrapper .deliverables ul { list-style: none; padding: 0; margin: 0; }
  .dqe-assessment-wrapper .deliverables li { font-size: 14px; margin-bottom: 8px; display: flex; gap: 10px; }
  .dqe-assessment-wrapper .deliverables li::before { content: "▸"; color: var(--green); }

  .dqe-assessment-wrapper .app-footer { text-align: center; padding: 32px 24px; font-size: 12px; color: var(--ink); opacity: 0.6; }

  /* ---------- Assessment Flow ---------- */
  .dqe-assessment-wrapper .progress-bar-wrap { background: linear-gradient(145deg, #ffffff, #f5fafc); }
  .dqe-assessment-wrapper .progress-bar-inner { max-width: 900px; margin: 0 auto; padding: 12px 24px 16px; }
  .dqe-assessment-wrapper .progress-meta { display: flex; justify-content: space-between; font-size: 12px; font-weight: 500; color: var(--ink); margin-bottom: 8px; }
  .dqe-assessment-wrapper .progress-track { height: 6px; border-radius: 999px; overflow: hidden; background: var(--mist); }
  .dqe-assessment-wrapper .progress-fill { height: 100%; background: linear-gradient(90deg, #27BFF0, #A6D540); transition: width 0.3s ease; }

  .dqe-assessment-wrapper .assess-main {
    background:
      radial-gradient(circle at top right, rgba(39,191,240,0.08), transparent 25%),
      linear-gradient(160deg, rgba(255,255,255,0.92), rgba(233,240,243,0.96));
    border: 1px solid rgba(33,60,75,0.08);
    box-shadow: 0 24px 60px rgba(33,60,75,0.12);
    border-radius: 30px;
    max-width: 980px;
    margin: 32px auto;
    padding: 56px 24px 80px;
  }
  .dqe-assessment-wrapper .dim-label { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--blue-deep); margin-bottom: 12px; }
  .dqe-assessment-wrapper h2.dim-title { font-size: clamp(28px, 4vw, 36px); font-weight: 700; letter-spacing: -0.02em; color: var(--ink); margin-bottom: 16px; line-height: 1.2; }
  .dqe-assessment-wrapper .dim-anchor { font-size: 17px; line-height: 1.6; color: var(--ink); opacity: 0.8; margin-bottom: 32px; }
  .dqe-assessment-wrapper .pick-prompt { font-size: 14px; font-weight: 600; color: var(--ink); margin-bottom: 16px; }

  .dqe-assessment-wrapper .level-option {
    width: 100%;
    position: relative;
    overflow: hidden;
    text-align: left;
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    border: 1px solid rgba(33,60,75,0.12);
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: border-color 0.15s, box-shadow 0.15s, transform 0.1s;
    display: flex;
    gap: 16px;
    align-items: flex-start;
  }
  .dqe-assessment-wrapper .level-option:hover { border-color: rgba(39,191,240,0.5); transform: translateY(-3px); }
  .dqe-assessment-wrapper .level-option.selected {
    border: 2px solid var(--blue);
    background: linear-gradient(145deg, rgba(39,191,240,0.08), rgba(166,213,64,0.08));
    box-shadow: 0 18px 42px rgba(39,191,240,0.18);
    padding: 19px;
  }
  .dqe-assessment-wrapper .level-option-num {
    width: 40px; height: 40px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 700; font-size: 14px;
    flex-shrink: 0;
    margin-top: 2px;
  }
  .dqe-assessment-wrapper .level-option-body { flex: 1; }
  .dqe-assessment-wrapper .level-option-name { font-weight: 700; color: var(--ink); margin-bottom: 4px; font-size: 16px; }
  .dqe-assessment-wrapper .level-option-text { font-size: 14px; line-height: 1.7; color: #355160; }
  .dqe-assessment-wrapper .level-option-check {
    width: 24px; height: 24px;
    border-radius: 50%;
    background: var(--blue);
    color: #fff;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
    margin-top: 8px;
  }
  .dqe-assessment-wrapper .level-option.selected .level-option-check { display: flex; }

  .dqe-assessment-wrapper .nav-row { display: flex; justify-content: space-between; margin-top: 40px; }

  /* ---------- Results ---------- */
  .dqe-assessment-wrapper .results-main { max-width: 1200px; margin: 0 auto; padding: 48px 24px; }
  .dqe-assessment-wrapper .hero-score {
    background:
      radial-gradient(circle at 85% 10%, rgba(39,191,240,0.22), transparent 50%),
      radial-gradient(circle at 5% 95%, rgba(166,213,64,0.14), transparent 45%),
      linear-gradient(150deg, #1a3340 0%, #213C4B 50%, #182c38 100%);
    color: #fff;
    border-radius: 24px;
    padding: 48px;
    margin-bottom: 32px;
    display: grid;
    grid-template-columns: 5fr 7fr;
    gap: 32px;
    align-items: center;
    box-shadow: 0 20px 60px rgba(33,60,75,0.3);
  }
  @media (max-width: 800px) {
    .dqe-assessment-wrapper .hero-score { grid-template-columns: 1fr; padding: 32px; }
  }
  .dqe-assessment-wrapper .hero-score-label { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #b6e85b; margin-bottom: 12px; }
  .dqe-assessment-wrapper .hero-score-num {
    font-size: clamp(64px, 10vw, 96px);
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.03em;
    background: linear-gradient(120deg, #27BFF0 30%, #A6D540);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .dqe-assessment-wrapper .hero-score-out { font-size: 24px; opacity: 0.5; margin-left: 10px; }
  .dqe-assessment-wrapper .hero-score-level {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 8px;
    color: #fff;
  }
  .dqe-assessment-wrapper .hero-score-text { font-size: 17px; line-height: 1.6; opacity: 0.92; }

  .dqe-assessment-wrapper .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
  @media (max-width: 900px) { .dqe-assessment-wrapper .chart-grid { grid-template-columns: 1fr; } }

  .dqe-assessment-wrapper .panel {
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    border-radius: 16px;
    padding: 24px;
    border: 1px solid rgba(33,60,75,0.08);
  }
  .dqe-assessment-wrapper .panel h3 { font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
  .dqe-assessment-wrapper .panel .panel-sub { font-size: 13px; color: var(--ink); opacity: 0.7; margin-bottom: 16px; }
  .dqe-assessment-wrapper .panel canvas { width: 100% !important; }
  .dqe-assessment-wrapper .chart-host { position: relative; height: 340px; }

  .dqe-assessment-wrapper .summary-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 32px; }
  @media (max-width: 800px) { .dqe-assessment-wrapper .summary-grid { grid-template-columns: 1fr; } }
  .dqe-assessment-wrapper .summary-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
  .dqe-assessment-wrapper .summary-title { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--ink); opacity: 0.7; }
  .dqe-assessment-wrapper .summary-count {
    width: 32px; height: 32px;
    border-radius: 50%;
    color: #fff; font-weight: 700; font-size: 14px;
    display: flex; align-items: center; justify-content: center;
  }
  .dqe-assessment-wrapper .summary-list { list-style: none; padding: 0; margin: 0; }
  .dqe-assessment-wrapper .summary-list li { font-size: 14px; line-height: 1.4; color: var(--ink); margin-bottom: 8px; }
  .dqe-assessment-wrapper .summary-empty { font-size: 13px; color: var(--ink); opacity: 0.6; }

  .dqe-assessment-wrapper .gate {
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    border: 2px solid var(--blue);
    border-radius: 16px;
    padding: 40px;
    display: grid;
    grid-template-columns: 7fr 5fr;
    gap: 32px;
    align-items: center;
  }
  @media (max-width: 800px) { .dqe-assessment-wrapper .gate { grid-template-columns: 1fr; padding: 28px; } }
  .dqe-assessment-wrapper .gate-label { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--blue-deep); margin-bottom: 12px; }
  .dqe-assessment-wrapper .gate h3 { font-size: 28px; font-weight: 700; color: var(--ink); margin-bottom: 12px; letter-spacing: -0.02em; line-height: 1.2; }
  .dqe-assessment-wrapper .gate p { font-size: 15px; line-height: 1.6; color: var(--ink); opacity: 0.8; margin-bottom: 16px; }
  .dqe-assessment-wrapper .gate ul { list-style: none; padding: 0; margin: 0; }
  .dqe-assessment-wrapper .gate li { font-size: 14px; line-height: 1.5; color: var(--ink); opacity: 0.85; margin-bottom: 6px; }

  /* WPForms Gate Styling */
  .dqe-assessment-wrapper .dqe-wpform-box {
    background: var(--mist);
    border-radius: 18px;
    padding: 24px;
  }
  .dqe-assessment-wrapper .dqe-wpform-box .wpforms-field-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 6px;
    display: block;
  }
  .dqe-assessment-wrapper .dqe-wpform-box input[type="text"],
  .dqe-assessment-wrapper .dqe-wpform-box input[type="email"],
  .dqe-assessment-wrapper .dqe-wpform-box select,
  .dqe-assessment-wrapper .dqe-wpform-box textarea {
    width: 100%;
    padding: 12px 16px;
    background: linear-gradient(145deg, #ffffff, #f5fafc);
    border: 1px solid rgba(33,60,75,0.15);
    border-radius: 8px;
    font-size: 14px;
    color: var(--ink);
    outline: none;
    margin-bottom: 12px;
  }
  .dqe-assessment-wrapper .dqe-wpform-box button[type="submit"],
  .dqe-assessment-wrapper .dqe-wpform-box .wpforms-submit {
    background: var(--blue) !important;
    color: #fff !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    padding: 14px 24px !important;
    border: none !important;
    width: 100% !important;
    font-size: 15px !important;
    cursor: pointer !important;
    transition: transform 0.15s ease, box-shadow 0.15s ease !important;
  }
  .dqe-assessment-wrapper .dqe-wpform-box button[type="submit"]:hover,
  .dqe-assessment-wrapper .dqe-wpform-box .wpforms-submit:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 18px rgba(39,191,240,0.3) !important;
  }

  .dqe-assessment-wrapper .gate-step { max-width: 1000px; margin: 0 auto; padding: 56px 24px 80px; }
  .dqe-assessment-wrapper .gate-step .gate { box-shadow: 0 24px 60px rgba(33,60,75,0.12); }
  .dqe-assessment-wrapper .gate-step .gate h3 { font-size: 30px; }

  .dqe-assessment-wrapper .full-report { background: linear-gradient(145deg, #ffffff, #f5fafc); border-radius: 16px; padding: 40px; border: 1px solid rgba(33,60,75,0.08); }
  .dqe-assessment-wrapper .full-report-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--mist); flex-wrap: wrap; gap: 16px; }
  .dqe-assessment-wrapper .dim-card {
    background: var(--mist);
    border-radius: 18px;
    padding: 20px;
    margin-bottom: 16px;
    display: grid;
    grid-template-columns: 3fr 9fr;
    gap: 20px;
  }
  @media (max-width: 700px) { .dqe-assessment-wrapper .dim-card { grid-template-columns: 1fr; } }
  .dqe-assessment-wrapper .dim-card-left .dim-num-lbl { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--ink); opacity: 0.6; margin-bottom: 6px; }
  .dqe-assessment-wrapper .dim-card-title { font-weight: 700; color: var(--ink); margin-bottom: 14px; line-height: 1.3; }
  .dqe-assessment-wrapper .dim-card-pill { display: inline-block; padding: 4px 12px; border-radius: 999px; color: #fff; font-size: 13px; font-weight: 600; }
  .dqe-assessment-wrapper .dim-card-section { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 4px; }
  .dqe-assessment-wrapper .dim-card-section.now { color: var(--ink); opacity: 0.6; }
  .dqe-assessment-wrapper .dim-card-section.next { color: var(--blue-deep); margin-top: 12px; }
  .dqe-assessment-wrapper .dim-card-text { font-size: 14px; line-height: 1.55; color: var(--ink); }
  .dqe-assessment-wrapper .dim-card-text.next-step { opacity: 0.85; }

  .dqe-assessment-wrapper .platform-block {
    background:
      radial-gradient(circle at 90% 0%, rgba(166,213,64,0.18), transparent 50%),
      linear-gradient(150deg, #1a3340 0%, #213C4B 60%, #182c38 100%);
    color: #fff;
    border-radius: 18px;
    padding: 28px;
    margin-top: 24px;
    box-shadow: 0 12px 40px rgba(33,60,75,0.2);
  }
  .dqe-assessment-wrapper .platform-label { font-size: 11px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #b6e85b; margin-bottom: 10px; }
  .dqe-assessment-wrapper .platform-text { font-size: 14px; line-height: 1.6; opacity: 0.92; margin-bottom: 16px; }
  .dqe-assessment-wrapper .platform-link { display: inline-block; font-weight: 700; color: #b6e85b; text-decoration: underline; font-size: 14px; }

  .dqe-assessment-wrapper .share-bar { margin-top: 32px; text-align: center; font-size: 12px; color: var(--ink); opacity: 0.6; word-break: break-all; }
  .dqe-assessment-wrapper .share-bar code { font-family: ui-monospace, 'SF Mono', Menlo, monospace; font-size: 11px; }

  .dqe-assessment-wrapper .top-actions { display: flex; align-items: center; gap: 12px; }
  .dqe-assessment-wrapper .icon-btn { font-size: 13px; font-weight: 500; color: var(--ink); padding: 6px 12px; border-radius: 6px; background: var(--mist); transition: background 0.15s; }
  .dqe-assessment-wrapper .icon-btn:hover { background: rgba(39,191,240,0.15); }

  .dqe-assessment-wrapper .hidden { display: none !important; }

  .dqe-assessment-wrapper .toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--ink);
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    opacity: 0;
    transition: opacity 0.2s, transform 0.2s;
    pointer-events: none;
    z-index: 9999;
  }
  .dqe-assessment-wrapper .toast.show { opacity: 1; transform: translateX(-50%) translateY(-6px); }

  .dqe-assessment-wrapper .landing {
    background:
      radial-gradient(circle at 82% -5%, rgba(39,191,240,0.10), transparent 42%),
      radial-gradient(circle at 0% 95%, rgba(166,213,64,0.08), transparent 42%),
      linear-gradient(180deg, #ffffff 0%, #f2f8fb 100%);
    min-height: 80vh;
  }
  .dqe-assessment-wrapper .landing .app-header {
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(33,60,75,0.08);
  }
  .dqe-assessment-wrapper .landing .badge {
    background: #ffffff;
    color: var(--blue-deep);
    border: 1px solid rgba(39,191,240,0.55);
    box-shadow: 0 2px 10px rgba(39,191,240,0.10);
  }
  .dqe-assessment-wrapper .landing h1.hero .blue {
    background: linear-gradient(90deg, #27BFF0, #23A6DE);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .dqe-assessment-wrapper .landing h1.hero .green {
    background: linear-gradient(90deg, #A6D540, #6DBF42);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .dqe-assessment-wrapper .landing .level-card {
    background: #ffffff;
    border: 1px solid rgba(33,60,75,0.08);
    box-shadow: 0 18px 48px rgba(33,60,75,0.10);
  }
  .dqe-assessment-wrapper .landing .level-row {
    background: #f6fafc;
    border: 1px solid rgba(33,60,75,0.05);
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 8px;
    transition: background 0.15s, transform 0.15s;
  }
  .dqe-assessment-wrapper .landing .level-row:hover { background: #eef6fa; transform: translateX(2px); }

  .dqe-assessment-wrapper .overview-band {
    margin-top: 56px;
    padding-top: 48px;
    border-top: 1px solid rgba(33,60,75,0.10);
  }
  .dqe-assessment-wrapper .overview-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
  }
  @media (max-width: 800px) { .dqe-assessment-wrapper .overview-grid { grid-template-columns: 1fr; gap: 24px; } }

  .dqe-assessment-wrapper .overview-card {
    position: relative;
    background: #ffffff;
    border: 1px solid rgba(33,60,75,0.08);
    border-radius: 24px;
    padding: 38px;
    overflow: hidden;
    box-shadow: 0 18px 50px rgba(33,60,75,0.08);
    transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
  }
  .dqe-assessment-wrapper .overview-card:hover {
    transform: translateY(-4px);
    border-color: rgba(39,191,240,0.35);
    box-shadow: 0 24px 56px rgba(33,60,75,0.12);
  }
  .dqe-assessment-wrapper .overview-card:nth-child(2) { border-color: rgba(166,213,64,0.30); }
  .dqe-assessment-wrapper .overview-icon {
    width: 54px; height: 54px;
    border-radius: 16px;
    background: linear-gradient(135deg, #27BFF0, #23A6DE);
    color: white;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; font-weight: 700;
    margin-bottom: 22px;
    box-shadow: 0 10px 24px rgba(39,191,240,0.25);
  }
  .dqe-assessment-wrapper .overview-card:nth-child(2) .overview-icon {
    background: linear-gradient(135deg, #A6D540, #6DBF42);
    box-shadow: 0 10px 24px rgba(166,213,64,0.28);
  }
  .dqe-assessment-wrapper .overview-headline {
    font-size: clamp(28px, 3vw, 38px);
    line-height: 1.1;
    letter-spacing: -0.03em;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 18px;
  }
  .dqe-assessment-wrapper .overview-eyebrow {
    font-size: 12px; letter-spacing: 0.18em; font-weight: 700; text-transform: uppercase; color: var(--blue-deep); margin-bottom: 12px;
  }
  .dqe-assessment-wrapper .overview-card:nth-child(2) .overview-eyebrow { color: var(--green-deep); }
  .dqe-assessment-wrapper .overview-text { font-size: 16px; line-height: 1.7; color: rgba(33,60,75,0.78); }

  @media print {
    body { background: #fff; }
    .site-header, footer, .dqe-assessment-wrapper .app-header, .dqe-assessment-wrapper .full-report-head .btn, .dqe-assessment-wrapper .top-actions, .dqe-assessment-wrapper .share-bar, .dqe-assessment-wrapper .gate { display: none !important; }
    .dqe-assessment-wrapper .panel, .dqe-assessment-wrapper .full-report, .dqe-assessment-wrapper .dim-card, .dqe-assessment-wrapper .platform-block { break-inside: avoid; box-shadow: none; }
    .dqe-assessment-wrapper .hero-score, .dqe-assessment-wrapper .platform-block { background: #213C4B !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  }
</style>

<div class="dqe-assessment-wrapper">
  <div id="dqe-app"></div>
  <div id="dqe-wpform-template" style="display:none;">
    <?php echo do_shortcode('[wpforms id="12223" title="false"]'); ?>
  </div>
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

  const LEVEL_LABELS = ["Ad Hoc", "Managed", "Engineered", "Orchestrated", "Optimized"];
  const LEVEL_COLORS = ["#C04F15", "#ED7D31", "#FFC000", "#6DBF42", "#27BFF0"];
  const LEVEL_SHORTS = [
    "Production data dependency & high risk",
    "Basic guardrails & selective masking",
    "Intentional design & versioned definitions",
    "Pipeline-native & on-demand delivery",
    "Continuous optimization & enterprise-wide"
  ];

  const $ = sel => document.querySelector(sel);
  const esc = s => String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const genId = () => Math.random().toString(36).substring(2, 10) + Math.random().toString(36).substring(2, 6);

  const overallLabel = (s) => {
    if (s < 1.5) return { label:"Ad Hoc", level:1 };
    if (s < 2.5) return { label:"Managed", level:2 };
    if (s < 3.5) return { label:"Engineered", level:3 };
    if (s < 4.5) return { label:"Orchestrated", level:4 };
    return { label:"Optimized", level:5 };
  };

  const interpretation = (s) => {
    if (s < 1.5) return "Your data practices are largely reactive and rely on production data. Privacy, integrity, and provisioning are handled ad hoc. The biggest unlock is moving from copy-and-mask toward defined data strategies.";
    if (s < 2.5) return "You've built basic guardrails — masking, some automation, defined retention — but data provisioning is still labor-intensive and risk-prone. The next step is engineered design rather than incremental hardening.";
    if (s < 3.5) return "You're operating with intentional design — defined rules, versioned definitions, partially automated provisioning. The shift now is from engineered to orchestrated: centralized control, on-demand delivery, and synthetic-first thinking.";
    if (s < 4.5) return "Your data capabilities are orchestrated — pipeline-native, on-demand, governed at scale. The remaining work is continuous optimization driven by outcomes, defects, and model performance.";
    return "You're operating at enterprise-grade data maturity. Data is treated as a durable, definition-driven asset across thousands of teams, with continuous refinement.";
  };

  const dimGuidance = (dim, score) => {
    if (score <= 2) return `Treat ${dim.title.toLowerCase()} as a foundational gap. Moving from copy-based or manually managed practices to defined design will yield the largest near-term gains.`;
    if (score === 3) return "Solid foundations exist. The next move is shifting from intentional design to centralized orchestration and on-demand delivery.";
    if (score === 4) return "Strong orchestration in place. Continuous improvement loops driven by outcomes will take this dimension from orchestrated to optimized.";
    return "Operating at the highest maturity. Maintain through continuous refinement and outcome-driven optimization.";
  };

  const STORE_PREFIX = "dqe:";
  const saveSession = (id, payload) => {
    try { localStorage.setItem(STORE_PREFIX + id, JSON.stringify(payload)); return true; }
    catch (e) { return false; }
  };
  const loadSession = (id) => {
    try { const v = localStorage.getItem(STORE_PREFIX + id); return v ? JSON.parse(v) : null; }
    catch (e) { return null; }
  };
  const saveProgress = (st) => { try { localStorage.setItem("dqe:in_progress", JSON.stringify(st)); } catch(e){} };
  const loadProgress = () => { try { const v = localStorage.getItem("dqe:in_progress"); return v ? JSON.parse(v) : null; } catch(e){ return null; } };
  const clearProgress = () => { try { localStorage.removeItem("dqe:in_progress"); } catch(e){} };

  const logoHTML = `<div class="logo-text"><span class="gen">Gen</span><span class="rocket">Rocket</span></div>`;
  const headerHTML = (rightHTML="") => ``;

  const showToast = (msg) => {
    let t = document.getElementById("dqe-toast");
    if (!t) {
      t = document.createElement("div");
      t.id = "dqe-toast";
      t.className = "toast";
      document.body.appendChild(t);
    }
    t.textContent = msg;
    t.classList.add("show");
    clearTimeout(t._timer);
    t._timer = setTimeout(()=>t.classList.remove("show"), 1800);
  };

  const state = {
    screen: "landing",
    scores: {},
    currentIdx: 0,
    shareId: null,
    reportUnlocked: false,
    contact: null
  };

  const app = () => document.getElementById("dqe-app");

  function render() {
    if (state.screen === "landing") return renderLanding();
    if (state.screen === "assessment") return renderAssessment();
    if (state.screen === "gate") return renderGate();
    if (state.screen === "results") return renderResults();
  }

  function renderLanding() {
    const progress = loadProgress();
    const hasSaved = progress && progress.scores && Object.keys(progress.scores).length > 0;

    app().innerHTML = `
    <div class="landing">
      ${headerHTML(`<a class="header-link" href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a>`)}
      <main>
        <div class="landing-grid">
          <div>
            <div class="badge">The Data Quality Evolution Index</div>
            <h1 class="hero">Are you ready for a <span class="blue">synthetic-data-first</span> <span class="green">future?</span></h1>
            <p class="hero-sub">The Data Quality Evolution (DQE) Index is a maturity model that helps organizations assess the readiness of their data provisioning strategy for the future of software engineering, AI, and continuous delivery.</p>
            <div class="cta-row">
              <button class="btn btn-accent" id="startBtn">Start the assessment →</button>
              ${hasSaved ? `<button class="btn btn-ghost" id="resumeBtn">Resume saved session</button>` : ""}
            </div>
            <div class="stats">
              <div><div class="stat-num">10</div><div class="stat-lbl">Dimensions</div></div>
              <div><div class="stat-num">5</div><div class="stat-lbl">Maturity levels</div></div>
              <div><div class="stat-num">~3</div><div class="stat-lbl">Minutes</div></div>
            </div>
          </div>
          <div>
            <div class="level-card">
              <div class="level-card-title">The five maturity levels</div>
              ${LEVEL_LABELS.map((lbl,i)=>`
                <div class="level-row">
                  <div class="level-num" style="background:${LEVEL_COLORS[i]}">${i+1}</div>
                  <div>
                    <div class="level-name">Level ${i+1} — ${lbl}</div>
                    <div class="level-desc">${LEVEL_SHORTS[i]}</div>
                  </div>
                </div>`).join("")}
            </div>
            <div class="deliverables">
              <div class="deliverables-title">What you'll get</div>
              <ul>
                <li>An overall DQE Index score (1–5)</li>
                <li>A radar profile across all 10 dimensions</li>
                <li>Specific gaps and next-step guidance</li>
                <li>A shareable link to your results</li>
                <li>A downloadable summary report</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="overview-band">
          <div class="overview-grid">
            <div class="overview-card">
              <div class="overview-icon">↗</div>
              <div class="overview-eyebrow">A shift in operating model</div>
              <h3 class="overview-headline">From production-copy dependency to engineered synthetic data.</h3>
              <p class="overview-text">Data Quality Evolution represents a shift away from production data dependency and toward a <strong>synthetic-data-first operating model</strong> where data is engineered, controlled, and provisioned on demand. Privacy risks are eliminated, data quality becomes deterministic, and teams gain the ability to rapidly generate fit-for-purpose data for testing, AI training, and continuous delivery at scale.</p>
            </div>

            <div class="overview-card">
              <div class="overview-icon">◎</div>
              <div class="overview-eyebrow">What the Index does</div>
              <h3 class="overview-headline">Benchmark readiness across 10 enterprise data dimensions.</h3>
              <p class="overview-text">The DQE Index enables organizations to <strong>benchmark their maturity across ten critical dimensions</strong>, identify opportunities for improvement, and build a roadmap toward a more secure, scalable, automated, and future-ready data strategy.</p>
            </div>
          </div>
        </div>
      </main>
      <footer class="app-footer d-none">© ${new Date().getFullYear()} GenRocket, Inc. The DQE Index is technology-agnostic and intended for honest self-assessment.</footer>
    </div>`;

    $("#startBtn").addEventListener("click", () => {
      state.scores = {};
      state.currentIdx = 0;
      state.shareId = null;
      state.reportUnlocked = false;
      state.screen = "assessment";
      clearProgress();
      render();
    });
    const resumeBtn = $("#resumeBtn");
    if (resumeBtn) {
      resumeBtn.addEventListener("click", () => {
        const p = loadProgress();
        if (p) {
          state.scores = p.scores || {};
          state.currentIdx = p.currentIdx || 0;
          state.screen = "assessment";
          render();
        }
      });
    }
  }

  function renderAssessment() {
    const dim = DIMENSIONS[state.currentIdx];
    const answered = state.scores[dim.id];
    const completedCount = Object.values(state.scores).filter(v=>v!=null).length;
    const progress = ((state.currentIdx + (answered ? 1 : 0)) / DIMENSIONS.length) * 100;

    app().innerHTML = `
      ${headerHTML(`<button class="header-link" id="exitBtn" style="background:none;border:none;cursor:pointer;">Exit</button>`)}
      <div class="progress-bar-wrap">
        <div class="progress-bar-inner">
          <div class="progress-meta">
            <span>Dimension ${state.currentIdx + 1} of ${DIMENSIONS.length}</span>
            <span>${completedCount} of ${DIMENSIONS.length} answered</span>
          </div>
          <div class="progress-track"><div class="progress-fill" style="width:${progress}%"></div></div>
        </div>
      </div>
      <main class="assess-main">
        <div class="dim-label">Dimension ${state.currentIdx + 1}</div>
        <h2 class="dim-title">${esc(dim.title)}</h2>
        <p class="dim-anchor">${esc(dim.anchor)}</p>
        <div class="pick-prompt">Which description most closely matches your organization today?</div>

        <div id="levelList">
          ${dim.levels.map((desc,i)=>{
            const lvl = i+1;
            const sel = answered === lvl;
            return `
            <button class="level-option ${sel?"selected":""}" data-lvl="${lvl}">
              <div class="level-option-num" style="background:${LEVEL_COLORS[i]}">${lvl}</div>
              <div class="level-option-body">
                <div class="level-option-name">Level ${lvl} — ${LEVEL_LABELS[i]}</div>
                <div class="level-option-text">${esc(desc)}</div>
              </div>
              <div class="level-option-check">✓</div>
            </button>`;
          }).join("")}
        </div>
        <div class="nav-row">
          <button class="btn btn-ghost" id="prevBtn" ${state.currentIdx===0?"disabled":""}>← Previous</button>
          <button class="btn btn-accent" id="nextBtn" ${!answered?"disabled":""}>${state.currentIdx === DIMENSIONS.length-1 ? "Get my results →" : "Next dimension →"}</button>
        </div>
      </main>`;

    document.querySelectorAll(".level-option").forEach(btn=>{
      btn.addEventListener("click", () => {
        const lvl = parseInt(btn.dataset.lvl, 10);
        state.scores[dim.id] = lvl;
        saveProgress({ scores: state.scores, currentIdx: state.currentIdx, timestamp: Date.now() });
        render();
      });
    });
    const exitBtn = $("#exitBtn");
    if (exitBtn) { exitBtn.addEventListener("click", () => { state.screen = "landing"; render(); }); }
    $("#prevBtn").addEventListener("click", () => {
      if (state.currentIdx > 0) { state.currentIdx--; render(); window.scrollTo({top:0,behavior:"smooth"}); }
    });
    $("#nextBtn").addEventListener("click", () => {
      if (!state.scores[dim.id]) return;
      if (state.currentIdx < DIMENSIONS.length - 1) {
        state.currentIdx++;
        render();
        window.scrollTo({top:0,behavior:"smooth"});
      } else {
        state.shareId = genId();
        saveSession(state.shareId, { scores: state.scores, reportUnlocked: false, timestamp: Date.now() });
        saveProgress({ scores: state.scores, currentIdx: state.currentIdx, shareId: state.shareId, timestamp: Date.now() });
        state.screen = "gate";
        const url = new URL(window.location);
        url.searchParams.set("id", state.shareId);
        try { history.replaceState({}, "", url.toString()); } catch (e) {}
        render();
      }
    });
  }

  function renderGate() {
    app().innerHTML = `
      ${headerHTML(`<a class="header-link" href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a>`)}
      <main class="gate-step">
        <div class="gate">
          <div>
            <div class="gate-label">One last step</div>
            <h3>Where should we send your DQE Index report?</h3>
            <p>Your assessment is complete. Enter your details to view your full results — overall score, maturity profile, per-dimension guidance, and a downloadable PDF.</p>
            <ul>
              <li>▸ Your overall DQE Index score and maturity level</li>
              <li>▸ Radar profile across all 10 dimensions</li>
              <li>▸ Per-dimension gaps and next-step guidance</li>
              <li>▸ A downloadable / printable PDF report</li>
            </ul>
          </div>
          <div>
            <div class="dqe-wpform-box">
              <div id="dqe-wpform-slot"></div>
            </div>
          </div>
        </div>
      </main>
      <footer class="app-footer">© ${new Date().getFullYear()} GenRocket, Inc. The DQE Index is technology-agnostic and intended for honest self-assessment.</footer>`;

    injectWPForm();
  }

  async function generateDQEpdf(name, email, company, overall, levelInfo) {
    if (!window.jspdf) return null;
    try {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF({ unit: 'pt', format: 'letter' });

      doc.setFillColor(33, 60, 75);
      doc.rect(0, 0, 612, 75, 'F');

      doc.setTextColor(39, 191, 240);
      doc.setFontSize(22);
      doc.setFont('helvetica', 'bold');
      doc.text("GenRocket", 40, 45);

      doc.setTextColor(255, 255, 255);
      doc.setFontSize(13);
      doc.text("Data Quality Evolution (DQE) Index Report", 175, 45);

      doc.setTextColor(33, 60, 75);
      doc.setFontSize(11);
      doc.setFont('helvetica', 'bold');
      doc.text("ASSESSMENT DETAILS", 40, 110);

      doc.setFont('helvetica', 'normal');
      doc.setFontSize(10);
      doc.text(`Customer Name: ${name || 'N/A'}`, 40, 128);
      doc.text(`Work Email: ${email || 'N/A'}`, 40, 143);
      doc.text(`Company: ${company || 'N/A'}`, 40, 158);
      doc.text(`Assessment Date: ${new Date().toLocaleDateString()}`, 40, 173);

      doc.setFont('helvetica', 'bold');
      doc.setFontSize(14);
      doc.text(`DQE Index Score: ${overall} / 5.0`, 320, 128);
      doc.setFontSize(11);
      doc.setTextColor(39, 191, 240);
      doc.text(`Maturity Level: Level ${levelInfo.level} — ${levelInfo.label}`, 320, 148);

      doc.setDrawColor(225, 235, 240);
      doc.setLineWidth(1);
      doc.line(40, 190, 572, 190);

      doc.setTextColor(33, 60, 75);
      doc.setFontSize(11);
      doc.setFont('helvetica', 'bold');
      doc.text("10-DIMENSION MATURITY BREAKDOWN", 40, 215);

      let y = 240;
      DIMENSIONS.forEach((dim, idx) => {
        const score = state.scores[dim.id] || 1;
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(10);
        doc.setTextColor(33, 60, 75);
        doc.text(`${idx + 1}. ${dim.title}`, 40, y);

        doc.setTextColor(39, 191, 240);
        doc.text(`Level ${score} — ${LEVEL_LABELS[score - 1]}`, 450, y);

        y += 14;
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(8.5);
        doc.setTextColor(80, 80, 80);
        const descLines = doc.splitTextToSize(dim.levels[score - 1], 520);
        doc.text(descLines, 40, y);
        y += (descLines.length * 11) + 12;

        if (y > 710 && idx < DIMENSIONS.length - 1) {
          doc.addPage();
          y = 50;
        }
      });

      return doc.output('blob');
    } catch(e) {
      console.error("PDF gen error:", e);
      return null;
    }
  }

  async function unlockAndSaveReport() {
    state.reportUnlocked = true;
    saveSession(state.shareId, {
      scores: state.scores,
      reportUnlocked: true,
      timestamp: Date.now()
    });
    saveProgress({
      scores: state.scores,
      currentIdx: state.currentIdx,
      shareId: state.shareId,
      reportUnlocked: true,
      timestamp: Date.now()
    });

    const form = document.querySelector(".dqe-wpform-box form");
    let nameVal = "";
    let emailVal = "";
    let companyVal = "";

    if (form) {
      const nameInput = form.querySelector('input[name="wpforms[fields][1]"], input[name="wpforms[fields][1][first]"]');
      const lastNameInput = form.querySelector('input[name="wpforms[fields][1][last]"]');
      nameVal = (nameInput ? nameInput.value : "") + (lastNameInput && lastNameInput.value ? " " + lastNameInput.value : "");
      
      const emailInput = form.querySelector('input[name="wpforms[fields][2]"]');
      emailVal = emailInput ? emailInput.value : "";
      
      const companyInput = form.querySelector('input[name="wpforms[fields][3]"]');
      companyVal = companyInput ? companyInput.value : "";
    }

    const vals = Object.values(state.scores);
    const overall = vals.length ? (vals.reduce((a,b)=>a+b,0)/vals.length).toFixed(1) : "N/A";
    const info = overallLabel(overall);
    const shareUrl = `${location.origin}${location.pathname}?id=${state.shareId}`;

    try {
      const pdfBlob = await generateDQEpdf(nameVal, emailVal, companyVal, overall, info);
      const data = new FormData();
      data.append('action', 'upload_dqe_pdf');
      if (pdfBlob) {
        data.append('dqe_pdf', pdfBlob, `DQE_Report_${state.shareId}.pdf`);
      }
      data.append('name', nameVal);
      data.append('email', emailVal);
      data.append('company', companyVal);
      data.append('score', overall + ' / 5.0');
      data.append('level', 'Level ' + info.level + ' — ' + info.label);
      data.append('share_id', state.shareId);
      data.append('share_url', shareUrl);
      data.append('scores_json', JSON.stringify(state.scores));

      let ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
      try {
        if (window.wpforms_settings && window.wpforms_settings.ajaxurl) {
          ajaxUrl = window.wpforms_settings.ajaxurl;
        }
      } catch(err) {}

      if (window.jQuery && window.jQuery.ajax) {
        window.jQuery.ajax({
          url: ajaxUrl,
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          error: function(xhr, status, err) {
            console.warn("DQE report upload notice:", err || status);
          }
        });
      } else {
        fetch(ajaxUrl, {
          method: 'POST',
          body: data
        }).catch(function(err) {
          console.warn("DQE report upload notice:", err);
        });
      }
    } catch(e) {
      console.warn("PDF generation notice:", e);
    }
  }

  function injectWPForm() {
    const slot = document.getElementById("dqe-wpform-slot");
    const template = document.getElementById("dqe-wpform-template");
    if (slot && template) {
      slot.innerHTML = template.innerHTML;

      const form = slot.querySelector("form.wpforms-form");
      if (form) {
        try {
          let formActionUrl = new URL(form.action || window.location.href);
          formActionUrl.searchParams.set("id", state.shareId);
          form.action = formActionUrl.toString();
        } catch(e) {}

        const vals = Object.values(state.scores);
        const overall = vals.length ? (vals.reduce((a,b)=>a+b,0)/vals.length).toFixed(1) : "N/A";
        const info = overallLabel(overall);
        const shareUrl = `${location.origin}${location.pathname}?id=${state.shareId}`;
        const summaryReport = DIMENSIONS.map((d, i) => `${i+1}. ${d.title}: Level ${state.scores[d.id] || 'N/A'}`).join("\n");

        // 1. Populate registered WPForms Field ID 5 (DQE Report Details Textarea field)
        const field5 = form.querySelector('textarea[name="wpforms[fields][5]"], input[name="wpforms[fields][5]"]');
        if (field5) {
          field5.value = [
            "=== DQE INDEX ASSESSMENT REPORT ===",
            "Overall Score: " + overall + " / 5.0",
            "Maturity Level: Level " + info.level + " — " + info.label,
            "Report Link: " + shareUrl,
            "",
            "=== DIMENSION SCORES ===",
            summaryReport
          ].join("\n");
        }

        // 2. Also pass payload fields for server filter hook
        const payload = {
          'dqe_overall_score': overall + ' / 5.0',
          'dqe_maturity_level': 'Level ' + info.level + ' — ' + info.label,
          'dqe_share_url': shareUrl,
          'dqe_share_id': state.shareId,
          'share_id': state.shareId,
          'dqe_dimension_breakdown': summaryReport
        };

        for (const [key, val] of Object.entries(payload)) {
          let input = form.querySelector(`input[name="${key}"], textarea[name="${key}"]`);
          if (!input) {
            input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            form.appendChild(input);
          }
          input.value = val;
        }

        const submitBtn = form.querySelector("button[type='submit'], .wpforms-submit");
        if (submitBtn) {
          submitBtn.addEventListener("click", unlockAndSaveReport);
        }
        form.addEventListener("submit", unlockAndSaveReport);
      }
    }
  }

  function renderResults() {
    const vals = Object.values(state.scores);
    const overall = vals.reduce((a,b)=>a+b,0) / vals.length;
    const info = overallLabel(overall);

    const radarLabels = DIMENSIONS.map(d => d.title.split(" & ")[0].split(" ").slice(0,2).join(" "));
    const radarValues = DIMENSIONS.map(d => state.scores[d.id]);

    const sortedDims = [...DIMENSIONS].sort((a,b) => state.scores[a.id] - state.scores[b.id]);
    const barLabels = sortedDims.map(d => d.title);
    const barValues = sortedDims.map(d => state.scores[d.id]);
    const barColors = sortedDims.map(d => LEVEL_COLORS[state.scores[d.id]-1]);

    const gaps = DIMENSIONS.filter(d => state.scores[d.id] <= 2);
    const mid = DIMENSIONS.filter(d => state.scores[d.id] === 3);
    const strengths = DIMENSIONS.filter(d => state.scores[d.id] >= 4);

    const shareUrl = `${location.origin}${location.pathname}?id=${state.shareId}`;

    app().innerHTML = `
      ${headerHTML('')}
      <main class="results-main">
        <div style="display:flex; justify-content:flex-end; margin-bottom:16px;">
          <button class="header-link" id="restartBtn" style="background:none;border:none;cursor:pointer;">Start over</button>
        </div>
        <div class="hero-score">
          <div>
            <div class="hero-score-label">Your DQE Index</div>
            <div><span class="hero-score-num">${overall.toFixed(1)}</span><span class="hero-score-out">/ 5.0</span></div>
            <div class="hero-score-level" style="background:${LEVEL_COLORS[info.level-1]}">Level ${info.level} — ${info.label}</div>
          </div>
          <div class="hero-score-text">${interpretation(overall)}</div>
        </div>

        <div class="chart-grid">
          <div class="panel">
            <h3>Maturity profile</h3>
            <div class="panel-sub">Your score across all 10 dimensions</div>
            <div class="chart-host"><canvas id="radarChart"></canvas></div>
          </div>
          <div class="panel">
            <h3>Dimensions ranked</h3>
            <div class="panel-sub">Lowest scores are your biggest improvement levers</div>
            <div class="chart-host"><canvas id="barChart"></canvas></div>
          </div>
        </div>

        <div class="summary-grid">
          ${summaryCardHTML("Improvement priorities", gaps, "#C04F15", "No dimensions at Level 1 or 2 — solid foundation.")}
          ${summaryCardHTML("Build on momentum", mid, "#FFC000", "No mid-maturity dimensions.")}
          ${summaryCardHTML("Strengths", strengths, "#6DBF42", "Room to grow across the board.")}
        </div>

        <div id="reportRegion">
          ${state.reportUnlocked ? fullReportHTML(overall) : gateHTML()}
        </div>

        <div style="
          margin-top:32px;
          padding:24px 28px;
          border-radius:20px;
          background: linear-gradient(145deg, rgba(33,60,75,0.96), rgba(24,44,56,0.98));
          border:1px solid rgba(39,191,240,0.16);
          box-shadow:0 18px 48px rgba(33,60,75,0.18);
          color:rgba(255,255,255,0.82);
        ">
          <div style="font-size:11px; font-weight:700; letter-spacing:0.18em; text-transform:uppercase; color:#A6D540; margin-bottom:10px;">Next step</div>
          <div style="font-size:18px; line-height:1.7; max-width:920px;">
            Organizations advancing toward a <strong style="color:#fff;">synthetic-data-first operating model</strong> often benefit from expert guidance around scalable test data management, privacy-safe provisioning, automation, and enterprise synthetic data strategy.
            <br /><br />
            <span style="color:#27BFF0;font-weight:700;">Reach out to GenRocket</span> to explore how leading enterprises are modernizing data provisioning for testing, AI initiatives, and continuous delivery at scale.
          </div>
        </div>

        <div class="share-bar">Share link: <code>${esc(shareUrl)}</code></div>
      </main>`;

    drawRadar("radarChart", radarLabels, radarValues);
    drawBar("barChart", barLabels, barValues, barColors);

    const copyBtn = $("#copyBtn");
    if (copyBtn) {
      copyBtn.addEventListener("click", () => {
        navigator.clipboard.writeText(shareUrl).then(()=>showToast("Share link copied"));
      });
    }
    const restartBtn = $("#restartBtn");
    if (restartBtn) {
      restartBtn.addEventListener("click", () => {
        state.scores = {}; state.currentIdx = 0; state.shareId = null; state.reportUnlocked = false;
        state.screen = "landing";
        const url = new URL(window.location); url.searchParams.delete("id"); try { history.replaceState({}, "", url.toString()); } catch (e) {}
        render();
      });
    }

    if (state.reportUnlocked) {
      bindReportListeners();
    } else {
      bindGateListeners();
    }
  }

  function summaryCardHTML(title, items, color, emptyMsg) {
    return `
    <div class="panel">
      <div class="summary-head">
        <div class="summary-title">${esc(title)}</div>
        <div class="summary-count" style="background:${color}">${items.length}</div>
      </div>
      ${items.length === 0
        ? `<p class="summary-empty">${esc(emptyMsg)}</p>`
        : `<ul class="summary-list">${items.map(d => `<li>${esc(d.title)} (${state.scores[d.id]})</li>`).join("")}</ul>`}
    </div>`;
  }

  function gateHTML() {
    return `
    <div class="gate">
      <div>
        <div class="gate-label">Full report</div>
        <h3>Get your detailed report</h3>
        <p>Per-dimension guidance, your specific gaps, and a printable PDF you can share with stakeholders.</p>
        <ul>
          <li>▸ Per-dimension diagnostic and next-step guidance</li>
          <li>▸ Printable PDF report</li>
          <li>▸ Benchmark against the broader market (when available)</li>
        </ul>
      </div>
      <div>
        <div class="dqe-wpform-box">
          <div id="dqe-wpform-slot"></div>
        </div>
      </div>
    </div>`;
  }

  function bindGateListeners() {
    injectWPForm();
  }

  function fullReportHTML(overall) {
    return `
    <div class="full-report" id="printRegion">
      <div class="full-report-head">
        <div>
          <div class="dim-label">Detailed report</div>
          <h3 style="font-size:24px; font-weight:700; color:var(--ink); margin-top:4px;">Per-dimension breakdown & guidance</h3>
        </div>
        <button class="btn btn-green" id="printBtn">Download / print PDF</button>
      </div>
      ${DIMENSIONS.map((dim,idx)=>{
        const score = state.scores[dim.id];
        return `
        <div class="dim-card">
          <div class="dim-card-left">
            <div class="dim-num-lbl">Dimension ${idx+1}</div>
            <div class="dim-card-title">${esc(dim.title)}</div>
            <div class="dim-card-pill" style="background:${LEVEL_COLORS[score-1]}">Level ${score} — ${LEVEL_LABELS[score-1]}</div>
          </div>
          <div>
            <div class="dim-card-section now">Your current state</div>
            <div class="dim-card-text">${esc(dim.levels[score-1])}</div>
            <div class="dim-card-section next">Next step</div>
            <div class="dim-card-text next-step">${esc(dimGuidance(dim, score))}</div>
          </div>
        </div>`;
      }).join("")}
      <div class="platform-block">
        <div class="platform-label">Where this leads</div>
        <div class="platform-text">The DQE Index is technology-agnostic, but it reflects a broader industry shift away from production-based and manually managed data practices toward engineered, repeatable, automation-ready approaches. GenRocket's Quality Evolution Platform is built to support that journey — treating data definitions as durable assets and generating test or training data as reproducible outcomes, so organizations can advance along this index at their own pace.</div>
        <a class="platform-link" href="https://www.genrocket.com" target="_blank" rel="noopener">Learn more about GenRocket →</a>
      </div>
    </div>`;
  }

  function bindReportListeners() {
    $("#printBtn").addEventListener("click", () => window.print());
  }

  function drawRadar(canvasId, labels, values) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    const dpr = window.devicePixelRatio || 1;
    const container = canvas.parentElement;
    const W = container.clientWidth;
    const H = container.clientHeight;
    canvas.width = W * dpr;
    canvas.height = H * dpr;
    canvas.style.width = W + "px";
    canvas.style.height = H + "px";
    const ctx = canvas.getContext("2d");
    ctx.scale(dpr, dpr);

    const cx = W / 2;
    const cy = H / 2 + 6;
    const radius = Math.min(W, H) / 2 - 50;
    const N = labels.length;
    const maxV = 5;

    ctx.strokeStyle = "rgba(33,60,75,0.18)";
    ctx.lineWidth = 1;
    for (let r = 1; r <= 5; r++) {
      ctx.beginPath();
      for (let i = 0; i < N; i++) {
        const angle = (Math.PI * 2 * i / N) - Math.PI / 2;
        const rr = (radius * r) / 5;
        const x = cx + Math.cos(angle) * rr;
        const y = cy + Math.sin(angle) * rr;
        if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
      }
      ctx.closePath();
      ctx.stroke();
    }
    ctx.strokeStyle = "rgba(33,60,75,0.13)";
    for (let i = 0; i < N; i++) {
      const angle = (Math.PI * 2 * i / N) - Math.PI / 2;
      ctx.beginPath();
      ctx.moveTo(cx, cy);
      ctx.lineTo(cx + Math.cos(angle) * radius, cy + Math.sin(angle) * radius);
      ctx.stroke();
    }
    ctx.fillStyle = "rgba(39,191,240,0.32)";
    ctx.strokeStyle = "#27BFF0";
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (let i = 0; i < N; i++) {
      const angle = (Math.PI * 2 * i / N) - Math.PI / 2;
      const rr = (radius * values[i]) / maxV;
      const x = cx + Math.cos(angle) * rr;
      const y = cy + Math.sin(angle) * rr;
      if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = "#23A6DE";
    for (let i = 0; i < N; i++) {
      const angle = (Math.PI * 2 * i / N) - Math.PI / 2;
      const rr = (radius * values[i]) / maxV;
      ctx.beginPath();
      ctx.arc(cx + Math.cos(angle) * rr, cy + Math.sin(angle) * rr, 3, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.fillStyle = "#213C4B";
    ctx.font = "500 11px Montserrat, sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (let i = 0; i < N; i++) {
      const angle = (Math.PI * 2 * i / N) - Math.PI / 2;
      const lx = cx + Math.cos(angle) * (radius + 20);
      const ly = cy + Math.sin(angle) * (radius + 20);
      ctx.fillText(labels[i], lx, ly);
    }
  }

  function drawBar(canvasId, labels, values, colors) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    const dpr = window.devicePixelRatio || 1;
    const container = canvas.parentElement;
    const W = container.clientWidth;
    const H = container.clientHeight;
    canvas.width = W * dpr;
    canvas.height = H * dpr;
    canvas.style.width = W + "px";
    canvas.style.height = H + "px";
    const ctx = canvas.getContext("2d");
    ctx.scale(dpr, dpr);

    const padLeft = 160;
    const padRight = 24;
    const padTop = 10;
    const padBottom = 24;
    const chartW = W - padLeft - padRight;
    const chartH = H - padTop - padBottom;
    const N = labels.length;
    const rowH = chartH / N;
    const barH = Math.min(rowH * 0.6, 22);
    const maxV = 5;

    ctx.strokeStyle = "rgba(33,60,75,0.1)";
    ctx.lineWidth = 1;
    ctx.fillStyle = "#213C4B";
    ctx.font = "500 11px Montserrat, sans-serif";
    ctx.textAlign = "center";
    for (let v = 0; v <= maxV; v++) {
      const x = padLeft + (chartW * v) / maxV;
      ctx.beginPath();
      ctx.moveTo(x, padTop);
      ctx.lineTo(x, padTop + chartH);
      ctx.stroke();
      ctx.fillText(String(v), x, padTop + chartH + 14);
    }
    ctx.font = "500 11px Montserrat, sans-serif";
    for (let i = 0; i < N; i++) {
      const y = padTop + i * rowH + (rowH - barH) / 2;
      const w = (chartW * values[i]) / maxV;
      ctx.fillStyle = colors[i];
      const r = 4;
      ctx.beginPath();
      ctx.moveTo(padLeft, y);
      ctx.lineTo(padLeft + Math.max(w - r, 0), y);
      ctx.quadraticCurveTo(padLeft + w, y, padLeft + w, y + r);
      ctx.lineTo(padLeft + w, y + barH - r);
      ctx.quadraticCurveTo(padLeft + w, y + barH, padLeft + w - r, y + barH);
      ctx.lineTo(padLeft, y + barH);
      ctx.closePath();
      ctx.fill();
      ctx.fillStyle = "#213C4B";
      ctx.textAlign = "right";
      ctx.textBaseline = "middle";
      let lbl = labels[i];
      if (lbl.length > 28) lbl = lbl.slice(0, 26) + "…";
      ctx.fillText(lbl, padLeft - 10, y + barH / 2);
      ctx.fillStyle = "#fff";
      ctx.textAlign = "right";
      ctx.font = "700 11px Montserrat, sans-serif";
      if (w > 24) ctx.fillText(String(values[i]), padLeft + w - 8, y + barH / 2);
      ctx.font = "500 11px Montserrat, sans-serif";
    }
  }

  function boot() {
    const params = new URLSearchParams(window.location.search);
    let id = params.get("id");

    if (!id) {
      const prog = loadProgress();
      if (prog && prog.shareId) {
        id = prog.shareId;
      }
    }

    if (id) {
      let saved = loadSession(id);
      if ((!saved || !saved.scores) && window.DQE_SERVER_SESSION && window.DQE_SERVER_SESSION.scores) {
        saved = window.DQE_SERVER_SESSION;
        saveSession(id, saved);
      }
      if (saved && saved.scores) {
        const scoreCount = Object.keys(saved.scores).length;
        state.shareId = id;
        state.scores = saved.scores;
        state.contact = saved.contact || null;

        if (saved.reportUnlocked || scoreCount >= DIMENSIONS.length) {
          state.reportUnlocked = true;
          state.screen = "results";
          const url = new URL(window.location);
          if (url.searchParams.get("id") !== id) {
            url.searchParams.set("id", id);
            try { history.replaceState({}, "", url.toString()); } catch (e) {}
          }
          render();
          return;
        }
      }
    }
    render();

    let resizeTimer;
    window.addEventListener("resize", () => {
      if (state.screen !== "results") return;
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        const vals = Object.values(state.scores);
        if (vals.length === 0) return;
        const radarLabels = DIMENSIONS.map(d => d.title.split(" & ")[0].split(" ").slice(0,2).join(" "));
        const radarValues = DIMENSIONS.map(d => state.scores[d.id]);
        const sortedDims = [...DIMENSIONS].sort((a,b) => state.scores[a.id] - state.scores[b.id]);
        drawRadar("radarChart", radarLabels, radarValues);
        drawBar("barChart", sortedDims.map(d=>d.title), sortedDims.map(d=>state.scores[d.id]), sortedDims.map(d => LEVEL_COLORS[state.scores[d.id]-1]));
      }, 150);
    });
  }

  // Listen for WPForms submission success event (AJAX)
  if (window.jQuery) {
    window.jQuery(document).on('wpformsSubmitSuccess', function(event, response, $form) {
      unlockAndSaveReport();
      state.reportUnlocked = true;
      saveSession(state.shareId, {
        scores: state.scores,
        reportUnlocked: true,
        timestamp: Date.now()
      });
      state.screen = "results";
      render();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();
</script>

<?php get_footer(); ?>
