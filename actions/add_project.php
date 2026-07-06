<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../projects.php");
    exit();
}

require_once "../config/database.php";

$userId = $_SESSION['user_id'];

// Get form data safely
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$technologies = trim($_POST['technologies'] ?? '');
$github = trim($_POST['github'] ?? '');
$live_demo = trim($_POST['live_demo'] ?? '');

$imageName = "";

// Upload image
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

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

// Save project
$sql = "INSERT INTO projects
(user_id, title, description, technologies, github_link, live_demo, image)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $userId,
    $title,
    $description,
    $technologies,
    $github,
    $live_demo,
    $imageName
]);

header("Location: ../projects.php");
exit();