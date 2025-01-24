<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_linea = $_SERVER['QUERY_STRING'];

if (isset($_POST['borrar_registro'])) {
    // Recepción de variables para actualizar
    $linea = $_POST['linea'];

    // Datos de fecha y hora de modificación
    $modifica_data = $_SESSION['nombre_completo'];
    $fecha_hora_modificacion = date("Y-m-d H:i:s");

    //Borrado de línea / departamento
    $delete_linea = $con -> prepare("DELETE FROM lineas WHERE id_linea = '$id_linea'");
    $val_delete_linea = $delete_linea -> execute();

    if ($val_delete_linea) {
      $asunto = "PERMISOS | Departamento eliminado";
      $destinatario = "tecnicos@veco.lat";
      $cabecera = "From: <noreply@veco.lat>";
      $mensaje = "Se notifica que el departamento ".$linea." con ID: ".$id_linea." ha sido eliminado exitosamente el ".$fecha_hora_modificacion." por ".$modifica_data." en el Software de Permisos.\n\n
      Atentamente\n\n
      Soporte Devinsa\n\n
      tecnicos@veco.lat";

      mail($destinatario, $asunto, $mensaje, $cabecera);

        echo '
        <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center"><strong>REGISTRO ELIMINADO</strong></h4>
        <p class="text-center">
        Se ha eliminado correctamente el departamento/línea '.$linea.' con folio <strong><u>#'.$id_linea.'</u></strong>.
        </p>
        </div>
        ';
    } else {
        echo '<script>alert("Ocurrió un error al intentar borrar el registro, inténtalo de nuevo o ponte en contacto con el Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=lineas.php?'.$id_linea.'">';
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
        <h1 class="animated lightSpeedIn"><strong>Eliminación del departamento #<u><?php echo $id_linea; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
        <a href="lineas.php" class="btn-sm btn btn-success"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a>
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
$buscar_depto = $con->prepare("SELECT * FROM lineas WHERE id_linea = '$id_linea'");
$buscar_depto->setFetchMode(PDO::FETCH_OBJ);
$buscar_depto->execute();

$show_depto = $buscar_depto->fetchAll();

if ($buscar_depto -> rowCount() > 0) {
    foreach ($show_depto as $depto) {

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form" method="POST">

        <div class="alert alert-danger container">
        <strong><center><u><i>IMPORTANTE:</i></u> :</strong> Recuerda que al borrar un área, los departamentos, puestos y empleados tendrán que ser configurados de nuevo.</center>
        </div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Área Actual</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="area" readonly value="'.$depto -> area.'">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Línea / Departamento</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="linea" readonly value="'.$depto -> linea.'">
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