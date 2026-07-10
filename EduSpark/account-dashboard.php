<?php
require_once __DIR__ . "/app.php";
require_login();

$user = current_user();
$userId = (int) $user["id"];
$xp = user_xp($userId);
$level = max(1, (int) floor($xp / 100) + 1);
$materialsCount = (int) db_value("SELECT COUNT(*) FROM materials");
$quizAttempts = (int) db_value("SELECT COUNT(*) FROM quiz_attempts WHERE user_id = ?", "i", [$userId]);
$practiceSubmissions = (int) db_value("SELECT COUNT(*) FROM practice_submissions WHERE user_id = ?", "i", [$userId]);
$feedbackCount = (int) db_value("SELECT COUNT(*) FROM feedback_messages WHERE user_id = ?", "i", [$userId]);
$activeDays = (int) db_value(
    "SELECT COUNT(*) FROM (
        SELECT DATE(created_at) AS activity_date FROM quiz_attempts WHERE user_id = ?
        UNION
        SELECT DATE(created_at) AS activity_date FROM practice_submissions WHERE user_id = ?
    ) AS activity_days",
    "ii",
    [$userId, $userId]
);
$goalPercent = min(100, ($xp % 100));
$latestMaterials = db_all("SELECT * FROM materials ORDER BY id DESC LIMIT 3");
$users = db_all("SELECT id, fullname, username FROM users");
$leaderboard = [];

foreach ($users as $account) {
    $leaderboard[] = [
        "id" => (int) $account["id"],
        "name" => $account["fullname"] ?: $account["username"],
        "xp" => user_xp((int) $account["id"])
    ];
}

usort($leaderboard, function ($a, $b) {
    return $b["xp"] <=> $a["xp"];
});

