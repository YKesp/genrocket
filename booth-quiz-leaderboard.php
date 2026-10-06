<?php
/**
 * Template Name: Booth Quiz Leaderboard
 * Description: Top 10 Leaderboard for the GenRocket Booth Challenge
 */

get_header();

// Fetch leaderboard entries from DB
global $wpdb;
$table_name = $wpdb->prefix . 'booth_quiz_leaderboard';
$entries = array();
$total_participants = 0;

$selected_top = isset($_GET['top']) ? sanitize_text_field($_GET['top']) : '10';
if (!in_array($selected_top, array('10', '20', '50', '100', 'all'))) {
    $selected_top = '10';
}

$limit_sql = ($selected_top === 'all') ? "" : " LIMIT " . intval($selected_top);
$display_title_count = ($selected_top === 'all') ? "All Participants" : "Top " . intval($selected_top);

if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
    $entries = $wpdb->get_results(
        "SELECT id, user_name, designation, company, score, total_questions, score_text, percentage, time_taken, created_at 
         FROM $table_name 
          ORDER BY score DESC, created_at DESC"
         . $limit_sql,
        ARRAY_A
    );
    $total_participants = (int)$wpdb->get_var("SELECT COUNT(*) FROM $table_name");
}

// Helper to format participant designation and company line
$format_participant_subtitle = function($item, $default = 'Participant') {
    if (!$item) return $default;
    $parts = array();
    if (!empty($item['designation'])) {
        $parts[] = $item['designation'];
    }
    if (!empty($item['company'])) {
        $parts[] = $item['company'];
    }
    return !empty($parts) ? implode(' · ', $parts) : $default;
};

