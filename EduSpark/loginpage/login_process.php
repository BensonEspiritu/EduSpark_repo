<?php
session_start();
include "database.php";

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    echo "<script>
        alert('Please enter your email and password.');
        window.location.href='login.php';
    </script>";
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT id, fullname, username, email, password FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["fullname"] = $user["fullname"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];

    header("Location: ../account-dashboard.php");
    exit();
}

echo "<script>
    alert('Invalid email or password.');
    window.location.href='login.php';
</script>";
exit();
?>
