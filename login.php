<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        echo "<script>alert('نام کاربری یا رمز عبور اشتباه است! لطفاً دوباره امتحان کنید.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود کاربران</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>فرم ورود</h1></header>
    <main>
        <form method="post">
            <label for="username">نام کاربری</label>
            <input type="text" id="username" name="username" required>

            <label for="password">رمز عبور</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">ورود</button>
        </form>
    </main>
</body>
</html>
