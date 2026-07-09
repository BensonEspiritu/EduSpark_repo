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
    <title>Create Account - EduSpark</title>

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

            <h2><span class="create-text">Create</span> Account</h2>
            <p>Join EduSpark and start learning today.</p>

            <form action="register_process.php" method="POST">

                <div class="input-group">
                    <label>Full Name</label>

                    <div class="input-box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="fullname" placeholder="Full Name" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Username</label>

                    <div class="input-box">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                </div>

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
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <button type="submit">Create Account</button>

            </form>

            <div class="login">
                Already have an account?
                <a href="login.php">Sign In</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
