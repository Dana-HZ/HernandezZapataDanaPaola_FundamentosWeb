<?php
require "db.php";

if(!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])){
    header("Location: register.php?error=Completa todos los campos");
    return;
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = "client";

$sql = "INSERT INTO users(username,email,password,role)
        VALUES('$username','$email','$password','$role')";

mysqli_query($conn, $sql);

header("Location: login.php");
?>