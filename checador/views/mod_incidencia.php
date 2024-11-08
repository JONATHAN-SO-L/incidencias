<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_permiso = $_SERVER['QUERY_STRING'];

if (isset($_POST['nuevos_cambios'])) {
    // Recepción de variables para actualizar
    $motivo_ausencia = $_POST['motivo_ausencia'];
    $fecha_ausencia = $_POST['fecha_ausencia'];
    $dias_solicitados = $_POST['dias_solicitados'];
    $hora_salida = $_POST['hora_salida'];
    $fecha_regreso = $_POST['fecha_regreso'];
    $hora_regreso = $_POST['hora_regreso'];
    $observaciones = $_POST['observaciones'];

    // Datos de fecha y hora de modificación
    $modifica_data = $_SESSION['nombre_completo'];
    $fecha_hora_modificacion = date("Y-m-d H:i:s");

    //Actualización de datos
    $update_permiso = $con->prepare("UPDATE permisos SET motivo_ausencia = ?, fecha_ausencia = ?, dias_solicitados = ?,
    hora_salida = ?, fecha_regreso = ?, hora_regreso = ?, observaciones = ?, modifica_data = ?, fecha_hora_modificacion = ?
    WHERE id_permiso = '$id_permiso'");

    $val_update = $update_permiso->execute([$motivo_ausencia, $fecha_ausencia, $dias_solicitados, $hora_salida, $fecha_regreso, $hora_regreso, $observaciones, $modifica_data, $fecha_hora_modificacion]);

    if ($val_update) {
        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>REGISTRO ACTUALIZADO</strong></h4>
        <p class="text-center">
        Se actualizó correctamente el folio <strong><u>#'.$id_permiso.'</u></strong>.
        </p>
        </div>
        ';
    } else {
        echo '<script>alert("Ocurrió un error al intentar actualizar el registro, inténtalo de nuevo o ponte en contacto con el Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=../../user/permisos_lista.php?'.$id_permiso.'">';
    }

} else {
    echo '<script>console.log("No se recibió acción del botón")</script>';
}
?>

<!--************************************ Page content******************************-->
<style>
  .page-header{
    display:none;
  }
  footer {
    display: none;
  }
  .fa-copyright:before {
    content: "\f1f9";
    display: none;
  }
  .col-sm-img {
    width: 100%;
  }
</style>
<?php include "../../inc/navbarchkad.php"; ?>
<div class="container"><br><br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="page-header2">
        <h1 class="animated lightSpeedIn"><strong>Modificación de la incidencia #<u><?php echo $id_permiso; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
        <a href="../../user/permisos_lista.php" class="btn-sm btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br><br>
        <p class="pull-right text-primary">
          <strong>
            <?php include "../../inc/timezone.php"; ?>
          </strong>
        </p>
      </div>
    </div>
  </div>
</div>
<!--************************************ Page content******************************-->
<div class="container">
  <div class="row"><br>
  </div>
</div>

<?php
$buscar_incidencia = $con->prepare("SELECT * FROM permisos WHERE id_permiso = '$id_permiso'");
$buscar_incidencia->setFetchMode(PDO::FETCH_OBJ);
$buscar_incidencia->execute();

$show_incidencia = $buscar_incidencia->fetchAll();

if ($buscar_incidencia -> rowCount() > 0) {
    foreach ($show_incidencia as $incidencia) {
        
        $evidencia = $incidencia -> evidencia;

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
        <label class="col-sm-2 control-label">Fecha de Creación del Permiso:</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="fecha_creacion" readonly value="'.$incidencia -> fecha_creacion.'">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Nombre del Colaborador</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="nombre_colaborador" readonly value="'.$incidencia -> nombre_colaborador.'">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Clave de Colaborador / No. Empleado</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="no_empleado" readonly value="'.$incidencia -> no_empleado.'">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Puesto</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="puesto" readonly value="'.$incidencia -> puesto.'">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Sede</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="sede" readonly value="'.$incidencia -> sede.'">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Motivo de Ausencia</label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="motivo_ausencia" onclick="toggle(this);" required>
        <option value="0">'.$incidencia -> motivo_ausencia.' - (Actual) </option>
        ';
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
        echo'
        </select><span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Fecha de Ausencia</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="date" min="2024-10-01" class="form-control"  name="fecha_ausencia" value="'.$incidencia -> fecha_ausencia.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Días Solicitados</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="number" min="0" class="form-control"  name="dias_solicitados" value="'.$incidencia -> dias_solicitados.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Hora de Salida</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="time" class="form-control"  name="hora_salida" value="'.$incidencia -> hora_salida.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Fecha de Probable Regreso</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="date" min="2024-10-01" class="form-control"  name="fecha_regreso" value="'.$incidencia -> fecha_regreso.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Hora de Regreso</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="time" class="form-control" name="hora_regreso" value="'.$incidencia -> hora_regreso.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Observaciones</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="observaciones" value="'.$incidencia -> observaciones.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="col-sm-11" >
        <div class="form-group">
        <label  class="col-sm-2 control-label">Evidencia Adjunta</label>
        </div>';

        if ($evidencia != NULL) {
            echo '<a class="btn btn-success btn-md text-center" href="'.$incidencia -> evidencia.'" target="_blank" style="margin-left: 50%; margin-bottom: 5%;">Abrir en otra pestaña</a>';
        } else {
            echo '<h8 style="position: relative; left: 200px; bottom: 20px;"><i>--- No se encontró evidencia adjunta ---</i></h8>';
        }

        echo '
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Dirección IP de registro</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="ip_registro" readonly value="'.$incidencia -> ip_registro.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div><br>

        <center>
        <div class="form-group">
        <div class="input-group">
        <input type="submit" class="text-center btn-md btn btn-success" name="nuevos_cambios" id="nuevos_cambios" value="Guardar cambios">
        </div>
        </div>
        </center>

        </form>
        </div>
        </div>';
    }
include "../../inc/footer_rh.php";

} else {
    echo '<h2 class="text-center">No se encontró información registrada en el sistema</h2>';
}

}else{
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
        <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>

      </div>
      <div class="col-sm-7 animated flip">
        <h1 class="text-danger">Lo sentimos esta página es solamente para empleados RRHH de Veco</h1>
        <h3 class="text-info text-center">Inicia sesión como RH para poder acceder</h3>
      </div>
      <div class="col-sm-1">&nbsp;</div>
    </div>
  </div>
  <?php
}
?>