<?php
require '../../config.php';

$colaborador = $_POST['colaborador'];

$query = $con->prepare("SELECT * FROM empleados WHERE no_empleado = '$colaborador' ORDER BY no_empleado ASC");
$query->setFetchMode(PDO::FETCH_OBJ);
$query->execute();

$show_no_collab = $query->fetchAll();

if ($query -> rowCount() > 0) {
    foreach ($show_no_collab as $no_employee) {
        $number = $no_employee -> no_empleado;
        $html.='<input type="text" class="form-control" readonly name="no_empleado" value='.$number.'>
        <span class="input-group-addon"><i class="fa fa-user"></i></span>';
    }
}

$html= '<input type="text" class="form-control" readonly name="no_empleado" placeholder="Ejemplo: S012">
<span class="input-group-addon"><i class="fa fa-user"></i></span>';

echo $html;

?>