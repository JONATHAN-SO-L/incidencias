<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchkad.php';
    require '../functions/links2.php';
    require '../config.php';

    // Obtiene clave del colaborador
    $id_empleado = $_SERVER['QUERY_STRING'];

    // Obtiene los datos del registro en DDBB
    $buscar_colaborador = $con->prepare("SELECT * FROM veco_do.empleados WHERE no_empleado = '$id_empleado'");
    $buscar_colaborador->setFetchMode(PDO::FETCH_OBJ);
    $buscar_colaborador->execute();

    $mostrar_colaborador = $buscar_colaborador->fetchAll();

    if ($buscar_colaborador -> rowCount() > 0) {
        foreach ($mostrar_colaborador as $colaborador) {
            $nombre_colaborador = $colaborador -> nombre_colaborador;
            $no_empleado = $colaborador -> no_empleado;
            $area = $colaborador -> area;
        }
    } else {
        echo '<script>alert("Ocurrió un problema con el registro que se quiere mostrar ya que no existe, por favor contacta al Soporte Técnico")</script>';
        echo '<meta http-equiv="refresh" content="0; url=empleados.php">';
    }

    if (isset($_POST['guardar_empleado'])) { ?>
        <img src="../../img/spin_carga.gif" alt="Pantalla de carga" style="heigth: 100%; width: 100%;">
        <?php
        // Obtiene datos del formulario
        $linea = $_POST['linea'];
        $puesto = $_POST['puesto'];
        $sede = $_POST['sede'];
        $gerente_jefe = $_POST['gerente_jefe'];
        $registra_data = $_POST['registra_data'];
        $fecha_hora_registro = date("Y-m-d H:i:s");

        // Guardar nuevos datos en el registro del empleado
        $guardar_empleado = $con->prepare("UPDATE empleados SET linea = ?, puesto = ?, sede = ?, gerente_jefe = ?, registra_data = ?, fecha_hora_registro = ?");
        $val_guardar_empleado = $guardar_empleado -> execute([$linea, $puesto, $sede, $gerente_jefe, $registra_data, $fecha_hora_registro]);

        if ($val_guardar_empleado) {
            echo '<script>alert("¡Se registró con éxito el empleado: '.$nombre_colaborador.' con Clave: '.$no_empleado.' en el sistema!")</script>';
            echo '<meta http-equiv="refresh" content="0; url=empleados.php">';
        } else {
            echo '<script>alert("Ocurrió un problema al intentar guardar los datos, por favor contacta al Soporte Técnico")</script>';
            echo '<meta http-equiv="refresh" content="0; url=empleados.php">';
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
            <input type="text" class="form-control" name="nombre_colaborador" value="<?php echo $nombre_colaborador; ?>" readonly><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;No. Empleado / Clave del Colaborador</label>
            <input type="text" class="form-control" name="no_empleado" value="<?php echo $no_empleado; ?>" readonly><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Área</label>
            <input type="text" class="form-control" name="area" value="<?php echo $area; ?>" readonly><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Línea / Departamento</label>
            <select class="form-control" name="linea" id="linea" required>
                <option value=""> - Selecciona el departamentos correspondiente - </option>
                <?php
                // Busca la línea / departamento en base al área
                $s_linea = $con->prepare("SELECT linea FROM lineas WHERE area = '$area'");
                $s_linea->setFetchMode(PDO::FETCH_OBJ);
                $s_linea->execute();

                $m_linea = $s_linea->fetchAll();

                if ($s_linea -> rowCount() > 0) {
                    foreach ($m_linea as $linea) {
                        $linea = $linea -> linea;
                        echo '<option value="'.$linea.'">'.$linea.'</option>';
                    }
                } else {
                    echo 'No se encontraron líneas registradas en el sistema, por favor, verifícalo en la Configuración Avanzada';
                }
                ?>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Puesto</label>
            <select class="form-control" name="puesto" id="puesto" required>
                <option value=""> - Selecciona el puesto correspondiente - </option>
                <?php
                // Busca el puesto en base al área
                $s_puesto = $con->prepare("SELECT puesto FROM puestos WHERE area = '$area'");
                $s_puesto->setFetchMode(PDO::FETCH_OBJ);
                $s_puesto->execute();

                $m_puesto = $s_puesto->fetchAll();

                if ($s_puesto -> rowCount() > 0) {
                    foreach ($m_puesto as $puesto) {
                        $puesto = $puesto -> puesto;
                        echo '<option value="'.$puesto.'">'.$puesto.'</option>';
                    }
                } else {
                    echo 'No se encontraron puestos registradas en el sistema, por favor, verifícalo en la Configuración Avanzada';
                }
                ?>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Sede</label>
            <select class="form-control" name="sede" id="sede" required>
                <option value=""> - Selecciona la sede del colaborador - </option>
                <option value="CDMX">CDMX</option>
                <option value="Morelos">Morelos</option>
                <option value="Externo">Externo</option>
            </select><br>

            <label class="control-label"><i class="fa fa-user"></i>&nbsp;Jefe Inmediato <u><i>(G - Gerente // J - Jefe)</i></u></label>
            <select class="form-control" name="gerente_jefe" id="gerente_jefe" required>
                <option value=""> - Selecciona el jefe directo del colaborador - </option>
                <?php
                // Busca al jefe inmediato en base al área
                $buscar_jefe = $con->prepare("SELECT nombre_comp, area, tipo_chk FROM veco_sims_devecchi.usuario_sop WHERE area = '$area' AND tipo_chk = 'G' OR area = '$area' AND tipo_chk = 'J' ORDER BY tipo_chk ASC");
                $buscar_jefe->setFetchMode(PDO::FETCH_OBJ);
                $buscar_jefe->execute();

                $show_jefe = $buscar_jefe -> fetchAll();

                if ($buscar_jefe -> rowCount() > 0) {
                    foreach ($show_jefe as $jefe) {
                        $nombre_jefe = $jefe -> nombre_comp;
                        $tipo_jefe = $jefe -> tipo_chk;
                        echo '<option value="'.$nombre_jefe.'">'.$nombre_jefe.' || Tipo: '.$tipo_jefe.'</option>';
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