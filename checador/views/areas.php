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
                <h1 class="animated lightSpeedIn"><strong>Áreas de VECO</strong></h1>
                <span class="label label-danger">Desarrollo Organizacional</span><br><br>
                <a href="advanced_conf.php" class="btn-sm btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Salir al menú</a><br>
              </div>
            </div>
          </div>
        </div>
		
        <div class="container">
          <div class="row">
            <div class="col-sm-2"><br>
                <img src="../../img/areas.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>

            <div class="col-sm-10"><br>
              <p class="lead text-info">Bienvenido(a) <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todas las áreas registradas en el sistema.</p>
            </div>

            <div class="col-sm-5"><br>
                <form method="POST">
                    <label>Buscar Área: </label>
                    <input class="pull-right form-control" type="search" name="buscar_area" id="buscar_area" placeholder="Ingresa el nombre del área">
                    <input type="submit" class="btn btn-success btn-sm pull-right" value="Buscar" name="buscar_ar" id="buscar_ar">
                </form>
            </div>

            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="nueva_area.php" class="btn btn-sm btn-success">Agregar Nueva Área</a>
                 </strong>
               </p>
            </div>
        </div>
        </div>
        
        <br><br>

        <?php
        if (isset($_POST['buscar_ar'])) { 
            require '../config.php';
            $palabra_clave = $_POST['buscar_area']; ?>
            
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                    <label>Resultados de: <span class="badge bg-success"><?php echo $palabra_clave; ?></span></label>
                    <a href="areas.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br>
                            <?php
                            $buscar_areas = $con->prepare("SELECT * FROM areas WHERE area LIKE '%$palabra_clave%' ORDER BY id_area ASC");
                            $buscar_areas->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_areas->execute();

                            $show_areas = $buscar_areas->fetchAll();

                            // Contador de totales
                            $total_areas = $con->prepare("SELECT COUNT(*) FROM areas WHERE area LIKE '%$palabra_clave%'");
                            $total_areas->execute();
                            $num_total_areas = $total_areas->fetchColumn();

                            if ($buscar_areas -> rowCount() > 0) { ?>
                            <label>Total: <span class="badge bg-success"><?php echo $num_total_areas; ?></span></label><br><br>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Área</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_areas as $areas) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_area.php?".$areas->id_area."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_area.php?".$areas->id_area."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $areas->id_area; ?></strong></td>
                                                <td class="text-center"><?php echo $areas->area; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron áreas registradas en el sistema</h2>';
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

                            $buscar_areas = $con->prepare("SELECT * FROM areas ORDER BY id_area ASC");
                            $buscar_areas->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_areas->execute();

                            $show_areas = $buscar_areas->fetchAll();

                            // Contador de totales
                            $total_areas = $con->prepare("SELECT COUNT(*) FROM areas");
                            $total_areas->execute();
                            $num_total_areas = $total_areas->fetchColumn();

                            if ($buscar_areas -> rowCount() > 0) { ?>
                            <label>Total de Áreas: <span class="badge bg-success"><?php echo $num_total_areas; ?></span></label>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Área</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_areas as $areas) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_area.php?".$areas->id_area."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_area.php?".$areas->id_area."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $areas->id_area; ?></strong></td>
                                                <td class="text-center"><?php echo $areas->area; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron áreas registradas en el sistema</h2>';
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