<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-categorias';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idCategoria = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM categorias WHERE idCategoria = :id");
    $stmt->execute(array(':id' => $idCategoria));
    $categoria = $stmt->fetch();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idCategoria = $_POST['idCategoria'];
    $nombreCategoria = $_POST['categoria'];
    $imgActual = $_POST['img-actual'];
    $descripcionCategoria = $_POST['descripcion'];
    $img = $_FILES['imagen']['name'];
    $imgTmpName = $_FILES['imagen']['tmp_name'];

    if(empty($nombreCategoria) || empty($imgActual) || empty($descripcionCategoria)){
        $notificacion = "Error: No puede dejar campos vacíos";
    }else{

        if(empty($img)){
            $img = $imgActual;
        }else{
            $archivo_destino='../../img/categorias/'.$_FILES['imagen']['name'];
            move_uploaded_file($imgTmpName,$archivo_destino);
        }

        $stmt = $conexion->prepare("UPDATE categorias SET categoria = :categoria, descripcionCategoria = :descripcion, imgCategoria = :img WHERE idCategoria = :id ");
        $resultado = $stmt->execute(array(':categoria' => $nombreCategoria, ':descripcion' => $descripcionCategoria, ':img' => $img ,':id' => $idCategoria));

        if($resultado){
            header('Location:listado.php');
        }

    }
    
}

require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container py-4">
        <h1 class="text-center">Modificar Categoría</h1>

        <div class="row py-4">
            <form action="modificar.php" method="POST" class="col-md-6 mx-auto fondo-formulario" enctype="multipart/form-data">
                <input type="hidden" name="idCategoria" value="<?php echo (isset($categoria)) ? $categoria['idCategoria'] : '' ?>">
                <div class="mb-3">
                    <label for="categoria">Nombre de la categoría:</label>
                    <input class="form-control" type="text" name="categoria" id="categoria" value="<?php echo (isset($categoria)) ? $categoria['categoria'] : '' ?>">
                </div>

                <div class="mb-3">
                    <label for="imagen">Imagen:</label>
                    <img src="<?php echo RUTARAIZ . '/img/categorias/' . trim($categoria['imgCategoria'])?>" alt="" class="imagen-modificar-categoria">
                    <input class="form-control mt-2" type="file" name="imagen" id="imagen">
                    <input type="hidden" name="img-actual" value='<?php echo (isset($categoria)) ? $categoria['imgCategoria'] : '' ?>'>
                </div>

                <div class="mb-3">
                    <label for="descripcion">Descripción de la categoría:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="5"><?php echo (isset($categoria)) ? trim($categoria['descripcionCategoria']) : '' ?></textarea>
                </div>

                <?php 
                        if(isset($notificacion)){
                            echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                        }              
                ?>

                <button class="btn d-grid gap-2 col-5 mx-auto boton-crear-categoria" type="submit">Modificar</button>
            </form>
        </div>
    </div>
</section>


<?php
  require_once('../../includes/footer.php');
?>