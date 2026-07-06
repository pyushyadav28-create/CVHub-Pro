<?php

session_start();

require_once '../config/database.php';

$stmt = $pdo->prepare("

UPDATE users

SET

full_name=?,
phone=?,
location=?,
job_title=?,
github=?,
linkedin=?,
website=?,
bio=?

WHERE id=?

");

$stmt->execute([

$_POST['full_name'],
$_POST['phone'],
$_POST['location'],
$_POST['job_title'],
$_POST['github'],
$_POST['linkedin'],
$_POST['website'],
$_POST['bio'],

$_SESSION['user_id']

]);

$_SESSION['user_name'] = $_POST['full_name'];

header("Location: ../profile.php?updated=1");
exit();