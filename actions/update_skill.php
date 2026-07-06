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

$id = $_POST['id'];
$skillName = trim($_POST['skill_name']);
$skillLevel = trim($_POST['skill_level']);
$category = trim($_POST['category']);

$sql = "UPDATE skills
        SET
            skill_name = ?,
            skill_level = ?,
            category = ?
        WHERE id = ? AND user_id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $skillName,
    $skillLevel,
    $category,
    $id,
    $userId
]);

header("Location: ../skills.php");
exit();