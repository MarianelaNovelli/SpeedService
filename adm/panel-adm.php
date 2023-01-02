<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'panel-adm';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

?>

<main class="panel-adm">
    <section class="panel-bienvenida">
        <div class="container panel-admin">
            <h1 class="text-center">Panel de Control</h1>
            <p  class="text-center"><i>Aquí podrás realizar las operaciones que desees sobre los registros de categorías de servicios, proveedores y clientes.</i></p>
        </div>       
    </section>

    <section class="panel">
        <div class="container">
            <div class="botonera row m-5 py-3">
                <div class="col-12 col-md-4 text-center">
                    <h3 class="mb-3">Categorías</h3>
                    <a href="categorias/nuevo.php" class="btn boton-agregar">Agregar</a>
                    <a href="categorias/listado.php" class="btn boton-mostrar">Mostrar</a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <h3 class="mb-3">Servicios</h3>
                    <a href="#" class="btn boton-agregar">Agregar</a>
                    <a href="#" class="btn boton-mostrar">Mostrar</a>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <h3 class="mb-3">Usuarios</h3>
                    <a href="#" class="btn boton-mostrar">Mostrar</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
  require_once('../includes/footer.php');
?>