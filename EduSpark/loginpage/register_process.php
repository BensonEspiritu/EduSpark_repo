<?php
include "database.php";

$fullname = trim($_POST['fullname'] ?? "");
$username = trim($_POST['username'] ?? "");
$email = trim($_POST['email'] ?? "");
$plainPassword = $_POST['password'] ?? "";
$password = password_hash($plainPassword, PASSWORD_DEFAULT);

if ($fullname === "" || $username === "" || $email === "" || $plainPassword === "") {
    echo "<script>
        alert('Please complete all fields.');
        window.location.href='register.php';
    </script>";
    exit();
}

/* Check Username */
$checkUsername = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
mysqli_stmt_bind_param($checkUsername, "s", $username);
mysqli_stmt_execute($checkUsername);
$usernameResult = mysqli_stmt_get_result($checkUsername);

if (mysqli_num_rows($usernameResult) > 0) {

    echo "<script>
        alert('Username is already taken. Please choose another username.');
        window.location.href='register.php';
    </script>";
    exit();
}

/* Check Email */
$checkEmail = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($checkEmail, "s", $email);
mysqli_stmt_execute($checkEmail);
$emailResult = mysqli_stmt_get_result($checkEmail);

if (mysqli_num_rows($emailResult) > 0) {

    echo "<script>
        alert('Email is already registered. Please use another email.');
        window.location.href='register.php';
    </script>";
    exit();
}

/* Insert User */
$insertUser = mysqli_prepare(
    $conn,
    "INSERT INTO users(fullname, username, email, password) VALUES(?, ?, ?, ?)"
);
mysqli_stmt_bind_param($insertUser, "ssss", $fullname, $username, $email, $password);

if (mysqli_stmt_execute($insertUser)) {

    echo "<script>
        alert('Account created successfully!');
        window.location.href='login.php';
    </script>";

} else {

    echo "<script>
        alert('Registration failed.');
        window.location.href='register.php';
    </script>";

}

mysqli_close($conn);
?>
