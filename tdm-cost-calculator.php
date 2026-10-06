<?php /* Template Name: TDM Cost Calculator */ ?>
<?php get_header(); ?>
<?php
// Generate nonce for AJAX
$ajax_nonce = wp_create_nonce('gr_roi_nonce');
$ajax_url = admin_url('admin-ajax.php');
?>
<style>
  :root {
    --gr-cyan: #2abdf0;
    --gr-green: #a6d540;
    --gr-dark: #213C4B;
    --gr-light: #E9F0F3;
    --gr-cyan-deep: #23A6DE;
    --gr-green-deep: #6DBF42;
    --gr-orange: #ED7D31;
    --gr-rust: #C04F15;
    --ink: #213C4B;
    --ink-soft: #3F5A6B;
    --ink-mute: #6B7F8E;
    --line: #D5DEE4;
    --line-soft: #E9F0F3;
    --shadow-sm: 0 1px 2px rgba(33, 60, 75, 0.06);
    --shadow-md: 0 4px 12px rgba(33, 60, 75, 0.08);
    --shadow-lg: 0 20px 60px rgba(33, 60, 75, 0.25);
    --radius: 8px;
  }
  #wrapper{
        position: relative;
        overflow: visible !important;
        width: 100%;
        min-height: inherit !important;
  }
  * { box-sizing: border-box; }
    #wrapper .tophead  .btn-primary {
      min-width: 186px;
      padding: 10px 20px 9px 20px;
      line-height: 25px;
      border-radius: 6px;
      font-size: 18px;
      font-weight: 500;
      text-transform: none;
      background: #24ace3;
      border: none;
      margin-right: 10px;
    }
    #wrapper .tophead {
      position: sticky;
      top: 102px;
      z-index: 99;
    }
    #wrapper .tophead  .btn-primary:hover{  
      color: #1b8bb0;
      background: white;
    }
    .gr-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:6px;font-weight:600;cursor:pointer;border:none;transition:all 0.15s ease;font-family:inherit;}
    .gr-btn-ghost{background:transparent;color:#8FA6B5;}
    .gr-btn-ghost:hover{background:rgba(255,255,255,0.08);color:white;}
    .gr-btn-primary{background:var(--gr-green);color:var(--gr-dark);}
    .gr-btn-primary:hover{background:var(--gr-green-deep);color:white;}
    
    .gr-badge{display:inline-flex;align-items:center;gap:7px;padding:5px 11px;background:rgba(39,191,240,0.15);border:1px solid rgba(39,191,240,0.35);border-radius:999px;margin-bottom:16px;}
    .gr-badge-dot{width:6px;height:6px;border-radius:999px;background:var(--gr-green);animation:pulse 2s ease-in-out infinite;}
    @keyframes pulse{
        0%,100%{opacity:1}
        50%{opacity:.4}
    }
    .gr-badge-text{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--gr-cyan);}
    .gr-grid{display:grid;grid-template-columns:380px 1fr;gap:24px;}
    @media (max-width:1024px){
        .gr-grid{grid-template-columns:1fr;}
    }
    .gr-card{background:white;border:1px solid var(--line);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow-sm);}
    .gr-card-dark{background:var(--gr-dark);border:1px solid var(--gr-dark);border-radius:var(--radius);padding:20px;position:relative;overflow:hidden;box-shadow:var(--shadow-sm);}
    .gr-card-dark::before{content:'';position:absolute;top:0;right:0;width:130px;height:130px;background:radial-gradient(circle,rgba(166,213,64,0.15) 0%,transparent 70%);}
    .gr-card-dark > *{position:relative;}
    .gr-card-header{display:flex;align-items:center;gap:10px;padding-bottom:14px;margin-bottom:16px;border-bottom:1px solid var(--line-soft);}
    .gr-card-dark .gr-card-header{border-bottom-color:rgba(255,255,255,0.1);}
    .gr-card-icon{width:28px;height:28px;border-radius:6px;background:rgba(39,191,240,0.12);color:var(--gr-cyan);display:flex;align-items:center;justify-content:center;}
    .gr-card-icon-muted{background:rgba(107,127,142,0.15);color:var(--ink-mute);}
    .gr-card-icon-green{background:rgba(166,213,64,0.2);color:var(--gr-green);}
    .gr-card-title{font-size:15px;font-weight:700;text-transform:uppercase;letter-spacing:0.09em;color:var(--ink);margin:0;}
    .gr-card-dark .gr-card-title{color:white;}
    .gr-field{display:block;margin-bottom:16px;}
    .gr-field:last-child{margin-bottom:0;}
    .gr-field-label{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:6px;}
    .gr-field-label-text{font-size:12.5px;font-weight:600;color:var(--ink);line-height:1.25;display:inline-flex;align-items:center;gap:5px;}
    .gr-card-dark .gr-field-label-text{color:white;}
    .gr-field-unit{font-size:10.5px;color:var(--ink-mute);font-weight:500;margin-left:8px;flex-shrink:0;}
    .gr-card-dark .gr-field-unit{color:#8FA6B5;}
    .gr-tip{display:inline-flex;align-items:center;justify-content:center;width:14px;height:14px;border-radius:999px;background:var(--line);color:var(--ink-mute);font-size:9.5px;font-weight:700;cursor:help;transition:all 0.15s ease;user-select:none;position:relative;}
    .gr-card-dark .gr-tip{background:rgba(255,255,255,0.15);color:white;}
    .gr-tip:hover,.gr-tip:focus{background:var(--gr-cyan);color:white;outline:none;}
    .gr-tip-content{visibility:hidden;opacity:0;position:absolute;bottom:calc(100% + 8px);left:50%;transform:translateX(-50%);background:var(--gr-dark);color:white;padding:9px 12px;border-radius:6px;font-size:11.5px;font-weight:500;line-height:1.45;width:240px;box-shadow:var(--shadow-md);z-index:100;transition:opacity 0.15s ease,visibility 0.15s ease;text-transform:none;letter-spacing:normal;text-align:left;pointer-events:none;}
    .gr-tip-content::after{content:'';position:absolute;top:100%;left:50%;transform:translateX(-50%);border:5px solid transparent;border-top-color:var(--gr-dark);}
    .gr-tip:hover .gr-tip-content,.gr-tip:focus .gr-tip-content,.gr-tip.active .gr-tip-content{visibility:visible;opacity:1;}
    .gr-field input{width:100%;padding:9px 12px;background:white;border:1px solid var(--line)!important;border-radius:6px!important;font-size:14px;color:var(--ink);transition:all 0.15s ease;-moz-appearance:textfield;}
    .gr-field input::-webkit-inner-spin-button,.gr-field input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0;}
    .gr-card-dark .gr-field input{background:rgba(255,255,255,0.1);border-color:rgba(255,255,255,0.2);color:white;}
    .gr-field input:focus{outline:none;border-color:var(--gr-cyan);box-shadow:0 0 0 3px rgba(39,191,240,0.15);}
    .gr-field-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;}
    .gr-footprint{padding-top:12px;margin-top:12px;border-top:1px solid var(--line-soft);display:flex;justify-content:space-between;font-size:12.5px;}
    .gr-footprint-label{color:var(--ink-mute);font-weight:500;}
    .gr-footprint-value{font-weight:700;color:var(--ink);}
    .gr-note{font-size:10.5px;color:var(--ink-mute);display:flex;gap:6px;line-height:1.45;padding:0 4px;}
    .gr-note svg{flex-shrink:0;margin-top:2px;}
    .gr-results{display:flex;flex-direction:column;gap:22px;}
    .gr-headline{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    @media (max-width:640px){
        .gr-headline{grid-template-columns:1fr;}
    }
    .gr-savings-card{border-radius:var(--radius);padding:24px;position:relative;overflow:hidden;border:2px solid;}
    .gr-savings-card.y1{border-color:var(--gr-green);background:linear-gradient(135deg,rgba(166,213,64,0.12) 0%,white 100%);}
    .gr-savings-card.three-yr{border-color:var(--gr-dark);background:var(--gr-dark);color:white;}
    .gr-savings-card.three-yr::before{content:'';position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:999px;background:rgba(39,191,240,0.18);}
    .gr-savings-card.three-yr::after{content:'';position:absolute;bottom:-30px;left:-30px;width:130px;height:130px;background:radial-gradient(circle,rgba(166,213,64,0.18) 0%,transparent 60%);}
    .gr-savings-card > *{position:relative;}
    .gr-savings-label{display:flex;align-items:center;gap:7px;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:8px;}
    .y1 .gr-savings-label{color:var(--gr-green-deep);}
    .three-yr .gr-savings-label{color:var(--gr-cyan);}
    .gr-savings-value{font-size:36px;font-weight:700;letter-spacing:-0.02em;line-height:1;font-variant-numeric:tabular-nums;}
    .y1 .gr-savings-value{color:var(--gr-dark);}
    .three-yr .gr-savings-value{color:white;}
    .gr-savings-sub{font-size:12px;margin-top:8px;font-weight:600;}
    .y1 .gr-savings-sub{color:var(--ink-soft);}
    .three-yr .gr-savings-sub{color:var(--gr-green);}
    .gr-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
    @media (max-width:640px){
        .gr-stats{grid-template-columns:repeat(2,1fr);}
    }
    .gr-stat{border-radius:var(--radius);padding:14px 16px;border:1px solid;}
    .gr-stat.legacy{background:var(--gr-light);border-color:var(--line);}
    .gr-stat.gr{background:var(--gr-dark);border-color:var(--gr-dark);}
    .gr-stat-label{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:6px;}
    .legacy .gr-stat-label{color:var(--ink-mute);}
    .gr .gr-stat-label{color:var(--gr-cyan);}
    .gr-stat-value{font-size:22px;font-weight:700;letter-spacing:-0.01em;font-variant-numeric:tabular-nums;}
    .legacy .gr-stat-value{color:var(--ink-soft);}
    .gr .gr-stat-value{color:white;}
    .gr-charts{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    @media (max-width:768px){
        .gr-charts{grid-template-columns:1fr;}
    }
    .gr-chart-title{font-size:14px;font-weight:700;color:var(--ink);margin:0 0 2px;}
    .gr-chart-sub{font-size:11px;color:var(--ink-mute);margin:0 0 14px;}
    .gr-chart-svg{width:100%;height:200px;}
    .gr-bar-label{font-size:11px;font-weight:600;fill:var(--ink-soft);}
    .gr-bar-value{font-size:11.5px;font-weight:700;fill:var(--ink);font-variant-numeric:tabular-nums;}
    .gr-axis{font-size:10px;fill:var(--ink-mute);}
    .gr-table-wrap{overflow-x:auto;}
    .gr-table{width:100%;border-collapse:collapse;font-size:13.5px;}
    .gr-table thead{background:white;border-bottom:1px solid var(--line);}
    .gr-table th{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--ink-mute);padding:12px 12px;text-align:right;}
    .gr-table th:first-child{text-align:left;padding-left:20px;}
    .gr-table th:last-child{padding-right:20px;}
    .gr-table td{padding:9px 12px;text-align:right;color:var(--ink-soft);font-variant-numeric:tabular-nums;border-bottom:1px solid var(--line-soft);}
    .gr-table td:first-child{text-align:left;padding-left:20px;color:var(--ink-soft);}
    .gr-table td:last-child{padding-right:20px;color:var(--ink);font-weight:600;}
    .gr-table-section td{background:var(--gr-light);font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--ink-soft)!important;padding:7px 20px;}
    .gr-table-section.gr-section td{background:var(--gr-dark);color:var(--gr-cyan)!important;}
    .gr-table-subtotal td{background:#DDE5EA;color:var(--ink)!important;font-weight:700;}
    .gr-table-subtotal.gr-row td{background:rgba(39,191,240,0.12);color:var(--ink)!important;font-weight:700;}
    .gr-table-savings td{background:rgba(166,213,64,0.18);border-top:2px solid var(--gr-green);font-weight:700;color:var(--gr-green-deep)!important;padding:12px;}
    .gr-table-savings td:first-child,.gr-table-savings td:last-child{color:var(--ink)!important;}
    .gr-pillars{background:var(--gr-dark);color:white;border-radius:12px;padding:32px 36px;position:relative;overflow:hidden;}
    .gr-pillars::before{content:'';position:absolute;top:0;right:0;width:280px;height:280px;background:radial-gradient(circle,rgba(39,191,240,0.12) 0%,transparent 70%);}
    .gr-pillars::after{content:'';position:absolute;bottom:0;left:0;width:220px;height:220px;background:radial-gradient(circle,rgba(166,213,64,0.12) 0%,transparent 70%);}
    .gr-pillars > *{position:relative;}
    .gr-pillar-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;margin-top:16px;}
    @media (max-width:768px){
        .gr-pillar-grid{grid-template-columns:1fr;}
    }
    .gr-pillar-num{width:32px;height:32px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;margin-bottom:12px;border:1px solid;}
    .gr-pillar:nth-child(1) .gr-pillar-num{background:rgba(166,213,64,0.18);border-color:rgba(166,213,64,0.4);color:var(--gr-green);}
    .gr-pillar:nth-child(2) .gr-pillar-num{background:rgba(39,191,240,0.18);border-color:rgba(39,191,240,0.4);color:var(--gr-cyan);}
    .gr-pillar:nth-child(3) .gr-pillar-num{background:rgba(237,125,49,0.18);border-color:rgba(237,125,49,0.4);color:var(--gr-orange);}
    .gr-pillar-title{font-weight:700;font-size:15px;margin-bottom:6px;}
    .gr-pillar-body{font-size:13px;color:#C5D2E0;line-height:1.55;margin:0;}
    .gr-footer{border-top:1px solid var(--line);text-align:center;padding-top:18px;font-size:11px;color:var(--ink-mute);line-height:1.55;}

    /* Lead Modal */
    .gr-modal-overlay{position:fixed;inset:0;background:rgba(33,60,75,0.75);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;z-index:200;padding:20px;opacity:0;visibility:hidden;transition:opacity 0.2s ease,visibility 0.2s ease;}
    .gr-modal-overlay.active{opacity:1;visibility:visible;}
    .gr-modal{background:white;border-radius:12px;max-width:460px;width:100%;box-shadow:var(--shadow-lg);transform:translateY(20px);transition:transform 0.25s ease;overflow:hidden;}
    .gr-modal-overlay.active .gr-modal{transform:translateY(0);}
    .gr-modal-head{background:var(--gr-dark);color:white;padding:24px 28px;position:relative;overflow:hidden;}
    .gr-modal-head::before{content:'';position:absolute;top:0;right:0;width:180px;height:180px;background:radial-gradient(circle,rgba(166,213,64,0.2) 0%,transparent 70%);}
    .gr-modal-head > *{position:relative;}
    .gr-modal-head h2{font-size:22px;font-weight:700;margin:0 0 6px;letter-spacing:-0.01em;}
    .gr-modal-head p{font-size:13px;color:#C5D2E0;margin:0;line-height:1.5;}
    .gr-modal-body{padding:24px 28px 28px;}
    .gr-modal-field{margin-bottom:14px;}
    .gr-modal-field label{display:block;font-size:11.5px;font-weight:600;color:var(--ink);margin-bottom:5px;}
    .gr-modal-field input,.gr-modal-field select{width:100%;padding:10px 12px;background:white;border:1px solid var(--line);border-radius:6px;font-size:13.5px;font-family:inherit;color:var(--ink);transition:all 0.15s ease;}
    .gr-modal-field input:focus,.gr-modal-field select:focus{outline:none;border-color:var(--gr-cyan);box-shadow:0 0 0 3px rgba(39,191,240,0.15);}
    .gr-modal-actions{display:flex;gap:10px;margin-top:22px;}
    .gr-modal-btn{flex:1;padding:11px 16px;border-radius:6px;font-size:13px;font-weight:700;cursor:pointer;border:none;font-family:inherit;transition:all 0.15s ease;}
    .gr-modal-btn.cancel{background:var(--gr-light);color:var(--ink-soft);}
    .gr-modal-btn.cancel:hover{background:var(--line);}
    .gr-modal-btn.submit{background:var(--gr-green);color:var(--gr-dark);}
    .gr-modal-btn.submit:hover{background:var(--gr-green-deep);color:white;}
    .gr-modal-btn:disabled{opacity:0.6;cursor:not-allowed;}
    .gr-modal-note{font-size:11px;color:var(--ink-mute);margin-top:14px;text-align:center;line-height:1.5;}
    .gr-modal-error{background:rgba(192,79,21,0.1);border:1px solid rgba(192,79,21,0.3);color:var(--gr-rust);padding:10px 12px;border-radius:6px;font-size:12px;margin-top:10px;display:none;}
    .gr-modal-error.show{display:block;}
    .gr-modal-success{text-align:center;padding:16px 0;}
    .gr-modal-success-icon{width:52px;height:52px;border-radius:999px;background:rgba(166,213,64,0.2);color:var(--gr-green-deep);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;}
    .gr-modal-success h3{font-size:17px;font-weight:700;color:var(--ink);margin:0 0 6px;}
    .gr-modal-success p{font-size:13px;color:var(--ink-mute);margin:0 0 18px;line-height:1.5;}

    /* Tooltip overflow fix */
    .gr-card,.gr-card-dark,.gr-field,.gr-field-label,.gr-field-label-text{overflow:visible!important;}
    .gr-tip{position:relative;z-index:20;}
    .gr-tip-content{width:280px;max-width:min(280px,calc(100vw - 40px));white-space:normal;overflow-wrap:break-word;z-index:9999;}
    .gr-card-dark .gr-tip-content{background:#ffffff;color:var(--gr-dark);}
    .gr-card-dark .gr-tip-content:after{border-top-color:#fff;}
    .banner .caption{background:radial-gradient(circle at 18% 28%,rgba(39,191,240,0.25) 0%,transparent 42%),radial-gradient(circle at 82% 72%,rgba(166,213,64,0.22) 0%,transparent 38%);opacity:0.9;}
    .banner .caption h1{color:#fff!important;font:700 45px/1 'Catamaran',sans-serif!important;text-align:center;}
    .title span{color:#a6d540!important;}
    .newblock{padding:65px 0;font:18px/26px Catamaran,sans-serif;color:#53696f;}
    .gr-modal-body .wpforms-container .wpforms-field{margin-bottom:15px;}
    .gr-modal-body .wpforms-field input,.gr-modal-body .wpforms-field select{width:100%;padding:12px 15px;border:1px solid #d5dee4;border-radius:12px;font-size:14px;}
    .gr-modal-body .wpforms-submit{background:#27BFF0;color:white;border:none;padding:12px 24px;border-radius:100px;cursor:pointer;width:100%;font-weight:600;}
    #wpforms-11933.wpforms-container-full .wpforms-form .wpforms-field {
        padding: 0 !important;
    }
    #wpforms-11933 .wpforms-field-medium{
        border: 1px solid #ddd !important;
    }
    #wpforms-11933  button[type="submit"]{
        width: 100%;
        background: #a6d540 !important;
    }
    .print-logo{
        display:none;
        margin-bottom: 20px;
    }
    .social-media{
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    .social-media li i{
      font-size: 40px;
      color: #2abdf0;
    }
    .info a{ color: #2abdf0;}
    #wrapper .tophead .btn-primary{margin-left: 10px;}
    @media screen and (max-width: 991px){
      #wrapper .tophead .btn-primary {
        min-width: 100%;
        margin-left: 0;
        font-size: 16px;
        margin-top: 10px;
      }
      .gr-table{min-width: 400px;}
    }
     @media screen and (max-width: 639px){
      #wrapper .tophead .btn-primary {
        font-size: 13px;
      }
      #tableBody{width: 350px;}
      .banner .caption h1{font-size: 30px!important;}
     }
     /* Currency input styling */
.currency-input,
.percent-input {
  width: 100%;
  padding: 9px 12px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2) !important;
  border-radius: 6px !important;
  font-size: 14px;
  color: white;
  transition: all 0.15s ease;
  font-variant-numeric: tabular-nums;
}

.currency-input:focus,
.percent-input:focus {
  outline: none;
  border-color: var(--gr-cyan) !important;
  box-shadow: 0 0 0 3px rgba(39,191,240,0.15);
}

.currency-input::-webkit-input-placeholder,
.percent-input::-webkit-input-placeholder {
  color: rgba(255,255,255,0.3);
}
    @media print {
      .d-print-block, .print-logo{display:block!important;}
      .d-print-flex{display:flex!important;}
        #main {
          overflow: visible !important;
          min-height: inherit !important;
        }
        *{
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }
        *:after,*:before{display: none;}
        #wrapper{min-height:inherit;width:100%;display:block;}
        .gr-grid{width:100% !important;display:block !important;}
        .gr-charts,.gr-stats{width:100%;}
        .no-print,#newheader,.request-demo-section,#newfooter,.sticky-bar,#wpadminbar, .gr-modal-overlay{display:none!important;}
        html,body,.gr-main{background:white!important;}
        .gr-modal-overlay{display:none!important;}
        .gr-hero,.gr-pillars,.gr-stat.gr,.gr-savings-card.three-yr{color-adjust:exact;-webkit-print-color-adjust:exact;print-color-adjust:exact;}
        .newblock,.container,#main,.gr-results,html,body,#wrapper{width:100%!important;padding:0!important;overflow:visible!important;display:block!important;margin: 0 !important; padding: 0 !important;gap: 0 !important;}
        .gr-savings-card{width: 80%;}
      }
</style>
<div id="pdf-export-content">
<?php 
$page_banner = get_field('page_banner');
$banner_caption = get_field('banner_caption');
$banner_class = get_field('banner_class');
?>
<div class="tophead no-print py-2 bg-dark ">
    <div class="container d-flex flex-wrap justify-content-center justify-content-lg-end gap-4">
        <button class="gr-btn gr-btn-primary" id="exportPdfBtn" aria-label="Export PDF">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            Get Your Report
        </button>
        <button class="btn btn-secondary" onclick="resetInputs()" aria-label="Reset">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path></svg>
            Reset
        </button>
        <a href="https://www.genrocket.com/replace-legacy-tdm-platforms/" class="btn btn-primary">Book a Discovery meeting with GenRocket</a>
        </div>
</div>
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
    <div class="newblock" >
        <div class="container">
             <div class="gr-grid">
    <aside class="no-print" style="display:flex; flex-direction:column; gap:18px;">

      <section class="gr-card">
        <div class="gr-card-header">
          <div class="gr-card-icon">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/></svg>
          </div>
          <h2 class="gr-card-title">Environment</h2>
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Production databases
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">The number of production databases that need test data — masked from prod or generated synthetically. Each one is a unit of cost in both pricing models.</span>
              </span>
            </span>
            <span class="gr-field-unit">count</span>
          </div>
          <input type="text" class="numeric-only" id="numDatabases" value="20" min="0" step="1" oninput="recalc()" />
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Average database size
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">Average size per database in terabytes. Legacy TDM charges per TB, so this directly drives their cost. GenRocket's pricing is independent of size.</span>
              </span>
            </span>
            <span class="gr-field-unit">TB</span>
          </div>
          <input type="text" id="avgDbSize" class="numeric-only" value="5" min="0" step="0.1" oninput="recalc()" />
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Annual data growth rate
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">How much your data footprint grows year over year. Industry average is 10–25%. Higher growth = bigger legacy bill in Years 2 and 3, and a stronger savings case.</span>
              </span>
            </span>
            <span class="gr-field-unit">%</span>
          </div>
          <input type="text" id="growthRate" class="numeric-only" value="15" min="0" step="1" oninput="recalc()" />
        </div>

        <div class="gr-footprint">
          <span class="gr-footprint-label">Total production footprint</span>
          <span class="gr-footprint-value" id="footprint">100.0 TB</span>
        </div>
      </section>

      <!-- <section class="gr-card">
        <div class="gr-card-header">
          <div class="gr-card-icon gr-card-icon-muted">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <h2 class="gr-card-title">Legacy TDM Costs</h2>
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Annual software license / subscription
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">The base license fee charged by the legacy TDM vendor. Set to $0 if they monetize purely through volume (per-TB) charges.</span>
              </span>
            </span>
            <span class="gr-field-unit">$/year</span>
          </div>
          <input type="text" id="legacyLicense" class="numeric-only" value="0" min="0" step="1000" oninput="recalc()" />
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Volume-based masking rate
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">What the legacy vendor charges per terabyte of data masked, per year. Industry range: $8K–$20K/TB. This is the line that balloons as data grows.</span>
              </span>
            </span>
            <span class="gr-field-unit">$/TB/year</span>
          </div>
          <input type="text" id="maskingRate" class="numeric-only" value="12000" min="0" step="100" oninput="recalc()" />
        </div>

        <div class="gr-field-grid">
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Services Y1
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Professional services in Year 1 — implementation, integration, training. Usually highest in Year 1.</span>
                </span>
              </span>
              <span class="gr-field-unit">$</span>
            </div>
            <input type="text" id="legacyServicesY1" class="numeric-only" value="150000" min="0" step="1000" oninput="recalc()" />
          </div>
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Services Y2
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Ongoing services in Year 2 — maintenance, new use cases, support contracts.</span>
                </span>
              </span>
              <span class="gr-field-unit">$</span>
            </div>
            <input type="text" id="legacyServicesY2" class="numeric-only" value="150000" min="0" step="1000" oninput="recalc()" />
          </div>
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Services Y3
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Ongoing services in Year 3.</span>
                </span>
              </span>
              <span class="gr-field-unit">$</span>
            </div>
            <input type="text" id="legacyServicesY3" class="numeric-only" value="150000" min="0" step="1000" oninput="recalc()" />
          </div>
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Premium support rate
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">Typically 12–22% of base license. Calculated on the software license only, not the per-TB charges.</span>
              </span>
            </span>
            <span class="gr-field-unit">% of license</span>
          </div>
          <input type="text" id="legacySupportRate" class="numeric-only" value="12" min="0" step="1" oninput="recalc()" />
        </div>
      </section> -->
      <section class="gr-card">
  <div class="gr-card-header">
    <div class="gr-card-icon gr-card-icon-muted">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
    </div>
    <h2 class="gr-card-title">Legacy TDM Costs</h2>
  </div>

  <div class="gr-field">
    <div class="gr-field-label">
      <span class="gr-field-label-text">
        Annual software license / subscription
        <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
          <span class="gr-tip-content">The base license fee charged by the legacy TDM vendor. Set to $0 if they monetize purely through volume (per-TB) charges.</span>
        </span>
      </span>
      <span class="gr-field-unit">$/year</span>
    </div>
    <div style="position:relative;">
      <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">$</span>
      <input type="text" id="legacyLicense" class="currency-input" value="0" min="0" step="1000" oninput="recalc()" style="padding-left:28px;" />
    </div>
  </div>

  <div class="gr-field">
    <div class="gr-field-label">
      <span class="gr-field-label-text">
        Volume-based masking rate
        <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
          <span class="gr-tip-content">What the legacy vendor charges per terabyte of data masked, per year. Industry range: $8K–$20K/TB. This is the line that balloons as data grows.</span>
        </span>
      </span>
      <span class="gr-field-unit">$/TB/year</span>
    </div>
    <div style="position:relative;">
      <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">$</span>
      <input type="text" id="maskingRate" class="currency-input" value="12,000" min="0" step="100" oninput="recalc()" style="padding-left:28px;" />
    </div>
  </div>

  <div class="gr-field-grid">
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Services Y1
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Professional services in Year 1 — implementation, integration, training. Usually highest in Year 1.</span>
          </span>
        </span>
        <span class="gr-field-unit">$</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">$</span>
        <input type="text" id="legacyServicesY1" class="currency-input" value="150,000" min="0" step="1000" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Services Y2
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Ongoing services in Year 2 — maintenance, new use cases, support contracts.</span>
          </span>
        </span>
        <span class="gr-field-unit">$</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">$</span>
        <input type="text" id="legacyServicesY2" class="currency-input" value="150,000" min="0" step="1000" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Services Y3
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Ongoing services in Year 3.</span>
          </span>
        </span>
        <span class="gr-field-unit">$</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">$</span>
        <input type="text" id="legacyServicesY3" class="currency-input" value="150,000" min="0" step="1000" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
  </div>

  <div class="gr-field">
    <div class="gr-field-label">
      <span class="gr-field-label-text">
        Premium support rate
        <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
          <span class="gr-tip-content">Typically 12–22% of base license. Calculated on the software license only, not the per-TB charges.</span>
        </span>
      </span>
      <span class="gr-field-unit">% of license</span>
    </div>
    <div style="position:relative;">
      <span style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#6B7F8E;font-weight:600;font-size:14px;z-index:1;">%</span>
      <input type="text" id="legacySupportRate" class="percent-input" value="12" min="0" step="1" oninput="recalc()" style="padding-right:28px;" />
    </div>
  </div>
</section>

      <!-- <section class="gr-card-dark">
        <div class="gr-card-header">
          <div class="gr-card-icon gr-card-icon-green">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/></svg>
          </div>
          <h2 class="gr-card-title">GenRocket Costs</h2>
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              IPM license per database
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">GenRocket's In-Place Masking license is a fixed annual cost per database — not per TB. Whether a database is 1 TB or 100 TB, the cost is the same.</span>
              </span>
            </span>
            <span class="gr-field-unit">$/db/year</span>
          </div>
          <input type="text" id="grIpmPerDb" class="numeric-only" value="10000" min="0" step="500" oninput="recalc()" />
        </div>

        <div class="gr-field-grid">
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Nav Y1
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Navigator services — GenRocket's expert-led implementation and enablement. Per database, per year.</span>
                </span>
              </span>
              <span class="gr-field-unit">$/db</span>
            </div>
            <input type="text" id="grNavigatorY1" class="numeric-only" value="8000" min="0" step="500" oninput="recalc()" />
          </div>
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Nav Y2
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Navigator services in Year 2.</span>
                </span>
              </span>
              <span class="gr-field-unit">$/db</span>
            </div>
            <input type="text" id="grNavigatorY2" class="numeric-only" value="8000" min="0" step="500" oninput="recalc()" />
          </div>
          <div class="gr-field">
            <div class="gr-field-label">
              <span class="gr-field-label-text">
                Nav Y3
                <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                  <span class="gr-tip-content">Navigator services in Year 3. Often reduced as customer team becomes self-sufficient.</span>
                </span>
              </span>
              <span class="gr-field-unit">$/db</span>
            </div>
            <input type="text" id="grNavigatorY3" class="numeric-only" value="8000" min="0" step="500" oninput="recalc()" />
          </div>
        </div>

        <div class="gr-field">
          <div class="gr-field-label">
            <span class="gr-field-label-text">
              Premium support rate
              <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
                <span class="gr-tip-content">GenRocket's premium support is calculated on the total IPM license value. Standard 12%.</span>
              </span>
            </span>
            <span class="gr-field-unit">% of license</span>
          </div>
          <input type="text" id="grSupportRate" value="12" class="numeric-only" min="0" step="1" oninput="recalc()" />
        </div>
      </section> -->

      <section class="gr-card-dark">
  <div class="gr-card-header">
    <div class="gr-card-icon gr-card-icon-green">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/></svg>
    </div>
    <h2 class="gr-card-title">GenRocket Costs</h2>
  </div>

  <div class="gr-field">
    <div class="gr-field-label">
      <span class="gr-field-label-text">
        IPM license per database
        <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
          <span class="gr-tip-content">GenRocket's In-Place Masking license is a fixed annual cost per database — not per TB. Whether a database is 1 TB or 100 TB, the cost is the same.</span>
        </span>
      </span>
      <span class="gr-field-unit">$/db/year</span>
    </div>
    <div style="position:relative;">
      <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#8FA6B5;font-weight:600;font-size:14px;">$</span>
      <input type="text" id="grIpmPerDb" class="currency-input" value="10,000" min="0" step="500" oninput="recalc()" style="padding-left:28px;" />
    </div>
  </div>

  <div class="gr-field-grid">
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Nav Y1
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Navigator services — GenRocket's expert-led implementation and enablement. Per database, per year.</span>
          </span>
        </span>
        <span class="gr-field-unit">$/db</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#8FA6B5;font-weight:600;font-size:14px;">$</span>
        <input type="text" id="grNavigatorY1" class="currency-input" value="8,000" min="0" step="500" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Nav Y2
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Navigator services in Year 2.</span>
          </span>
        </span>
        <span class="gr-field-unit">$/db</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#8FA6B5;font-weight:600;font-size:14px;">$</span>
        <input type="text" id="grNavigatorY2" class="currency-input" value="8,000" min="0" step="500" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
    <div class="gr-field">
      <div class="gr-field-label">
        <span class="gr-field-label-text">
          Nav Y3
          <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
            <span class="gr-tip-content">Navigator services in Year 3. Often reduced as customer team becomes self-sufficient.</span>
          </span>
        </span>
        <span class="gr-field-unit">$/db</span>
      </div>
      <div style="position:relative;">
        <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#8FA6B5;font-weight:600;font-size:14px;">$</span>
        <input type="text" id="grNavigatorY3" class="currency-input" value="8,000" min="0" step="500" oninput="recalc()" style="padding-left:28px;" />
      </div>
    </div>
  </div>

  <div class="gr-field">
    <div class="gr-field-label">
      <span class="gr-field-label-text">
        Premium support rate
        <span class="gr-tip" tabindex="0" role="button" aria-label="More info">?
          <span class="gr-tip-content">GenRocket's premium support is calculated on the total IPM license value. Standard 12%.</span>
        </span>
      </span>
      <span class="gr-field-unit">% of license</span>
    </div>
    <div style="position:relative;">
      <span style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#8FA6B5;font-weight:600;font-size:14px;">%</span>
      <input type="text" id="grSupportRate" class="percent-input" value="12" min="0" step="1" oninput="recalc()" style="padding-right:28px;" />
    </div>
  </div>
</section>

      <div class="gr-note">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
        <span>Estimates exclude infrastructure and storage costs to keep the comparison conservative. Validate customer-specific pricing during discovery.</span>
      </div>
    </aside>

    <section class="gr-results" >
      <div class="justify-content-between d-none d-print-flex">
        <a href="https://www.genrocket.com/"><img src="https://www.genrocket.com/wp-content/themes/genrocket/assets/images/genrocket-logo.jpg?t=current_timestamp" width="200" alt="GenRocket - Test Data Management"></a>
        <div class="info">
          Phone: <a href="tel:8058362879">(805) 836-2879</a> <br>
          Email: <a href="mailto:info@genrocket.com">info@genrocket.com</a>
        </div>
      </div>
      <div class="gr-headline">
        <div class="gr-savings-card y1">
          <div class="gr-savings-label">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
            Year 1 Savings
          </div>
          <div class="gr-savings-value" id="y1Savings">$966,000</div>
          <div class="gr-savings-sub" id="y1SavingsPct">71.6% reduction vs. legacy</div>
        </div>
        <div class="gr-savings-card three-yr">
          <div class="gr-savings-label">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            3-Year Projected Savings
          </div>
          <div class="gr-savings-value" id="threeYrSavings">$3,465,000</div>
          <div class="gr-savings-sub" id="threeYrSavingsPct">75.0% reduction vs. legacy</div>
        </div>
      </div>

      <div class="gr-stats">
        <div class="gr-stat legacy"><div class="gr-stat-label">Legacy Y1</div><div class="gr-stat-value" id="legacyY1">$1,350,000</div></div>
        <div class="gr-stat gr"><div class="gr-stat-label">GenRocket Y1</div><div class="gr-stat-value" id="grY1">$384,000</div></div>
        <div class="gr-stat legacy"><div class="gr-stat-label">Legacy 3-Year</div><div class="gr-stat-value" id="legacy3Yr">$4,617,000</div></div>
        <div class="gr-stat gr"><div class="gr-stat-label">GenRocket 3-Year</div><div class="gr-stat-value" id="gr3Yr">$1,152,000</div></div>
      </div>

      <div class="gr-charts">
        <div class="gr-card">
          <h3 class="gr-chart-title">Year 1 Comparison</h3>
          <p class="gr-chart-sub">All-in cost including services and support</p>
          <svg class="gr-chart-svg" id="chartY1" viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet"></svg>
        </div>
        <div class="gr-card">
          <h3 class="gr-chart-title">3-Year Projection</h3>
          <p class="gr-chart-sub">Cumulative cost with data growth applied</p>
          <svg class="gr-chart-svg" id="chart3Yr" viewBox="0 0 400 200" preserveAspectRatio="xMidYMid meet"></svg>
        </div>
      </div>

      <div class="gr-card" style="padding:0; overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid var(--line); background: var(--gr-light);">
          <h3 class="gr-chart-title">Cost Breakdown by Year</h3>
          <p class="gr-chart-sub" style="margin-bottom:0;">Full line-item comparison of both pricing models</p>
        </div>
        <div class="gr-table-wrap">
          <div id="tableBody"></div> 
        </div>
      </div>

      <div class="gr-pillars">
        <div class="gr-badge"><span class="gr-badge-text">Why the Economics Work</span></div>
        <div class="gr-pillar-grid">
          <div class="gr-pillar">
            <div class="gr-pillar-num">01</div>
            <div class="gr-pillar-title">Unparalleled Security & Privacy</div>
            <p class="gr-pillar-body">Metadata-driven masking and synthetic data replacement eliminate reliance on exposed production datasets while protecting sensitive enterprise information by design.</p>
          </div>
          <div class="gr-pillar">
            <div class="gr-pillar-num">02</div>
            <div class="gr-pillar-title">Enterprise-Class Speed & Performance</div>
            <p class="gr-pillar-body">Multi-threaded parallel processing delivers high-performance masking and rapid provisioning of fit-for-purpose data for modern testing and AI workflows.</p>
          </div>
          <div class="gr-pillar">
            <div class="gr-pillar-num">03</div>
            <div class="gr-pillar-title">Major Savings at Scale</div>
            <p class="gr-pillar-body">Reduce infrastructure, storage, licensing, and operational costs with a more economical alternative to traditional TDM and masking platforms.</p>
          </div>
        </div>
      </div>

      <footer class="gr-footer">
        <a class="print-logo" href="https://www.genrocket.com/"><img src="https://www.genrocket.com/wp-content/themes/genrocket/assets/images/genrocket-logo.jpg?nocache=1" width="200" alt="GenRocket - Test Data Management"></a>
        Directional estimate for planning and evaluation. Customer-specific pricing, environment details, and services scope should be validated during discovery.<br />
        <strong style="color: var(--ink-soft);">© GenRocket</strong> · Data Masking Cost Savings Calculator
      </footer>
    </section>
  </div>
        </div>
    </div>
    <?php endwhile; endif; wp_reset_query(); ?>
</main>
</div>
<!-- Modal Form -->
<div class="gr-modal-overlay" id="leadModal">
    <div class="gr-modal">
        <div class="gr-modal-head">
            <h2>Get your savings report</h2>
            <p>Share a few details to download your personalized PDF report.</p>
        </div>
        <div class="gr-modal-body">
            <?php echo do_shortcode('[wpforms id="11933" title="false"]'); ?>
            <div id="modalError" class="gr-modal-error"></div>
            <p class="gr-modal-note">By submitting, you agree to be contacted about GenRocket solutions.</p>
        </div>
        <button class="gr-modal-close" onclick="closeLeadModal()">×</button>
    </div>
</div>



<style>
    #exportPdfBtn{margin-right:10px; }
.gr-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 10000;
    align-items: center;
    justify-content: center;
}
.gr-modal-overlay.active { display: flex; }
.gr-modal {
    background: white;
    border-radius: 24px;
    max-width: 500px;
    width: 90%;
    position: relative;
}
.gr-modal-close {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
}
.form-group { margin-bottom: 15px; }
.form-group input, .form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
}
.gr-modal-btn {
    width: 100%;
    padding: 14px;
    background: #27BFF0;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
}
.gr-modal-error {
    background: #fee;
    color: #c00;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    display: none;
}
.gr-modal-note {
    font-size: 12px;
    color: #666;
    text-align: center;
    margin-top: 15px;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<?php
// Debug code - check for PDFs in uploads directory
$upload_dir = wp_upload_dir();
$files = glob($upload_dir['path'] . '/roi_report_*.pdf');
echo '<!-- PDF Files found: ' . count($files) . ' -->';
if (!empty($files)) {
    echo '<!-- Latest PDF: ' . end($files) . ' -->';
    echo '<!-- File exists: ' . (file_exists(end($files)) ? 'YES' : 'NO') . ' -->';
}
?>
<script>
  // Set AJAX variables from PHP
// Set AJAX variables from PHP
const GR_AJAX_URL = '<?php echo admin_url("admin-ajax.php"); ?>';
const GR_NONCE = '<?php echo wp_create_nonce("gr_roi_nonce"); ?>';

console.log('AJAX URL:', GR_AJAX_URL);
console.log('Nonce set:', GR_NONCE ? 'Yes' : 'No');
// Calculator Functions
const fmtMoney = (n) => isFinite(n) ? '$' + Math.round(n).toLocaleString() : '$0';
const fmtPct = (n) => `${(n * 100).toFixed(1)}%`;

function recalc() {
    // Helper to parse currency values
    const parseCurrency = (value) => {
        if (!value) return 0;
        // Remove commas and dollar signs, parse as float
        const clean = String(value).replace(/[$,]/g, '').trim();
        return parseFloat(clean) || 0;
    };
    
    const get = (id) => {
        const element = document.getElementById(id);
        if (!element) return 0;
        // For currency inputs, parse the formatted value
        if (element.classList.contains('currency-input')) {
            return parseCurrency(element.value);
        }
        // For percentage inputs
        if (element.classList.contains('percent-input')) {
            return parseFloat(element.value) || 0;
        }
        // For regular numeric inputs
        return parseFloat(element.value) || 0;
    };
    
    const numDatabases = get('numDatabases');
    const avgDbSize = get('avgDbSize');
    const growthRate = get('growthRate') / 100;
    const legacyLicense = get('legacyLicense');
    const maskingRate = get('maskingRate');
    const legacyServicesY1 = get('legacyServicesY1');
    const legacyServicesY2 = get('legacyServicesY2');
    const legacyServicesY3 = get('legacyServicesY3');
    const legacySupportRate = get('legacySupportRate') / 100;
    const grIpmPerDb = get('grIpmPerDb');
    const grNavigatorY1 = get('grNavigatorY1');
    const grNavigatorY2 = get('grNavigatorY2');
    const grNavigatorY3 = get('grNavigatorY3');
    const grSupportRate = get('grSupportRate') / 100;
    
    // Calculations
    const tbY1 = numDatabases * avgDbSize;
    const tbY2 = tbY1 * (1 + growthRate);
    const tbY3 = tbY2 * (1 + growthRate);
    
    const legacyMaskY1 = tbY1 * maskingRate;
    const legacyMaskY2 = tbY2 * maskingRate;
    const legacyMaskY3 = tbY3 * maskingRate;
    const legacySupport = legacyLicense * legacySupportRate;
    
    const legacyY1 = legacyLicense + legacyMaskY1 + legacyServicesY1 + legacySupport;
    const legacyY2 = legacyLicense + legacyMaskY2 + legacyServicesY2 + legacySupport;
    const legacyY3 = legacyLicense + legacyMaskY3 + legacyServicesY3 + legacySupport;
    const legacy3Yr = legacyY1 + legacyY2 + legacyY3;
    
    const grLicense = numDatabases * grIpmPerDb;
    const grSupport = grLicense * grSupportRate;
    const grY1 = grLicense + grSupport + (numDatabases * grNavigatorY1);
    const grY2 = grLicense + grSupport + (numDatabases * grNavigatorY2);
    const grY3 = grLicense + grSupport + (numDatabases * grNavigatorY3);
    const gr3Yr = grY1 + grY2 + grY3;
    
    const y1Savings = legacyY1 - grY1;
    const threeYrSavings = legacy3Yr - gr3Yr;
    const y1SavingsPct = legacyY1 > 0 ? y1Savings / legacyY1 : 0;
    const threeYrSavingsPct = legacy3Yr > 0 ? threeYrSavings / legacy3Yr : 0;
    
    // Update UI
    document.getElementById('footprint').innerHTML = `${tbY1.toFixed(1)} TB`;
    document.getElementById('y1Savings').innerHTML = fmtMoney(y1Savings);
    document.getElementById('y1SavingsPct').innerHTML = `${fmtPct(y1SavingsPct)} reduction vs. legacy`;
    document.getElementById('threeYrSavings').innerHTML = fmtMoney(threeYrSavings);
    document.getElementById('threeYrSavingsPct').innerHTML = `${fmtPct(threeYrSavingsPct)} reduction vs. legacy`;
    document.getElementById('legacyY1').innerHTML = fmtMoney(legacyY1);
    document.getElementById('grY1').innerHTML = fmtMoney(grY1);
    document.getElementById('legacy3Yr').innerHTML = fmtMoney(legacy3Yr);
    document.getElementById('gr3Yr').innerHTML = fmtMoney(gr3Yr);
    
    // Update table
    document.getElementById('tableBody').innerHTML = `
        <table class="gr-table">
        <thead><tr><th>Component</th><th>Year 1</th><th>Year 2</th><th>Year 3</th><th>3-Yr Total</th></tr></thead>
        <tbody>
        <tr><td colspan="5"><strong>Legacy TDM</strong></td></tr>
        <tr><td>Base software license</td><td>${fmtMoney(legacyLicense)}</td><td>${fmtMoney(legacyLicense)}</td><td>${fmtMoney(legacyLicense)}</td><td>${fmtMoney(legacyLicense * 3)}</td></tr>
        <tr><td>Volume-based masking</td><td>${fmtMoney(legacyMaskY1)}</td><td>${fmtMoney(legacyMaskY2)}</td><td>${fmtMoney(legacyMaskY3)}</td><td>${fmtMoney(legacyMaskY1 + legacyMaskY2 + legacyMaskY3)}</td></tr>
        <tr><td>Professional services</td><td>${fmtMoney(legacyServicesY1)}</td><td>${fmtMoney(legacyServicesY2)}</td><td>${fmtMoney(legacyServicesY3)}</td><td>${fmtMoney(legacyServicesY1 + legacyServicesY2 + legacyServicesY3)}</td></tr>
        <tr><td>Premium support</td><td>${fmtMoney(legacySupport)}</td><td>${fmtMoney(legacySupport)}</td><td>${fmtMoney(legacySupport)}</td><td>${fmtMoney(legacySupport * 3)}</td></tr>
        <tr style="background:#f0f7fa;"><td><strong>Legacy Subtotal</strong></td><td><strong>${fmtMoney(legacyY1)}</strong></td><td><strong>${fmtMoney(legacyY2)}</strong></td><td><strong>${fmtMoney(legacyY3)}</strong></td><td><strong>${fmtMoney(legacy3Yr)}</strong></td></tr>
        </tbody>
        </table>
        <table class="gr-table gr-table2">
        <thead><tr><th>Component</th><th>Year 1</th><th>Year 2</th><th>Year 3</th><th>3-Yr Total</th></tr></thead>
        <tbody>
        <tr><td colspan="5"><strong>GenRocket</strong></td></tr>
        <tr><td>IPM database licensing</td><td>${fmtMoney(grLicense)}</td><td>${fmtMoney(grLicense)}</td><td>${fmtMoney(grLicense)}</td><td>${fmtMoney(grLicense * 3)}</td></tr>
        <tr><td>Premium support</td><td>${fmtMoney(grSupport)}</td><td>${fmtMoney(grSupport)}</td><td>${fmtMoney(grSupport)}</td><td>${fmtMoney(grSupport * 3)}</td></tr>
        <tr><td>Navigator services</td><td>${fmtMoney(numDatabases * grNavigatorY1)}</td><td>${fmtMoney(numDatabases * grNavigatorY2)}</td><td>${fmtMoney(numDatabases * grNavigatorY3)}</td><td>${fmtMoney((numDatabases * grNavigatorY1) + (numDatabases * grNavigatorY2) + (numDatabases * grNavigatorY3))}</td></tr>
        <tr style="background:#f0f7fa;"><td><strong>GenRocket Subtotal</strong></td><td><strong>${fmtMoney(grY1)}</strong></td><td><strong>${fmtMoney(grY2)}</strong></td><td><strong>${fmtMoney(grY3)}</strong></td><td><strong>${fmtMoney(gr3Yr)}</strong></td></tr>
        <tr style="background:#e8f5e9;"><td><strong>Projected Savings</strong></td><td><strong>${fmtMoney(legacyY1 - grY1)}</strong></td><td><strong>${fmtMoney(legacyY2 - grY2)}</strong></td><td><strong>${fmtMoney(legacyY3 - grY3)}</strong></td><td><strong>${fmtMoney(threeYrSavings)}</strong></td></tr>
        </tbody>
        </table>
    `;
    
    // Update charts
    drawChart('chartY1', legacyY1, grY1);
    drawChart('chart3Yr', legacy3Yr, gr3Yr);
}

function drawChart(svgId, legacyVal, grVal) {
    const svg = document.getElementById(svgId);
    const baseY = 165, chartH = 130, barW = 90;
    const maxVal = Math.max(legacyVal, grVal, 1);
    const legacyH = (legacyVal / maxVal) * chartH;
    const grH = (grVal / maxVal) * chartH;
    const legacyX = 90, grX = 220;
    const fmtK = (v) => v >= 1000000 ? `$${(v/1000000).toFixed(1)}M` : `$${(v/1000).toFixed(0)}K`;
    svg.innerHTML = `
      <line x1="40" y1="${baseY}" x2="380" y2="${baseY}" stroke="#D5DEE4" stroke-width="1"/>
      <line x1="40" y1="${baseY - chartH/2}" x2="380" y2="${baseY - chartH/2}" stroke="#E9F0F3" stroke-width="1" stroke-dasharray="3 3"/>
      <line x1="40" y1="${baseY - chartH}" x2="380" y2="${baseY - chartH}" stroke="#E9F0F3" stroke-width="1" stroke-dasharray="3 3"/>
      <text class="gr-axis" x="35" y="${baseY + 4}" text-anchor="end">$0</text>
      <text class="gr-axis" x="35" y="${baseY - chartH/2 + 4}" text-anchor="end">${fmtK(maxVal/2)}</text>
      <text class="gr-axis" x="35" y="${baseY - chartH + 4}" text-anchor="end">${fmtK(maxVal)}</text>
      <rect x="${legacyX}" y="${baseY - legacyH}" width="${barW}" height="${legacyH}" fill="#6B7F8E" rx="4"/>
      <text class="gr-bar-value" x="${legacyX + barW/2}" y="${baseY - legacyH - 8}" text-anchor="middle">${fmtK(legacyVal)}</text>
      <text class="gr-bar-label" x="${legacyX + barW/2}" y="${baseY + 18}" text-anchor="middle">Legacy TDM</text>
      <rect x="${grX}" y="${baseY - grH}" width="${barW}" height="${grH}" fill="#27BFF0" rx="4"/>
      <text class="gr-bar-value" x="${grX + barW/2}" y="${baseY - grH - 8}" text-anchor="middle">${fmtK(grVal)}</text>
      <text class="gr-bar-label" x="${grX + barW/2}" y="${baseY + 18}" text-anchor="middle">GenRocket</text>
    `;
}

function resetInputs() {
    const inputs = [
        'numDatabases','avgDbSize','growthRate',
        'legacyLicense','maskingRate','legacyServicesY1','legacyServicesY2','legacyServicesY3','legacySupportRate',
        'grIpmPerDb','grNavigatorY1','grNavigatorY2','grNavigatorY3','grSupportRate'
    ];
    const defaults = [
        20, 5, 15,
        0, 12000, 150000, 150000, 150000, 12,
        10000, 8000, 8000, 8000, 12
    ];
    
    inputs.forEach((id, idx) => {
        const element = document.getElementById(id);
        if (element) {
            if (element.classList.contains('currency-input')) {
                // Format the default value with commas
                element.value = formatCurrency(defaults[idx]);
            } else if (element.classList.contains('percent-input')) {
                element.value = defaults[idx];
            } else {
                element.value = defaults[idx];
            }
        }
    });
    recalc();
}

// Generate PDF and return as Blob/DataURL
async function generatePDFAsBlob() {
    try {
        // Create a clean clone for PDF
        const element = document.getElementById('pdf-export-content');
        const clone = element.cloneNode(true);
        
        // Get the logo URL
        const originalLogoLink = document.querySelector('.print-logo img');
        const logoUrl = originalLogoLink ? originalLogoLink.src : 'https://www.genrocket.com/wp-content/themes/genrocket/assets/images/genrocket-logo.jpg?v=timestamp';
        
        // Create a custom header with logo and contact info
        const customHeader = document.createElement('div');
        customHeader.className = 'pdf-header';
        customHeader.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0 10px 0; margin-bottom: 10px; border-bottom: 2px solid #D5DEE4;">
                <div class="pdf-logo">
                    <img src="${logoUrl}" alt="GenRocket" style="max-height: 50px; width: auto;">
                </div>
                <div class="pdf-contact" style="text-align: right; font-size: 11px; color: #6B7F8E; line-height: 1.5;">
                    Phone: <a href="tel:8058362879" style="color: #213C4B; text-decoration: none;">(805) 836-2879</a><br>
                    Email: <a href="mailto:info@genrocket.com" style="color: #213C4B; text-decoration: none;">info@genrocket.com</a>
                </div>
            </div>
        `;
        
        // Remove the existing logo area from clone
        const existingLogoArea = clone.querySelector('.justify-content-between.d-none.d-print-flex');
        if (existingLogoArea) {
            existingLogoArea.remove();
        }
        
        // Find where to insert the header
        const resultsSection = clone.querySelector('.gr-results');
        if (resultsSection) {
            resultsSection.insertBefore(customHeader, resultsSection.firstChild);
        }
        
        // Apply PDF-specific styles to clone
        const style = document.createElement('style');
        style.textContent = `
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                padding: 0;
                margin: 0;
                background: white;
                font-family: Arial, sans-serif;
            }
            .pdf-export-container {
                max-width: 100%;
                padding: 20px !important;
                margin: 0 auto !important;
            }
            .no-print, .tophead, .banner, .gr-btn, #exportPdfBtn, .gr-modal-overlay, .gr-btn-primary {
                display: none !important;
            }
            .d-print-block, .print-logo{display:block!important;}
            .gr-grid {
                display: block !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .gr-results {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .gr-headline {
                display: flex !important;
                gap: 20px !important;
                margin-bottom: 20px !important;
            }
            .gr-savings-card {
                flex: 1 !important;
                padding: 15px !important;
            }
            .gr-stats {
                display: flex !important;
                gap: 15px !important;
                margin-bottom: 10px !important;
            }
            .gr-stat {
                flex: 1 !important;
            }
            .gr-charts {
                display: flex !important;
                gap: 20px !important;
                margin-bottom: 10px !important;
            }
            .gr-charts .gr-card {
                flex: 1 !important;
                width: 100% !important;
                padding: 15px !important;
            }
            .gr-card{border:0 !important; box-shadow:none !important;}
            .gr-table-wrap {
                overflow-x: visible !important;
                margin-bottom: 20px !important;
            }
            .gr-table {
                width: 100% !important;
                font-size: 12px !important;
                border-collapse: collapse !important;
                margin-bottom: 20px !important;
                border: 1px solid #D5DEE4 !important;
            }
            .gr-table2 {
                page-break-before: avoid !important;
                margin-top: 45px !important;
            }
            .gr-table th, .gr-table td {
                padding:7.5px 8px !important;
                text-align: left !important;
            }
            .gr-pillars {
                page-break-inside: avoid !important;
                margin-bottom: 20px !important;
                padding: 10px !important;
            }
            .gr-pillar-grid {
                display: flex !important;
                gap: 20px !important;
            }
            .gr-pillar {
                flex: 1 !important;
            }
            .gr-footer {
                margin-top: 5px !important;
                text-align: center !important;
                font-size: 9px !important;
                color: #6B7F8E !important;
                padding-top: 8px !important;
                padding-bottom: 2px !important;
                border-top: 1px solid #D5DEE4 !important;
            }
            .pdf-header {
                margin-bottom: 20px !important;
            }
            .pdf-logo img {
                max-height: 50px;
                width: auto;
            }
            .pdf-contact a {
                color: #213C4B;
                text-decoration: none;
            }
            html, body, #wrapper, #main, .newblock, .container {
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }
            .container {
                width: 100% !important;
                max-width: none !important;
                padding: 0 !important;
            }
        `;
        clone.prepend(style);
        clone.classList.add('pdf-export-container');
        
        // Create a temporary container
        const container = document.createElement('div');
        container.style.position = 'absolute';
        container.style.left = '-9999px';
        container.style.top = '0';
        container.style.width = '800px';
        container.style.background = 'white';
        container.style.margin = '0';
        container.style.padding = '0';
        container.appendChild(clone);
        document.body.appendChild(container);
        
        // Wait for rendering
        await new Promise(resolve => setTimeout(resolve, 500));
        
        // Capture with html2canvas
        const canvas = await html2canvas(clone, {
            scale: 2,
            useCORS: true,
            logging: false,
            backgroundColor: '#ffffff',
            windowWidth: clone.scrollWidth,
            windowHeight: clone.scrollHeight,
            allowTaint: false
        });
        
        // Clean up temporary container
        document.body.removeChild(container);
        
        // Create PDF
        const { jsPDF } = window.jspdf;
        const imgData = canvas.toDataURL('image/jpeg', 1.0);
        
        // Calculate dimensions to fit A4
        const imgWidth = 200; // mm
        const pageHeight = 287; // mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        
        let pdf = new jsPDF({
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait'
        });
        
        let position = 0;
        let heightLeft = imgHeight;
        
        // Add first page
        pdf.addImage(imgData, 'JPEG', 5, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;
        
        // Add additional pages if needed
        while (heightLeft > 0) {
            position = position - pageHeight;
            pdf.addPage();
            pdf.addImage(imgData, 'JPEG', 5, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }
        
        // Get total page count
        const pageCount = pdf.internal.getNumberOfPages();
        
        // Add clickable button on the LAST page only
        if (pageCount > 0) {
            pdf.setPage(pageCount);
            
            // Get page dimensions
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeightPdf = pdf.internal.pageSize.getHeight();
            
            // Button text
            const buttonText = 'Book a Discovery meeting with GenRocket';
            
            // Set font for measurement
            pdf.setFontSize(9);
            pdf.setFont('helvetica', 'bold');
            const textWidth = pdf.getTextWidth(buttonText);
            
            // Button padding - OPTIMIZED
            const paddingX = 10;
            const paddingY = 3;
            
            // Button dimensions
            const buttonWidth = textWidth + (paddingX * 2);
            const buttonHeight = 13 + (paddingY * 1);
            
            // Position at bottom center
            const x = (pageWidth - buttonWidth) / 2;
            const y = pageHeightPdf - 86; // 16mm from bottom
            
            // === DRAW GREEN BACKGROUND ===
            pdf.setFillColor(36, 172, 227); // GenRocket green
            pdf.rect(x, y, buttonWidth, buttonHeight, 'F');
            
            // === DRAW BORDER (subtle) ===
            pdf.setDrawColor(36, 172, 227);
            pdf.setLineWidth(0.2);
            pdf.rect(x, y, buttonWidth, buttonHeight, 'S');
            
            // === DRAW WHITE TEXT ===
            pdf.setTextColor(255, 255, 255);
            pdf.setFontSize(9);
            pdf.setFont('helvetica', 'bold');
            
            // Center the text inside the button
            const textX = x + (buttonWidth - textWidth) / 2;
            const textY = y + paddingY + 6.5;
            
            pdf.text(buttonText, textX, textY);
            
            // === MAKE THE ENTIRE BUTTON CLICKABLE ===
            pdf.link(x, y, buttonWidth, buttonHeight, {
                url: 'https://www.genrocket.com/replace-legacy-tdm-platforms/'
            });
        }
        
        // Return as Blob
        return pdf.output('blob');
        
    } catch (error) {
        console.error('Error generating PDF:', error);
        throw error;
    }
}

// PDF Generation function for direct download
async function generatePDF() {
    const btn = document.getElementById('exportPdfBtn');
    if (!btn) return;
    
    const originalText = btn.innerHTML;
    btn.innerHTML = 'Generating PDF...';
    btn.disabled = true;
    
    try {
        showLoadingOverlay('Generating PDF, please wait...');
        
        const pdfBlob = await generatePDFAsBlob();
        const pdfUrl = URL.createObjectURL(pdfBlob);
        
        // Save PDF
        const companyName = document.getElementById('wpforms-11933-field_3')?.value || 'Report';
        const link = document.createElement('a');
        link.href = pdfUrl;
        link.download = `GenRocket_ROI_Report_${companyName.replace(/[^a-zA-Z0-9]/g, '_')}.pdf`;
        link.click();
        
        setTimeout(() => URL.revokeObjectURL(pdfUrl), 100);
        
        hideLoadingOverlay();
        
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to generate report. Please try again.');
        hideLoadingOverlay();
    } finally {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
}

// Loading overlay functions
function showLoadingOverlay(message) {
    let overlay = document.getElementById('pdfLoadingOverlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'pdfLoadingOverlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            font-family: Arial, sans-serif;
        `;
        overlay.innerHTML = `
            <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; color: #213C4B;">
                <div style="font-size: 40px; margin-bottom: 20px;">⏳</div>
                <div id="loadingMessage" style="font-size: 16px; margin-bottom: 15px;">${message}</div>
                <div style="width: 200px; height: 4px; background: #E9F0F3; border-radius: 2px; overflow: hidden;">
                    <div style="width: 0%; height: 100%; background: #a6d540; border-radius: 2px; animation: loadingProgress 2s ease-in-out infinite;"></div>
                </div>
            </div>
            <style>
                @keyframes loadingProgress {
                    0% { width: 0%; }
                    50% { width: 100%; }
                    100% { width: 0%; }
                }
            </style>
        `;
        document.body.appendChild(overlay);
    }
    const msgDiv = document.getElementById('loadingMessage');
    if (msgDiv) msgDiv.textContent = message;
    overlay.style.display = 'flex';
}

function hideLoadingOverlay() {
    const overlay = document.getElementById('pdfLoadingOverlay');
    if (overlay) {
        overlay.style.display = 'none';
    }
}

// Modal handling
function openLeadModal() { 
    const modal = document.getElementById('leadModal');
    if (modal) {
        // Clear form fields
        const nameField = document.getElementById('wpforms-11933-field_1');
        const emailField = document.getElementById('wpforms-11933-field_2');
        const companyField = document.getElementById('wpforms-11933-field_3');
        const roleField = document.getElementById('wpforms-11933-field_4');
        if (nameField) nameField.value = '';
        if (emailField) emailField.value = '';
        if (companyField) companyField.value = '';
        if (roleField) roleField.value = '';
        
        // Clear any previous error messages
        const errorDiv = document.getElementById('modalError');
        if (errorDiv) errorDiv.style.display = 'none';
        
        modal.style.display = 'flex';
        modal.classList.add('active');
    }
}

function closeLeadModal() { 
    const modal = document.getElementById('leadModal');
    if (modal) {
        modal.style.display = 'none';
        modal.classList.add('active');
    }
}

// Form submission handling
function showModalError(message) {
    const errorDiv = document.getElementById('modalError');
    if (errorDiv) {
        errorDiv.innerHTML = message;
        errorDiv.style.display = 'block';
        setTimeout(function() {
            errorDiv.style.display = 'none';
        }, 3000);
    } else {
        alert(message);
    }
}

// Form submission handling
// Handle form submission
// Handle form submission
async function handleLeadFormSubmit(e) {
    e.preventDefault();
    
    const name = document.getElementById('wpforms-11933-field_1')?.value?.trim() || '';
    const email = document.getElementById('wpforms-11933-field_2')?.value?.trim() || '';
    const company = document.getElementById('wpforms-11933-field_3')?.value?.trim() || '';
    const role = document.getElementById('wpforms-11933-field_4')?.value || '';
    
    if (!name || !email || !company || !role) {
        alert('Please fill in all fields.');
        return false;
    }
    
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }
    
    showLoadingOverlay('Generating your TDM Cost Report...');
    
    try {
        // Generate PDF as Blob
        const pdfBlob = await generatePDFAsBlob();
        const pdfFile = new File([pdfBlob], `roi_${company.replace(/[^a-zA-Z0-9]/g, '_')}.pdf`, { type: 'application/pdf' });
        
        // Upload PDF via AJAX
        const formData = new FormData();
        formData.append('action', 'upload_roi_pdf');
        formData.append('roi_pdf', pdfFile);
        formData.append('company', company);
        formData.append('email', email);
        formData.append('name', name);
        formData.append('role', role);
        
        const ajaxurl = window.grPdfAjax?.ajaxurl || '/wp-admin/admin-ajax.php';
        
        const response = await fetch(ajaxurl, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (!result.success) {
            throw new Error(result.data || 'Failed to upload PDF');
        }
        
        hideLoadingOverlay();
        closeLeadModal();
        
        // Download the PDF
        const link = document.createElement('a');
        link.href = result.data.pdf_url;
        link.download = `GenRocket_ROI_Report_${company.replace(/[^a-zA-Z0-9]/g, '_')}.pdf`;
        link.click();
        
        // Use AJAX to submit the form data WITHOUT redirecting
        // This prevents the page from reloading and the POST resubmission warning
        const wpForm = document.getElementById('wpforms-form-11933');
        if (wpForm) {
            // Submit form data via AJAX instead of traditional POST
            const formDataAjax = new FormData(wpForm);
            formDataAjax.append('action', 'submit_wpforms_ajax');
            
            try {
                await fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: formDataAjax
                });
                
                // Show success message
                showSuccessMessage('Thank you! Your report has been generated.');
                
            } catch (error) {
                console.error('Form submission error:', error);
                // Don't redirect - just log the error
            }
        }
        
        // Remove the form submit handler to prevent default submission
        if (wpForm) {
            wpForm.removeEventListener('submit', handleLeadFormSubmit);
            // We don't call wpForm.submit() here to avoid page reload
        }
        
    } catch (error) {
        console.error('Error:', error);
        hideLoadingOverlay();
        alert('Failed to generate report: ' + error.message + '. Please try again.');
    }
    
    return false;
}

