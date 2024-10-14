<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchk.php';
    require '../functions/links2.php';

    if (isset($_POST['guardar_puesto'])) { ?>
    <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
    <?php
    // Recepción de los valores a guardar
    $nombre_area = $_POST['nombre_area'];
    $nombre_puesto = $_POST['nombre_puesto'];
    $registra_data = $_POST['registra_data'];

    // Conexión a base de datos
    require '../config.php';

    // Comprobación de la existencia del empleado a través de la clave o número de empleado
    $existe_empleado = $con -> prepare("SELECT no_empleado FROM empleados WHERE no_empleado = '$no_empleado'");
    $existe_empleado->setFetchMode(PDO::FETCH_OBJ);
    $existe_empleado->execute();

    $valida_puesto = $existe_empleado -> fetchAll();

    /*if ($existe_empleado -> rowCount() > 0) {
        echo '<script>alert("El empleado '.$.' con clave '.$no_empleado.'ya existe, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=nuevo_empleado.php">';
        } else {
            // Registro de información
            $registra_puesto = $con->prepare("INSERT INTO puestos (area, puesto, registra_data) VALUES (?, ?, ?)");
            $val_registro_puesto = $registra_puesto->execute([$nombre_area, $nombre_puesto, $registra_data]);

            if ($val_registro_puesto) {
            echo '<script>alert("¡Registro exitoso del puesto '.$nombre_puesto.'!")</script>';
            echo '<meta http-equiv="refresh" content="0; url=empleados.php">';
            } else {
            echo '<script>alert("Ocurrió un problema al guardar los datos del puesto, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
            echo '<meta http-equiv="refresh" content="0; url=nuevo_empleado.php">';
            }
        }*/
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
                <h1 class="animated lightSpeedIn">Registro de Empleados</h1>
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
                        echo '<option value="'.$area -> area.'">'.$area -> area.'</option>';
                    }
                } else {
                    echo '<h2 class="text-center">No se encontraron areas registradas en el sistema, por favor, verifícalo en la Administración de las Áreas</h2>';
                }
                ?>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Línea / Departamento</label>
            <select class="form-control" name="linea" id="linea" required>
                <option value=""> - Selecciona el departamentos correspondiente - </option>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Puesto</label>
            <select class="form-control" name="puesto" id="puesto" required>
                <option value=""> - Selecciona el puesto correspondiente - </option>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Sede</label>
            <select class="form-control" name="sede" id="sede" required>
                <option value=""> - Selecciona la sede del colaborador - </option>
                <option value="CDMX">CDMX</option>
                <option value="Morelos">Morelos</option>
                <option value="Externo">Externo</option>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Jefe Inmediato</label>
            <select class="form-control" name="gerente_jefe" id="gerente_jefe" required>
                <option value=""> - Selecciona el jefe directo del colaborador - </option>
            </select><br>

            </div><br>

            <input type="hidden" value="<?php echo $_SESSION['nombre_completo'] ?>" name="registra_data">

            <center><button type="submit" class="btn btn-success" name="guardar_empleado">Guardar Nuevo Empleado</button></center>
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