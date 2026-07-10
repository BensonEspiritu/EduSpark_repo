<?php
$query = $_SERVER["QUERY_STRING"] ?? "";
$target = "../learning-guide.php" . ($query !== "" ? "?" . $query : "");
header("Location: " . $target);
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Guide | EduSpark</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <aside class="sidebar">
            <a class="brand" href="index.php" aria-label="EduSpark home">
                <span class="brand-mark">E</span>
                <span>EduSpark</span>
            </a>

            <nav class="side-nav" aria-label="Main navigation">
                <a class="nav-item" href="index.php">
                    <span class="nav-icon" aria-hidden="true">D</span>
                    <span>Dashboard</span>
                </a>
                <a class="nav-item" href="lessons.php">
                    <span class="nav-icon" aria-hidden="true">L</span>
                    <span>Lessons</span>
                </a>
                <a class="nav-item" href="quiz.php">
                    <span class="nav-icon" aria-hidden="true">Q</span>
                    <span>Quizzes</span>
                </a>
                <a class="nav-item" href="exercises.php">
                    <span class="nav-icon" aria-hidden="true">X</span>
                    <span>Exercises</span>
                </a>
                <a class="nav-item active" href="study_tips.php" aria-current="page">
                    <span class="nav-icon" aria-hidden="true">S</span>
                    <span>Study Tips</span>
                </a>
                <a class="nav-item" href="contact-feedback.php">
                    <span class="nav-icon" aria-hidden="true">F</span>
                    <span>Feedback</span>
                </a>
            </nav>
        </aside>

        <main class="dashboard page-layout">
            <header class="page-hero">
                <div class="section-heading">
                    <a class="secondary-button" href="study_tips.php">&larr; Back to Study Tips</a>
                </div>
                <p class="eyebrow">Learning Guide</p>
                <h1>Time Management</h1>
                <span class="resource-code">Beginner &bull; 4 min read</span>
            </header>

            <section class="panel" aria-labelledby="introduction-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Start Here</p>
                        <h2 id="introduction-heading">Introduction</h2>
                    </div>
                </div>
                <p>
                    Good time management helps you study with less stress by turning big tasks into clear,
                    focused sessions that are easier to start and easier to finish.
                </p>
            </section>

            <section class="panel" aria-labelledby="tips-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Study Strategy</p>
                        <h2 id="tips-heading">Key Tips</h2>
                    </div>
                </div>

                <div class="lesson-list">
                    <article class="lesson-card">
                        <span class="lesson-badge">1</span>
                        <div>
                            <h3>Plan study blocks before the week begins.</h3>
                            <p>Choose realistic times for each subject so your schedule has structure.</p>
                        </div>
                    </article>

                    <article class="lesson-card">
                        <span class="lesson-badge">2</span>
                        <div>
                            <h3>Start with the most important task.</h3>
                            <p>Handle urgent or difficult work first while your focus is still fresh.</p>
                        </div>
                    </article>

                    <article class="lesson-card">
                        <span class="lesson-badge">3</span>
                        <div>
                            <h3>Break large assignments into smaller steps.</h3>
                            <p>Use short goals like outlining, reviewing notes, or solving five questions.</p>
                        </div>
                    </article>

                    <article class="lesson-card">
                        <span class="lesson-badge">4</span>
                        <div>
                            <h3>Review your progress at the end of each day.</h3>
                            <p>Adjust tomorrow's plan based on what you completed and what still needs attention.</p>
                        </div>
                    </article>
                </div>
            </section>

            <section class="panel" aria-labelledby="summary-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Wrap Up</p>
                        <h2 id="summary-heading">Summary</h2>
                    </div>
                </div>
                <p>
                    Time management is not about filling every minute; it is about giving each study goal a
                    clear place so you can stay consistent and avoid last-minute pressure.
                </p>
            </section>
        </main>
    </div>
</body>
</html>
