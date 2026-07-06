<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../config/database.php";

$userId = $_SESSION['user_id'];

$current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if ($new !== $confirm) {
    header("Location: ../settings.php?error=1");
    exit();
}

$stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user || !password_verify($current, $user['password'])) {
    header("Location: ../settings.php?error=1");
    exit();
}

$hashedPassword = password_hash($new, PASSWORD_DEFAULT);

$update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$update->execute([$hashedPassword, $userId]);

header("Location: ../settings.php?success=1");
exit();