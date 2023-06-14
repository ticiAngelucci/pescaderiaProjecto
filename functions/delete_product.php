<?php
session_start();

// Verificar si se ha enviado la clave del producto a eliminar
if (isset($_POST['key'])) {
    $key = $_POST['key'];

    // Verificar si existe una sesión de carrito y si la clave del producto existe en el carrito
    if (isset($_SESSION['carrito']) && isset($_SESSION['carrito'][$key])) {
        // Eliminar el producto del carrito utilizando la clave
        unset($_SESSION['carrito'][$key]);

        // Actualizar el número de productos en el carrito
        $cartCount = count($_SESSION['carrito']);

        // Devolver "success" como respuesta cuando se elimina el producto del carrito
        echo 'success';
    }
}
?>