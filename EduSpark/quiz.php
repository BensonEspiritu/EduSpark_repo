<?php
require_once __DIR__ . "/app.php";
require_login();

$user = current_user();
$userId = (int) $user["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $questions = db_all("SELECT * FROM quiz_questions ORDER BY id ASC");
    $answers = $_POST["answers"] ?? [];
    $score = 0;

    foreach ($questions as $question) {
        $questionId = (int) $question["id"];
        $answer = strtoupper($answers[$questionId] ?? "");

        if ($answer === $question["correct_option"]) {
            $score++;
        }
    }

    db_execute(
        "INSERT INTO quiz_attempts(user_id, score, total) VALUES(?, ?, ?)",
        "iii",
        [$userId, $score, count($questions)]
    );

    flash("Quiz submitted. You scored $score out of " . count($questions) . ".");
    redirect_to("quiz.php");
}

$questions = db_all("SELECT * FROM quiz_questions ORDER BY id ASC");
$attempts = db_all(
    "SELECT * FROM quiz_attempts WHERE user_id = ? ORDER BY created_at DESC LIMIT 5",
    "i",
    [$userId]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpark Quiz</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("quiz"); ?>

        <main class="dashboard page-layout">
            <?php render_flash(); ?>

            <header class="page-hero">
                <p class="eyebrow">Interactive Learning</p>
                <h1>Take Quiz</h1>
                <p>Submit your answers to save a quiz attempt and earn XP on your dashboard.</p>
            </header>

            <form class="quiz-panel" action="quiz.php" method="post">
                <?php foreach ($questions as $index => $question): ?>
                    <fieldset>
                        <legend><?php echo h($index + 1); ?>. <?php echo h($question["question_text"]); ?></legend>
                        <label>
                            <input type="radio" name="answers[<?php echo h($question["id"]); ?>]" value="A" required>
                            <?php echo h($question["option_a"]); ?>
                        </label>
                        <label>
                            <input type="radio" name="answers[<?php echo h($question["id"]); ?>]" value="B">
                            <?php echo h($question["option_b"]); ?>
                        </label>
                        <label>
                            <input type="radio" name="answers[<?php echo h($question["id"]); ?>]" value="C">
                            <?php echo h($question["option_c"]); ?>
                        </label>
                    </fieldset>
                <?php endforeach; ?>

                <button class="primary-button form-button" type="submit">Submit quiz</button>
            </form>

            <section class="crud-panel" aria-labelledby="attempt-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Saved results</p>
                        <h2 id="attempt-heading">Recent quiz attempts</h2>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Score</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($attempts) === 0): ?>
                            <tr>
                                <td colspan="3">No quiz attempts yet.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($attempts as $attempt): ?>
                            <tr>
                                <td><?php echo h($attempt["score"]); ?></td>
                                <td><?php echo h($attempt["total"]); ?></td>
                                <td><?php echo h($attempt["created_at"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
