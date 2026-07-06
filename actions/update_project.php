<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../projects.php");
    exit();
}

$userId = $_SESSION['user_id'];

$id = $_POST['id'];
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$technologies = trim($_POST['technologies']);
$github = trim($_POST['github']);
$live_demo = trim($_POST['live_demo']);

// Get current image
$stmt = $pdo->prepare("SELECT image FROM projects WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);
$currentProject = $stmt->fetch();

if (!$currentProject) {
    die("Project not found.");
}

$imageName = $currentProject['image'];

// Upload new image if selected
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($extension, $allowed)) {

        $imageName = time() . "_" . basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/uploads/projects/" . $imageName
        );
    }
}

// Update database
$sql = "UPDATE projects
SET
title = ?,
description = ?,
technologies = ?,
github_link = ?,
live_demo = ?,
image = ?
WHERE id = ? AND user_id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $title,
    $description,
    $technologies,
    $github,
    $live_demo,
    $imageName,
    $id,
    $userId
]);

header("Location: ../projects.php");
exit();