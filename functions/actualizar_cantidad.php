<?php
include("functions/conection.php");
include("functions/cart.php");

if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    $indice = $_GET['indice'];
    $cantidad = $_GET['cantidad'];

    if (is_numeric($indice) && is_numeric($cantidad)) {
        $indice = intval($indice);
        $cantidad = intval($cantidad);

        if (isset($_SESSION['carrito'][$indice])) {
            $_SESSION['carrito'][$indice]['cantidad_disponible'] = $cantidad;
            $precioTotal = $_SESSION['carrito'][$indice]['precio_por_gramo'] * $cantidad;
            echo number_format($precioTotal, 2);
        }
    }
}
?>