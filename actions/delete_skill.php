<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../config/database.php";

if (!isset($_GET['id'])) {
    header("Location: ../skills.php");
    exit();
}

$id = $_GET['id'];
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("DELETE FROM skills WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

header("Location: ../skills.php");
exit();