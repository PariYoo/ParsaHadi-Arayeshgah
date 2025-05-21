<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $username = htmlspecialchars($username);

    // بررسی اینکه آیا نام کاربری قبلاً ثبت شده
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        echo "<script>alert('این نام کاربری قبلاً ثبت شده است. لطفاً وارد شوید!'); window.location.href='login.php';</script>";
        exit;
    } else {
        // رمزگذاری پسورد
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashed_password])) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            echo "<script>alert('خطا در ثبت‌نام! لطفاً دوباره تلاش کنید.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>فرم ثبت‌نام</h1></header>
    <main>
        <form method="post">
            <label for="username">نام کاربری</label>
            <input type="text" id="username" name="username" required>

            <label for="password">رمز عبور</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">ثبت‌نام</button>
        </form>
    </main>
</body>
</html>
