<?php

require "db.php";

if (!isset($_GET["id"])) {
    header("Location: adminProducts.php");
    return;
}

$id = $_GET["id"];

$sql = "DELETE FROM products WHERE id = $id";

try {
    mysqli_query($conn, $sql);
    header("Location: adminProducts.php");
} catch (Exception $e) {
    header("Location: adminProducts.php?error=" . $e->getMessage());
    return;
}

?>