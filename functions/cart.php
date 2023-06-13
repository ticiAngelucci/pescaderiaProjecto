<?php
    session_start();
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    include("functions/conection.php");
    
// Función para obtener un producto por su ID
function obtenerProductoPorId($idProducto) {
global $conexion;

// Escapar el ID del producto para evitar inyección de SQL
$idProducto = mysqli_real_escape_string($conexion, $idProducto);

// Ejecutar la consulta
$sql = "SELECT * FROM productos WHERE id_producto = $idProducto";
$resultado = $conexion->query($sql);

// Verificar si se obtuvo un resultado
if ($resultado && $resultado->num_rows > 0) {
$producto = $resultado->fetch_assoc(); // Obtener el primer resultado como un array asociativo
return $producto;
}

return null; // Si no se encuentra el producto, devolver null o algún valor apropiado
}

// Función para agregar un producto al carrito
function agregarProductoAlCarrito($idProducto, $cantidad) {
// Obtener el producto seleccionado utilizando el ID
$producto = obtenerProductoPorId($idProducto);

// Verificar si el producto existe en el carrito
if (isset($_SESSION['carrito'][$idProducto])) {
// Si el producto ya está en el carrito, incrementar la cantidad seleccionada
$_SESSION['carrito'][$idProducto]['cantidad_disponible'] += $cantidad;
} else {
// Si el producto no está en el carrito, agregarlo con la cantidad seleccionada
$producto['cantidad_disponible'] = $cantidad;
$_SESSION['carrito'][$idProducto] = $producto;
}

// Mostrar una notificación o mensaje de confirmación
echo '<script>
alert("El producto se ha agregado al carrito");
</script>';
}


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Verificar si se ha presionado el botón "Agregar"
if (isset($_POST['accionBoton']) && $_POST['accionBoton'] === 'Agregar') {
// Obtener el ID del producto y la cantidad desde el formulario
$idProducto = $_POST['id_producto'];
$cantidad = $_POST['cantidad_disponible'];

// Agregar el producto al carrito
agregarProductoAlCarrito($idProducto, $cantidad);
}
}
?>