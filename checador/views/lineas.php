<?php
session_start();
if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="RH" || $_SESSION['tipo']=="admin"){
    
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
                <h1 class="animated lightSpeedIn"><strong>Líneas o Departamentos de VECO</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="advanced_conf.php" class="btn-sm btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Salir al menú</a><br>
              </div>
            </div>
          </div>
        </div>
		
        <div class="container">
          <div class="row">
            <div class="col-sm-2"><br>
                <img src="../../img/lineas.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>

            <div class="col-sm-10"><br>
              <p class="lead text-info">Bienvenido(a) <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todas las líneas / departamentos registrados en el sistema.</p>
            </div>

            <div class="col-sm-5"><br>
                <form method="POST">
                    <label>Buscar Línea / Departamento: </label>
                    <input class="pull-right form-control" type="search" name="buscar_linea" id="buscar_linea" placeholder="Inserta el nombre del área o línea / departamento">
                    <input type="submit" class="btn btn-success btn-sm pull-right" value="Buscar" name="buscar_lin" id="buscar_lin">
                </form>
            </div>
            
            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="nueva_linea.php" class="btn btn-sm btn-success">Agregar Nuevo Departamento</a>
                 </strong>
               </p>
            </div>
        </div>
        </div>
        
        <br><br>

        <?php
        if (isset($_POST['buscar_lin'])) {
            require '../config.php';
            $palabra_clave = $_POST['buscar_linea']; ?>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                    <label>Resultados de: <span class="badge bg-success"><?php echo $palabra_clave; ?></span></label>
                    <a href="lineas.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br>
                            <?php
                            $buscar_lineas = $con->prepare("SELECT * FROM lineas WHERE area LIKE '%$palabra_clave%' or linea LIKE '%$palabra_clave%' ORDER BY id_linea ASC");
                            $buscar_lineas->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_lineas->execute();

                            $show_lineas = $buscar_lineas->fetchAll();

                            // Contador de totales
                            $total_lineas = $con->prepare("SELECT COUNT(*) FROM lineas WHERE area LIKE '%$palabra_clave%'");
                            $total_lineas->execute();
                            $num_total_lineas = $total_lineas->fetchColumn();

                            if ($buscar_lineas -> rowCount() > 0) { ?>
                            <label>Total: <span class="badge bg-success"><?php echo $num_total_lineas; ?></span></label><br><br>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Departamento</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_lineas as $linea) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_linea.php?".$linea->id_linea."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_linea.php?".$linea->id_linea."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $linea->id_linea; ?></strong></td>
                                                <td class="text-center"><?php echo $linea->area; ?></td>
                                                <td class="text-center"><?php echo $linea->linea; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron departamentos registrados en el sistema</h2>';
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

                            $buscar_lineas = $con->prepare("SELECT * FROM lineas ORDER BY area ASC");
                            $buscar_lineas->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_lineas->execute();

                            $show_lineas = $buscar_lineas->fetchAll();

                            // Contador de totales
                            $total_lineas = $con->prepare("SELECT COUNT(*) FROM lineas");
                            $total_lineas->execute();
                            $num_total_lineas = $total_lineas->fetchColumn();

                            if ($buscar_lineas -> rowCount() > 0) { ?>
                            <label>Total de Líneas / Departamentos: <span class="badge bg-success"><?php echo $num_total_lineas; ?></span></label>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Departamento</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_lineas as $linea) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_linea.php?".$linea->id_linea."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_linea.php?".$linea->id_linea."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $linea->id_linea; ?></strong></td>
                                                <td class="text-center"><?php echo $linea->area; ?></td>
                                                <td class="text-center"><?php echo $linea->linea; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron departamentos registrados en el sistema</h2>';
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