<?php
session_start();
include_once '../libs/enviar_correo.php';

$env =  sendemail($_POST['codigo'],$_POST['correo']);

if($env){
    $_SESSION['codigo'] = $_POST['codigo'];
    echo $env;
}else{
    echo $env;
}

?>