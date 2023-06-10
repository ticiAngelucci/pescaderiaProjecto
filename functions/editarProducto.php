<?php 
include("functions/conection.php");

if(isset($_POST['editarProducto'])){
    if(
        strlen($_POST['nombre'])>= 1 &&
        strlen($_POST['descripcion'])>= 1 &&
        strlen($_POST['id_categoria'])>= 1 &&
        strlen($_POST['precio_por_gramo'])>= 1 &&
        strlen($_POST['id_estado_producto'])>= 1 &&
        strlen($_POST['cantidad_disponible'])>= 1
        
        ){
            $nombre=trim($_POST['nombre']);
            $descripcion=trim($_POST['descripcion']);
            $id_categoria=trim($_POST['id_categoria']);
            $precio_por_gramo=trim($_POST['precio_por_gramo']);
            $id_estado_producto=trim($_POST['id_estado_producto']);
            $cantidad_disponible=trim($_POST['cantidad_disponible']);
            $consulta="UPDATE productos SET nombre = '$nombre' or descripcion = '$descripcion' or id_categoria = '$id_categoria' or precio_por_gramo = '$precio_por_gramo' or id_estado_producto = '$id_estado_producto' or cantidad_disponible = '$cantidad_disponible'
             WHERE id_producto = '$id_producto'";            
            $resultado=mysqli_query($conexion,$consulta);   
            if ($resultado) {
                echo '<div class="alert alert-success alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        El cambio se ha completado con éxito.
                      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mt-3 mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        Ha ocurrido un error en la edicion.
                      </div>';
            }
            
            
}
}
?>