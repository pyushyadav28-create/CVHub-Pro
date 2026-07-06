<?php

require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic Validation
    if (empty($full_name) || empty($email) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Check if email already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        die("Email already exists.");
    }

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert User
    $stmt = $pdo->prepare("
        INSERT INTO users (full_name, email, password)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $full_name,
        $email,
        $hashedPassword
    ]);

    header("Location: ../login.php?registered=1");
    exit();
}