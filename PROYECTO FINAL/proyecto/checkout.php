<?php
require "db.php";
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'client'){
    header("Location: login.php");
    return;
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if(count($cart) == 0){
    header("Location: index.php?page=cart");
    return;
}

$total = 0;

foreach($cart as $id){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $p = mysqli_fetch_array($result);
    if($p){
        $total += $p['price'];
    }
}

$user_id = $_SESSION['id'];
$tracking = rand(10000, 99999);

mysqli_query($conn, "INSERT INTO orders(user_id,total,tracking)
VALUES($user_id,$total,$tracking)");

$order_id = mysqli_insert_id($conn);

foreach($cart as $id){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $p = mysqli_fetch_array($result);

    if($p){
        $name = $p['name'];
        $price = $p['price'];
        $image = $p['image'];

        mysqli_query($conn, "INSERT INTO order_items(order_id,product_id,name,price,image)
        VALUES($order_id,$id,'$name',$price,'$image')");
    }
}

$_SESSION['cart'] = [];

header("Location: index.php?page=profile&msg=Compra exitosa");
?>