$userRank = 1;
foreach ($leaderboard as $index => $account) {
    if ($account["id"] === $userId) {
        $userRank = $index + 1;
        break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpark Account Dashboard</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("home"); ?>

        <main class="dashboard">
            <?php render_flash(); ?>

            <header class="topbar">
                <div>
                    <p class="eyebrow">Learning account</p>
                    <h1>Welcome back, <?php echo h($user["fullname"] ?: $user["username"]); ?></h1>
                </div>
                <div class="top-actions">
                    <button class="icon-button" type="button" aria-label="Notifications">!</button>
                    <div class="profile-chip" aria-label="Account profile">
                        <span class="profile-avatar"><?php echo h(first_initial($user)); ?></span>
                        <span>Level <?php echo h($level); ?></span>
                    </div>
                </div>
            </header>

            <section class="hero-panel" aria-label="Daily practice summary">
                <div class="hero-copy">
                    <p class="eyebrow">Today's goal</p>
                    <h2>Study smarter, compete harder, level up</h2>
                    <p>Take a quiz or answer a practice exercise to add XP to your account and climb the leaderboard.</p>
                    <div class="hero-actions">
                        <a class="primary-button" href="quiz.php">Start quiz</a>
                        <a class="secondary-button" href="practice-exercises.php">Review words</a>
                    </div>
                </div>

                <div class="mascot-card" aria-label="Mascot progress">
                    <div class="mascot">
                        <span class="mascot-eye left"></span>
                        <span class="mascot-eye right"></span>
                        <span class="mascot-beak"></span>
                        <span class="mascot-wing left"></span>
                        <span class="mascot-wing right"></span>
                    </div>
                    <div class="goal-ring">
                        <span><?php echo h($goalPercent); ?>%</span>
                    </div>
                </div>
            </section>

            <section class="stats-grid" aria-label="Account statistics">
                <article class="stat-card">
                    <span class="stat-icon flame">D</span>
                    <p>Active Days</p>
                    <strong><?php echo h($activeDays); ?></strong>
                </article>
                <article class="stat-card">
                    <span class="stat-icon bolt">X</span>
                    <p>Total XP</p>
                    <strong><?php echo h($xp); ?></strong>
                </article>
                <article class="stat-card">
                    <span class="stat-icon gem">M</span>
                    <p>Materials</p>
                    <strong><?php echo h($materialsCount); ?></strong>
                </article>
                <article class="stat-card">
                    <span class="stat-icon trophy">R</span>
                    <p>Rank</p>
                    <strong>#<?php echo h($userRank); ?></strong>
                </article>
            </section>

            <section class="feature-hub" aria-labelledby="feature-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Learning hub</p>
                        <h2 id="feature-heading">Choose your activity</h2>
                    </div>
                </div>

                <div class="feature-map">
                    <article class="feature-path">
                        <div class="feature-title">
                            <span class="feature-arrow"></span>
                            <div>
                                <h3>Learning Resources</h3>
                                <p>Open course notes, slides, and topic summaries.</p>
                            </div>
                        </div>
                        <a class="branch-link" href="subject-materials.php">
                            <span class="branch-line"></span>
                            <span class="feature-arrow"></span>
                            <span>View Subject Materials</span>
                        </a>
                    </article>

                    <article class="feature-path">
                        <div class="feature-title">
                            <span class="feature-arrow"></span>
                            <div>
                                <h3>Interactive Learning</h3>
                                <p>Test yourself with quick questions and practice drills.</p>
                            </div>
                        </div>
                        <a class="branch-link" href="quiz.php">
                            <span class="branch-line"></span>
                            <span class="feature-arrow"></span>
                            <span>Take Quiz</span>
                        </a>
                        <a class="branch-link" href="practice-exercises.php">
                            <span class="branch-line"></span>
                            <span class="feature-arrow"></span>
                            <span>Answer Practice Exercises</span>
                        </a>
                    </article>

                    <article class="feature-path">
                        <div class="feature-title">
                            <span class="feature-arrow"></span>
                            <div>
                                <h3>Feedback and Others</h3>
                                <p>Read study tips, open learning guides, or send feedback.</p>
                            </div>
                        </div>
                        <a class="branch-link" href="study_tips.php">
                            <span class="branch-line"></span>
                            <span class="feature-arrow"></span>
                            <span>View Study Tips</span>
                        </a>
                        <a class="branch-link" href="contact-feedback.php">
                            <span class="branch-line"></span>
                            <span class="feature-arrow"></span>
                            <span>Contact Feedback</span>
                        </a>
                    </article>
                </div>
            </section>

            <div class="content-grid">
                <section class="panel lessons-panel" aria-labelledby="lesson-heading">
                    <div class="section-heading">
                        <div>
                            <p class="eyebrow">Learning path</p>
                            <h2 id="lesson-heading">Subject materials</h2>
                        </div>
                        <a href="subject-materials.php">View all</a>
                    </div>

                    <div class="lesson-list">
                        <?php foreach ($latestMaterials as $index => $material): ?>
                            <article class="lesson-card <?php echo $index === 0 ? "current" : ""; ?>">
                                <div class="lesson-badge"><?php echo h($index + 1); ?></div>
                                <div>
                                    <h3><?php echo h($material["title"]); ?></h3>
                                    <p><?php echo h($material["description"]); ?></p>
                                </div>
                                <span class="xp-pill"><?php echo h($material["code"]); ?></span>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="panel" aria-labelledby="leaderboard-heading">
                    <div class="section-heading">
                        <div>
                            <p class="eyebrow">EduSpark League</p>
                            <h2 id="leaderboard-heading">Leaderboard</h2>
                        </div>
                        <span class="rank-badge">#<?php echo h($userRank); ?></span>
                    </div>

                    <ol class="leaderboard">
                        <?php foreach (array_slice($leaderboard, 0, 5) as $index => $account): ?>
                            <li class="<?php echo $account["id"] === $userId ? "you" : ""; ?>">
                                <span class="place"><?php echo h($index + 1); ?></span>
                                <span><?php echo h($account["name"]); ?></span>
                                <strong><?php echo h($account["xp"]); ?> XP</strong>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </section>
            </div>

            <section class="bottom-grid" aria-label="Progress and badges">
                <article class="panel weekly-panel">
                    <div class="section-heading">
                        <div>
                            <p class="eyebrow">Activity</p>
                            <h2>Practice rhythm</h2>
                        </div>
                        <span><?php echo h($quizAttempts); ?> quizzes</span>
                    </div>
                    <div class="bar-chart" aria-label="Weekly XP chart">
                        <span style="--height: 32%"><b>Mon</b></span>
                        <span style="--height: 46%"><b>Tue</b></span>
                        <span style="--height: 58%"><b>Wed</b></span>
                        <span style="--height: 82%"><b>Thu</b></span>
                        <span style="--height: 54%"><b>Fri</b></span>
                        <span style="--height: 68%"><b>Sat</b></span>
                        <span style="--height: 42%"><b>Sun</b></span>
                    </div>
                </article>

                <article class="panel achievements-panel">
                    <div class="section-heading">
                        <div>
                            <p class="eyebrow">Collection</p>
                            <h2>Account badges</h2>
                        </div>
                    </div>
                    <div class="badge-row">
                        <span class="achievement green"><?php echo h($activeDays); ?></span>
                        <span class="achievement blue"><?php echo h($quizAttempts); ?></span>
                        <span class="achievement gold"><?php echo h($practiceSubmissions + $feedbackCount); ?></span>
                    </div>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
