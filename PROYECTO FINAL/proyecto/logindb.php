<?php
require "db.php";
session_start();

if(!isset($_POST['email']) || !isset($_POST['password'])){
    header("Location: login.php?error=Completa todos los campos");
    return;
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result);

if($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if($user['role'] == 'admin'){
        header("Location: admin/adminProducts.php");
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: login.php?error=Datos incorrectos");
}
?>