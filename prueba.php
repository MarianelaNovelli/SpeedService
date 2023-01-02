<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $img = $_FILES['imgPerfil']['name'];
    $imgTmpName = $_FILES['imgPerfil']['tmp_name'];
    $extension = pathinfo($img, PATHINFO_EXTENSION);

    switch ($extension) {
        case 'jpg':
            echo 'ES JPG';
        break;
            
        case 'png':
            echo 'ES PNG';
            break;
        case 'jpeg':
           echo 'ES JPEG';
            break;
        
        default:
            echo 'ERROR INVALIDO';
            break;
    }

    
}


?>

<section>
    <div class="container">
        
        <form action="prueba.php" method="POST" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="imgPerfil">Imagen de perfil:</label>
            <input type="file" class="form-control" id="imgPerfil" name="imgPerfil">
        
        </div>
    <button type="submit">Enviar</button>
        </form>
    </div>
</section>


