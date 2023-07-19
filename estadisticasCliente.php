<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location:login.php");
    exit();
}
include('components/navbar.php');
include('functions/conection.php');
  ?>
 <?php include('components/footer.php'); ?>