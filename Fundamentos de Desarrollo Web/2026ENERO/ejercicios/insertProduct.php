<?php

require "db.php";

if(!isset($_POST["name"]) || !isset($_POST["price"]) || !isset($_FILES['image']))
    {
        header("Location: adminProducts.php?error=Datos incompletos");
        return;

    }


$name = $_POST["name"];
$price = $_POST["price"];

$imageName = $_FILES['image']['name'];
$type = $_FILES['image']['type'];
$path = $_FILES['image']['tmp_name'];

if(!strpos($type, "jpeg") && !strpos($type, "png") && !strpos($type, "gif") && !strpos($type, "jpg"))
    {
        header("Location: adminProducts.php?error=Imagen invalida");
        return;        
    }


//$sql = "INSERT INTO products(name, price, image) VALUES('$name', $price, '$imageName')";

$stmt = $conn->prepare(
    "INSERT INTO products(name, price, image) VALUES(?, ?, ?)"    
);

$stmt->blind_param("sds", $name, $price, $imageName);

try{
    //mysqli_query($conn, $sql);
    $stmt->execute();

    move_uploaded_file($path, "./images/$imageName");
    header("Location: adminProducts.php");

}catch(Exception $e){
    header("Location: adminProducts.php?error=" . $e->getMessage());
    return;
}

?>