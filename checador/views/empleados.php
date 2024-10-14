<?php
session_start();
if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
    require '../../inc/navbarchk.php';
    require '../functions/links2.php';
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
<div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn">Empleados de VECO</h1>
                <span class="label label-danger">Desarrollo Organizacional</span>
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
              <p class="lead text-info">Bienvenido <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todos los empleados registrados en el sistema.</p>
            </div>
            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="nuevo_empleado.php" class="btn btn-sm btn-success">Agregar Nuevo Empleado</a>
                 </strong>
               </p>
            </div>
        </div>
        </div>
        
        <br><br>
        
        <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                            <?php
                            require '../config.php';

                            $buscar_empleados = $con->prepare("SELECT * FROM empleados ORDER BY area ASC");
                            $buscar_empleados->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_empleados->execute();

                            $show_empleados = $buscar_empleados->fetchAll();

                            if ($buscar_empleados -> rowCount() > 0) { ?>
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
                                                    <a href='#?".$empleado->id_empleado."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><?php echo $empleado->id_empleado; ?></td>
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
<?php
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
<?php
}
?>