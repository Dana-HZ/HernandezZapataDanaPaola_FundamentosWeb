<?php

require "db.php";

if(!isset($_POST["name"]) || !isset($_POST["price"]) || !isset($_POST["id"]) || !isset($_FILES['image']))
    {
        header("Location: adminProducts.php");
        return;

    }

$name = $_POST["name"];
$price = $_POST["price"];
$id = $_POST["id"];

$imageName = $_FILES['image']['name'];
$type = $_FILES['image']['type'];
$path = $_FILES['image']['tmp_name'];

if(!strpos($type, "jpeg") && !strpos($type, "png") && !strpos($type, "gif") && !strpos($type, "jpg"))
    {
        header("Location: adminProducts.php?error=Imagen invalida");
        return;        
    }


$sql = "UPDATE products SET name='$name', price=$price, image='$imageName' WHERE id=$id";

try{
    mysqli_query($conn, $sql);
    move_uploaded_file($path, "./images/$imageName");
    
    header("Location: adminProducts.php");

}catch(Exception $e){
    header("Location: adminProducts.php?error=" . $e->getMessage());
    return;
}

?>
