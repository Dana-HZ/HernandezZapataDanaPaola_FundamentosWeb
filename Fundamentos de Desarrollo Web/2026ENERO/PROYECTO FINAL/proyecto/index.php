<?php
require "db.php";
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php?error=Inicia sesión");
    return;
}

if($_SESSION['role'] == 'admin'){
    header("Location: admin/adminProducts.php");
    return;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Bazar</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
<div class="logo"><b>IM JUST A GIRL BAZAR</b></div>
<nav>
<a href="index.php?page=home">HOME</a>
<a href="index.php?page=catalog">CATÁLOGO</a>
<a href="index.php?page=profile">PERFIL</a>
<a href="index.php?page=cart">CARRITO</a>
<a href="logout.php">SALIR</a>
</nav>
</header>

<?php if($page == 'home'){ ?>

<section class="active">
<div class="hero">
<div class="hero-text">
<h1>Im just a <br><i>girl</i></h1>
<div class="buttons">
<button onclick="window.location.href='index.php?page=catalog'">DISPONIBLES</button>
</div>
</div>

<div class="home-grid">
<?php
$result = mysqli_query($conn, "SELECT * FROM products LIMIT 4");
while($p = mysqli_fetch_array($result)){
?>
<div class="card">
<img src="images/<?php echo $p['image']; ?>">
<h3><?php echo $p['name']; ?></h3>
<p>$<?php echo $p['price']; ?></p>
</div>
<?php } ?>
</div>
</div>
</section>

<?php } ?>

<?php if($page == 'catalog'){ ?>

<section class="active">
<h2>Catálogo completo</h2>
<div class="catalog-grid">

<?php
$result = mysqli_query($conn, "SELECT * FROM products");
while($p = mysqli_fetch_array($result)){
?>
<div class="card">
<img src="images/<?php echo $p['image']; ?>">
<h3><?php echo $p['name']; ?></h3>
<p>$<?php echo $p['price']; ?></p>
<a href="addCart.php?id=<?php echo $p['id']; ?>">
<button>Agregar</button>
</a>
</div>
<?php } ?>

</div>
</section>

<?php } ?>

<?php if($page == 'cart'){ ?>

<section class="active">
<h2>Carrito</h2>

<div id="cartItems">
<?php
$total = 0;
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

foreach($cart as $index => $id){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $p = mysqli_fetch_array($result);

    if($p){
        $total += $p['price'];
?>
<div class="card cart-card">
<div class="cart-info">
<img src="images/<?php echo $p['image']; ?>">
<div>
<p><b><?php echo $p['name']; ?></b></p>
<p>$<?php echo $p['price']; ?></p>
</div>
</div>

<a href="removeCart.php?index=<?php echo $index; ?>">
<button>Eliminar</button>
</a>
</div>
<?php }} ?>
</div>

<h3>Total $<?php echo $total; ?></h3>

<?php if($total > 0){ ?>
<a href="checkout.php">
<button>Pagar</button>
</a>
<?php } ?>

</section>

<?php } ?>

<?php if($page == 'profile'){ ?>

<section class="active">
<h2>Perfil</h2>
<p><?php echo $_SESSION['username']; ?></p>

<h3>Mis pedidos</h3>

<div id="orders">
<?php
$user_id = $_SESSION['id'];
$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=$user_id");

while($order = mysqli_fetch_array($orders)){
?>
<div class="card">
<p><b>Pedido #<?php echo $order['id']; ?></b></p>
<p>Rastreo: <?php echo $order['tracking']; ?></p>

<?php
$order_id = $order['id'];
$items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id=$order_id");

while($item = mysqli_fetch_array($items)){
?>
<div class="order-item">
<img src="images/<?php echo $item['image']; ?>">
<span><?php echo $item['name']; ?> - $<?php echo $item['price']; ?></span>
</div>
<?php } ?>

<p><b>Total: $<?php echo $order['total']; ?></b></p>
</div>
<?php } ?>
</div>
</section>

<?php } ?>

<div id="toast"></div>
<script src="script.js"></script>

<?php if(isset($_GET['msg'])){ ?>
<script>
showToast("<?php echo $_GET['msg']; ?>");
</script>
<?php } ?>

</body>
</html>