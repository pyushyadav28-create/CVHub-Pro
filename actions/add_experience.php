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

$company = trim($_POST['company']);
$job_title = trim($_POST['job_title']);
$employment_type = trim($_POST['employment_type']);
$location = trim($_POST['location']);
$start_date = $_POST['start_date'];
$end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;
$description = trim($_POST['description']);

$sql = "INSERT INTO experience
(user_id, company, job_title, employment_type, location, start_date, end_date, description)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $userId,
    $company,
    $job_title,
    $employment_type,
    $location,
    $start_date,
    $end_date,
    $description
]);

header("Location: ../experience.php");
exit();