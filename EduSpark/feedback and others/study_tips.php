<?php
header("Location: ../study_tips.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Tips | EduSpark</title>
    <link rel="stylesheet" href="study_tips.css">
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
            <section class="page-hero" aria-labelledby="study-tips-title">
                <p class="eyebrow">Learning Guide</p>
                <h1 id="study-tips-title">Study Tips</h1>
                <p>
                    Build stronger study routines with quick, practical strategies for planning,
                    reviewing, preparing for exams, and staying healthy while learning.
                </p>
            </section>

            <section class="resource-grid" aria-label="Study tip cards">
                <article class="resource-card" id="time-management">
                    <span class="lesson-badge" aria-hidden="true">&#9200;</span>
                    <div>
                        <h2>Time Management</h2>
                        <p>
                            Plan study blocks, set priorities, and break large tasks into smaller
                            steps so deadlines feel easier to handle.
                        </p>
                    </div>
                    <span class="resource-code">4 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=time-management">Read More</a>
                </article>

                <article class="resource-card" id="note-taking">
                    <span class="lesson-badge" aria-hidden="true">&#9999;</span>
                    <div>
                        <h2>Note Taking</h2>
                        <p>
                            Capture key ideas clearly, organize examples, and leave room for review
                            notes that make revision faster.
                        </p>
                    </div>
                    <span class="resource-code">3 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=note-taking">Read More</a>
                </article>

                <article class="resource-card" id="active-recall">
                    <span class="lesson-badge" aria-hidden="true">&#128161;</span>
                    <div>
                        <h2>Active Recall</h2>
                        <p>
                            Test yourself before checking answers so your brain practices retrieving
                            information, not just recognizing it.
                        </p>
                    </div>
                    <span class="resource-code">5 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=active-recall">Read More</a>
                </article>

                <article class="resource-card" id="pomodoro-technique">
                    <span class="lesson-badge" aria-hidden="true">&#9201;</span>
                    <div>
                        <h2>Pomodoro Technique</h2>
                        <p>
                            Use focused study sessions with short breaks to protect your attention
                            and make long study periods less draining.
                        </p>
                    </div>
                    <span class="resource-code">4 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=pomodoro-technique">Read More</a>
                </article>

                <article class="resource-card" id="exam-preparation">
                    <span class="lesson-badge" aria-hidden="true">&#127891;</span>
                    <div>
                        <h2>Exam Preparation</h2>
                        <p>
                            Review early, practice with past questions, and map weak topics before
                            the final countdown begins.
                        </p>
                    </div>
                    <span class="resource-code">6 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=exam-preparation">Read More</a>
                </article>

                <article class="resource-card" id="healthy-study-habits">
                    <span class="lesson-badge" aria-hidden="true">&#127793;</span>
                    <div>
                        <h2>Healthy Study Habits</h2>
                        <p>
                            Support your learning with sleep, movement, hydration, and breaks that
                            keep your energy steady.
                        </p>
                    </div>
                    <span class="resource-code">3 min read</span>
                    <a class="secondary-button" href="learning-guide.php?topic=healthy-study-habits">Read More</a>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
