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

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$p = mysqli_fetch_array($result);

if(!$p){
    header("Location: adminProducts.php?error=Producto no encontrado");
    return;
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<header>
<div class="logo"><b>IM JUST A GIRL BAZAR</b></div>
<nav>
<a href="adminProducts.php">ADMIN</a>
<a href="../logout.php">SALIR</a>
</nav>
</header>

<section class="active login-section">
<div class="form">
<h2>Editar producto</h2>

<form action="updateProduct.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $p['id']; ?>">
<input name="name" value="<?php echo $p['name']; ?>">
<input name="price" type="number" value="<?php echo $p['price']; ?>">
<input type="file" name="image">
<button type="submit">Actualizar</button>
</form>
</div>
</section>

</body>
</html>