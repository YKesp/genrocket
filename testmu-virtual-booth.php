<?php
/**
 * Template Name: TestMu Virtual Booth
 * Description: GenRocket Virtual Booth page for TestMu AI 2026 with WPForms lead capture & Google Sheets integration
 */

// Filter WPForms confirmation message to include PDF download button
add_filter('wpforms_frontend_confirmation_message', function($confirmation, $form_data, $fields, $entry_id) {
    $pdf_url = 'https://www.genrocket.com/wp-content/uploads/2026/09/GenRocket-TestMu-AI.pdf';
    
    $clean_msg = trim(strip_tags($confirmation));
    if (empty($clean_msg)) {
        $clean_msg = 'Thanks for stopping by our booth! Your information has been received.';
    }

    $download_html = '<div class="tm-confirmation-box">';
    $download_html .= '<div class="tm-success-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>';
    $download_html .= '<h3 class="tm-confirm-title">Thank You!</h3>';
    $download_html .= '<p class="tm-confirm-msg">' . esc_html($clean_msg) . '</p>';
    $download_html .= '<div class="tm-download-card">';
    $download_html .= '  <div class="tm-download-info">';
    $download_html .= '    <svg class="tm-pdf-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>';
    $download_html .= '    <div>';
    $download_html .= '      <span class="tm-download-title">Your GenRocket Guide</span>';
    $download_html .= '      <span class="tm-download-sub">PDF Document</span>';
    $download_html .= '    </div>';
    $download_html .= '  </div>';
    $download_html .= '  <a href="' . esc_url($pdf_url) . '" class="tm-download-btn" target="_blank" download="GenRocket-TestMu-AI.pdf">';
    $download_html .= '    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>';
    $download_html .= '    Download PDF';
    $download_html .= '  </a>';
    $download_html .= '</div>';
    $download_html .= '</div>';

    return $download_html;
}, 10, 4);

get_header();
?>

