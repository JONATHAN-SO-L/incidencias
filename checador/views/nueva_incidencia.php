<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchkad.php';
    require '../functions/links2.php';

    if (isset($_POST['guardar_puesto'])) { ?>
    <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
    <?php
    // Recepción de los valores a guardar
    $motivo_ausencia = $_POST['motivo_ausencia'];
    $registra_data = $_POST['registra_data'];
    $fecha_hora_registro = date("Y-m-d H:i:s");

    // Conexión a base de datos
    require '../config.php';

    // Comprobación de la existencia del puesto
    $existe_incidencia = $con -> prepare("SELECT motivo_ausencia FROM motivo_ausencia WHERE motivo_ausencia LIKE '%$motivo_ausencia%'");
    $existe_incidencia->setFetchMode(PDO::FETCH_OBJ);
    $existe_incidencia->execute();

    $valida_incidencia = $existe_incidencia -> fetchAll();

    if ($existe_incidencia -> rowCount() > 0) {
        echo '<script>alert("La incidencia '.$motivo_ausencia.' ya existe, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=nueva_incidencia.php">';
        } else {
            // Registro de información
            $registra_incidencia = $con->prepare("INSERT INTO motivo_ausencia (motivo_ausencia, registra_data, fecha_hora_registro) VALUES (?, ?, ?)");
            $val_registro_incidencia = $registra_incidencia->execute([$motivo_ausencia, $registra_data, $fecha_hora_registro]);

            if ($val_registro_incidencia) {
            echo '<script>alert("¡Registro exitoso de la nueva incidencia '.$motivo_ausencia.'")</script>';
            echo '<meta http-equiv="refresh" content="0; url=motivos_ausencia.php">';
            } else {
            echo '<script>alert("Ocurrió un problema al guardar los datos del puesto, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
            echo '<meta http-equiv="refresh" content="0; url=nueva_incidencia.php">';
            }
        }
    }

?>

<style>
.page-header{
display:none;
}

</style>


        <!--************************************ Page content******************************-->
		<div class="container"><br><br><br>
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn"><strong>Registro de Motivos de Ausencia</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="motivos_ausencia.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar a las incidencias</a><br><br>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container">
        <div class="alert alert-warning">
            <strong>¡RECUERDA!</strong> No utilices acentos para registrar los nombres.
        </div>
        </div>
	 <!--************************************ Page content******************************-->	
		
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrar un motivo de ausencia nuevo debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="" method="POST">
			
            <div class="form-group">
                <label class="control-label"><i class="fa fa-user"></i>&nbsp;Motivo de Ausencia</i></label>
                <input type="text" class="form-control" name="motivo_ausencia" placeholder="Ejemplo -> Incapacidad: Interna" required maxlength="255">
            </div><br>

            <input type="hidden" value="<?php echo $_SESSION['nombre_completo'] ?>" name="registra_data">

            <center><button type="submit" class="btn btn-success" name="guardar_puesto">Guardar Nueva Incidencia</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "../../inc/footer_rh.php";
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                
            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos esta página es solamente para Administradores del Checador Virtual</h1>
                <h3 class="text-info">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
    <meta http-equiv="refresh" content="0; url=soporte.php?view=soporte"/>
<?php
}
?>