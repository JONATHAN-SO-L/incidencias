<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_empleado = $_SERVER['QUERY_STRING'];

if (isset($_POST['nuevos_cambios'])) {
    // Recepción de variables para actualizar
    $nombre_colaborador = $_POST['nombre_colaborador'];
    $no_empleado = $_POST['no_empleado'];
    $area = $_POST['area'];
    $linea = $_POST['linea'];
    $puesto = $_POST['puesto'];
    $sede = $_POST['sede'];
    $gerente_jefe = $_POST['gerente_jefe'];

    // Datos de fecha y hora de modificación
    $modifica_data = $_SESSION['nombre_completo'];
    $fecha_hora_modificacion = date("Y-m-d H:i:s");

    //Actualización de datos
    $update_empleado = $con->prepare("UPDATE empleados SET nombre_colaborador = ?, no_empleado = ?, area = ?, linea = ?,
    puesto = ?, sede = ?, gerente_jefe = ?, modifica_data = ?, fecha_hora_modificacion = ?
    WHERE id_empleado = '$id_empleado'");

    $val_update = $update_empleado->execute([$nombre_colaborador, $no_empleado, $area, $linea,
    $puesto, $sede, $gerente_jefe, $fecha_hora_modificacion, $modifica_data]);

    if ($val_update) {
        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>REGISTRO ACTUALIZADO</strong></h4>
        <p class="text-center">
        Se actualizó correctamente el folio <strong><u>#'.$id_empleado.'</u></strong>.
        </p>
        </div>
        ';
    } else {
        echo '<script>alert("Ocurrió un error al intentar actualizar el registro, inténtalo de nuevo o ponte en contacto con el Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=empleados.php?'.$id_empleado.'">';
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
        <h1 class="animated lightSpeedIn"><strong>Modificación del empleado #<u><?php echo $id_empleado; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
        <a href="empleados.php" class="btn-sm btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br><br>
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
$buscar_empleado = $con->prepare("SELECT * FROM empleados WHERE id_empleado = '$id_empleado'");
$buscar_empleado->setFetchMode(PDO::FETCH_OBJ);
$buscar_empleado->execute();

$show_empleado = $buscar_empleado->fetchAll();

if ($buscar_empleado -> rowCount() > 0) {
    foreach ($show_empleado as $empleado) {
      $nombre_colaborador = $empleado -> nombre_colaborador;
      $no_empleado = $empleado -> no_empleado;
      $area = $empleado -> area;
      $linea = $empleado -> linea;
      $puesto = $empleado -> puesto;
      $sede = $empleado->sede;
      $gerente_jefe = $empleado->gerente_jefe;

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
        <label class="col-sm-2 control-label">Nombre Completo</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="nombre_colaborador" value="'.$nombre_colaborador.'" placeholder="Ejemplo: Roberto Ramírez Mejía">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">No. Empleado / Clave</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="no_empleado" value="'.$no_empleado.'" placeholder="Ejemplo: R012">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Área</label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="area" id="area">
        <option value="'.$area.'">'.$area.' - (Actual)</option>';
        $buscar_area = $con->prepare("SELECT * FROM areas ORDER BY id_area ASC");
        $buscar_area->setFetchMode(PDO::FETCH_OBJ);
        $buscar_area->execute();

        $show_area = $buscar_area->fetchAll();

        if ($buscar_area -> rowCount() > 0) {
          foreach ($show_area as $area) {
            $areas_lista = $area -> area;
            echo '<option value="'.$areas_lista.'">'.$areas_lista.'</option>';
          }
        }
        echo '</select>
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="alert alert-warning container">
        <strong><center><u><i>*</i></u> :  Para poder realizar cambio de departamento, puesto o jefe inmediato, primero es necesario guardar el cambio de la nueva área.</center></strong>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Línea / Departamento <u><i>*</i></u></label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="linea" id="linea">
        <option value="'.$linea.'">'.$linea.' - (Actual)</option>';
        $buscar_lineas = $con->prepare("SELECT * FROM lineas WHERE area = '$empleado->area' ORDER BY area ASC");
        $buscar_lineas->setFetchMode(PDO::FETCH_OBJ);
        $buscar_lineas->execute();

        $show_lineas = $buscar_lineas->fetchAll();

        if ($buscar_lineas -> rowCount() > 0) {
          foreach ($show_lineas as $linea) {
            $lineas_lista = $linea -> linea;
            echo '<option value="'.$lineas_lista.'">'.$lineas_lista.'</option>';
          }
        }
        echo '</select>
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Puesto <u><i>*</i></u></label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="puesto" id="puesto">
        <option value="'.$puesto.'">'.$puesto.' - (Actual)</option>';
        $buscar_puestos = $con->prepare("SELECT * FROM puestos WHERE area = '$empleado->area' ORDER BY area ASC");
        $buscar_puestos->setFetchMode(PDO::FETCH_OBJ);
        $buscar_puestos->execute();

        $show_puestos = $buscar_puestos->fetchAll();

        if ($buscar_puestos -> rowCount() > 0) {
          foreach ($show_puestos as $puesto) {
            $puestos_lista = $puesto -> puesto;
            echo '<option value="'.$puestos_lista.'">'.$puestos_lista.'</option>';
          }
        }
        echo '</select>
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Sede</label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="sede" id="sede">
        <option value="'.$sede.'">'.$sede.' - (Actual)</option>
        <option value="CDMX">CDMX</option>
        <option value="Morelos">Morelos</option>
        <option value="Externo">Externo</option>
        </select>
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Jefe Inmediato <u><i>*</i></u></label>
        <div class="col-sm-10">
        <div class="input-group">
        <select class="form-control" name="gerente_jefe" id="gerente_jefe">
        <option value="'.$gerente_jefe.'">'.$gerente_jefe.' - (Actual)</option>';
        $buscar_jefe = $con->prepare("SELECT nombre_comp, tipo_chk FROM veco_sims_devecchi.usuario_sop WHERE tipo_chk !='C' AND area LIKE '%$empleado->area%' ORDER BY nombre_comp ASC");
        $buscar_jefe->setFetchMode(PDO::FETCH_OBJ);
        $buscar_jefe->execute();

        $show_jefe = $buscar_jefe->fetchAll();

        if ($buscar_jefe -> rowCount() > 0) {
          foreach ($show_jefe as $gerente_jefe) {
            $lista_jefes = $gerente_jefe -> nombre_comp;
            echo '<option value="'.$lista_jefes.'">'.$lista_jefes.'</option>';
          }
        }
        echo '</select>
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

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
  <meta http-equiv="refresh" content="0; url=soporte.php?view=soporte"/>
  <?php
}
?>