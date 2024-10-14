<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchk.php';
    require '../functions/links2.php';

    if (isset($_POST['guardar_area'])) { ?>
    <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
    <?php
    // Recepción de los valores a guardar
    $nombre_area = $_POST['nombre_area'];
    $registra_data = $_POST['registra_data'];

    // Conexión a base de datos
    require '../config.php';

    // Comprobación de la existencia del área
    $existe_area = $con -> prepare("SELECT area FROM areas WHERE area = '$nombre_area'");
    $existe_area->setFetchMode(PDO::FETCH_OBJ);
    $existe_area->execute();

    $valida_area = $existe_area -> fetchAll();

    if ($existe_area -> rowCount() > 0) {
        echo '<script>alert("El área '.$nombre_area.' ya existe, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=nueva_area.php">';
        } else {
            // Registro de información
            $registra_area = $con->prepare("INSERT INTO areas (area, registra_data) VALUES (?, ?)");
            $val_registro_area = $registra_area->execute([$nombre_area, $registra_data]);

            if ($val_registro_area) {
            echo '<script>alert("¡Registro exitoso del área '.$nombre_area.'!")</script>';
            echo '<meta http-equiv="refresh" content="0; url=areas.php">';
            } else {
            echo '<script>alert("Ocurrió un problema al guardar los datos del área, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
            echo '<meta http-equiv="refresh" content="0; url=nueva_area.php">';
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
		<div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn">Registro de Áreas</h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
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
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrar un empleado nuevo debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="" method="POST">
			
            <div class="form-group">
              <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre del Área <i>(Evita usar acentos)</i></label>
              <input type="text" class="form-control" name="nombre_area" placeholder="Ejemplo: Desarrollo Organizacional" required maxlength="50">
            </div>

            <input type="hidden" value="<?php echo $_SESSION['nombre_completo'] ?>" name="registra_data">

            <center><button type="submit" class="btn btn-success" name="guardar_area">Guardar Nueva Área</button></center>
          </form>
        </div>
      </div>
    </div>

    <!--div class="col-sm-4 text-center hidden-xs">
      <img src="img/linux.png" class="img-responsive" alt="Image">
      <h2 class="text-primary">¡Gracias! Por preferirnos</h2>
    </div-->

  </div>
</div>

<?php
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
<?php
}
?>