<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../../checador/config.php';
  
  $id_permiso = $_SERVER['QUERY_STRING'];

if (isset($_POST['borrar'])) {
    // Consulta para eliminar
    $drop_registro = $con->prepare("DELETE FROM permisos WHERE id_permiso = '$id_permiso'");
    $val_drop = $drop_registro->execute();

    if ($val_drop) {
        echo '<script>alert("Se eliminó correctamente el registro #'.$id_permiso.'")</script>';
        echo '<meta http-equiv="refresh" content="0; url=../../user/permisos_lista.php?'.$id_permiso.'">';
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
        <h1 class="animated lightSpeedIn"><strong>Eliminar incidencia #<u><?php echo $id_permiso; ?></u></strong></h1>
        <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
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
<center>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-danger">
            <div class="panel-heading">
            <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i><center></center></strong></h3>
            </div>
            <div class="panel-body">
            <div class="col-sm-12">
                <h3><strong>¿Estás seguro(a) que deseas eliminar permanentemente este registro?</strong></h3><br>
                <center class="aling-text">
                <form method="POST"><input type="submit" class="btn-md btn btn-danger" name="borrar" id="borrar" value="Si, eliminar">
                <a href="../../user/permisos_lista.php" class="btn-md btn btn-primary">No, cancelar</a></form>
                </center>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
</center>
<br><br><br>

<?php
include "../../inc/footer_rh.php";

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