<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchkad.php';
    require '../functions/links2.php';
    require '../config.php';

    if (isset($_POST['guardar_empleado'])) { ?>
        <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
        <?php
        // Obtiene datos del formulario
        $no_empleado = $_POST['no_empleado'];
        // Valida que el colaborador no exista en base al número/clave de empleado
        $buscar_empleado = $con->prepare("SELECT no_empleado FROM veco_do.empleados WHERE no_empleado = '$no_empleado'");
        $buscar_empleado->setFetchMode(PDO::FETCH_OBJ);
        $buscar_empleado->execute();

        $mostrar_empleados = $buscar_empleado->fetchAll();

        if ($buscar_empleado -> rowCount() > 0) {
            $no_empleado = $_POST['no_empleado'];
            echo '<script>alert("No fue posible registrar el nuevo colaborador ya que el código de empleado: '.$no_empleado.' ya existe, por favor, inténtalo de nuevo")</script>';
            echo '<meta http-equiv="refresh" content="0; url=nuevo_empleado.php">';
            die();
        } else {
            foreach ($mostrar_empleados as $empleado_number) {
                $no_empleado = $empleado_number -> no_empleado;
            }
            $nombre_colaborador = $_POST['nombre_colaborador'];
            $area = $_POST['area'];
            $registra_data = $_POST['registra_data'];

            // Registro del información en DDBB
            $save_collab = $con->prepare("INSERT INTO veco_do.empleados (nombre_colaborador, no_empleado, area, registra_data) VALUES (?, ?, ?, ?)");
            $val_save_collab = $save_collab->execute([$nombre_colaborador, $no_empleado, $area, $registra_data]);

            if ($val_save_collab) {
                echo '<meta http-equiv="refresh" content="0; url=nuevo_empleado2.php?'.$no_empleado.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al guardar los datos del empleado, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
                echo '<meta http-equiv="refresh" content="0; url=nuevo_empleado.php">';
            }
        }
    } else {
        echo '<script>console.log("No se recibió acción del botón")</script>';
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
                <h1 class="animated lightSpeedIn"><strong>Registro de Empleados</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="empleados.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar a los empleados</a><br><br>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container">
        <div class="alert alert-warning">
            <strong>¡RECUERDA!</strong> No utilices acentos para registrar los nombres.<br>
            <strong>¡IMPORTANTE!</strong> El formulario se irá actualizando conforme vayas guardando datos.
        </div>
        </div>
	 <!--************************************ Page content******************************-->	
		
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrar un empleado nuevo debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="" method="POST">
            <div class="form-group">
            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre Completo del Colaborador <i>(Evita usar acentos)</i></label>
            <input type="text" class="form-control" name="nombre_colaborador" placeholder="Ejemplo: Raquel Arizmendi Garcia" required maxlength="50"><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;No. Empleado / Clave del Colaborador</label>
            <input type="text" class="form-control" name="no_empleado" placeholder="Ejemplo: A01" required maxlength="50"><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Área</label>
            <select class="form-control" name="area" id="area" required>
                <option value=""> - Selecciona el área correspondiente - </option>
                <?php
                require '../config.php';

                $buscar_area = $con->prepare("SELECT area FROM areas ORDER BY area ASC");
                $buscar_area->setFetchMode(PDO::FETCH_OBJ);
                $buscar_area->execute();

                $show_areas = $buscar_area -> fetchAll();

                if ($buscar_area -> rowCount() > 0) {
                    foreach ($show_areas as $area) {
                        $area = $area -> area;
                        echo '<option value="'.$area.'">'.$area.'</option>';
                    }
                } else {
                    echo '<h2 class="text-center">No se encontraron áreas registradas en el sistema, por favor, verifícalo en la <strong>Administración de las Áreas</strong></h2>';
                }
                ?>
            </select><br>
            </div><br>

            <input type="hidden" value="<?php echo $_SESSION['nombre_completo'] ?>" name="registra_data">

            <center><button type="submit" class="btn btn-success" name="guardar_empleado">Guardar Nuevo Empleado</button></center>
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
    <meta http-equiv="refresh" content="0; url=../../soporte.php?view=soporte"/>
<?php
}
?>