<?php
include '../../config_mysqlnd.php';

$delimiter = ",";

$filename = "Permisos_Ausentismo_".date('Y-m-d')."_CDMX.csv";
$fecha_inicio = $_POST['fecha1'];
$fecha_fin = $_POST['fecha2'];

//create a file pointer
$f = fopen('php://memory', 'a');

//crea los encabezados de las columnas
$fields = array('ID / Folio', 'Clave de Colaborador', 'Nombre Completo', 'Fecha de Ingreso', 'Estatus', 'Puesto', 'Area', 'Departamento', 'Sede', 'Jefe Inmediato', 'Fecha de Creacion Incidencia', 'Hora de Creacion de Incidencia', 'Incidencia', 'Goce de Sueldo', 'Fecha de Ausencia', 'Hora de Salida', 'Hora de Regreso','Dias Solicitados', 'Observaciones');

fputcsv($f, $fields, $delimiter);

//extrae cada fila de datos, les da formato csv y los escribe en fichero creado
$value="SELECT * FROM permisos WHERE fecha_ausencia BETWEEN '$fecha_inicio' AND '$fecha_fin' AND sede = 'CDMX'"; 

$result = $mysqli->query($value);

while($d = $result->fetch_assoc()){
    $lineData = array($d["id_permiso"], $d["no_empleado"], $d["nombre_colaborador"], '', '',  $d["puesto"], $d["area"], $d["linea"], $d["sede"], $d["gerente_jefe"], $d["fecha_creacion"], $d["hora_creacion"], $d["motivo_ausencia"], $d["goce_sueldo"], $d["fecha_ausencia"], $d["hora_salida"], $d["hora_regreso"], $d['dias_solicitados'], $d["observaciones"]);

		fputcsv($f, $lineData, $delimiter);

	}
    //vuelve al principio de cada fila
	fseek($f, 0);    

	 //crea las cabeceras para la exportacion para descarga del archivo con el nombre y fecha
     header('Content-Type: text/csv; charset=UTF-8');
     header("Content-Disposition: attachment; filename=\"$filename\";");

	//Escribe toda la informacion restante de un puntero a un archivo
    fpassthru($f);

exit;

?>