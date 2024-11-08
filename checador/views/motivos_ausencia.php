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
                <h1 class="animated lightSpeedIn"><strong>Motivos de Ausencia</strong></h1>
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
                <img src="../../img/incidencias.png" alt="Image" class="img-responsive animated flipInY" style="border-radius: 100%; border: solid;">
            </div>
            <div class="col-sm-10"><br>
              <p class="lead text-info">Bienvenido(a) <strong><?php echo $_SESSION['nombre_completo'];?></strong>, en esta página se muestran todas los motivos de ausencia registrados.</p>
            </div>
            <div clas="pull-left">
                <p class="pull-right text-primary">
                  <strong>
                    <a href="" class="btn btn-sm btn-success">Agregar Nuevo Motivo de Ausencia</a>
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

                            $buscar_descripciones = $con->prepare("SELECT * FROM motivo_ausencia ORDER BY id_motivo ASC");
                            $buscar_descripciones->setFetchMode(PDO::FETCH_OBJ);
                            $buscar_descripciones->execute();

                            $show_descripciones = $buscar_descripciones->fetchAll();

                            if ($buscar_descripciones -> rowCount() > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th class="text-center">Acción</th>
                                            <th class="text-center">Folio / ID</th>
                                            <th class="text-center">Descripción</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($show_descripciones as $descripcion) {
                                            echo "<tbody>
                                            <tr>
                                                <td class='text-center'>
                                                    <a href='#?".$descripcion->id_motivo."' class='btn btn-sm btn-warning' title='Modificar'><i class='fa fa-eye' aria-hidden='true'></i> Modificar</a>
                                                    <a href='#?".$descripcion->id_motivo."' class='btn btn-sm btn-danger' title='Eliminar'><i class='fa fa-eye' aria-hidden='true'></i> Eliminar</a>
                                                </td>"
                                        ?>
                                                <td class="text-center"><strong><?php echo $descripcion->id_motivo; ?></strong></td>
                                                <td class="text-center"><?php echo $descripcion->motivo_ausencia; ?></td>
                                            </tr>
                                        </tbody>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            <?php } else {
                                echo '<h2 class="text-center">No se encontraron motivos de ausencia registrados en el sistema</h2>';
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
<?php
}
?>