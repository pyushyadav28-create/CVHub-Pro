<?php

session_start();
require_once '../config/database.php';

$stmt = $pdo->prepare("
DELETE FROM education
WHERE id=? AND user_id=?
");

$stmt->execute([
$_GET['id'],
$_SESSION['user_id']
]);

header("Location: ../education.php");
exit();