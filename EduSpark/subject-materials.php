<?php
require_once __DIR__ . "/app.php";
require_login();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "save_material") {
        $id = (int) ($_POST["id"] ?? 0);
        $code = trim($_POST["code"] ?? "");
        $title = trim($_POST["title"] ?? "");
        $description = trim($_POST["description"] ?? "");
        $content = trim($_POST["content"] ?? "");

        if ($code === "" || $title === "" || $description === "" || $content === "") {
            flash("Please complete all material fields.");
        } elseif ($id > 0) {
            db_execute(
                "UPDATE materials SET code = ?, title = ?, description = ?, content = ? WHERE id = ?",
                "ssssi",
                [$code, $title, $description, $content, $id]
            );
            flash("Material updated successfully.");
        } else {
            db_execute(
                "INSERT INTO materials(code, title, description, content) VALUES(?, ?, ?, ?)",
                "ssss",
                [$code, $title, $description, $content]
            );
            flash("Material added successfully.");
        }

        redirect_to("subject-materials.php");
    }

    if ($action === "delete_material") {
        $id = (int) ($_POST["id"] ?? 0);

        if ($id > 0) {
            db_execute("DELETE FROM materials WHERE id = ?", "i", [$id]);
            flash("Material deleted.");
        }

        redirect_to("subject-materials.php");
    }
}

$editId = (int) ($_GET["edit"] ?? 0);
$editing = $editId > 0 ? db_one("SELECT * FROM materials WHERE id = ?", "i", [$editId]) : null;
$materials = db_all("SELECT * FROM materials ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpark Subject Materials</title>
    <link rel="stylesheet" href="duodash.css">
</head>
<body>
    <div class="dashboard-shell">
        <?php render_nav("materials"); ?>

        <main class="dashboard page-layout">
            <?php render_flash(); ?>

            <header class="page-hero">
                <p class="eyebrow">Learning Resources</p>
                <h1>View Subject Materials</h1>
                <p>Add, read, update, and delete course materials from the database.</p>
            </header>

            <section class="crud-panel" aria-labelledby="material-form-heading">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Material manager</p>
                        <h2 id="material-form-heading"><?php echo $editing ? "Edit Material" : "Add Material"; ?></h2>
                    </div>
                    <?php if ($editing): ?>
                        <a href="subject-materials.php">Cancel edit</a>
                    <?php endif; ?>
                </div>

                <form class="form-grid" action="subject-materials.php" method="post">
                    <input type="hidden" name="action" value="save_material">
                    <input type="hidden" name="id" value="<?php echo h($editing["id"] ?? 0); ?>">

                    <label>
                        Code
                        <input class="input-field" type="text" name="code" value="<?php echo h($editing["code"] ?? ""); ?>" required>
                    </label>
                    <label>
                        Title
                        <input class="input-field" type="text" name="title" value="<?php echo h($editing["title"] ?? ""); ?>" required>
                    </label>
                    <label class="wide-field">
                        Description
                        <textarea class="input-field" name="description" rows="3" required><?php echo h($editing["description"] ?? ""); ?></textarea>
                    </label>
                    <label class="wide-field">
                        Content
                        <textarea class="input-field" name="content" rows="5" required><?php echo h($editing["content"] ?? ""); ?></textarea>
                    </label>

                    <button class="primary-button form-button" type="submit">
                        <?php echo $editing ? "Save changes" : "Add material"; ?>
                    </button>
                </form>
            </section>

            <section class="resource-grid" aria-label="Subject materials">
                <?php foreach ($materials as $index => $material): ?>
                    <article class="resource-card <?php echo $index === 0 ? "featured" : ""; ?>">
                        <span class="resource-code"><?php echo h($material["code"]); ?></span>
                        <h2><?php echo h($material["title"]); ?></h2>
                        <p><?php echo h($material["description"]); ?></p>
                        <p><?php echo h($material["content"]); ?></p>
                        <div class="action-row">
                            <a class="secondary-button" href="subject-materials.php?edit=<?php echo h($material["id"]); ?>">Edit</a>
                            <form class="inline-form" action="subject-materials.php" method="post">
                                <input type="hidden" name="action" value="delete_material">
                                <input type="hidden" name="id" value="<?php echo h($material["id"]); ?>">
                                <button class="danger-button" type="submit">Delete</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>
</html>
