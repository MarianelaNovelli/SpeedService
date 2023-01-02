<?php
$pagina = 'servicios';
require_once('../includes/config.php');
require_once('../includes/header.php');
?>

<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            <div class="row">
                <!-- COLUMNA FILTROS -->
                <div class="col-md-2">
                    <h3>Filtros</h3>
                </div>

                <!-- COLUMNA SERVICIOS -->
                <div class="col-md-10 columna-servicios">
                    <h2>Servicios:</h2>
                    <div class="row fila-servicios">

                        <div class="col-md-4 servicio-1">
                            <article class="servicio">
                                <a href="#"><img class="logo-servicio img-fluid" src="../img/servicio_flete.jpg" alt="imagen servicio"></a>
                                   <a href="3"><h3 class="titulo-servicio">Remises Noroeste</h3></a>
                                    <p class="descripcion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis illum ab excepturi nobis possimus? Est facere ipsum illo maxime magnam!</p>
                                    <p class="horario-servicio">Horario: 08:00 a 00:00 hs.</p>
                                    <p class="precio-servicio">Valor del servicio: $400</p>
                            </article>
                        </div>
                        <div class="col-md-4 servicio-2">
                        <article class="servicio">
                                <a href="#"><img class="logo-servicio img-fluid" src="../img/servicio_remis.jpg" alt="imagen servicio"></a>
                                   <a href="3"><h3 class="titulo-servicio">Remises Noroeste</h3></a>
                                    <p class="descripcion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis illum ab excepturi nobis possimus? Est facere ipsum illo maxime magnam!</p>
                                    <p class="horario-servicio">Horario: 08:00 a 00:00 hs.</p>
                                    <p class="precio-servicio">Valor del servicio: $400</p>
                            </article>
                        </div>
                        <div class="col-md-4">
                        <article class="servicio">
                                <a href="#"><img class="logo-servicio img-fluid" src="../img/servicio_mandado.jpg" alt="imagen servicio" ></a>
                                   <a href="3"><h3 class="titulo-servicio">Remises Noroeste</h3></a>
                                    <p class="descripcion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis illum ab excepturi nobis possimus? Est facere ipsum illo maxime magnam!</p>
                                    <p class="horario-servicio">Horario: 08:00 a 00:00 hs.</p>
                                    <p class="precio-servicio">Valor del servicio: $400</p>
                            </article>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
  require_once('../includes/footer.php');
?>