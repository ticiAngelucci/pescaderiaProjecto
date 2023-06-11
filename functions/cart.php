<?php

include("functions/conection.php");
/* // Verificar si la variable de sesión del carrito no está definida y crearla
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}
     */
// Función para obtener un producto por su ID (ejemplo básico)

function obtenerProductoPorId($idProducto) {
    global $conexion; // Acceder a la conexión establecida anteriormente

    // Ejecutar la consulta
    $sql = "SELECT * FROM productos WHERE id_producto = $idProducto";
    $resultado = $conexion->query($sql);

    // Verificar si se obtuvo un resultado
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc(); // Obtener el primer resultado como un array asociativo
        return $producto;
    }

    return null; // Si no se encuentra el producto, devolver null o algún valor apropiado
}


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha presionado el botón "Agregar"
    if ($_POST['accionBoton'] === 'Agregar') {
        // Obtener el ID del producto desde el formulario
        $idProducto = $_POST['id_producto'];

        // Obtener el producto seleccionado utilizando el ID
        $producto = obtenerProductoPorId($idProducto);

        // Agregar el producto al carrito (variable de sesión)
        $_SESSION['carrito'][] = $producto;

        // Mostrar una notificación o mensaje de confirmación
        echo '<script>alert("El producto se ha agregado al carrito");</script>';
    }
}
?>