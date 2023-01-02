<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../../index.php');
}

$pagina = 'alta-fletes';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

/* LISTAR CATEGORIAS */
$stmt = $conexion->prepare("SELECT * FROM tipo_vehiculo WHERE idTipo = 4 OR idTipo = 5");
$stmt->execute();

$tipoVehiculos = $stmt->fetchAll();


require_once('../../includes/header.php');
?>

<main class="registro-servicio">

    <seccion class="formulario py-4">
       <div class="container">
            <h1 class="text-center mb-4">Dar de alta un servicio</h1>
            
           <div class="row align-items-center">
           
               <div class="col-4">
                   <h2 class="mb-1 text-center"><b>Formá parte de la nueva app de servicios de la Ciudad de Chivilcoy</b></h2>
                   <p class="text-center">Registrá tu servicio, cumplí con nuestros requisitos y ganá dinero. Aplica únicamente para aquellos que completen el proceso de registro exitosamente.</p>
               </div>

               <div class="col-8">
                <?php 
                if(isset($notificacion)){
                    echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                }else if(isset($notificacionExito)){
                    echo '<p class="bg-success text-white text-center">'.$notificacionExito.'</p>';
                }                    
                ?>

               <form action="registro.php" method="POST" enctype="multipart/form-data" id="formRegistro">

                    <div class="row" id="datosServicio">
                        <div class="col-12 col-md-6 arregloForm">
                            <div class="mb-3">
                                <label for="nombreServicio">Nombre del servicio:</label>
                                <input type="text" class="form-control" id="nombreServicio" name="nombreServicio" required>
                            </div>
                        
                            <div class="mb-3">
                                <label for="horario">Horario disponible:</label>
                                <input type="text" class="form-control" id="horario" name="horario" required>
                            </div>

                            
                            
                        </div>

                        <div class="col-12 col-md-6">

                        <div class="mb-3">
                                <label for="alcance">Alcance (kms. a la redonda):</label>
                                <input type="text" class="form-control" id="alcance" name="alcance" required>
                        </div>

                        <div class="mb-3">
                                <label for="descripcionCapacidad">Descripción del servicio:</label>
                                <textarea name="descripcionCapacidad" id="descripcionCapacidad" rows="6" class="form-control" required></textarea>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row d-none opacity-0" id="datosVehiculo">
                        <div class="col-12 col-md-6 arregloForm">

                            <div class="mb-3">
                                <label for="patente">Patente:</label>
                                <input type="text" class="form-control" id="patente" name="patente" required>
                            </div>

                            <div class="mb-3">
                                <label for="idTipo">Tipo de vehiculo</label>
                                <select name="idTipo" id="idTipo" class="form-select" required>
                                    
                                    <?php 
                                        foreach ($tipoVehiculos as $fila) {
                                            echo '
                                            <option value="'.$fila['idTipo'].'">'.ucfirst($fila['tipo']).'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="descripcionCapacidad">Capacidad de carga (kg.):</label>
                                <textarea name="descripcionCapacidad" id="descripcionCapacidad" rows="6" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="fotosVehiculo">Fotos del vehiculo (máximo 4):</label>
                                <input type="file" name="fotosVehiculo" multiple="fotosVehiculo" class="form-control" required>
                            </div>
                            

                            </div>

                            <div class="col-12 col-md-6">

                                <div class="mb-3">
                                    <label for="polizaSeguro">Poliza de seguro:</label>
                                    <input type="file" class="form-control" id="polizaSeguro" name="polizaSeguro" required>
                                </div>
                                <div class="mb-3">
                                    <label for="imgVTV">Imágen de VTV:</label>
                                    <input type="file" class="form-control" id="imgVTV" name="imgVTV" required>
                                </div>

                                <div class="mb-3">
                                    <label for="descripcionCapacidad">Descripción del vehiculo:</label>
                                    <textarea name="descripcionCapacidad" id="descripcionCapacidad" rows="6" class="form-control" required></textarea>
                                </div>
                            </div>

                        </div>
                   
          
                               
                    <button class="btn d-grid gap-2 col-5 mx-auto boton-servicio" id="btnSiguiente">Siguiente</button>
                   <button type="submit" class="btn d-grid gap-2 col-5 mx-auto boton-servicio d-none">Enviar solicitud</button>
                   

               </form>
            
               </div>
           </div>
       </div>
   </seccion>

</main>


<script src="../../js/alta-fletes.js"></script>
<?php 
require_once('../../includes/footer.php');
?>