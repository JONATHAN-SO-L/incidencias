<?php
session_start();

if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH"){
  header('Content-Type: text/html; charset=UTF-8');
  require '../checador/config.php';
  
  $id_permiso = $_SERVER['QUERY_STRING'];
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
<?php include "../inc/navbarchk.php"; ?>
<div class="container"><br><br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="page-header2">
        <h1 class="animated lightSpeedIn">Visualización</h1>
        <span class="label label-danger">Desarrollo Organizacional</span>
        <p class="pull-right text-primary">
          <strong>
            <?php include "../inc/timezone.php"; ?>
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
$buscar_incidencia = $con->prepare("SELECT * FROM permisos WHERE id_permiso = '$id_permiso'");
$buscar_incidencia->setFetchMode(PDO::FETCH_OBJ);
$buscar_incidencia->execute();

$show_incidencia = $buscar_incidencia->fetchAll();

if ($buscar_incidencia -> rowCount() > 0) {
    foreach ($show_incidencia as $incidencia) {
        
        $evidencia = $incidencia -> evidencia;

        echo '<div class="container">
        <div class="col-sm-12">
        <form class="form-horizontal" role="form">
        <div class="form-group">
        <label class="col-sm-2 control-label">Fecha de Creación del Permiso:</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input class="form-control" type="text" name="fecha_creacion" readonly value="'.$incidencia -> fecha_creacion.'">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Nombre del Colaborador</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="nombre_colaborador" readonly value="'.$incidencia -> nombre_colaborador.'">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Clave de Colaborador / No. Empleado</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="no_empleado" readonly value="'.$incidencia -> no_empleado.'">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Puesto</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="puesto" readonly value="'.$incidencia -> puesto.'">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Sede</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="sede" readonly value="'.$incidencia -> sede.'">
        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Motivo de Ausencia</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="motivo_ausencia" readonly value="'.$incidencia -> motivo_ausencia.'">
        <span class="input-group-addon"><i class="fa fa-users"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Fecha de Ausencia</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="fecha_ausencia" readonly value="'.$incidencia -> fecha_ausencia.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Días Solicitados</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="dias_solicitados" readonly value="'.$incidencia -> dias_solicitados.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Hora de Salida</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="hora_salida" readonly value="'.$incidencia -> hora_salida.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Fecha de Probable Regreso</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control"  name="fecha_regreso" readonly value="'.$incidencia -> fecha_regreso.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Hora de Regreso</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="hora_regreso" readonly value="'.$incidencia -> hora_regreso.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Observaciones</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="observaciones" readonly value="'.$incidencia -> observaciones.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <div class="col-sm-11" >
        <div class="form-group">
        <label  class="col-sm-2 control-label">Evidencia Adjunta</label>
        </div>';

        if ($evidencia != NULL) {
            echo '<a class="btn btn-success btn-md text-center" href="'.$incidencia -> evidencia.'" target="_blank" style="margin-left: 50%; margin-bottom: 5%;">Abrir en otra pestaña</a>';
        } else {
            echo '<h8 style="position: relative; left: 200px; bottom: 20px;"><i>--- No se encontró evidencia adjunta ---</i></h8>';
        }

        echo '
        </div>

        <div class="form-group">
        <label  class="col-sm-2 control-label">Dirección IP de registro</label>
        <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="ip_registro" readonly value="'.$incidencia -> ip_registro.'">
        <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
        </div> 
        </div>
        </div>

        <br>
        </form>
        </div>
        </div>';
    }
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
  <?php
}
?>