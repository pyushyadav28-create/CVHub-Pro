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
    header("Location: ../projects.php");
    exit();
}

$userId = $_SESSION['user_id'];
$id = $_GET['id'];

// Get project image
$stmt = $pdo->prepare("SELECT image FROM projects WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

$project = $stmt->fetch();

if (!$project) {
    die("Project not found.");
}

// Delete image file
if (!empty($project['image'])) {

    $imagePath = "../assets/uploads/projects/" . $project['image'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// Delete project
$stmt = $pdo->prepare("DELETE FROM projects WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

header("Location: ../projects.php");
exit();