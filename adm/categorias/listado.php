<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-categorias';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');


$stmt = $conexion->prepare("SELECT * FROM categorias WHERE bajaCategoria = 0 ORDER BY categoria");
$stmt->execute();
$categorias = $stmt->fetchAll();

require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Listado de Categorías</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($categorias as $fila) {
                            echo '
                                <tr>
                                    <td class="align-middle"><img src="'.RUTARAIZ.'/img/categorias/'.$fila['imgCategoria'].'" alt="imagen de la categoría" style="max-width:100px"></td>
                                    <td class="align-middle">'.$fila['categoria'].'</td>
                                    <td class="align-middle">'.$fila['descripcionCategoria'].'</td>
                                    <td class="align-middle">
                                        <a href="modificar.php?id='.$fila['idCategoria'].'" class="icono-modificar"><i class="fa-solid fa-gear"></i></a>
                                        <a href="eliminar.php?id='.$fila['idCategoria'].'"  class="icono-eliminar"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</section>


<?php
  require_once('../../includes/footer.php');
?>