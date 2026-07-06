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

$institution = trim($_POST['institution']);
$degree = trim($_POST['degree']);
$field = trim($_POST['field_of_study']);
$start = $_POST['start_year'];
$end = !empty($_POST['end_year']) ? $_POST['end_year'] : NULL;
$grade = trim($_POST['grade']);
$description = trim($_POST['description']);

$sql = "INSERT INTO education
(user_id, institution, degree, field_of_study, start_year, end_year, grade, description)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $userId,
    $institution,
    $degree,
    $field,
    $start,
    $end,
    $grade,
    $description
]);

header("Location: ../education.php");
exit();