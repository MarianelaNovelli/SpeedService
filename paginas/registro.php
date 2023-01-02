<?php
session_start();

if(isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

$pagina = 'registro';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');


/* FUNCIONES */

function obtener_edad_segun_fecha($fechaNacimiento){
    $nacimiento = new DateTime($fechaNacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}
function validarTelefono($telefonoCliente){
    $reg = "#^[\s\.-]?\d{4}[\s\.-]?\d{6}$#";
    return preg_match($reg, $telefonoCliente);
}

/* LISTAR CATEGORIAS  */
$stmt = $conexion->prepare("SELECT * FROM categorias");
$stmt->execute();

$categorias = $stmt->fetchAll();

/* PROCESAR FORMULARIO */

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nombreCompleto = $_POST['nombreCliente'];
    $correoCliente = $_POST['correoCliente'];
    $telefonoCliente = $_POST['telefonoCliente'];
    $dniCliente = $_POST['dniCliente'];
    $direccionCliente = $_POST['direccionCliente'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $pass = $_POST['pass'];
    $passConfirm = $_POST['passConfirm'];
    $img = $_FILES['imgPerfil']['name'];
    $imgTmpName = $_FILES['imgPerfil']['tmp_name'];
    
    $maxEdad = 95;
    $minEdad = 16;
    $edad = obtener_edad_segun_fecha($fechaNacimiento);
    $codigo = $_POST['codigo'];
        
     if($codigo != $_SESSION['codigo']){
         unset($_SESSION['codigo']);
         
        $notificacion = "Error: El código de validación es incorrecto.";
     }else if(empty($nombreCompleto) || empty($correoCliente) || empty($telefonoCliente) || empty($dniCliente) || empty($direccionCliente) || empty($fechaNacimiento) || empty($img) || empty($pass)){
        $notificacion = "Error: no puede dejar campos vacíos.";
    }else if(strlen($nombreCompleto) <= 5){
        $notificacion = "Error: El nombre debe contener al menos 6 caracteres.";
        $nombreError = true;
    }else if($pass != $passConfirm){
        $notificacion = "Error: Las contraseñas deben coincidir.";
    }else if ( $edad < $minEdad || $edad > $maxEdad ){
        $notificacion = "Error: La edad ingresada no es correcta.";
    }else if(!filter_var($correoCliente, FILTER_VALIDATE_EMAIL)){
        $notificacion = "Error: El correo ingresado no es correcto.";
    }else if(!validarTelefono($telefonoCliente)){
        $notificacion = "Error: El teléfono ingresado no es correcto.";
    }else{
        /* LISTAR USUARIO POR CORREO  */
        unset($_SESSION['codigo']);
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->execute(array(':correo' => $correoCliente));

        if($stmt->rowCount() > 0){
            $notificacion = "Error: El correo ingresado ya está registrado.";
        }else{

            $archivo_destino = '../img/usuarios/'.$_FILES['imgPerfil']['name'];
            move_uploaded_file($imgTmpName,$archivo_destino);

            /* LISTAR USUARIO POR CORREO  */
            
            $stmt = $conexion->prepare("INSERT INTO usuarios(imgUsuario, nombreCompleto, correo, password, telefono, dni, direccion, fechaNacimiento, idRol) VALUES (:imgUsuario,:nombre,:correo,:password,:telefono,:dni,:direccion,:fecha,1)");
            $passHash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
            $resultado = $stmt->execute(array(':imgUsuario' => $img, ':nombre' => $nombreCompleto, ':correo' => $correoCliente,':password' => $passHash,':telefono'=> $telefonoCliente, ':dni' => $dniCliente, ':direccion' => $direccionCliente, ':fecha' => $fechaNacimiento));

            if($resultado){

                $notificacionExito = "Éxito: se ha registrado correctamente.";

            }
        }
    }

}

?>



<main class="registrar-servicio">

    <seccion class="formulario py-1">
       
        <div class="container">
            <div class="row align-items-center">
            
                <div class="col-4">
                    <h2 class="mb-1 text-center"><b>Formá parte de la nueva app de servicios de la Ciudad de Chivilcoy</b></h2>
                    <p class="text-center">Registrá tu servicio, cumplí con nuestros requisitos y ganá dinero. Aplica únicamente para aquellos que completen el proceso de registro exitosamente.</p>
                </div>

                <div class="col-8">
            <?php 
            if(isset($notificacion)){
                echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
            }else {

            }

            ?>

                <form action="registro.php" method="POST" enctype="multipart/form-data" id="formRegistro" class="row">

                    <div class="col-12 col-md-6 arregloForm">
                        <div class="mb-3">
                            <label for="nombreProveedor">Nombre y Apellido:</label>
                            <input type="text" class="form-control" id="nombreProveedor" name="nombreCliente" required>
                            <p class="text-white bg-danger msj-error">Error: El nombre debe tener al menos 6 caracteres.</p>
                        </div>
                        <div class="mb-3">
                            <label for="imgPerfil">Imagen de perfil:</label>
                            <input type="file" class="form-control" id="imgPerfil" name="imgPerfil">
                            <p class="text-white bg-danger msj-error">Error: Debe elegir una imagen de perfil.</p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefonoProveedor">Teléfono (Ej. 2346-xxxxxx):</label>
                            <input type="text" class="form-control" id="telefonoProveedor" name="telefonoCliente" required>
                        </div>

                        <div class="mb-3">
                            <label for="correoProveedor">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correoProveedor" name="correoCliente" required>
                        </div>

                        <div class="mb-3">
                            <label for="codigo">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                        </div>
                      
                        <button type="button" id="btnCodigo" onclick="validacionCorreo()" class="btn d-grid gap-2 col-6 mx-auto boton-servicio">Solicitar código</button>

                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="telefonoProveedor">Dirección:</label>
                            <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaNacimiento">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                        </div>
                        <div class="mb-3">
                            <label for="dniCliente">DNI (sin puntos):</label>
                            <input type="number" class="form-control" id="dniCliente" name="dniCliente" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass">Contraseña:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                        <div class="mb-3">
                            <label for="passConfirm">Repita su contraseña:</label>
                            <input type="password" class="form-control" id="passConfirm" name="passConfirm" required>
                        </div>
                        
                        
                    </div>

                                       
                    <button type="submit" id="btnEnviar" class="d-none btn d-grid gap-2 col-5 mx-auto boton-servicio">Enviar solicitud</button>
                    

                </form>

                </div>
            </div>
        </div>
    </seccion>

</main>
<!-- SWEET ALERT -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 <script>
    let errorServidor = "<?php echo (isset($notificacion)) ? $notificacion : '' ;?>";
    let exitoServidor = "<?php echo (isset($notificacionExito)) ? $notificacionExito : '' ;?>";
    
    if(errorServidor){
        alert(errorServidor);
    }else if(exitoServidor)
    {
        alert(exitoServidor); 
        window.location.href = '/proyectos/speedservice/paginas/ingresar.php';
        
    }

   
</script>
<script src="../js/validarRegistro.js?<?php echo time();?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?php
  require_once('../includes/footer.php');
?>