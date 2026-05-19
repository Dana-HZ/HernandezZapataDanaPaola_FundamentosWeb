<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
<div class="logo"><b>IM JUST A GIRL BAZAR</b></div>
</header>

<section class="active login-section">
<div class="form">
<h2>Registro</h2>

<form action="registerdb.php" method="POST">
<input name="username" placeholder="Nombre">
<input name="email" placeholder="Correo">
<input name="password" type="password" placeholder="Contraseña">
<button type="submit">Crear cuenta</button>
</form>

<p onclick="window.location.href='login.php'">¿Ya tienes cuenta? Inicia sesión</p>

<?php
if(isset($_GET['error'])){
    echo "<span class='error'>".$_GET['error']."</span>";
}
?>
</div>
</section>

</body>
</html>