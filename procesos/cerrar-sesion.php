<?php 
session_start();


if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

unset($_SESSION['idUsuario']);
unset($_SESSION['correo']);
unset($_SESSION['nombre']);
unset($_SESSION['idRol']);
unset($_SESSION['imgUsuario']);

session_destroy();

header('location:../index.php');

?>
