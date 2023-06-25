<?php
include("functions/conection.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array(); // Inicializar como un arreglo vacío
}

function obtenerProductoPorId($idProducto) {
    global $conexion;
    $idProducto = mysqli_real_escape_string($conexion, $idProducto);
    $sql = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
        return $producto;
    }

    return null;
}

function agregarProductoAlCarrito($idProducto, $cantidad) {
    global $conexion;
    $producto = obtenerProductoPorId($idProducto);

    if ($producto) {
        $encontrado = false;
        foreach ($_SESSION['carrito'] as $indice => $item) {
            if ($item['id_producto'] == $idProducto) {
                $_SESSION['carrito'][$indice]['cantidad_disponible'] += $cantidad;
                $encontrado = true;
                break;
            }
        }

        if (!$encontrado) {
            $producto['cantidad_disponible'] = $cantidad;
            $_SESSION['carrito'][] = $producto;
        }

        echo '<script>alert("El producto seleccionado se ha agregado");</script>';
        header('Location: inicio.php ');
        exit();
    } else {
        echo '<script>alert("El producto seleccionado no existe");</script>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accionBoton']) && $_POST['accionBoton'] === 'Agregar') {
        $idProducto = mysqli_real_escape_string($conexion, $_POST['id_producto']);
        $cantidad = intval($_POST['cantidad_disponible']);
        agregarProductoAlCarrito($idProducto, $cantidad);
    }
}
?>