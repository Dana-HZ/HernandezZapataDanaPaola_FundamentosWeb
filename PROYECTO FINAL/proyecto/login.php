<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
<div class="logo"><b>IM JUST A GIRL BAZAR</b></div>
</header>

<section class="active login-section">
<div class="form">
<h2>Iniciar Sesión</h2>

<form action="logindb.php" method="POST">
<input name="email" placeholder="Correo">
<input name="password" type="password" placeholder="Contraseña">
<button type="submit">Iniciar sesión</button>
</form>

<p onclick="window.location.href='register.php'">¿No tienes cuenta? Regístrate</p>

<?php
if(isset($_GET['error'])){
    echo "<span class='error'>".$_GET['error']."</span>";
}
?>
</div>
</section>

</body>
</html>