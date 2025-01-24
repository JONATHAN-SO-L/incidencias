<?php
session_start();
if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    require '../config.php';
    require '../../inc/navbarchkad.php';
?>

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
</style>
<div class="container"><br><br><br>
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn"><strong>Empleados de VECO</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="advanced_conf.php" class="btn-sm btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Salir al menú</a><br>
                <p class="pull-right text-primary">
                  <strong>
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>
		
        <div class="container">
          <div class="row">
            <div class="col-sm-2"><br>
                <img src="../../img/empleados.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>

            <div class="col-sm-10"><br>
              <p class="lead text-info">Bienvenido(a) <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran <strong>todos los empleados Externos</strong>.</p>
            </div>

            <div class="col-sm-5"><br>
                <form method="POST">
                    <label>Buscar Empleado: </label>
                    <input class="pull-right form-control" type="search" name="buscar_empleado" id="buscar_empleado" placeholder="Inserta el nombre completo, número clave del colaborador o área">
                    <input type="submit" class="btn btn-success btn-sm pull-right" value="Buscar" name="buscar_employee" id="buscar_employee">
                </form>
            </div>

            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="nuevo_empleado.php" class="btn btn-sm btn-success">Agregar Nuevo Empleado</a>
                 </strong>
               </p>
            </div>
        </div>
        </div><br>

<!--------------------------------------------
Pildoras de de división para mostrar las sedes
--------------------------------------------->
<?php
// Consulta para obtener el número de registros por sede
//CDMX
$s_empleados_cdmx = $con->prepare("SELECT COUNT(*) FROM veco_do.empleados WHERE sede = 'CDMX'");
$s_empleados_cdmx->execute();
$total_empleados_cdmx = $s_empleados_cdmx->fetchColumn();

//MORELOS
$s_empleados_morelos = $con->prepare("SELECT COUNT(*) FROM veco_do.empleados WHERE sede = 'Morelos'");
$s_empleados_morelos->execute();
$total_empleados_morelos = $s_empleados_morelos->fetchColumn();

//EXTERNOS
$s_empleados_externo = $con->prepare("SELECT COUNT(*) FROM veco_do.empleados WHERE sede = 'Externo'");
$s_empleados_externo->execute();
$total_empleados_externos = $s_empleados_externo->fetchColumn();
?>

<div class="container mt-3">
  <ul class="nav nav-pills nav-justified">
    <li class="nav-item">
      <a class="nav-link" href="empleados_cdmx.php"><strong>CDMX</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_empleados_cdmx?></span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="empleados_morelos.php"><strong>MORELOS</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_empleados_morelos?></span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="empleados_externos.php"><strong>EXTERNO</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_empleados_externos?></span></a>
    </li>
  </ul>
</div><br>

        <?php
        if (isset($_POST['buscar_employee'])) {
            $palabra_clave = $_POST['buscar_empleado']; ?>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                    <label>Resultados de: <span class="badge bg-success"><?php echo $palabra_clave; ?></span></label>
                    <a href="empleados_externos.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br>
                            <?php
                            $buscar_empleados = $con->prepare("SELECT * FROM empleados WHERE nombre_colaborador LIKE '%$palabra_clave%' AND sede = 'Externo' OR no_empleado LIKE '%$palabra_clave%' AND sede = 'Externo' OR area LIKE '%$palabra_clave%' AND sede = 'Externo' ORDER BY id_empleado ASC");
                            $buscar_empleados->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_empleados->execute();

                            $show_empleados = $buscar_empleados->fetchAll();

                            // Contador de totales
                            $total_empleados = $con->prepare("SELECT COUNT(*) FROM empleados WHERE nombre_colaborador LIKE '%$palabra_clave%' AND sede = 'Externo' OR no_empleado LIKE '%$palabra_clave%' AND sede = 'Externo' OR area LIKE '%$palabra_clave%' AND sede = 'Externo'");
                            $total_empleados->execute();
                            $num_total_empleados = $total_empleados->fetchColumn();

                            if ($buscar_empleados -> rowCount() > 0) { ?>
                            <label>Total: <span class="badge bg-success"><?php echo $num_total_empleados; ?></span></label><br><br>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Nombre del Colaborador</th>
                                            <th class="text-center">Clave / No. Empleado</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Línea / Departamento</th>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Sede</th>
                                            <th class="text-center">Jefe Inmediato</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_empleados as $empleado) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_empleado.php?".$empleado->id_empleado."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_empleado.php?".$empleado->id_empleado."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $empleado->id_empleado; ?></strong></td>
                                                <td class="text-center"><?php echo $empleado->nombre_colaborador; ?></td>
                                                <td class="text-center"><?php echo $empleado->no_empleado; ?></td>
                                                <td class="text-center"><?php echo $empleado->area; ?></td>
                                                <td class="text-center"><?php echo $empleado->linea; ?></td>
                                                <td class="text-center"><?php echo $empleado->puesto; ?></td>
                                                <td class="text-center"><?php echo $empleado->sede; ?></td>
                                                <td class="text-center"><?php echo $empleado->gerente_jefe; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron empleados registrados en el sistema</h2>';
                            }
                            ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                            <?php
                            require '../config.php';

                            $buscar_empleados = $con->prepare("SELECT * FROM empleados WHERE sede = 'Externo' ORDER BY area ASC");
                            $buscar_empleados->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_empleados->execute();

                            $show_empleados = $buscar_empleados->fetchAll();

                            // Contador de totales
                            $total_empleados = $con->prepare("SELECT COUNT(*) FROM empleados WHERE sede = 'Externo'");
                            $total_empleados->execute();
                            $num_total_empleados = $total_empleados->fetchColumn();

                            if ($buscar_empleados -> rowCount() > 0) { ?>
                            <label>Total de Empleados: <span class="badge bg-success"><?php echo $num_total_empleados; ?></span></label>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Nombre del Colaborador</th>
                                            <th class="text-center">Clave / No. Empleado</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Línea / Departamento</th>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Sede</th>
                                            <th class="text-center">Jefe Inmediato</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_empleados as $empleado) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_empleado.php?".$empleado->id_empleado."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_empleado.php?".$empleado->id_empleado."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $empleado->id_empleado; ?></strong></td>
                                                <td class="text-center"><?php echo $empleado->nombre_colaborador; ?></td>
                                                <td class="text-center"><?php echo $empleado->no_empleado; ?></td>
                                                <td class="text-center"><?php echo $empleado->area; ?></td>
                                                <td class="text-center"><?php echo $empleado->linea; ?></td>
                                                <td class="text-center"><?php echo $empleado->puesto; ?></td>
                                                <td class="text-center"><?php echo $empleado->sede; ?></td>
                                                <td class="text-center"><?php echo $empleado->gerente_jefe; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron empleados registrados en el sistema</h2>';
                            }
                            ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <?php }

include "../../inc/footer_rh.php";
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="../../img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="../../img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para RH de Veco</h1>
                    <h3 class="text-info text-center">Inicia sesión como RH para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
        <meta http-equiv="refresh" content="0; url=soporte.php?view=soporte"/>
<?php
}
?>