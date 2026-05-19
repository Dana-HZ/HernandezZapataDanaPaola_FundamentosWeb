<?php
require "../db.php";
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    return;
}

if(!isset($_GET['id'])){
    header("Location: adminProducts.php?error=Id invalido");
    return;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);

try{
    $stmt->execute();
    header("Location: adminProducts.php");
}catch(Exception $e){
    header("Location: adminProducts.php?error=" . $e->getMessage());
    return;
}
?>