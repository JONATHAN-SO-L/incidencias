<?php
session_start();
if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    require '../checador/config.php';
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
<?php include "../inc/navbarchk.php"; ?>
<div class="container"><br><br><br>
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn"><strong>Permisos de Ausentismo</strong></h1>
                <span class="label label-danger"><?php echo $_SESSION['ar'];?></span><br><br>
                <a href="../checador/views/advanced_conf.php" class="btn-sm btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Salir al menú</a><br>
                <p class="pull-right text-primary">
                  <strong>
                  <?php include "../inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>
		
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
                <img src="../img/permiso1.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todos los permisos registrados en el Sistema <strong>solo de EXTERNOS</strong>.</p>
            </div>
          
            <div class="col-sm-9">
            <form action="../checador/functions/search/incidencias_csv_externos.php" method="POST">
                <input type="submit" name="buscar_permisos" class="btn btn-success btn-sm pull-right" value="Descargar CSV" style="margin-left: 2%;">
                <input type="date" name="fecha2" class="pull-right" min="2024-09-01" required style="margin-left: 2%;">
                <label class="pull-right" style="margin-left: 4%;">Fecha de fin:</label>
                <input type="date" name="fecha1" class="pull-right" min="2024-09-01" required style="margin-left: 2%;">
                <label class="pull-right">Fecha de inicio:</label>
            </form>
            </div>

            <div class="col-sm-5"><br>
                <form method="POST">
                    <label>Buscar Incidencia: </label>
                    <input class="pull-right form-control" type="search" name="buscar_incidencia" id="buscar_incidencia" placeholder="Ingresa el nombre del colaborador, clave o folio del registro">
                    <input type="submit" class="btn btn-success btn-sm pull-right" value="Buscar" name="buscar_in" id="buscar_in">
                </form>
            </div>

        </div>
        </div><br>

<!--------------------------------------------
Pildoras de de división para mostrar las sedes
--------------------------------------------->
<?php
// Consulta para obtener el número de registros por sede
//CDMX
$s_permiso_cdmx = $con->prepare("SELECT COUNT(*) FROM veco_do.permisos WHERE sede = 'CDMX'");
$s_permiso_cdmx->execute();
$total_permisos_cdmx = $s_permiso_cdmx->fetchColumn();

//MORELOS
$s_permiso_morelos = $con->prepare("SELECT COUNT(*) FROM veco_do.permisos WHERE sede = 'Morelos'");
$s_permiso_morelos->execute();
$total_permisos_morelos = $s_permiso_morelos->fetchColumn();

//EXTERNOS
$s_permiso_externo = $con->prepare("SELECT COUNT(*) FROM veco_do.permisos WHERE sede = 'Externo'");
$s_permiso_externo->execute();
$total_permisos_externos = $s_permiso_externo->fetchColumn();
?>

<div class="container mt-3">
  <ul class="nav nav-pills nav-justified">
    <li class="nav-item">
      <a class="nav-link" href="permisos_lista_cdmx.php"><strong>CDMX</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_permisos_cdmx?></span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="permisos_lista_morelos.php"><strong>MORELOS</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_permisos_morelos?></span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="permisos_lista_externos.php"><strong>EXTERNO</strong>&nbsp;&nbsp;<span class="badge rounded-pill bg-primary"><?php echo $total_permisos_externos?></span></a>
    </li>
  </ul>
</div>

