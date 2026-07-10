<?php
require_once __DIR__ . "/app.php";
require_login();

$topics = [
    [
        "slug" => "time-management",
        "icon" => "T",
        "title" => "Time Management",
        "summary" => "Plan study blocks, set priorities, and break large tasks into smaller steps so deadlines feel easier to handle.",
        "time" => "4 min read"
    ],
    [
        "slug" => "note-taking",
        "icon" => "N",
        "title" => "Note Taking",
        "summary" => "Capture key ideas clearly, organize examples, and leave room for review notes that make revision faster.",
        "time" => "3 min read"
    ],
    [
        "slug" => "active-recall",
        "icon" => "A",
        "title" => "Active Recall",
        "summary" => "Test yourself before checking answers so your brain practices retrieving information, not just recognizing it.",
        "time" => "5 min read"
    ],
    [
        "slug" => "pomodoro-technique",
        "icon" => "P",
        "title" => "Pomodoro Technique",
        "summary" => "Use focused study sessions with short breaks to protect your attention and make long study periods less draining.",
        "time" => "4 min read"
    ],
    [
        "slug" => "exam-preparation",
        "icon" => "E",
        "title" => "Exam Preparation",
        "summary" => "Review early, practice with past questions, and map weak topics before the final countdown begins.",
        "time" => "6 min read"
    ],
    [
        "slug" => "healthy-study-habits",
        "icon" => "H",
        "title" => "Healthy Study Habits",
        "summary" => "Support your learning with sleep, movement, hydration, and breaks that keep your energy steady.",
        "time" => "3 min read"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Tips | EduSpark</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("tips"); ?>

        <main class="dashboard page-layout">
            <section class="page-hero" aria-labelledby="study-tips-title">
                <p class="eyebrow">Feedback and others</p>
                <h1 id="study-tips-title">Study Tips</h1>
                <p>Build stronger study routines with quick, practical strategies for planning, reviewing, preparing for exams, and staying healthy while learning.</p>
            </section>

            <section class="resource-grid" aria-label="Study tip cards">
                <?php foreach ($topics as $topic): ?>
                    <article class="resource-card study-card" id="<?php echo h($topic["slug"]); ?>">
                        <span class="lesson-badge" aria-hidden="true"><?php echo h($topic["icon"]); ?></span>
                        <div>
                            <h2><?php echo h($topic["title"]); ?></h2>
                            <p><?php echo h($topic["summary"]); ?></p>
                        </div>
                        <span class="resource-code"><?php echo h($topic["time"]); ?></span>
                        <a class="secondary-button" href="learning-guide.php?topic=<?php echo h($topic["slug"]); ?>">Read More</a>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>
</html>
