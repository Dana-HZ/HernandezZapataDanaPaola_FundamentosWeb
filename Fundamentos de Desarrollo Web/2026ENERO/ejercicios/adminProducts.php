<?php 

require "db.php";

session_start();

if(isset($_SESSION['username']))
    {
        $username =  $_SESSION['username'];
        $role =  $_SESSION['role'];

        if($role != 'admin')
            {
                header("Location: home.php");
                return;
            }

    }else
    {
        header("Location: login.php?error=Inicia sesión");
        return;
    }



$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

//$products = mysqli_fetch_array($results);
//var_dump($products);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1 class="title">Crear producto</h1>

    <form action="./insertProduct.php" method="POST" enctype="multipart/form-data">
        <label for="name"> Nombre </label>
        <input type="text" id="name" name="name">
        <label for="price"> Price </label>
        <input type="number" id="price" name="price">

        <label for="image"> Imagen </label>
        <input type="file" id="image" name="image">

        <button type="submit"> Crear </button>

        <?php

        if(isset($_GET['error']))
            {
                echo "<span> Error: " . $_GET['error'] . "</span>";

            }

        ?>

    </form>




    <h1 class="title">Administrar productos</h1>
    <div class="products-container">

        <?php
            while($product = mysqli_fetch_array($result)){

        ?>

        <div class="product-item">   
            
            <img src="./images/<?php echo $product['image']?>" alt="Imagen del producto">
            <p class="product-title"> <?php echo $product['name'] ?> </p>
            <p class="product-price"> <?php echo "$" . number_format($product['price'], 2, ".") ?> </p>

            <button onclick="window.location.href='editProduct.php?id=<?php echo $product['id']?> '"> Editar </button>
            <button onclick="window.location.href='deleteProduct.php?id=<?php echo $product['id']?> '"> Eliminar </button>

        </div>    
        
        <?php
        }
        ?>

    </div>

    <a href="logoutdb.php">Cerrar sesión</a>


</body>
</html>