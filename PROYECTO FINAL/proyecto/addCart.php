<?php
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'client'){
    header("Location: login.php");
    return;
}

if(!isset($_GET['id'])){
    header("Location: index.php?page=catalog");
    return;
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = $_GET['id'];

header("Location: index.php?page=catalog&msg=Producto agregado al carrito");
?>