// Export button handler - ALWAYS show modal, never bypass
function setupExportButton() {
    const exportBtn = document.getElementById('exportPdfBtn');
    if (exportBtn) {
        // Remove existing listeners
        const newBtn = exportBtn.cloneNode(true);
        exportBtn.parentNode.replaceChild(newBtn, exportBtn);
        
        newBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            // Always show the lead capture modal
            openLeadModal();
        });
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize calculator
    recalc();
    
    // Setup export button
    setupExportButton();
    
    // Currency input formatting
   // Currency input formatting with auto-commas as user types
document.querySelectorAll('.currency-input').forEach(input => {
    // Format on blur (final cleanup)
    input.addEventListener('blur', function() {
        // Remove any existing commas and get the raw number
        const raw = this.value.replace(/,/g, '');
        const num = parseFloat(raw);
        if (!isNaN(num) && num >= 0) {
            this.value = formatCurrency(num);
        } else if (this.value.trim() === '') {
            this.value = '0';
        }
        recalc();
    });
    
    // Auto-format as user types
    input.addEventListener('input', function(e) {
        // Get cursor position
        const start = this.selectionStart;
        const end = this.selectionEnd;
        
        // Get the raw value (remove all non-numeric characters except decimal)
        const raw = this.value.replace(/[^0-9.]/g, '');
        
        // If there's a decimal, handle it properly
        const parts = raw.split('.');
        let integerPart = parts[0] || '0';
        const decimalPart = parts.length > 1 ? '.' + parts[1] : '';
        
        // Remove leading zeros (but keep single zero)
        if (integerPart.length > 1 && integerPart.startsWith('0')) {
            integerPart = integerPart.replace(/^0+/, '');
            if (integerPart === '') integerPart = '0';
        }
        
        // Format with commas
        const formatted = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + decimalPart;
        
        // Only update if value changed
        if (formatted !== this.value) {
            // Calculate new cursor position
            const oldLength = this.value.length;
            const newLength = formatted.length;
            const diff = newLength - oldLength;
            
            this.value = formatted;
            
            // Adjust cursor position
            const newPos = start + diff;
            this.setSelectionRange(newPos, newPos);
        }
        
        // Trigger recalc for real-time updates
        recalc();
    });
    
    // Handle paste events
    input.addEventListener('paste', function(e) {
        e.preventDefault();
        const pasted = (e.clipboardData || window.clipboardData).getData('text');
        const numericOnly = pasted.replace(/[^0-9.]/g, '');
        this.value = numericOnly;
        // Trigger input event to format
        this.dispatchEvent(new Event('input'));
        recalc();
    });
    
    // Handle focus - select all text for easy typing
    input.addEventListener('focus', function() {
        this.select();
    });
});

    
    // Percentage input formatting
    document.querySelectorAll('.percent-input').forEach(input => {
        input.addEventListener('blur', function() {
            formatPercentInput(this);
            recalc();
        });
        
        input.addEventListener('input', function(e) {
            // Store cursor position
            const start = this.selectionStart;
            const end = this.selectionEnd;
            
            // Remove non-numeric characters except decimal
            const numericOnly = this.value.replace(/[^0-9.]/g, '');
            
            // If value changed, update
            if (numericOnly !== this.value) {
                this.value = numericOnly;
                this.setSelectionRange(start - 1, end - 1);
            }
            
            recalc();
        });
    });
    
    // Find the WPForms form and attach submit handler
    const wpForm = document.getElementById('wpforms-form-11933');
    if (wpForm) {
        // Remove all existing submit handlers
        const newForm = wpForm.cloneNode(true);
        wpForm.parentNode.replaceChild(newForm, wpForm);
        
        // Attach our handler
        newForm.addEventListener('submit', handleLeadFormSubmit);
        
        // Disable WPForms AJAX submission
        newForm.setAttribute('data-ajax', 'false');
    }
    
    // Close modal when clicking outside
    const modal = document.getElementById('leadModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLeadModal();
            }
        });
    }
    
    console.log('Calculator initialized');
});

// Make functions global
window.resetInputs = resetInputs;
window.closeLeadModal = closeLeadModal;
window.openLeadModal = openLeadModal;
window.generatePDF = generatePDF;
</script>
<?php get_footer(); ?>
