<?php
require "../db.php";
session_start();

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    return;
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Admin</title>
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

<section class="active">
<h2>Agregar producto</h2>

<div class="form admin-form">
<form action="insertProduct.php" method="POST" enctype="multipart/form-data">
<input name="name" placeholder="Nombre">
<input name="price" type="number" placeholder="Precio">
<input type="file" name="image">
<button type="submit">Agregar</button>
</form>
</div>

<h2>Catálogo administrador</h2>

<div class="catalog-grid">
<?php while($p = mysqli_fetch_array($result)){ ?>
<div class="card">
<img src="../images/<?php echo $p['image']; ?>">
<h3><?php echo $p['name']; ?></h3>
<p>$<?php echo $p['price']; ?></p>

<a href="editProduct.php?id=<?php echo $p['id']; ?>">
<button>Editar</button>
</a>

<a href="deleteProduct.php?id=<?php echo $p['id']; ?>">
<button>Eliminar</button>
</a>
</div>
<?php } ?>
</div>
</section>

</body>
</html>