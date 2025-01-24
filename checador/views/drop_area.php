<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_area = $_SERVER['QUERY_STRING'];

if (isset($_POST['borrar_registro'])) {
    // Recepción de variables para actualizar
    $area = $_POST['area'];

    // Datos de fecha y hora de modificación
    $modifica_data = $_SESSION['nombre_completo'];
    $fecha_hora_modificacion = date("Y-m-d H:i:s");

    //Borrado de área
    $delete_area = $con -> prepare("DELETE FROM areas WHERE id_area = '$id_area'");
    $val_delete_area = $delete_area -> execute();

    if ($val_delete_area) {
      $asunto = "PERMISOS | Área eliminada";
      $destinatario = "tecnicos@veco.lat";
      $cabecera = "From: <noreply@veco.lat>";
      $mensaje = "Se notifica que el área ".$area." con ID: ".$id_area." ha sido eliminado exitosamente el ".$fecha_hora_modificacion." por ".$modifica_data." en el Software de Permisos.\n\n
      Atentamente\n\n
      Soporte Devinsa\n\n
      tecnicos@veco.lat";

      mail($destinatario, $asunto, $mensaje, $cabecera);

        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>REGISTRO ELIMINADO</strong></h4>
        <p class="text-center">
        Se ha eliminado correctamente el área '.$area.' con folio <strong><u>#'.$id_area.'</u></strong>.
        </p>
        </div>
        ';
    } else {
        echo '<script>alert("Ocurrió un error al intentar borrar el registro, inténtalo de nuevo o ponte en contacto con el Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=areas.php?'.$id_area.'">';
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
        <h1 class="animated lightSpeedIn"><strong>Eliminación del área #<u><?php echo $id_area; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
        <a href="areas.php" class="btn-sm btn btn-success"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a>
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
$buscar_area = $con->prepare("SELECT * FROM areas WHERE id_area = '$id_area'");
$buscar_area->setFetchMode(PDO::FETCH_OBJ);
$buscar_area->execute();

$show_area = $buscar_area->fetchAll();

if ($buscar_area -> rowCount() > 0) {
    foreach ($show_area as $area) {

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form" method="POST">

        <div class="alert alert-danger container">
        <strong><center><u><i>IMPORTANTE:</i></u> :</strong> Recuerda que al borrar un área, los departamentos, puestos y empleados tendrán que ser configurados de nuevo.</center>
        </div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Nombre Área</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="area" readonly value="'.$area -> area.'">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <center>
        <div class="form-group">
        <div class="input-group">
        <input type="submit" class="text-center btn-md btn btn-danger" name="borrar_registro" id="borrar_registro" value="Borrar">
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