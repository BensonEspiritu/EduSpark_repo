<?php
header("Location: ../contact-feedback.php");
exit();

function h($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

$categories = ["General Question", "Suggestion", "Bug Report"];
$message = "";
$messageType = "";
$form = [
    "fullname" => "",
    "email" => "",
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
        $message = "Please complete all feedback fields.";
        $messageType = "error";
    } elseif (!filter_var($form["email"], FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } elseif (!in_array($form["category"], $categories, true)) {
        $message = "Please choose a valid feedback category.";
        $messageType = "error";
    } else {
        // Saving can be added here later.
        $message = "Feedback sent successfully.";
        $messageType = "success";
        $form = [
            "fullname" => "",
            "email" => "",
            "category" => "",
            "subject" => "",
            "message" => ""
        ];
    }
}
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
                <a class="nav-item" href="study_tips.php">
                    <span class="nav-icon" aria-hidden="true">S</span>
                    <span>Study Tips</span>
                </a>
                <a class="nav-item active" href="contact-feedback.php" aria-current="page">
                    <span class="nav-icon" aria-hidden="true">F</span>
                    <span>Feedback</span>
                </a>
            </nav>
        </aside>

        <main class="dashboard page-layout">
            <?php if ($message !== ""): ?>
                <div
                    class="alert"
                    role="alert"
                    <?php if ($messageType === "error"): ?>
                        style="background: rgba(255, 51, 78, 0.2); border-color: rgba(255, 51, 78, 0.68);"
                    <?php endif; ?>
                >
                    <?php echo h($message); ?>
                </div>
            <?php endif; ?>

            <header class="page-hero">
                <p class="eyebrow">Contact EduSpark</p>
                <h1>Contact Feedback</h1>
                <p>Send a question, suggestion, or bug report for frontend and PHP validation testing.</p>
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
        </main>
    </div>
</body>
</html>
