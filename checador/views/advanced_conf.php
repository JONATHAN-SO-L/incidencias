<?php 
session_start();

include "../../inc/navbarchkad.php";

if($_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    date_default_timezone_set('America/Mexico_City');
    header('Content-Type: text/html; charset=UTF-8');

    $area = $_SESSION['ar'];
    $jefe = $_SESSION['nombre_completo'];

    require '../../checador/config.php';
?>

<meta charset="UTF-8"><br><br><br>
<style>
    .permiso-top {
        padding: 10px;
        width: 70%;
        margin-left: 45px;
    }

    .permiso_portada {
        width: 60%;
        border: solid 5px;
        border-radius: 100px;
    }

    .botones {
        margin-left: 25%;
    }

    .btn {
        margin-left: 15px;
        margin-top: 5px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <a href="../../soporte.php" class="btn-sm btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Salir al Inicio</a><br><br><br>
            <div class="panel panel-success">
            <div class="panel-heading">
            <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i><center>Selecciona la herramienta que deseas utilizar</center></strong></h3>
            </div>
            <div class="panel-body">
            <div class="col-sm-6 botones">
                <center class="aling-text">
                <a href="./../../user/permisos_lista.php" class="btn-md btn btn-primary">Permisos / Incidencias</a>
                <a href="areas.php" class="btn-md btn btn-info">Áreas</a>
                <a href="lineas.php" class="btn-md btn btn-success">Líneas / Departamentos</a>
                <a href="puestos.php" class="btn-md btn btn-warning">Puestos</a>
                <a href="empleados.php" class="btn-md btn btn-danger">Empleados</a>
                <a href="motivos_ausencia.php" class="btn-md btn btn-primary">Motivos de Ausencia</a>
                <!--a href="jefes_lista.php" class="btn-md btn btn-info">Jefes Inmediatos</a-->
                </center>
            </div>
            </div>
            </div>
        </div>
    </div>
</div><br><br><br>

<?php
include "../../inc/footer_rh.php";

}else{
	?>
    /*******************************
    NO ES UN USUARIO R.R.H.H.
    *******************************/
    <div class="container"><br><br><br><br>
    <div class="row">
    <div class="col-sm-4">
    <img src="../img/SadTux.png" alt="Image" class="img-responsive"/>

    </div><br><br><br><br><br>
    <div class="col-sm-7 text-center">
    <h1 class="text-danger">Lo sentimos esta página es solamente para integrantes de R.R.H.H. registrados en el Sistema</h1>
    <h3 class="text-info">Inicia sesión con tu usuario para otras funciones</h3>
    </div>
    <div class="container">
    <a href="permisos_lista.php" class="btn btn-danger" style="margin-left: 28%;"><span><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></span> Regresar</a>
    </div><br>
    <div class="col-sm-1">&nbsp;</div>
    </div>
    </div>
    <meta http-equiv="refresh" content="0; url=soporte.php?view=soporte"/>
	<?php
}
?>
