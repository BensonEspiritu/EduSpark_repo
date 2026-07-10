<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: ../account-dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EduSpark Login</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <img src="image.png" alt="EduSpark">
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <div class="form-box">

            <h2><span class="create-text">Welcome</span> Back</h2>
            <p>Log in to your EduSpark account.</p>
            <p>Sign in to continue.</p>

            <form action="login_process.php" method="POST">

                <div class="input-group">
                    <label>Email</label>

                    <div class="input-box">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" placeholder="name@example.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>

                    <div class="input-box">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="********" required>
                    </div>
                </div>

                <button type="submit">Sign In</button>

            </form>

            <div class="login">
                Don't have an account?
                <a href="register.php">Sign Up</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
