<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_puesto = $_SERVER['QUERY_STRING'];

if (isset($_POST['nuevos_cambios'])) {
    // Recepción de variables para actualizar
    $puesto_nuevo = $_POST['puesto_nuevo'];

    // Datos de fecha y hora de modificación
    $modifica_data = $_SESSION['nombre_completo'];
    $fecha_hora_modificacion = date("Y-m-d H:i:s");

    //Actualización de datos
    $update_puesto = $con->prepare("UPDATE puestos SET puesto = ?, fecha_hora_modificacion = ?, modifica_data = ?
    WHERE id_puesto = '$id_puesto'");

    $val_update = $update_puesto->execute([$puesto_nuevo, $fecha_hora_modificacion, $modifica_data]);

    if ($val_update) {
        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>REGISTRO ACTUALIZADO</strong></h4>
        <p class="text-center">
        Se actualizó correctamente el folio <strong><u>#'.$id_puesto.'</u></strong>.
        </p>
        </div>
        ';
    } else {
        echo '<script>alert("Ocurrió un error al intentar actualizar el registro, inténtalo de nuevo o ponte en contacto con el Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=puestos.php?'.$id_puesto.'">';
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
        <h1 class="animated lightSpeedIn"><strong>Modificación del puesto #<u><?php echo $id_puesto; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
        <a href="puestos.php" class="btn-sm btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br><br>
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
$buscar_puesto = $con->prepare("SELECT * FROM puestos WHERE id_puesto = '$id_puesto'");
$buscar_puesto->setFetchMode(PDO::FETCH_OBJ);
$buscar_puesto->execute();

$show_puesto = $buscar_puesto->fetchAll();

if ($buscar_puesto -> rowCount() > 0) {
    foreach ($show_puesto as $puesto) {

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
        <label class="col-sm-2 control-label">Área</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="area" readonly value="'.$puesto -> area.'">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Puesto Actual</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="puesto_actual" readonly value="'.$puesto -> puesto.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div><br>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Puesto Nuevo</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="puesto_nuevo" value="'.$puesto -> puesto.'">
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
  <meta http-equiv="refresh" content="0; url=soporte.php?view=soporte"/>
  <?php
}
?>