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
                <h1 class="animated lightSpeedIn"><strong>Puestos de VECO</strong></h1>
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
                <img src="../../img/puestos.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>

            <div class="col-sm-10"><br>
              <p class="lead text-info">Bienvenido(a) <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todos los puestos registrados en el sistema.</p>
            </div>

            <div class="col-sm-5"><br>
                <form method="POST">
                    <label>Buscar Puesto: </label>
                    <input class="pull-right form-control" type="search" name="buscar_puesto" id="buscar_puesto" placeholder="Inserta el puesto o área a buscar">
                    <input type="submit" class="btn btn-success btn-sm pull-right" value="Buscar" name="buscar_pues" id="buscar_pues">
                </form>
            </div>

            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="nuevo_puesto.php" class="btn btn-sm btn-success">Agregar Nuevo Puesto</a>
                 </strong>
               </p>
            </div>
        </div>
        </div>
        
        <br><br>

        <?php
        if (isset($_POST['buscar_pues'])) {
            require '../config.php';
            $palabra_clave = $_POST['buscar_puesto']; ?>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                    <label>Resultados de: <span class="badge bg-success"><?php echo $palabra_clave; ?></span></label>
                    <a href="puestos.php" class="btn-sm btn btn-danger pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar al inicio</a><br>
                            <?php
                            $buscar_puestos = $con->prepare("SELECT * FROM puestos WHERE area LIKE '%$palabra_clave%' OR puesto LIKE '%$palabra_clave%' ORDER BY id_puesto ASC");
                            $buscar_puestos->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_puestos->execute();

                            $show_puestos = $buscar_puestos->fetchAll();

                            // Contador de totales
                            $total_puestos = $con->prepare("SELECT COUNT(*) FROM puestos WHERE area LIKE '%$palabra_clave%' OR puesto LIKE '%$palabra_clave%'");
                            $total_puestos->execute();
                            $num_total_puestos = $total_puestos->fetchColumn();

                            if ($buscar_puestos -> rowCount() > 0) { ?>
                            <label>Total: <span class="badge bg-success"><?php echo $num_total_puestos; ?></span></label><br><br>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Área</th>
                                            <th class="text-center">Puesto</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_puestos as $puesto) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='mod_puesto.php?".$puesto->id_puesto."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='drop_puesto.php?".$puesto->id_puesto."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $puesto->id_puesto; ?></strong></td>
                                                <td class="text-center"><?php echo $puesto->area; ?></td>
                                                <td class="text-center"><?php echo $puesto->puesto; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron puestos registrados en el sistema</h2>';
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
                        $buscar_puestos = $con->prepare("SELECT * FROM puestos ORDER BY area ASC");
                        $buscar_puestos->setFetchMode(PDO::FETCH_OBJ);
                        $buscar_puestos->execute();

                        $show_puestos = $buscar_puestos->fetchAll();

                        // Contador de totales
                        $total_puestos = $con->prepare("SELECT COUNT(*) FROM puestos");
                        $total_puestos->execute();
                        $num_total_puestos = $total_puestos->fetchColumn();

                        if ($buscar_puestos -> rowCount() > 0) { ?>
                        <label>Total de Puestos: <span class="badge bg-success"><?php echo $num_total_puestos; ?></span></label>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                        <th class="text-center">Acción</th>
                                        <th class="text-center">Folio / ID</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Puesto</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach ($show_puestos as $puesto) {
                                        echo "<tbody>
                                        <tr>
                                            <td class='text-center'>
                                                <a href='mod_puesto.php?".$puesto->id_puesto."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                <a href='drop_puesto.php?".$puesto->id_puesto."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                            </td>"
                                    ?>
                                            <td class="text-center"><strong><?php echo $puesto->id_puesto; ?></strong></td>
                                            <td class="text-center"><?php echo $puesto->area; ?></td>
                                            <td class="text-center"><?php echo $puesto->puesto; ?></td>
                                        </tr>
                                    </tbody>
                                    <?php }
                                    ?>
                                </table>
                            </div>
                        <?php } else {
                            echo '<h2 class="text-center">No se encontraron puestos registrados en el sistema</h2>';
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