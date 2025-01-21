<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchkad.php';
    require '../functions/links2.php';

    if (isset($_POST['guardar_puesto'])) { ?>
    <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
    <?php
    // Recepción de los valores a guardar
    $nombre_area = $_POST['nombre_area'];
    $nombre_puesto = $_POST['nombre_puesto'];
    $registra_data = $_POST['registra_data'];
    $fecha_hora_registro = date("Y-m-d H:i:s");

    // Conexión a base de datos
    require '../config.php';

    // Comprobación de la existencia del puesto
    $existe_puesto = $con -> prepare("SELECT puesto FROM puestos WHERE puesto LIKE '%$nombre_puesto%' AND area LIKE '%$nombre_area%'");
    $existe_puesto->setFetchMode(PDO::FETCH_OBJ);
    $existe_puesto->execute();

    $valida_puesto = $existe_puesto -> fetchAll();

    if ($existe_puesto -> rowCount() > 0) {
        echo '<script>alert("El puesto '.$nombre_puesto.' ya existe, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=nuevo_puesto.php">';
        } else {
            // Registro de información
            $registra_puesto = $con->prepare("INSERT INTO puestos (area, puesto, registra_data, fecha_hora_registro) VALUES (?, ?, ?, ?)");
            $val_registro_puesto = $registra_puesto->execute([$nombre_area, $nombre_puesto, $registra_data, $fecha_hora_registro]);

            if ($val_registro_puesto) {
            echo '<script>alert("¡Registro exitoso del puesto '.$nombre_puesto.' para el área '.$nombre_area.'!")</script>';
            echo '<meta http-equiv="refresh" content="0; url=puestos.php">';
            } else {
            echo '<script>alert("Ocurrió un problema al guardar los datos del puesto, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
            echo '<meta http-equiv="refresh" content="0; url=nuevo_puesto.php">';
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
                <h1 class="animated lightSpeedIn"><strong>Registro de Puestos</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="puestos.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar a los puestos</a><br><br>
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
        <div class="panel-heading text-center"><strong>Para poder registrar un puesto nuevo debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="" method="POST">
			
            <div class="form-group">
                <label class="control-label"><i class="fa fa-user"></i>&nbsp;Área a la que pertenece el puesto</label>
                <select class="form-control" name="nombre_area" id="nombre_area" required>
                    <option value=""> - Selecciona el área correspondiente - </option>
                    <?php
                    require '../config.php';

                    $buscar_area = $con->prepare("SELECT area FROM areas ORDER BY area ASC");
                    $buscar_area->setFetchMode(PDO::FETCH_OBJ);
                    $buscar_area->execute();

                    $show_areas = $buscar_area -> fetchAll();

                    if ($buscar_area -> rowCount() > 0) {
                        foreach ($show_areas as $area) {
                            echo '<option value="'.$area -> area.'">'.$area -> area.'</option>';
                        }
                    } else {
                        echo '<h2 class="text-center">No se encontraron areas registradas en el sistema, por favor, verifícalo en la Administración de las Áreas</h2>';
                    }
                    ?>
                </select><br><br>

                <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre del Puesto <i>(Evita usar acentos)</i></label>
                <input type="text" class="form-control" name="nombre_puesto" placeholder="Ejemplo: Atracción de Talento" required maxlength="50">
            </div><br>

            <input type="hidden" value="<?php echo $_SESSION['nombre_completo'] ?>" name="registra_data">

            <center><button type="submit" class="btn btn-success" name="guardar_puesto">Guardar Nuevo Puesto</button></center>
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