<?php
require_once 'model/Users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $userModel = new Users();
    $userModel->registerUser($username, $password, $email);

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Sign Up</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
