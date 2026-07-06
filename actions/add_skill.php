<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../skills.php");
    exit();
}

$userId = $_SESSION['user_id'];

$skillName = trim($_POST['skill_name']);
$skillLevel = trim($_POST['skill_level']);
$category = trim($_POST['category']);

$sql = "INSERT INTO skills (user_id, skill_name, skill_level, category)
        VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $userId,
    $skillName,
    $skillLevel,
    $category
]);

header("Location: ../skills.php");
exit();