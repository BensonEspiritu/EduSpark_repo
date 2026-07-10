<?php
require_once __DIR__ . "/app.php";
require_login();

$user = current_user();
$categories = ["General Question", "Suggestion", "Bug Report"];
$form = [
    "fullname" => $user["fullname"] ?: $user["username"],
    "email" => $user["email"],
    "category" => "",
    "subject" => "",
    "message" => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form = [
        "fullname" => trim($_POST["fullname"] ?? ""),
        "email" => trim($_POST["email"] ?? ""),
        "category" => trim($_POST["category"] ?? ""),
        "subject" => trim($_POST["subject"] ?? ""),
        "message" => trim($_POST["message"] ?? "")
    ];

    if (
        $form["fullname"] === "" ||
        $form["email"] === "" ||
        $form["category"] === "" ||
        $form["subject"] === "" ||
        $form["message"] === ""
    ) {
        flash("Please complete all feedback fields.");
    } elseif (!filter_var($form["email"], FILTER_VALIDATE_EMAIL)) {
        flash("Please enter a valid email address.");
    } elseif (!in_array($form["category"], $categories, true)) {
        flash("Please choose a valid feedback category.");
    } else {
        db_execute(
            "INSERT INTO feedback_messages(user_id, fullname, email, category, subject, message) VALUES(?, ?, ?, ?, ?, ?)",
            "isssss",
            [(int) $user["id"], $form["fullname"], $form["email"], $form["category"], $form["subject"], $form["message"]]
        );

        flash("Feedback sent successfully.");
        redirect_to("contact-feedback.php");
    }
}

$feedbackMessages = db_all(
    "SELECT * FROM feedback_messages WHERE user_id = ? ORDER BY created_at DESC LIMIT 5",
    "i",
    [(int) $user["id"]]
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Feedback | EduSpark</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("feedback"); ?>

        <main class="dashboard page-layout">
            <?php render_flash(); ?>

            <header class="page-hero">
                <p class="eyebrow">Contact EduSpark</p>
                <h1>Contact Feedback</h1>
                <p>Send a question, suggestion, or bug report. Your feedback is saved to your account.</p>
            </header>

            <section class="crud-panel" aria-labelledby="feedback-form-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Feedback Form</p>
                        <h2 id="feedback-form-heading">Send Feedback</h2>
                    </div>
                </div>

                <form class="form-grid" action="contact-feedback.php" method="post">
                    <label>
                        Full Name
                        <input class="input-field" type="text" name="fullname" value="<?php echo h($form["fullname"]); ?>" required>
                    </label>

                    <label>
                        Email
                        <input class="input-field" type="email" name="email" value="<?php echo h($form["email"]); ?>" required>
                    </label>

                    <label class="wide-field">
                        Category
                        <select class="input-field" name="category" required>
                            <option value="">Choose category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo h($category); ?>" <?php echo $form["category"] === $category ? "selected" : ""; ?>>
                                    <?php echo h($category); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label class="wide-field">
                        Subject
                        <input class="input-field" type="text" name="subject" value="<?php echo h($form["subject"]); ?>" required>
                    </label>

                    <label class="wide-field">
                        Message
                        <textarea class="input-field" name="message" rows="6" required><?php echo h($form["message"]); ?></textarea>
                    </label>

                    <button class="primary-button form-button" type="submit">Send Feedback</button>
                </form>
            </section>

            <section class="crud-panel" aria-labelledby="feedback-history-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Saved feedback</p>
                        <h2 id="feedback-history-heading">Recent messages</h2>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($feedbackMessages) === 0): ?>
                            <tr>
                                <td colspan="4">No feedback messages yet.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($feedbackMessages as $feedback): ?>
                            <tr>
                                <td><?php echo h($feedback["category"]); ?></td>
                                <td><?php echo h($feedback["subject"]); ?></td>
                                <td><?php echo h($feedback["message"]); ?></td>
                                <td><?php echo h($feedback["created_at"]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
