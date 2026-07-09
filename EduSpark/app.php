<?php
require_once __DIR__ . "/loginpage/database.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function h($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

function redirect_to($path) {
    header("Location: " . $path);
    exit();
}

function require_login() {
    if (!isset($_SESSION["user_id"])) {
        redirect_to("loginpage/login.php");
    }
}

function db_execute($sql, $types = "", $params = []) {
    global $conn;

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Database error: " . mysqli_error($conn));
    }

    if ($types !== "") {
        $bindValues = [$types];

        foreach ($params as $key => $value) {
            $bindValues[] = &$params[$key];
        }

        mysqli_stmt_bind_param($stmt, ...$bindValues);
    }

    mysqli_stmt_execute($stmt);
    return $stmt;
}

function db_all($sql, $types = "", $params = []) {
    $stmt = db_execute($sql, $types, $params);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    mysqli_stmt_close($stmt);
    return $rows;
}

function db_one($sql, $types = "", $params = []) {
    $rows = db_all($sql, $types, $params);
    return $rows[0] ?? null;
}

function db_value($sql, $types = "", $params = []) {
    $row = db_one($sql, $types, $params);

    if (!$row) {
        return 0;
    }

    return array_values($row)[0];
}

function current_user() {
    if (!isset($_SESSION["user_id"])) {
        return null;
    }

    $user = db_one(
        "SELECT id, fullname, username, email FROM users WHERE id = ?",
        "i",
        [(int) $_SESSION["user_id"]]
    );

    if (!$user) {
        session_destroy();
        redirect_to("loginpage/login.php");
    }

    return $user;
}

function flash($message = null) {
    if ($message !== null) {
        $_SESSION["flash"] = $message;
        return null;
    }

    $message = $_SESSION["flash"] ?? "";
    unset($_SESSION["flash"]);
    return $message;
}

function render_flash() {
    $message = flash();

    if ($message !== "") {
        echo '<div class="alert">' . h($message) . '</div>';
    }
}

function first_initial($user) {
    $name = trim($user["fullname"] ?: $user["username"]);
    return strtoupper(substr($name, 0, 1));
}

function render_nav($active) {
    $items = [
        "home" => ["account-dashboard.php", "H", "Home"],
        "materials" => ["subject-materials.php", "L", "Materials"],
        "quiz" => ["quiz.php", "Q", "Quiz"],
        "practice" => ["practice-exercises.php", "P", "Practice"],
        "logout" => ["logout.php", "S", "Sign out"]
    ];
    ?>
    <aside class="sidebar">
        <a class="brand" href="account-dashboard.php" aria-label="EduSpark home">
            <span class="brand-mark">E</span>
            <span>EduSpark</span>
        </a>

        <nav class="side-nav" aria-label="Page navigation">
            <?php foreach ($items as $key => $item): ?>
                <a class="nav-item <?php echo $active === $key ? "active" : ""; ?>" href="<?php echo h($item[0]); ?>">
                    <span class="nav-icon"><?php echo h($item[1]); ?></span>
                    <span><?php echo h($item[2]); ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
    </aside>
    <?php
}

function ensure_learning_tables() {
    global $conn;

    mysqli_query($conn, "
        CREATE TABLE IF NOT EXISTS materials (
            id INT AUTO_INCREMENT PRIMARY KEY,
            code VARCHAR(30) NOT NULL,
            title VARCHAR(120) NOT NULL,
            description TEXT NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    mysqli_query($conn, "
        CREATE TABLE IF NOT EXISTS quiz_questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question_text TEXT NOT NULL,
            option_a VARCHAR(255) NOT NULL,
            option_b VARCHAR(255) NOT NULL,
            option_c VARCHAR(255) NOT NULL,
            correct_option CHAR(1) NOT NULL
        )
    ");

    mysqli_query($conn, "
        CREATE TABLE IF NOT EXISTS quiz_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            score INT NOT NULL,
            total INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    mysqli_query($conn, "
        CREATE TABLE IF NOT EXISTS practice_exercises (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(140) NOT NULL,
            description TEXT NOT NULL
        )
    ");

    mysqli_query($conn, "
        CREATE TABLE IF NOT EXISTS practice_submissions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            exercise_id INT NOT NULL,
            answer TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    if ((int) db_value("SELECT COUNT(*) FROM materials") === 0) {
        $materials = [
            ["CS0043", "Application Development", "Interfaces, forms, databases, and CRUD workflow basics.", "Application development connects a user interface to a working database. In PHP, forms usually submit with POST, data is checked on the server, and records are created, read, updated, or deleted through SQL."],
            ["WEB101", "HTML and CSS Foundations", "Semantic pages, responsive layouts, color systems, and reusable components.", "HTML gives meaning to page content, while CSS controls the visual design. A good dashboard keeps structure clean and reuses class names so PHP can change data without breaking the design."],
            ["DB0021", "Database Records", "Tables, primary keys, user accounts, and saving records safely.", "A database stores records in tables. Each table should have a primary key, and user passwords should be hashed before they are saved."]
        ];

        foreach ($materials as $material) {
            db_execute(
                "INSERT INTO materials(code, title, description, content) VALUES(?, ?, ?, ?)",
                "ssss",
                $material
            );
        }
    }

    if ((int) db_value("SELECT COUNT(*) FROM quiz_questions") === 0) {
        $questions = [
            ["Which tag creates the largest heading?", "<h1>", "<title>", "<header>", "A"],
            ["What does CRUD stand for?", "Create, Read, Update, Delete", "Code, Run, Upload, Deploy", "Class, Route, User, Data", "A"],
            ["Which PHP variable contains submitted POST form data?", "$_POST", "$_FORM", "$_DATA", "A"]
        ];

        foreach ($questions as $question) {
            db_execute(
                "INSERT INTO quiz_questions(question_text, option_a, option_b, option_c, correct_option) VALUES(?, ?, ?, ?, ?)",
                "sssss",
                $question
            );
        }
    }

    if ((int) db_value("SELECT COUNT(*) FROM practice_exercises") === 0) {
        $exercises = [
            ["Create a Registration Form", "Build fields for username, password, email, and contact number."],
            ["Save a Record", "Write PHP that inserts form data into a database table."],
            ["Display Records", "Show database records inside a styled table or dashboard list."]
        ];

        foreach ($exercises as $exercise) {
            db_execute(
                "INSERT INTO practice_exercises(title, description) VALUES(?, ?)",
                "ss",
                $exercise
            );
        }
    }
}

function user_xp($userId) {
    $quizXp = (int) db_value(
        "SELECT COALESCE(SUM(score), 0) * 20 FROM quiz_attempts WHERE user_id = ?",
        "i",
        [$userId]
    );
    $practiceXp = (int) db_value(
        "SELECT COUNT(*) * 10 FROM practice_submissions WHERE user_id = ?",
        "i",
        [$userId]
    );

    return $quizXp + $practiceXp;
}

ensure_learning_tables();
?>
