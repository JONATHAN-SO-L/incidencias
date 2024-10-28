<?php 
session_start();

include "../inc/navbarchk.php";

if($_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH"){
    date_default_timezone_set('America/Mexico_City');
    header('Content-Type: text/html; charset=UTF-8');

    $area = $_SESSION['ar'];
    $jefe = $_SESSION['nombre_completo'];

    require '../checador/config.php';
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
</style>

<?php
// Valida si se ha registrado con anterioridad un permiso
$buscar_permiso = $con->prepare("SELECT id_permiso FROM permisos WHERE registra_data = '$jefe' ORDER BY id_permiso DESC LIMIT 1");
$buscar_permiso->setFetchMode(PDO::FETCH_OBJ);
$buscar_permiso->execute();

$mostrar_permiso = $buscar_permiso->fetchAll();

if ($buscar_permiso -> rowCount() > 0) {
    foreach ($mostrar_permiso as $permiso) {
        $folio = $permiso -> id_permiso;
        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>PERMISO REGISTRADO</strong></h4>
        <p class="text-center">
        Imprimir el último permiso que se registró en el sistema.
        </p><br>
        <center><a href="../checador/formatos/permiso_pdf.php?'.$folio.'" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</a></center>
        </div>
        ';
    }
} else {
    echo '<script>console.log("No hay registros en el sistema")</script>';
}
?>

<div class="container">
    <div class="row well">
        <div class="col-sm-2">
            <img src="../img/permiso2.png" class="img-responsive permiso-top">
        </div>

        <div class="col-sm-9 lead">
            <h3 class="text-success">¿Cómo enviar un permiso?</h3>
            <p>Para registrar un permiso, deberás llenar todos los campos del siguiente formulario.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Permisos de Ausencia</strong></h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <br><br><br>
                            <p class="text-success text-justify">Por favor llena todos los datos de este formulario para regitrarlos datos necesarios.</p><br><br><br>	
                            <img src="../img/permiso1.png" class="permiso_portada"><br><br>
                        </div>

                        <div class="col-sm-8">
                            <form class="form-horizontal" action="../checador/functions/add/permisos_rh.php" method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Hora Creación Permiso</label>
                                        <div class='col-sm-10'>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="hora_permiso" readonly value="<?php echo date("H:i");?>" placeholder="Ejemplo: 08:00">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Fecha Creación Permiso</label>
                                        <div class='col-sm-10'>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="fecha_permiso" readonly value="<?php echo date("Y-m-d");?>" placeholder="Ejemplo: 02/10/2024">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Colaborador</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <select class="form-control" name="colaborador" id="colaborador" required>
                                                    <option value=""> - Selecciona el colaborador - </option>
                                                        <?php
                                                        // Buscar los tipos de permisos/motivos de ausencia en la base de datos correspondiente
                                                        $colaboradores = $con->prepare("SELECT * FROM empleados ORDER BY nombre_colaborador ASC");
                                                        $colaboradores->setFetchMode(PDO::FETCH_OBJ);
                                                        $colaboradores->execute();

                                                        $show_colaboradores = $colaboradores->fetchAll();

                                                        // Si existe información registrada, se muestra
                                                        if ($colaboradores -> rowCount() > 0) {
                                                            foreach ($show_colaboradores as $colaborador) {
                                                                $nombre_colaborador = $colaborador -> nombre_colaborador;
                                                                $no_empleado = $colaborador -> no_empleado;
                                                                echo '<option value="'.$no_empleado.'">'.$nombre_colaborador.'</option>';
                                                            }
                                                        }
                                                        ?>
                                                </select><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Motivo de Ausencia</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <select class="form-control" name="motivo_ausencia" onclick="toggle(this);" required>
                                                    <option value="0"> - Selecciona el permiso - </option>
                                                    <?php
                                                    // Buscar los tipos de permisos/motivos de ausencia en la base de datos correspondiente
                                                    $m_ausencia = $con->prepare("SELECT motivo_ausencia FROM motivo_ausencia ORDER BY motivo_ausencia ASC");
                                                    $m_ausencia->setFetchMode(PDO::FETCH_OBJ);
                                                    $m_ausencia->execute();

                                                    $show_ausencia = $m_ausencia->fetchAll();

                                                    // Si existe información registrada, se muestra
                                                    if ($m_ausencia -> rowCount() > 0) {
                                                        foreach ($show_ausencia as $ausencia) {
                                                            $ausencia -> motivo_ausencia;
                                                            echo '<option value="'.$ausencia -> motivo_ausencia.'">'.$ausencia -> motivo_ausencia.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Fecha de Ausencia</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <input type="date" class="form-control" name="fecha_ausencia" min="2024-09-01" required>
                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Número de días solicitados</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <input type="number" min="0" class="form-control" name="dias_solicitados" placeholder="Ejemplo: 1" required>
                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="horas_habilitadas" style="display: none">
                                        <font size=2 color="red">(El horario de trabajo es de 07:00 AM - 06:00 PM)</font>

                                        <div class="form-group"><br>
                                        <label  class="col-sm-2 control-label">Hora de Salida</label>
                                        <div class="col-sm-10">
                                        <div class='input-group'>
                                        <input type="time" class="form-control" name="hora_salida">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label  class="col-sm-2 control-label">Hora de Regreso</label>
                                        <div class="col-sm-10">
                                        <div class='input-group'>
                                        <input type="time" class="form-control" name="hora_regreso">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Fecha de Probable Regreso</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <input type="date" class="form-control" name="fecha_regreso" min="2024-09-01" required>
                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="goce_sueldo" style="display: none">
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Goce de Sueldo</label>
                                        <div class="col-sm-10">
                                            <div class='input-group'>
                                                <select class="form-control" name="goce_sueldo" id="goce_sueldo">
                                                    <option value="0"> - Selecciona según aplique - </option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Observaciones</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" placeholder="Anota tus observaciones aquí" name="observaciones_permiso"></textarea>
                                        </div>
                                    </div>
                                    <br>

                                    <font size=3 color="green" >Agregar Evidencia </font><font size=1.5 color="red">(Solo se aceptan PDF y el formato de imagen PNG, JPEG y JPG) </font><br>
                                    <label  class="control-label">Opcional - </label>
                                    <label  class="control-label">Máximo 5 MB* </label><br>
                                    <input accept="image/png, .jpeg, .jpg, .pdf" name="evidencia_permiso" id="imagen" type="file"><br>

                                    <br>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="Registrar" class="btn btn-success">Registrar</button>
                                        </div>
                                    </div>
                                </fieldset> 
                            </form>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-----------------------------------------------------------------
IMÁGENES POP-UP DE MOTIVOS DE AUSENCIA
------------------------------------------------------------------>
<!-- retardo_justificado -->
<div class="retardo_justificado" id="retardo_justificado" name="retardo_justificado" style="display: none">
<img class="img-responsive animated tada" src="../img/retardo_justificado.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- retardo_injustificado -->
<div class="retardo_injustificado" id="retardo_injustificado" name="retardo_injustificado" style="display: none">
<img class="img-responsive animated tada" src="../img/retardo_injustificado.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- paternidad -->
<div class="paternidad" id="paternidad" name="paternidad" style="display: none">
<img class="img-responsive animated tada" src="../img/paternidad.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- tiempo_por_tiempo -->
<div class="tiempo_por_tiempo" id="tiempo_por_tiempo" name="tiempo_por_tiempo" style="display: none">
<img class="img-responsive animated tada" src="../img/tiempo_por_tiempo.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- trabajo_casa -->
<div class="trabajo_casa" id="trabajo_casa" name="trabajo_casa" style="display: none">
<img class="img-responsive animated tada" src="../img/trabajo_casa.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- falta_justificada -->
<div class="falta_justificada" id="falta_justificada" name="falta_justificada" style="display: none">
<img class="img-responsive animated tada" src="../img/falta_justificada.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- falta_injustificada -->
<div class="falta_injustificada" id="falta_injustificada" name="falta_injustificada" style="display: none">
<img class="img-responsive animated tada" src="../img/falta_injustificada.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- salud -->
<div class="salud" id="salud" name="salud" style="display: none">
<img class="img-responsive animated tada" src="../img/salud.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- enfermedad_general -->
<div class="enfermedad_general" id="enfermedad_general" name="enfermedad_general" style="display: none">
<img class="img-responsive animated tada" src="../img/enfermedad_general.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- riesgo_trabajo -->
<div class="riesgo_trabajo" id="riesgo_trabajo" name="riesgo_trabajo" style="display: none">
<img class="img-responsive animated tada" src="../img/riesgo_trabajo.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- maternidad -->
<div class="maternidad" id="maternidad" name="maternidad" style="display: none">
<img class="img-responsive animated tada" src="../img/maternidad.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- vacaciones -->
<div class="vacaciones" id="vacaciones" name="vacaciones" style="display: none">
<img class="img-responsive animated tada" src="../img/vacaciones.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- labor_campo -->
<div class="labor_campo" id="labor_campo" name="labor_campo" style="display: none">
<img class="img-responsive animated tada" src="../img/labor_campo.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<!-- incapacidad_interna -->
<div class="incapacidad_interna" id="incapacidad_interna" name="incapacidad_interna" style="display: none">
<img class="img-responsive animated tada" src="../img/incapacidad_interna.png" style="position: absolute; left: 0.5%; float: right; top: 45%; width: 38%; border: 5px solid; border-radius: 10px;">
</div>

<?php
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
	<?php
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#fechainput").datepicker();
	});
</script>

<script type="text/javascript" src="../checador/functions/search/functions.js"></script>
<!--script type="text/javascript" src="../checador/functions/search/buscar_no_empleado.js"></script>
<script type="text/javascript" src="../checador/functions/search/buscar_puesto.js"></script>
<script type="text/javascript" src="../checador/functions/search/buscar_departamento.js"></script-->