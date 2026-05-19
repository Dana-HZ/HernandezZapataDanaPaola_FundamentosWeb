<?php
require "../db.php";
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    return;
}

if(!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['price'])){
    header("Location: adminProducts.php?error=Datos incompletos");
    return;
}

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

if($name == "" || $price == ""){
    header("Location: adminProducts.php?error=Completa todos los campos");
    return;
}

$imageName = $_FILES['image']['name'];
$type = $_FILES['image']['type'];
$path = $_FILES['image']['tmp_name'];

try{

    if($imageName != ""){

        if(!strpos($type, "jpeg") && !strpos($type, "png") && !strpos($type, "gif") && !strpos($type, "jpg")){
            header("Location: adminProducts.php?error=Imagen invalida");
            return;
        }

        $stmt = $conn->prepare(
            "UPDATE products SET name=?, price=?, image=? WHERE id=?"
        );

        $stmt->bind_param("sdsi", $name, $price, $imageName, $id);
        $stmt->execute();

        move_uploaded_file($path, "../images/$imageName");

    }else{

        $stmt = $conn->prepare(
            "UPDATE products SET name=?, price=? WHERE id=?"
        );

        $stmt->bind_param("sdi", $name, $price, $id);
        $stmt->execute();
    }

    header("Location: adminProducts.php");

}catch(Exception $e){
    header("Location: adminProducts.php?error=" . $e->getMessage());
    return;
}
?>