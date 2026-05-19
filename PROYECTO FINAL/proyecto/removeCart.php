<?php
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'client'){
    header("Location: login.php");
    return;
}

$index = $_GET['index'];

if(isset($_SESSION['cart'][$index])){
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

header("Location: index.php?page=cart&msg=Producto eliminado");
?>