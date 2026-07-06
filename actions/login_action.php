<?php

session_start();

require_once '../config/database.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);

$user = $stmt->fetch();

if($user && password_verify($password,$user['password'])){

    $_SESSION['user_id']=$user['id'];
    $_SESSION['user_name']=$user['full_name'];

    header("Location: ../dashboard.php");
    exit();

}else{

    header("Location: ../login.php?error=1");
    exit();

}