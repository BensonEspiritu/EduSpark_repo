<?php
require_once __DIR__ . "/app.php";
require_login();

$guides = [
    "time-management" => [
        "title" => "Time Management",
        "level" => "Beginner",
        "time" => "4 min read",
        "intro" => "Good time management helps you study with less stress by turning big tasks into clear, focused sessions that are easier to start and easier to finish.",
        "tips" => [
            ["Plan study blocks before the week begins.", "Choose realistic times for each subject so your schedule has structure."],
            ["Start with the most important task.", "Handle urgent or difficult work first while your focus is still fresh."],
            ["Break large assignments into smaller steps.", "Use short goals like outlining, reviewing notes, or solving five questions."],
            ["Review your progress at the end of each day.", "Adjust tomorrow's plan based on what you completed and what still needs attention."]
        ],
        "summary" => "Time management is about giving each study goal a clear place so you can stay consistent and avoid last-minute pressure."
    ],
    "note-taking" => [
        "title" => "Note Taking",
        "level" => "Beginner",
        "time" => "3 min read",
        "intro" => "Good notes make lessons easier to review because they separate main ideas from examples and small details.",
        "tips" => [
            ["Write headings for every topic.", "Clear headings help you find information quickly later."],
            ["Use short phrases instead of full paragraphs.", "This keeps your notes quick to scan when reviewing."],
            ["Add examples beside definitions.", "Examples make ideas easier to remember and apply."],
            ["Rewrite messy notes after class.", "A short cleanup session strengthens recall and fills missing gaps."]
        ],
        "summary" => "Strong notes are organized, brief, and easy to revisit before quizzes or practice exercises."
    ],
    "active-recall" => [
        "title" => "Active Recall",
        "level" => "Intermediate",
        "time" => "5 min read",
        "intro" => "Active recall means testing yourself before checking the answer, which strengthens memory more than rereading alone.",
        "tips" => [
            ["Close your notes and answer from memory.", "This forces your brain to retrieve the idea."],
            ["Turn headings into questions.", "Questions make review sessions more active."],
            ["Check your answer after trying.", "Correct mistakes while the gap is fresh."],
            ["Repeat weak questions later.", "Spacing out the same question helps the answer stick."]
        ],
        "summary" => "Active recall works because it turns review into practice instead of passive reading."
    ],
    "pomodoro-technique" => [
        "title" => "Pomodoro Technique",
        "level" => "Beginner",
        "time" => "4 min read",
        "intro" => "The Pomodoro technique uses short focus sessions and breaks to make studying feel less heavy.",
        "tips" => [
            ["Choose one clear task.", "A focused session works best when the target is specific."],
            ["Study for 25 minutes.", "Keep distractions away until the timer ends."],
            ["Take a 5 minute break.", "Stand up, stretch, or drink water."],
            ["Repeat and take a longer break.", "After several rounds, give your brain more recovery time."]
        ],
        "summary" => "Pomodoro sessions help you start faster and protect your attention during longer study days."
    ],
    "exam-preparation" => [
        "title" => "Exam Preparation",
        "level" => "Intermediate",
        "time" => "6 min read",
        "intro" => "Exam preparation is easier when review starts early and weak topics are identified before the final days.",
        "tips" => [
            ["List all exam topics.", "A topic list shows what needs attention."],
            ["Practice with sample questions.", "Questions reveal what you can actually apply."],
            ["Mark weak areas.", "Spend extra time on topics where mistakes repeat."],
            ["Review in short daily sessions.", "Consistent review beats one long last-minute session."]
        ],
        "summary" => "Good exam preparation combines planning, practice questions, and repeated review of weak areas."
    ],
    "healthy-study-habits" => [
        "title" => "Healthy Study Habits",
        "level" => "Beginner",
        "time" => "3 min read",
        "intro" => "Healthy study habits protect your energy so you can learn more consistently.",
        "tips" => [
            ["Sleep enough before studying.", "Tired brains struggle to focus and remember."],
            ["Drink water during long sessions.", "Hydration supports steady attention."],
            ["Take screen breaks.", "Short breaks reduce fatigue."],
            ["Move between sessions.", "Light movement helps reset your focus."]
        ],
        "summary" => "Learning improves when your study routine also protects your body and attention."
    ]
];

$slug = $_GET["topic"] ?? "time-management";
$guide = $guides[$slug] ?? $guides["time-management"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($guide["title"]); ?> | EduSpark</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("tips"); ?>

        <main class="dashboard page-layout">
            <header class="page-hero">
                <div class="section-heading">
                    <a class="secondary-button" href="study_tips.php">Back to Study Tips</a>
                </div>
                <p class="eyebrow">Learning Guide</p>
                <h1><?php echo h($guide["title"]); ?></h1>
                <span class="resource-code"><?php echo h($guide["level"]); ?> | <?php echo h($guide["time"]); ?></span>
            </header>

            <section class="panel" aria-labelledby="introduction-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Start Here</p>
                        <h2 id="introduction-heading">Introduction</h2>
                    </div>
                </div>
                <p><?php echo h($guide["intro"]); ?></p>
            </section>

            <section class="panel" aria-labelledby="tips-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Study Strategy</p>
                        <h2 id="tips-heading">Key Tips</h2>
                    </div>
                </div>

                <div class="lesson-list">
                    <?php foreach ($guide["tips"] as $index => $tip): ?>
                        <article class="lesson-card">
                            <span class="lesson-badge"><?php echo h($index + 1); ?></span>
                            <div>
                                <h3><?php echo h($tip[0]); ?></h3>
                                <p><?php echo h($tip[1]); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="panel" aria-labelledby="summary-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Wrap Up</p>
                        <h2 id="summary-heading">Summary</h2>
                    </div>
                </div>
                <p><?php echo h($guide["summary"]); ?></p>
            </section>
        </main>
    </div>
</body>
</html>
