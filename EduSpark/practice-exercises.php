<?php
require_once __DIR__ . "/app.php";
require_login();

$user = current_user();
$userId = (int) $user["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $exerciseId = (int) ($_POST["exercise_id"] ?? 0);
    $answer = trim($_POST["answer"] ?? "");

    if ($exerciseId <= 0 || $answer === "") {
        flash("Please write an answer before submitting.");
    } else {
        db_execute(
            "INSERT INTO practice_submissions(user_id, exercise_id, answer) VALUES(?, ?, ?)",
            "iis",
            [$userId, $exerciseId, $answer]
        );
        flash("Practice answer submitted.");
    }

    redirect_to("practice-exercises.php");
}

$exercises = db_all("SELECT * FROM practice_exercises ORDER BY id ASC");
$submissions = db_all(
    "SELECT ps.answer, ps.created_at, pe.title
     FROM practice_submissions ps
     JOIN practice_exercises pe ON pe.id = ps.exercise_id
     WHERE ps.user_id = ?
     ORDER BY ps.created_at DESC
     LIMIT 5",
    "i",
    [$userId]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpark Practice Exercises</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("practice"); ?>

        <main class="dashboard page-layout">
            <?php render_flash(); ?>

            <header class="page-hero">
                <p class="eyebrow">Interactive Learning</p>
                <h1>Answer Practice Exercises</h1>
                <p>Submit written practice answers and save them to your account.</p>
            </header>

            <section class="exercise-list" aria-label="Practice exercises">
                <?php foreach ($exercises as $index => $exercise): ?>
                    <article class="exercise-item">
                        <span><?php echo str_pad((string) ($index + 1), 2, "0", STR_PAD_LEFT); ?></span>
                        <div>
                            <h2><?php echo h($exercise["title"]); ?></h2>
                            <p><?php echo h($exercise["description"]); ?></p>
                            <form class="answer-form" action="practice-exercises.php" method="post">
                                <input type="hidden" name="exercise_id" value="<?php echo h($exercise["id"]); ?>">
                                <textarea class="input-field" name="answer" rows="3" placeholder="Type your answer here..." required></textarea>
                                <button class="secondary-button form-button" type="submit">Submit answer</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>

            <section class="crud-panel" aria-labelledby="submission-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Saved work</p>
                        <h2 id="submission-heading">Recent submissions</h2>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Exercise</th>
                            <th>Answer</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($submissions) === 0): ?>
                            <tr>
                                <td colspan="3">No practice submissions yet.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?php echo h($submission["title"]); ?></td>
                                <td><?php echo h($submission["answer"]); ?></td>
                                <td><?php echo h($submission["created_at"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
