<?php session_start();
 include('conection.php');
if(isset($_SESSION['carrito'])){
    $carrito_mio=$_SESSION['carrito'];
    if(isset($_POST['nombre'])){
        //precio_por_gramo
        //cantidad_disponible
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio_por_gramo'];
        $cantidad=$_POST['cantidad_disponible'];
        $num=0;
        $carrito_mio[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);

    }else{
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio_por_gramo'];
        $cantidad=$_POST['cantidad_disponible'];
        $carrito_mio[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
    }


    $_SESSION['carrito']=$carrito_mio;

}
header("Location" .$SERVER['HTTP_REFERER']);





?>