<?php
/************************
Búsqueda de incidencia
************************/
if (isset($_POST['buscar_in'])) {
    //La incidencia puede ser el folio, la clave del colaborador o el nombre del mismo
    $palabra_clave = $_POST['buscar_incidencia']; ?>

    <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                            <label>Resultados de: <span class="badge bg-success"><?php echo $palabra_clave; ?></span></label>
                            <a href="permisos_lista_externos.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br><br>
                            <?php
                            /*********************
                            Resultados de busqueda
                            *********************/
                            $buscar_permisos = $con->prepare("SELECT * FROM permisos WHERE id_permiso LIKE '%$palabra_clave%' AND sede = 'Externo' OR no_empleado LIKE '%$palabra_clave%' AND sede = 'Externo' OR nombre_colaborador LIKE '%$palabra_clave%' AND sede = 'Externo' ORDER BY id_permiso DESC");
                            $buscar_permisos->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_permisos->execute();

                            $show_permisos = $buscar_permisos->fetchAll();

                            if ($buscar_permisos -> rowCount() > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Clave de Colaborador</th>
                                            <th class="text-center">Nombre Completo</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Línea / Departamento</th>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Jefe Inmediato </th>
                                            <th class="text-center">Incidencia</th>
                                            <th class="text-center">Fecha de Ausencia</th>
                                            <th class="text-center">Días Solicitados</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_permisos as $permiso) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='ver_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-primary' title='Ver Incidencia'><i class='fa fa-eye' aria-hidden='true'></i> Ver Detalles</a>
                                                    <a href='../checador/formatos/permiso_pdf.php?".$permiso->id_permiso."' class='btn btn-sm btn-success' title='Imprimir' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i> Imprimir</a>
                                                    <a href='../checador/views/mod_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='../checador/views/drop_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $permiso->id_permiso; ?></strong></td>
                                                <td class="text-center"><?php echo $permiso->no_empleado; ?></td>
                                                <td class="text-center"><?php echo $permiso->nombre_colaborador; ?></td>
                                                <td class="text-center"><?php echo $permiso->area; ?></td>
                                                <td class="text-center"><?php echo $permiso->linea; ?></td>
                                                <td class="text-center"><?php echo $permiso->puesto; ?></td>
                                                <td class="text-center"><?php echo $permiso->gerente_jefe; ?></td>
                                                <td class="text-center"><strong><?php echo $permiso->motivo_ausencia; ?></strong></td>
                                                <td class="text-center"><strong><?php echo $permiso->fecha_ausencia; ?></strong></td>
                                                <td class="text-center"><?php echo $permiso->dias_solicitados; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron permisos registrados en el sistema</h2>';
                            }
                            ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

<?php } else {
    require '../checador/config.php';

    $buscar_permisos = $con->prepare("SELECT * FROM permisos WHERE sede = 'Externo' ORDER BY id_permiso DESC");
    $buscar_permisos->setFetchMode(PDO::FETCH_OBJ);
    $buscar_permisos->execute();

    $show_permisos = $buscar_permisos->fetchAll();

    if ($buscar_permisos -> rowCount() > 0) { ?>
    <div class="container"><br>
                <div class="row">
                    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                    <th class="text-center">Acción</th>
                    <th class="text-center">Folio / ID</th>
                    <th class="text-center">Clave de Colaborador</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Área</th>
                    <th class="text-center">Línea / Departamento</th>
                    <th class="text-center">Puesto</th>
                    <th class="text-center">Jefe Inmediato </th>
                    <th class="text-center">Incidencia</th>
                    <th class="text-center">Fecha de Ausencia</th>
                    <th class="text-center">Días Solicitados</th>
                    </tr>
                </thead>
                <?php
                foreach ($show_permisos as $permiso) {
                    echo "<tbody>
                    <tr>
                        <td class='text-center'>
                            <a href='ver_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-primary' title='Ver Incidencia'><i class='fa fa-eye' aria-hidden='true'></i> Ver Detalles</a>
                            <a href='../checador/formatos/permiso_pdf.php?".$permiso->id_permiso."' class='btn btn-sm btn-success' title='Imprimir' target='_blank'><i class='fa fa-eye' aria-hidden='true'></i> Imprimir</a>
                            <a href='../checador/views/mod_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                            <a href='../checador/views/drop_incidencia.php?".$permiso->id_permiso."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                        </td>"
                ?>
                        <td class="text-center"><strong><?php echo $permiso->id_permiso; ?></strong></td>
                        <td class="text-center"><?php echo $permiso->no_empleado; ?></td>
                        <td class="text-center"><?php echo $permiso->nombre_colaborador; ?></td>
                        <td class="text-center"><?php echo $permiso->area; ?></td>
                        <td class="text-center"><?php echo $permiso->linea; ?></td>
                        <td class="text-center"><?php echo $permiso->puesto; ?></td>
                        <td class="text-center"><?php echo $permiso->gerente_jefe; ?></td>
                        <td class="text-center"><strong><?php echo $permiso->motivo_ausencia; ?></strong></td>
                        <td class="text-center"><strong><?php echo $permiso->fecha_ausencia; ?></strong></td>
                        <td class="text-center"><?php echo $permiso->dias_solicitados; ?></td>
                    </tr>
                </tbody>
                <?php }
                ?>
            </table>
        </div>
    <?php } else {
        echo '<h2 class="text-center">No se encontraron permisos registrados en el sistema</h2>';
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
include "../inc/footer_permiso.php";
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                    
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