<style>
  :root {
    --tm-navy: #1c3d4c;
    --tm-navy-dark: #152e3a;
    --tm-cyan: #00b0f0;
    --tm-cyan-light: #e8f7fc;
    --tm-lime: #A6D540;
    --tm-bg: #edf4f8;
    --tm-card-bg: #ffffff;
    --tm-border: #d4e2eb;
    --tm-text: #1c3d4c;
    --tm-muted: #8fa6b5;
    --tm-subtext: #597382;
  }

  body {
    background-color: var(--tm-bg) !important;
  }

  .virtual-booth-wrapper {
    background-color: var(--tm-bg);
    min-height: 90vh;
    padding: 30px 15px 70px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    color: var(--tm-text);
    -webkit-font-smoothing: antialiased;
  }

  .virtual-booth-container {
    width: 100%;
    max-width: 560px;
    margin: 0 auto;
  }

  /* Top Logo */
  .virtual-booth-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    gap: 10px;
    text-decoration: none;
  }
  .virtual-booth-brand svg {
    width: 34px;
    height: 34px;
  }
  .virtual-booth-brand-title {
    font-size: 26px;
    font-weight: 900;
    letter-spacing: -0.5px;
    line-height: 1;
  }
  .virtual-booth-brand-title .gen { color: #00b0f0; }
  .virtual-booth-brand-title .rocket { color: #95c11f; }

  /* Hero Header Card (Dark Slate Navy with bottom-right curved swoop) */
  .virtual-booth-hero {
    background-color: var(--tm-navy);
    border-radius: 18px 18px 56px 18px;
    padding: 32px 28px 36px;
    color: #ffffff;
    box-shadow: 0 10px 30px rgba(28, 61, 76, 0.15);
    margin-bottom: 18px;
  }

  .virtual-booth-hero-kicker {
    color: #27bff0;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.2px;
    margin-bottom: 10px;
  }

  .virtual-booth-hero-title {
    font-size: 32px;
    font-weight: 800;
    line-height: 1.15;
    color: #ffffff;
    margin: 0 0 14px 0;
  }

  .virtual-booth-hero-desc {
    color: #cbdde7;
    font-size: 14.5px;
    line-height: 1.55;
    margin: 0;
    font-weight: 400;
  }

  /* Main Form Container Card (White) */
  .virtual-booth-form-card {
    background-color: var(--tm-card-bg);
    border-radius: 18px;
    border: 1px solid var(--tm-border);
    padding: 32px 28px;
    box-shadow: 0 6px 24px rgba(28, 61, 76, 0.06);
  }

  /* Section Headings */
  .virtual-booth-section-title,
  .virtual-booth-form-card .wpforms-field-divider,
  .virtual-booth-form-card .wpforms-field-section_divider {
    font-size: 14.5px !important;
    font-weight: 800 !important;
    color: var(--tm-navy) !important;
    margin-top: 26px !important;
    margin-bottom: 14px !important;
    display: flex !important;
    align-items: center !important;
    border: none !important;
    padding: 0 !important;
    width: 100% !important;
  }

  .virtual-booth-section-title.tm-sec-about {
    margin-top: 0 !important;
  }

  .virtual-booth-section-title .badge-num,
  .virtual-booth-form-card .wpforms-field-divider .badge-num {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background-color: var(--tm-cyan);
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 8px;
    flex-shrink: 0;
  }

  .virtual-booth-section-title .divider-line,
  .virtual-booth-form-card .wpforms-field-divider .divider-line {
    flex: 1;
    height: 1px;
    background-color: #dce7ee;
    margin-left: 12px;
  }

  /* WPForms Global Container Adjustments */
  .virtual-booth-form-card .wpforms-container {
    margin: 0 !important;
  }
  .virtual-booth-form-card .wpforms-field-container {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }
  .virtual-booth-form-card .wpforms-field {
    padding: 0 !important;
    margin: 0 !important;
    clear: both;
  }

  /* Two Column Grid */
  .virtual-booth-form-card .wpforms-field-row,
  .tm-two-col-row {
    display: flex !important;
    gap: 14px !important;
    width: 100% !important;
  }
  .virtual-booth-form-card .wpforms-one-half,
  .virtual-booth-form-card .wpforms-field-row .wpforms-field-row-column,
  .tm-two-col-row > .wpforms-field {
    flex: 1 !important;
    min-width: 0 !important;
  }

  /* Form Labels */
  .virtual-booth-form-card label.wpforms-field-label {
    display: block !important;
    font-size: 13.5px !important;
    font-weight: 700 !important;
    color: var(--tm-navy) !important;
    margin-bottom: 6px !important;
    line-height: 1.3 !important;
  }
  .virtual-booth-form-card label.wpforms-field-label .wpforms-required-label {
    color: var(--tm-navy) !important;
    font-weight: 800 !important;
    margin-left: 3px !important;
  }
  .virtual-booth-form-card .wpforms-field-sublabel,
  .virtual-booth-form-card .wpforms-field-description {
    font-size: 12px !important;
    color: var(--tm-muted) !important;
    margin-top: 3px !important;
    margin-bottom: 8px !important;
    display: block !important;
    font-weight: 400 !important;
  }

  /* Text Inputs, Selects & Textareas */
  .virtual-booth-form-card input[type="text"],
  .virtual-booth-form-card input[type="email"],
  .virtual-booth-form-card input[type="tel"],
  .virtual-booth-form-card input[type="url"],
  .virtual-booth-form-card input[type="number"],
  .virtual-booth-form-card select,
  .virtual-booth-form-card textarea {
    width: 100% !important;
    background: #ffffff !important;
    border: 1.5px solid var(--tm-border) !important;
    border-radius: 10px !important;
    color: var(--tm-navy) !important;
    font-size: 14.5px !important;
    font-family: inherit !important;
    padding: 11px 14px !important;
    outline: none !important;
    transition: all 0.2s ease !important;
    box-sizing: border-box !important;
    box-shadow: none !important;
  }

  .virtual-booth-form-card input::placeholder,
  .virtual-booth-form-card textarea::placeholder {
    color: #9ab2c0 !important;
  }

  .virtual-booth-form-card input:focus,
  .virtual-booth-form-card select:focus,
  .virtual-booth-form-card textarea:focus {
    border-color: var(--tm-cyan) !important;
    box-shadow: 0 0 0 3px rgba(0, 176, 240, 0.15) !important;
    background: #ffffff !important;
  }

  .virtual-booth-form-card select {
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238fa6b5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    background-size: 16px !important;
    padding-right: 38px !important;
    cursor: pointer;
  }

  /* ----------------------------------------------------
     1. RATING 1 - 5 BUTTONS (Horizontal Connected Grid)
     ---------------------------------------------------- */
  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul,
  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul.wpforms-field-radio,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul {
    display: flex !important;
    flex-direction: row !important;
    gap: 8px !important;
    width: 100% !important;
    margin: 8px 0 0 !important;
    padding: 0 !important;
    list-style: none !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li {
    flex: 1 !important;
    margin: 0 !important;
    padding: 0 !important;
    display: flex !important;
    list-style: none !important;
    position: relative !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li input[type="radio"],
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li input[type="radio"] {
    position: absolute !important;
    opacity: 0 !important;
    width: 0 !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    pointer-events: none !important;
    visibility: hidden !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li label,
  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li label.wpforms-field-label-inline,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li label {
    display: flex !important;
    width: 100% !important;
    height: 44px !important;
    align-items: center !important;
    justify-content: center !important;
    border: 1.5px solid var(--tm-border) !important;
    border-radius: 8px !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    color: var(--tm-navy) !important;
    background: #ffffff !important;
    cursor: pointer !important;
    transition: all 0.15s ease !important;
    margin: 0 !important;
    padding: 0 !important;
    user-select: none !important;
    text-align: center !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li:hover label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li:hover label {
    border-color: var(--tm-cyan) !important;
    background: var(--tm-cyan-light) !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li.is-checked label,
  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li:has(input:checked) label,
  .virtual-booth-wrapper .virtual-booth-form-card .tm-rating-field ul li input:checked + label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li.is-checked label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li:has(input:checked) label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-rating="true"] ul li input:checked + label {
    background: #00b0f0 !important;
    background-color: #00b0f0 !important;
    border-color: #00b0f0 !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(0, 176, 240, 0.3) !important;
  }

  .tm-rating-sublabels {
    display: flex !important;
    justify-content: space-between !important;
    font-size: 11.5px !important;
    color: var(--tm-muted) !important;
    margin-top: 6px !important;
    padding: 0 2px !important;
    width: 100% !important;
  }

  /* ----------------------------------------------------
     2. PILL-STYLE CHECKBOXES & RADIO BUTTONS (Oval Badges)
     ---------------------------------------------------- */
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
    list-style: none !important;
    padding: 0 !important;
    margin: 6px 0 0 !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li {
    display: inline-flex !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    position: relative !important;
    list-style: none !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li input[type="checkbox"],
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li input[type="radio"],
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li input {
    position: absolute !important;
    opacity: 0 !important;
    width: 0 !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    pointer-events: none !important;
    visibility: hidden !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li label.wpforms-field-label-inline,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li label.wpforms-field-label-inline,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li label {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 8px 18px !important;
    background: #ffffff !important;
    border: 1.5px solid var(--tm-border) !important;
    border-radius: 100px !important;
    color: var(--tm-navy) !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: all 0.15s ease !important;
    margin: 0 !important;
    user-select: none !important;
    line-height: 1.3 !important;
    text-align: center !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li:hover label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li:hover label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li:hover label {
    border-color: var(--tm-cyan) !important;
    background: #f4fbfe !important;
  }

  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li.is-checked label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li:has(input:checked) label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-checkbox ul li input:checked + label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li.is-checked label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li:has(input:checked) label,
  .virtual-booth-wrapper .virtual-booth-form-card .wpforms-field-radio:not(.tm-rating-field) ul li input:checked + label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li.is-checked label,
  .virtual-booth-wrapper .virtual-booth-form-card [data-is-pills="true"] ul li:has(input:checked) label {
    border-color: var(--tm-cyan) !important;
    background-color: var(--tm-cyan-light) !important;
    color: #007799 !important;
    font-weight: 600 !important;
    box-shadow: 0 0 0 1px var(--tm-cyan) !important;
  }

  /* ----------------------------------------------------
     3. SUBMIT BUTTON & CONFIRMATION
     ---------------------------------------------------- */
  .virtual-booth-form-card .wpforms-submit-container {
    padding: 0 !important;
    margin-top: 26px !important;
  }

  .virtual-booth-form-card button[type="submit"],
  .virtual-booth-form-card .wpforms-submit {
    display: block !important;
    width: 100% !important;
    border: none !important;
    cursor: pointer !important;
    font-family: inherit !important;
    background-color: var(--tm-navy) !important;
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 800 !important;
    padding: 15px 20px !important;
    border-radius: 10px !important;
    box-shadow: 0 4px 14px rgba(28, 61, 76, 0.2) !important;
    transition: all 0.2s ease !important;
    text-align: center !important;
  }

  .virtual-booth-form-card button[type="submit"]:hover,
  .virtual-booth-form-card .wpforms-submit:hover {
    background-color: var(--tm-navy-dark) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 18px rgba(28, 61, 76, 0.28) !important;
  }

  .virtual-booth-form-card button[type="submit"]:active,
  .virtual-booth-form-card .wpforms-submit:active {
    transform: translateY(1px) !important;
  }

  /* Form Disclaimer Note */
  .virtual-booth-form-disclaimer {
    text-align: center;
    font-size: 11.5px;
    color: var(--tm-muted);
    margin-top: 12px;
    line-height: 1.4;
  }

  /* Confirmation Message Box & PDF Download Card */
  .virtual-booth-form-card .wpforms-confirmation-container-full,
  .virtual-booth-form-card .wpforms-confirmation-container,
  .virtual-booth-form-card .tm-confirmation-box {
    background: #ffffff !important;
    border: 1.5px solid #bce2ca !important;
    border-radius: 16px !important;
    padding: 32px 24px !important;
    color: var(--tm-navy) !important;
    text-align: center !important;
    box-shadow: 0 8px 24px rgba(34, 197, 94, 0.08) !important;
    animation: tmFadeInUp 0.4s ease-out forwards;
  }

  @keyframes tmFadeInUp {
    from {
      opacity: 0;
      transform: translateY(12px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .tm-success-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #ecfdf5;
    border: 2px solid #a7f3d0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px auto;
    color: #10b981;
  }

  .tm-confirm-title {
    font-size: 24px !important;
    font-weight: 800 !important;
    color: var(--tm-navy) !important;
    margin: 0 0 8px 0 !important;
  }

  .tm-confirm-msg {
    font-size: 15px !important;
    line-height: 1.55 !important;
    color: var(--tm-subtext) !important;
    margin: 0 0 20px 0 !important;
  }

  .tm-download-card {
    background: #f8fbfd;
    border: 1.5px solid #d4e5f0;
    border-radius: 12px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    text-align: left;
    margin-top: 14px;
    transition: all 0.2s ease;
  }

  .tm-download-card:hover {
    border-color: var(--tm-cyan);
    background: #f0f9fd;
    box-shadow: 0 4px 16px rgba(0, 176, 240, 0.1);
  }

  .tm-download-info {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
  }

  .tm-pdf-icon {
    width: 38px;
    height: 38px;
    background: #ffebee;
    color: #e53935;
    border-radius: 8px;
    padding: 7px;
    flex-shrink: 0;
  }

  .tm-download-title {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--tm-navy);
    display: block;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .tm-download-sub {
    font-size: 12px;
    color: var(--tm-muted);
    display: block;
    margin-top: 2px;
  }

  .tm-download-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background-color: var(--tm-navy);
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none !important;
    flex-shrink: 0;
    transition: all 0.2s ease;
    box-shadow: 0 3px 10px rgba(28, 61, 76, 0.15);
  }

  .tm-download-btn:hover {
    background-color: var(--tm-cyan);
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 176, 240, 0.3);
  }

  .tm-download-btn svg {
    width: 16px;
    height: 16px;
  }

  @media (max-width: 520px) {
    .tm-download-card {
      flex-direction: column;
      align-items: stretch;
      text-align: center;
    }
    .tm-download-info {
      flex-direction: column;
      text-align: center;
    }
    .tm-download-btn {
      width: 100%;
    }
  }

  /* Error messages */
  .virtual-booth-form-card em.wpforms-error,
  .virtual-booth-form-card label.wpforms-error {
    color: #e63946 !important;
    font-size: 12px !important;
    margin-top: 5px !important;
    display: block !important;
  }

  /* Footer */
  .virtual-booth-footer {
    margin-top: 24px;
    text-align: center;
    color: var(--tm-muted);
    font-size: 12.5px;
    line-height: 1.5;
  }
  .virtual-booth-footer a {
    color: var(--tm-cyan);
    text-decoration: none;
    font-weight: 700;
  }
  .virtual-booth-footer a:hover {
    text-decoration: underline;
  }

  @media (max-width: 580px) {
    .virtual-booth-hero {
      padding: 26px 20px 30px;
      border-radius: 16px 16px 44px 16px;
    }
    .virtual-booth-hero-title {
      font-size: 26px;
    }
    .virtual-booth-form-card {
      padding: 24px 18px;
    }
  }
</style>

<div class="virtual-booth-wrapper">
  <div class="virtual-booth-container">
    
    <!-- Top GenRocket Brand Logo -->
    <a href="https://www.genrocket.com" class="virtual-booth-brand" target="_blank" rel="noopener">
  <img src="https://www.genrocket.com/wp-content/themes/genrocket/assets/images/GenRocket-logo.svg" alt="GenRocket logo" class="virtual-booth-logo" width="200" />
</a>

    <!-- Dark Slate Navy Hero Card -->
    <div class="virtual-booth-hero">
      <div class="virtual-booth-hero-kicker">TestMu AI Conference 2026 · Virtual booth</div>
      <h1 class="virtual-booth-hero-title">How did we do?</h1>
      <p class="virtual-booth-hero-desc">Thanks again for stopping by. A minute of your time helps us send you resources that actually fit your work — and skip the ones that don't.</p>
    </div>

    <!-- White Form Card -->
    <div class="virtual-booth-form-card">
      <?php echo do_shortcode('[wpforms id="12839" title="false"]'); ?>
      <div class="virtual-booth-form-disclaimer">Takes about a minute. We'll only use this to follow up and send relevant resources.</div>
    </div>

    <!-- Clean Footer -->
    <div class="virtual-booth-footer">
      © <?php echo date('Y'); ?> GenRocket, Inc. · <a href="https://www.genrocket.com" target="_blank" rel="noopener">genrocket.com</a>
    </div>

  </div>
</div>

<script>
  (function() {
    var PDF_DOWNLOAD_URL = 'https://www.genrocket.com/wp-content/uploads/2026/09/GenRocket-TestMu-AI.pdf';

    function ensureConfirmationDownload() {
      var card = document.querySelector('.virtual-booth-form-card');
      if (!card) return;

      var confirmation = card.querySelector('.wpforms-confirmation-container, .wpforms-confirmation-container-full');
      if (confirmation) {
        var disclaimer = card.querySelector('.virtual-booth-form-disclaimer');
        if (disclaimer) disclaimer.style.display = 'none';

        if (!confirmation.querySelector('.tm-download-card')) {
          var cardHtml = '<div class="tm-download-card">' +
            '<div class="tm-download-info">' +
              '<svg class="tm-pdf-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>' +
              '<div>' +
                '<span class="tm-download-title">Your GenRocket Guide</span>' +
                '<span class="tm-download-sub">PDF Document</span>' +
              '</div>' +
            '</div>' +
            '<a href="' + PDF_DOWNLOAD_URL + '" class="tm-download-btn" target="_blank" download="GenRocket-TestMu-AI.pdf">' +
              '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>' +
              'Download PDF' +
            '</a>' +
          '</div>';

          if (!confirmation.querySelector('.tm-success-icon')) {
            var origText = confirmation.innerHTML.trim();
            confirmation.innerHTML = '<div class="tm-confirmation-box">' +
              '<div class="tm-success-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>' +
              '<h3 class="tm-confirm-title">Thank You!</h3>' +
              '<p class="tm-confirm-msg">' + (origText || 'Thanks for stopping by our booth! Your information has been received.') + '</p>' +
              cardHtml +
            '</div>';
          } else {
            confirmation.insertAdjacentHTML('beforeend', cardHtml);
          }
        }
      }
    }

    function initBoothEnhancements() {
      ensureConfirmationDownload();

      var form = document.querySelector('.virtual-booth-form-card form');
      if (!form) return;

      // 1. Identify and setup fields
      var fields = form.querySelectorAll('.wpforms-field');
      fields.forEach(function(field) {
        var labelEl = field.querySelector('.wpforms-field-label');
        var labelText = labelEl ? labelEl.textContent.trim().toLowerCase() : '';
        var radioItems = field.querySelectorAll('ul.wpforms-field-radio li, .wpforms-field-radio li');
        
        // Rating Scale (1 to 5)
        var isRatingScale = false;
        if (radioItems.length === 5) {
          var vals = [];
          radioItems.forEach(function(li) {
            vals.push(li.textContent.trim());
          });
          if (vals.join('') === '12345' || labelText.indexOf('rate') !== -1 || labelText.indexOf('booth') !== -1) {
            isRatingScale = true;
          }
        }

        if (isRatingScale || field.classList.contains('wpforms-field-rating') || field.classList.contains('wpforms-field-net_promoter_score')) {
          field.classList.add('tm-rating-field');
          field.setAttribute('data-is-rating', 'true');
          
          var ul = field.querySelector('ul.wpforms-field-radio, .wpforms-field-radio');
          if (ul && !field.querySelector('.tm-rating-sublabels')) {
            var sublabels = document.createElement('div');
            sublabels.className = 'tm-rating-sublabels';
            sublabels.innerHTML = '<span>Not great</span><span>Loved it</span>';
            ul.parentNode.insertBefore(sublabels, ul.nextSibling);
          }
        } else if (field.classList.contains('wpforms-field-radio')) {
          field.setAttribute('data-is-pills', 'true');
        } else if (field.classList.contains('wpforms-field-checkbox')) {
          field.setAttribute('data-is-pills', 'true');
        }
      });

      // 2. Setup Section Dividers
      // Remove any previously inserted duplicate tags to avoid double labels
      form.querySelectorAll('.tm-custom-divider').forEach(function(el) { el.remove(); });

      // "About you" header before the first input field
      var firstInput = form.querySelector('.wpforms-field-container > .wpforms-field');
      if (firstInput && !form.querySelector('.tm-sec-about')) {
        var secAbout = document.createElement('div');
        secAbout.className = 'virtual-booth-section-title tm-sec-about tm-custom-divider';
        secAbout.textContent = 'About you';
        firstInput.parentNode.insertBefore(secAbout, firstInput);
      }

      // "1 Your feedback" before the Rating field
      var ratingField = form.querySelector('.tm-rating-field, [data-is-rating="true"]');
      if (ratingField) {
        var secFeedback = document.createElement('div');
        secFeedback.className = 'virtual-booth-section-title has-divider tm-sec-feedback tm-custom-divider';
        secFeedback.innerHTML = '<span class="badge-num">1</span><span>Your feedback</span><span class="divider-line"></span>';
        ratingField.parentNode.insertBefore(secFeedback, ratingField);
      }

      // "2 Your context" before Region / Role / Partner field
      fields.forEach(function(field) {
        var label = (field.querySelector('.wpforms-field-label') ? field.querySelector('.wpforms-field-label').textContent : '').toLowerCase();
        if ((label.indexOf('region') !== -1 || label.indexOf('role') !== -1 || label.indexOf('customer') !== -1 || label.indexOf('context') !== -1) && !form.querySelector('.tm-sec-context')) {
          var secContext = document.createElement('div');
          secContext.className = 'virtual-booth-section-title has-divider tm-sec-context tm-custom-divider';
          secContext.innerHTML = '<span class="badge-num">2</span><span>Your context</span><span class="divider-line"></span>';
          field.parentNode.insertBefore(secContext, field);
        }
      });

      // Hide default WPForms section divider text if it overlaps
      form.querySelectorAll('.wpforms-field-divider, .wpforms-field-section_divider').forEach(function(div) {
        div.style.display = 'none';
      });

      // 3. Side-by-side 2-column layout for Name & Company
      var nameField = null;
      var companyField = null;
      fields.forEach(function(field) {
        var label = (field.querySelector('.wpforms-field-label') ? field.querySelector('.wpforms-field-label').textContent : '').toLowerCase();
        if (label.indexOf('name') !== -1 && label.indexOf('company') === -1 && !nameField) {
          nameField = field;
        }
        if (label.indexOf('company') !== -1 && !companyField) {
          companyField = field;
        }
      });

      if (nameField && companyField && nameField.nextElementSibling === companyField && !nameField.parentNode.classList.contains('tm-two-col-row')) {
        var row = document.createElement('div');
        row.className = 'tm-two-col-row';
        nameField.parentNode.insertBefore(row, nameField);
        row.appendChild(nameField);
        row.appendChild(companyField);
      }

      // 4. Bind click events to items to ensure active state class sync
      form.querySelectorAll('ul li, .wpforms-field-radio li, .wpforms-field-checkbox li').forEach(function(li) {
        var input = li.querySelector('input');
        if (!input) return;

        if (input.checked) {
          li.classList.add('is-checked');
        } else {
          li.classList.remove('is-checked');
        }

        li.addEventListener('click', function() {
          setTimeout(function() {
            var parentUl = li.closest('ul');
            if (parentUl) {
              parentUl.querySelectorAll('li').forEach(function(sibling) {
                var sibInput = sibling.querySelector('input');
                if (sibInput && sibInput.checked) {
                  sibling.classList.add('is-checked');
                } else {
                  sibling.classList.remove('is-checked');
                }
              });
            }
          }, 50);
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initBoothEnhancements);
    } else {
      initBoothEnhancements();
    }

    window.addEventListener('load', initBoothEnhancements);
    document.addEventListener('change', initBoothEnhancements);
    setTimeout(initBoothEnhancements, 500);
    setTimeout(initBoothEnhancements, 1500);

    // Watch for AJAX submissions / changes inside card
    var cardEl = document.querySelector('.virtual-booth-form-card');
    if (cardEl && window.MutationObserver) {
      var observer = new MutationObserver(function() {
        ensureConfirmationDownload();
      });
      observer.observe(cardEl, { childList: true, subtree: true });
    }

    // WPForms jQuery AJAX event hook
    if (typeof jQuery !== 'undefined') {
      jQuery(document).on('wpformsAjaxSubmitSuccess wpformsConfirmation', function() {
        setTimeout(ensureConfirmationDownload, 50);
        setTimeout(ensureConfirmationDownload, 300);
      });
    }
  })();
</script>

<?php get_footer(); ?>