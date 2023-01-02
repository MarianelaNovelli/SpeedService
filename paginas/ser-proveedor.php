<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}


$pagina = 'ser-proveedor';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

/* LISTAR CATEGORIAS  */
$stmt = $conexion->prepare("SELECT * FROM categorias");
$stmt->execute();

$categorias = $stmt->fetchAll();



require_once('../includes/header.php');


?>

<main class="pagina-proveedor">
    <seccion class="formulario py-1">
        <div class="container">

            <div class="row align-items-center">
            
                <div class="col-4">
                    <h2 class="mb-1 text-center"><b>Formá parte de la nueva app de servicios de la Ciudad de Chivilcoy</b></h2>
                    <p class="text-center">Registrá tu servicio, cumplí con nuestros requisitos y ganá dinero. Aplica únicamente para aquellos que completen el proceso de registro exitosamente.</p>
                </div>

                <div class="col-8">
                   
                </div>
            </div>

        </div>
    </section>

</main>


<?php
  require_once('../includes/footer.php');
?>