$quiz_url = site_url('/booth-quiz/');
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
    --card: rgba(255, 255, 255, 0.05);
    --card-hover: rgba(255, 255, 255, 0.08);
    --line: rgba(39, 191, 240, 0.25);
    --gold: #FFD700;
    --silver: #E0E6ED;
    --bronze: #CD7F32;
  }

  .booth-lb-page {
    background: radial-gradient(1100px 750px at 80% -10%, #225a70 0%, var(--navy) 40%, var(--navy2) 75%, var(--navy3) 100%);
    background-attachment: fixed;
    min-height: 88vh;
    padding: 40px 16px 80px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    color: #ffffff;
    -webkit-font-smoothing: antialiased;
    box-sizing: border-box;
  }

  .booth-lb-container {
    max-width: 1080px;
    margin: 0 auto;
    width: 100%;
  }

  /* Header Section */
  .booth-lb-header {
    text-align: center;
    margin-bottom: 36px;
  }

  .booth-lb-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(39, 191, 240, 0.12);
    border: 1px solid rgba(39, 191, 240, 0.35);
    color: var(--cyan);
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 14px;
  }

  .booth-lb-pulse {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: var(--lime);
    box-shadow: 0 0 10px var(--lime);
  }

  .booth-lb-title {
    font-size: 44px;
    font-weight: 900;
    line-height: 1.15;
    margin: 0 0 10px;
    letter-spacing: -0.02em;
    color: #ffffff;
  }

  .booth-lb-title span {
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
  }

  .booth-lb-subtitle {
    color: #c0d8e3;
    font-size: 16px;
    max-width: 640px;
    margin: 0 auto;
    line-height: 1.55;
  }

  /* Toolbar */
  .booth-lb-toolbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    background: rgba(15, 32, 40, 0.65);
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 14px 22px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }

  .booth-lb-stats {
    display: flex;
    align-items: center;
    gap: 18px;
    font-size: 14px;
    color: var(--mute);
    flex-wrap: wrap;
  }

  .booth-lb-stats strong {
    color: #ffffff;
    font-size: 17px;
  }

  .booth-lb-filter {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: var(--mute);
  }

  .booth-top-dropdown {
    background: #152A36;
    color: #ffffff;
    border: 1.5px solid rgba(39, 191, 240, 0.45);
    border-radius: 100px;
    padding: 6px 16px;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    outline: none;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
  }

  .booth-top-dropdown:hover,
  .booth-top-dropdown:focus {
    border-color: var(--cyan);
    background: #1c3645;
    box-shadow: 0 0 14px rgba(39, 191, 240, 0.35);
  }

  .booth-top-dropdown option {
    background: #152A36;
    color: #ffffff;
  }

  .booth-lb-actions {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .booth-lb-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 100px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.25s ease;
    border: none;
  }

  .booth-lb-btn-primary {
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    color: #0c1a20 !important;
    box-shadow: 0 4px 16px rgba(39, 191, 240, 0.3);
  }

  .booth-lb-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(39, 191, 240, 0.45);
  }

  /* Top 3 Podium Cards */
  .booth-podium-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 32px;
    align-items: flex-end;
  }

  @media (max-width: 820px) {
    .booth-podium-grid {
      grid-template-columns: 1fr;
      align-items: stretch;
    }
  }

  .booth-podium-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 20px;
    padding: 26px 20px;
    text-align: center;
    position: relative;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: transform 0.3s ease, border-color 0.3s ease;
  }

  .booth-podium-card:hover {
    transform: translateY(-4px);
  }

  .booth-podium-rank-1 {
    order: 2;
    background: linear-gradient(180deg, rgba(255, 215, 0, 0.12) 0%, rgba(21, 42, 54, 0.8) 100%);
    border: 2px solid rgba(255, 215, 0, 0.6);
    padding-top: 36px;
    padding-bottom: 32px;
    box-shadow: 0 16px 40px rgba(255, 215, 0, 0.18);
  }

  @media (max-width: 820px) {
    .booth-podium-rank-1 { order: 1; }
  }

  .booth-podium-rank-2 {
    order: 1;
    border-color: rgba(224, 230, 237, 0.4);
  }

  .booth-podium-rank-3 {
    order: 3;
    border-color: rgba(205, 127, 50, 0.4);
  }

  .booth-podium-medal {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: 900;
  }

  .booth-podium-rank-1 .booth-podium-medal {
    width: 66px;
    height: 66px;
    font-size: 32px;
    background: radial-gradient(circle, #ffe259, #ffa751);
    color: #3b2800;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
  }

  .booth-podium-rank-2 .booth-podium-medal {
    background: radial-gradient(circle, #e0e6ed, #95a5a6);
    color: #1a252f;
    box-shadow: 0 0 14px rgba(224, 230, 237, 0.3);
  }

  .booth-podium-rank-3 .booth-podium-medal {
    background: radial-gradient(circle, #e67e22, #a0522d);
    color: #fff;
    box-shadow: 0 0 14px rgba(205, 127, 50, 0.3);
  }

  .booth-podium-name {
    font-size: 20px;
    line-height: 1.4;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .booth-podium-company {
    font-size: 13px;
    color: var(--mute);
    margin-bottom: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .booth-podium-score {
    font-size: 32px;
    font-weight: 900;
    color: var(--cyan);
    line-height: 1;
    margin-bottom: 4px;
  }

  .booth-podium-rank-1 .booth-podium-score {
    font-size: 38px;
    color: var(--lime);
  }

  .booth-podium-pct {
    font-size: 12px;
    font-weight: 700;
    color: #9bb9c6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Table Container */
  .booth-table-box {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 16px 40px rgba(15, 32, 40, 0.35);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
  }

  .booth-table-head {
    padding: 18px 24px;
    background: rgba(39, 191, 240, 0.08);
    border-bottom: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .booth-table-head h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 800;
    color: #ffffff;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .booth-lb-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }

  .booth-lb-table th {
    background: rgba(15, 32, 40, 0.6);
    color: var(--mute);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 14px 20px;
    font-weight: 700;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .booth-lb-table td {
    padding: 16px 20px;
    font-size: 15px;
    color: #e3f2f8;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    vertical-align: middle;
    transition: background 0.2s;
  }

  .booth-lb-table tr:hover td {
    background: var(--card-hover);
  }

  .booth-lb-table tr:last-child td {
    border-bottom: none;
  }

  .booth-rank-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-weight: 900;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
  }

  .booth-rank-1 { background: rgba(255, 215, 0, 0.2); color: var(--gold); border: 1px solid var(--gold); }
  .booth-rank-2 { background: rgba(224, 230, 237, 0.2); color: var(--silver); border: 1px solid var(--silver); }
  .booth-rank-3 { background: rgba(205, 127, 50, 0.2); color: var(--bronze); border: 1px solid var(--bronze); }

  .booth-user-cell {
    display: flex;
    flex-direction: column;
  }

  .booth-user-name {
    font-weight: 700;
    color: #ffffff;
    font-size: 15.5px;
  }

  .booth-user-comp {
    font-size: 12.5px;
    color: var(--mute);
    margin-top: 2px;
  }

  .booth-score-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(39, 191, 240, 0.15);
    border: 1px solid rgba(39, 191, 240, 0.4);
    color: var(--cyan);
    padding: 4px 12px;
    border-radius: 100px;
    font-weight: 800;
    font-size: 14px;
  }

  .booth-score-badge.perfect {
    background: rgba(166, 213, 64, 0.15);
    border-color: rgba(166, 213, 64, 0.4);
    color: var(--lime);
  }

  .booth-progress-bar {
    width: 120px;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    overflow: hidden;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
  }

  .booth-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--cyan), var(--lime));
    border-radius: 10px;
  }

  /* Empty state */
  .booth-empty-box {
    text-align: center;
    padding: 60px 20px;
  }

  .booth-empty-box .icon {
    font-size: 48px;
    margin-bottom: 16px;
  }

  .booth-empty-box h4 {
    font-size: 22px;
    font-weight: 800;
    margin: 0 0 8px;
    color: #fff;
  }

  .booth-empty-box p {
    color: var(--mute);
    max-width: 440px;
    margin: 0 auto 22px;
    font-size: 15px;
  }
</style>

<div class="booth-lb-page">
  <div class="booth-lb-container">

    <!-- Header -->
    <div class="booth-lb-header">
      <div class="booth-lb-badge">
        <span class="booth-lb-pulse"></span>
        <span>GenRocket Booth Challenge · Standings</span>
      </div>
      <h1 class="booth-lb-title"><?php echo esc_html($display_title_count); ?> <span>Leaderboard</span></h1>
      <p class="booth-lb-subtitle">Real-time leaderboard of quiz champions at our booth. Test your knowledge of Design-Driven Synthetic Data to get on the board!</p>
    </div>

    <!-- Toolbar -->
    <div class="booth-lb-toolbar">
      <div class="booth-lb-stats">
        <div><span>Total Participants:</span> <strong><?php echo $total_participants; ?></strong></div>
        
        <!-- Filter Dropdown -->
        <div class="booth-lb-filter">
          <label for="booth-top-select">Show:</label>
          <select id="booth-top-select" class="booth-top-dropdown" onchange="changeLeaderboardLimit(this.value)">
            <option value="10" <?php selected($selected_top, '10'); ?>>Top 10 Participants</option>
            <option value="20" <?php selected($selected_top, '20'); ?>>Top 20 Participants</option>
            <option value="50" <?php selected($selected_top, '50'); ?>>Top 50 Participants</option>
            <option value="100" <?php selected($selected_top, '100'); ?>>Top 100 Participants</option>
            <!-- <option value="all" <?php //selected($selected_top, 'all'); ?>>All Participants (<?php //echo $total_participants; ?>)</option> -->
          </select>
        </div>
      </div>

      <div class="booth-lb-actions">
        <!-- Take Quiz Button -->
        <a href="<?php echo esc_url($quiz_url); ?>" class="booth-lb-btn booth-lb-btn-primary">
          <span>Take the Challenge ⚡</span>
        </a>
      </div>
    </div>

    <!-- Podium View (Top 3) -->
    <?php if (!empty($entries)): 
        $top1 = isset($entries[0]) ? $entries[0] : null;
        $top2 = isset($entries[1]) ? $entries[1] : null;
        $top3 = isset($entries[2]) ? $entries[2] : null;
    ?>
    <div class="booth-podium-grid">
      <!-- Rank 2 -->
      <div class="booth-podium-card booth-podium-rank-2">
        <div class="booth-podium-medal">🥈</div>
        <div class="booth-podium-name" title="<?php echo esc_attr($top2 ? $top2['user_name'] : '—'); ?>"><?php echo esc_html($top2 ? $top2['user_name'] : 'Open Spot'); ?></div>
        <div class="booth-podium-company" title="<?php echo esc_attr($top2 ? $format_participant_subtitle($top2, 'Participant') : ''); ?>"><?php echo esc_html($top2 ? $format_participant_subtitle($top2, 'Participant') : 'Claim Rank #2'); ?></div>
        <div class="booth-podium-score"><?php echo esc_html($top2 ? $top2['score_text'] : '—'); ?></div>
        <div class="booth-podium-pct"><?php echo $top2 ? esc_html($top2['percentage']) . '% Score' : 'Take the quiz'; ?></div>
      </div>

      <!-- Rank 1 -->
      <div class="booth-podium-card booth-podium-rank-1">
        <div class="booth-podium-medal">🥇</div>
        <div class="booth-podium-name" style="font-size:23px;" title="<?php echo esc_attr($top1 ? $top1['user_name'] : '—'); ?>"><?php echo esc_html($top1 ? $top1['user_name'] : 'Open Spot'); ?></div>
        <div class="booth-podium-company" style="font-size:14px;" title="<?php echo esc_attr($top1 ? $format_participant_subtitle($top1, 'Champion') : ''); ?>"><?php echo esc_html($top1 ? $format_participant_subtitle($top1, 'Champion') : 'Claim Rank #1'); ?></div>
        <div class="booth-podium-score"><?php echo esc_html($top1 ? $top1['score_text'] : '—'); ?></div>
        <div class="booth-podium-pct"><?php echo $top1 ? esc_html($top1['percentage']) . '% Score' : 'Take the quiz'; ?></div>
      </div>

      <!-- Rank 3 -->
      <div class="booth-podium-card booth-podium-rank-3">
        <div class="booth-podium-medal">🥉</div>
        <div class="booth-podium-name" title="<?php echo esc_attr($top3 ? $top3['user_name'] : '—'); ?>"><?php echo esc_html($top3 ? $top3['user_name'] : 'Open Spot'); ?></div>
        <div class="booth-podium-company" title="<?php echo esc_attr($top3 ? $format_participant_subtitle($top3, 'Participant') : ''); ?>"><?php echo esc_html($top3 ? $format_participant_subtitle($top3, 'Participant') : 'Claim Rank #3'); ?></div>
        <div class="booth-podium-score"><?php echo esc_html($top3 ? $top3['score_text'] : '—'); ?></div>
        <div class="booth-podium-pct"><?php echo $top3 ? esc_html($top3['percentage']) . '% Score' : 'Take the quiz'; ?></div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Leaderboard Table -->
    <div class="booth-table-box">
      <div class="booth-table-head">
        <h3><span>🏆</span> <?php echo esc_html($display_title_count); ?> High Scorers</h3>
      </div>

      <div class="table-responsive">
        <table class="booth-lb-table">
          <thead>
            <tr>
              <th width="80">Rank</th>
              <th>Participant</th>
              <th width="140">Score</th>
              <th width="200">Accuracy</th>
              <th width="140">Completed</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($entries)): ?>
              <tr>
                <td colspan="5">
                  <div class="booth-empty-box">
                    <div class="icon">🚀</div>
                    <h4>No entries yet!</h4>
                    <p>Be the very first contestant on the board. Take the 6-question GenRocket Challenge now!</p>
                    <a href="<?php echo esc_url($quiz_url); ?>" class="booth-lb-btn booth-lb-btn-primary">Start Challenge →</a>
                  </div>
                </td>
              </tr>
            <?php else: 
                $rank = 0;
                foreach ($entries as $row): 
                  $rank++;
                  $is_perfect = ($row['score'] >= 6);
                  $rank_cls = ($rank === 1) ? 'booth-rank-1' : (($rank === 2) ? 'booth-rank-2' : (($rank === 3) ? 'booth-rank-3' : ''));
                  $medal_icon = ($rank === 1) ? '🥇' : (($rank === 2) ? '🥈' : (($rank === 3) ? '🥉' : '#' . $rank));
                  $entry_ts = strtotime($row['created_at']);
                  $now_ts   = current_time('timestamp');
                  if ($entry_ts > $now_ts) {
                      $entry_ts = $now_ts;
                  }
                  $diff = $now_ts - $entry_ts;
                  if ($diff < 60) {
                      $date_formatted = 'Just now';
                  } else {
                      $date_formatted = human_time_diff($entry_ts, $now_ts) . ' ago';
                  }
                  $sub_meta = $format_participant_subtitle($row, '');
            ?>
              <tr>
                <td>
                  <span class="booth-rank-pill <?php echo $rank_cls; ?>"><?php echo $medal_icon; ?></span>
                </td>
                <td>
                  <div class="booth-user-cell">
                    <span class="booth-user-name"><?php echo esc_html($row['user_name']); ?></span>
                    <?php if (!empty($sub_meta)): ?>
                      <span class="booth-user-comp"><?php echo esc_html($sub_meta); ?></span>
                    <?php endif; ?>
                  </div>
                </td>
                <td>
                  <span class="booth-score-badge <?php echo $is_perfect ? 'perfect' : ''; ?>">
                    <?php echo esc_html($row['score_text']); ?>
                  </span>
                </td>
                <td>
                  <div class="booth-progress-bar">
                    <div class="booth-progress-fill" style="width: <?php echo esc_attr($row['percentage']); ?>%;"></div>
                  </div>
                  <span style="font-weight:700; font-size:13px;"><?php echo esc_html($row['percentage']); ?>%</span>
                </td>
                <td style="color:var(--mute); font-size:13px;">
                  <?php echo esc_html($date_formatted); ?>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
function changeLeaderboardLimit(limit) {
  var url = new URL(window.location.href);
  url.searchParams.set('top', limit);
  window.location.href = url.toString();
}
</script>

<?php get_footer(); ?>
