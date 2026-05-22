<?php
    require "db.php";
    session_start();

    if(!isset($_POST["username"]) || !isset($_POST["password"]))
    {
        header("Location: login.php?error=Login incorrecto");
        return;

    }

    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT COUNT(*) as login, role FROM users WHERE username='$username' AND password='$password'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);

    //Registro
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //Validar
    password_verify($password, $hash);

    if($result['login'] > 0){
        //login exitoso
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $result['role'];
        header("Location: home.php");

    } else {
        //login incorrecto
        header("Location: login.php?error=Login incorrecto");
        return;

    }




?>