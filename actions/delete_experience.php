<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? null;
$userId = $_SESSION['user_id'];

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM experience WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
}

header("Location: ../experience.php");
exit();