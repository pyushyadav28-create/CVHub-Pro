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
    header("Location: ../education.php");
    exit();
}

$userId = $_SESSION['user_id'];

$id = $_POST['id'];
$institution = trim($_POST['institution']);
$degree = trim($_POST['degree']);
$field = trim($_POST['field_of_study']);
$start = $_POST['start_year'];
$end = !empty($_POST['end_year']) ? $_POST['end_year'] : NULL;
$grade = trim($_POST['grade']);
$description = trim($_POST['description']);

$sql = "UPDATE education SET
institution = ?,
degree = ?,
field_of_study = ?,
start_year = ?,
end_year = ?,
grade = ?,
description = ?
WHERE id = ? AND user_id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $institution,
    $degree,
    $field,
    $start,
    $end,
    $grade,
    $description,
    $id,
    $userId
]);

header("Location: ../education.php");
exit();