<?php
session_start();

require "../../lib/fpdf/fpdf.php";
include '../config.php';

$folio = $_SERVER['QUERY_STRING'];
$activo = $_SESSION['nombre_completo'];

// Recupera la información del permiso registrado
$buscar_info = $con->prepare("SELECT * FROM permisos WHERE id_permiso = '$folio'");
$buscar_info->setFetchMode(PDO::FETCH_OBJ);
$buscar_info->execute();

$mostar_info = $buscar_info->fetchAll();

if ($buscar_info -> rowCount() > 0) {
    foreach ($mostar_info as $permiso) {
        $nombre_colaborador = $permiso -> nombre_colaborador;
        $fecha_creacion = $permiso -> fecha_creacion;
        $puesto = $permiso -> puesto;
        $linea = $permiso -> linea;
        $area = $permiso -> area;
        $gerente_jefe = $permiso -> gerente_jefe;
        $notifica = $permiso -> registra_data;
        $fecha_ausencia = $permiso -> fecha_ausencia;
        $hora_salida = $permiso -> hora_salida;
        $dias_solicitados = $permiso -> dias_solicitados;
        $hora_regreso = $permiso -> hora_regreso;
        $fecha_regreso = $permiso -> fecha_regreso;
        $motivo_ausencia = $permiso -> motivo_ausencia;
        $goce_sueldo = $permiso -> goce_sueldo;
        $observaciones = $permiso -> observaciones;
        $registra_data = $permiso -> registra_data;
    }
} else {
    echo '<script>alert("Ocurrió un problema al cargar los datos del empleado, por favor, inténtalo de nuevo por favor o contacta al Soporte Técnico")</script>';
    echo '<meta http-equiv="refresh" content="0; url=../../user/permisos.php">';
}

class PDF extends FPDF
{
    function Header(){
    // Inicio de Encabezado
    $this->SetFillColor(2, 2, 2);
    $this->SetTextColor(255,255,255);
    $this->SetFont("Arial","b",18);
    // Título
    $this->Cell (185,15,utf8_decode('SOLICITUD DE AUSENTISMO'),0,1,'C',true);
    // Inicio de formulario
    $this->SetFont("Arial","b",10);
    $this->Cell (185,5,utf8_decode('Datos del Personal:'),0,1,'C',true);
    // Logo
    $this->Image('../../img/veco.png',20,13,20);
    }

    function Footer(){}
	
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,10);
$pdf->AliasNbPages();
$pdf->AddPage();

/***********************************************************************************************************************************************************
FORMATO 1
***********************************************************************************************************************************************************/

/********************
Datos del Personal
********************/
$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,10,utf8_decode('Nombre:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,10,utf8_decode($nombre_colaborador),1,0,'C');
$pdf->SetFont("Arial","b",9);
$pdf->Cell(30,10,utf8_decode('Fecha de Solicitud:'),1,0,'C');
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,10,$fecha_creacion,1,0,'C');
$pdf->Ln();

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Puesto:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,5,$puesto,1,0,'C');
$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Línea:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,5,$linea,1,0,'C');
$pdf->Ln();

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,10,utf8_decode('Área:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,10,$area,1,0,'C');
$pdf->Ln();
$pdf->SetFont("Arial","b",10);
$pdf->MultiCell(30,5,utf8_decode('Gerente / Jefe Inmediato:'),1,'L');
$pdf->SetXY(45,55);
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,10,$gerente_jefe,1,0,'C');
$pdf->SetXY(135,45);
$pdf->SetFont("Arial","b",10);
$pdf->MultiCell(30,10,utf8_decode('¿Quién notifica?:'),1,'L');
$pdf->SetXY(165,45);
$pdf->MultiCell(35,20,'',1,'L');


if ($registra_data == $nombre_colaborador) {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,46.5);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(183,43);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,51.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(178,48);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,56.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,53);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,61);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(192,58);
    $pdf->Cell(50,10,'Otro',0,0,'L');
} elseif ($registra_data == $gerente_jefe) {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,46.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(183,43);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,51.5);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(178,48);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,56.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,53);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,61);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(192,58);
    $pdf->Cell(50,10,'Otro',0,0,'L');
} else {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,46.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(183,43);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,51.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(178,48);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,56.5);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,53);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,61);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(192,58);
    $pdf->Cell(50,10,'Otro',0,0,'L');
}

/*********************
Datos del la Solicitud
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(15,65);
$pdf->SetTextColor(255,255,255);
$pdf->Cell (185,5,utf8_decode('Datos del la Solicitud:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,5,utf8_decode('Fecha de Ausencia:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(30,5,$fecha_ausencia,1,0,'C');
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,5,utf8_decode('Hora de Salida:'),1,0,'L');
$pdf->SetFont("Arial","",10);
if ($hora_salida == "") {
    $pdf->Cell(30,5,'N/A',1,0,'C');
} else {
    $pdf->Cell(30,5,$hora_salida,1,0,'C');
}

$pdf->SetXY(135,70);
$pdf->SetFont("Arial","b",8);
$pdf->MultiCell(30,7.5,utf8_decode('Fecha de probable regreso:'),1,'L');
$pdf->SetXY(165,70);
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,15,$fecha_regreso,1,0,'C');

$pdf->SetXY(15,75);
$pdf->SetFont("Arial","b",8);
$pdf->MultiCell(30,5,utf8_decode('Número de días solicitados:'),1,'L');
$pdf->SetXY(45,75);
$pdf->SetFont("Arial","",10);
$pdf->Cell(30,10,$dias_solicitados,1,0,'C');
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,10,utf8_decode('Hora de Regreso:'),1,0,'L');
$pdf->SetFont("Arial","",10);
if ($hora_regreso == "") {
    $pdf->Cell(30,10,'N/A',1,0,'C');
} else {
    $pdf->Cell(30,10,$hora_regreso,1,0,'C');
}
$pdf->Ln();

/*********************
Motivos de Ausencia
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(185,5,utf8_decode('Motivos de Ausencia:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->Cell(120,5,'',1,0,'L');

switch ($motivo_ausencia) {
    case 'Retardo Justificado':
    // Listado de Motivos
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->SetFont("Arial","b",7);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;


    case 'Retardo Injustificado':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Paternidad':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Tiempo por tiempo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Trabajo desde casa':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Falta Justificada':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Falta Injustificada':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Salud':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Enfermedad General':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Riesgo de trabajo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Maternidad':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Vacaciones':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Labor de campo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;
    
    default:
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,90.5);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,90.5);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,90.5);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,91);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,90.5);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,95.5);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,95.5);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,95.5);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,96);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,95.5);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;
}

/*********************
Goce de sueldos
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(135,90);
$pdf->Cell(30,10,utf8_decode('Goce de sueldo:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->SetXY(15,95);
$pdf->Cell(120,5,'',1,0,'L');

switch ($goce_sueldo) {
    case 'Si':
    // Si / No
    $pdf->SetXY(150,89.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,94);
    $pdf->Cell(5,5,'X',1,0,'C');

    $pdf->SetXY(162,89.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,94);
    $pdf->Cell(5,5,'',1,0,'C');
    break;

    case 'No':
    // Si / No
    $pdf->SetXY(150,89.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,94);
    $pdf->Cell(5,5,'',1,0,'C');

    $pdf->SetXY(162,89.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,94);
    $pdf->Cell(5,5,'X',1,0,'C');
    break;
    
    default:
    // Si / No
    $pdf->SetXY(150,89.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,94);
    $pdf->Cell(5,5,'',1,0,'C');

    $pdf->SetXY(162,89.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,94);
    $pdf->Cell(5,5,'',1,0,'C');
    break;
}

/*********************
Observaciones
*********************/
$observaciones = substr($observaciones, 0, 98);
$pdf->SetXY(15,100);
$pdf->Cell(30,5,utf8_decode('Observaciones:'),1,0,'L');
$pdf->SetFont("Arial","",8);
if ($observaciones == "") {
    $pdf->Cell(155,5,'N/A',1,0,'C');
} else {
    $pdf->Cell(155,5,utf8_decode($observaciones),1,0,'C');
}

/********************
Pie de página
********************/
// Inicio de Pie de página
$pdf->SetFillColor(2, 2, 2);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(15,105);
$pdf->Cell (185,5,'Autorizaciones',1,0,'C',true);

// Encabezados
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(15,110);
$pdf->Cell (62,5,utf8_decode('Solicitante:'),1,0,'C',true);
$pdf->SetXY(77,110);
$pdf->Cell (62,5,utf8_decode('Gerente o Jefe de área:'),1,0,'C',true);
$pdf->SetXY(137,110);
$pdf->Cell (63,5,utf8_decode('Capital Humano:'),1,0,'C',true);

// Cuadro de firmas
$pdf->SetXY(15,115);
$pdf->Cell (62,15,'',1,0,'C');
$pdf->SetXY(77,115);
$pdf->Cell (60,15,'',1,0,'C');
$pdf->SetXY(137,115);
$pdf->Cell (63,15,'',1,0,'C');


/***********************************************************************************************************************************************************
FORMATO 2
***********************************************************************************************************************************************************/

/********************
Encabezado
********************/
$pdf->SetXY(15,140);
$pdf->SetFillColor(2, 2, 2);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","b",18);
$pdf->Cell (185,15,utf8_decode('SOLICITUD DE AUSENTISMO'),0,1,'C',true);
$pdf->SetFont("Arial","b",10);
$pdf->Cell (185,5,utf8_decode('Datos del Personal:'),0,1,'C',true);

/********************
Datos del Personal
********************/
$pdf->SetXY(15,160);
$pdf->SetTextColor(2,2,2);

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,10,utf8_decode('Nombre:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,10,utf8_decode($nombre_colaborador),1,0,'C');
$pdf->SetFont("Arial","b",9);
$pdf->Cell(30,10,utf8_decode('Fecha de Solicitud:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,10,$fecha_creacion,1,0,'C');
$pdf->Ln();

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Puesto:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,5,utf8_decode($puesto),1,0,'C');
$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Línea:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,5,utf8_decode($linea),1,0,'C');
$pdf->SetFont("Arial","b",10);
$pdf->Ln();

$pdf->Cell(30,10,utf8_decode('Área:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(90,10,utf8_decode($area),1,0,'C');
$pdf->SetFont("Arial","b",10);
$pdf->Ln();
$pdf->MultiCell(30,5,utf8_decode('Gerente / Jefe Inmediato:'),1,'L');
$pdf->SetFont("Arial","",10);
$pdf->SetXY(45,185);
$pdf->Cell(90,10,utf8_decode($gerente_jefe),1,0,'C');
$pdf->SetXY(135,175);
$pdf->SetFont("Arial","b",10);
$pdf->MultiCell(30,10,utf8_decode('¿Quién notifica?:'),1,'L');
$pdf->SetXY(165,175);
$pdf->MultiCell(35,20,'',1,'L');

if ($registra_data == $nombre_colaborador) {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,176);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(183,172.5);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,181);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(178,177.5);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,186);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,182.5);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,191);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(192,187.5);
    $pdf->Cell(50,10,'Otro',0,0,'L');
} elseif ($registra_data == $gerente_jefe) {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,176);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(183,172.5);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,181);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(178,177.5);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,186);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,182.5);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,191);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(192,187.5);
    $pdf->Cell(50,10,'Otro',0,0,'L');
} else {
    // Cuadro de notificantes
    $pdf->SetFont("Arial","b",8);
    $pdf->SetXY(170,176);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(183,172.5);
    $pdf->Cell(50,10,'Trabajador',0,0,'L');

    $pdf->SetXY(170,181);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(178,177.5);
    $pdf->Cell(50,10,'Jefe Inmediato',0,0,'L');

    $pdf->SetXY(170,186);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(187,182.5);
    $pdf->Cell(50,10,'Familiar',0,0,'L');

    $pdf->SetXY(170,191);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(192,187.5);
    $pdf->Cell(50,10,'Otro',0,0,'L');
}

/*********************
Datos del la Solicitud
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(15,195);
$pdf->SetTextColor(255,255,255);
$pdf->Cell (185,5,utf8_decode('Datos del la Solicitud:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,5,utf8_decode('Fecha de Ausencia:'),1,0,'L');
$pdf->SetFont("Arial","",10);
$pdf->Cell(30,5,$fecha_ausencia,1,0,'C');
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,5,utf8_decode('Hora de Salida:'),1,0,'L');
$pdf->SetFont("Arial","",10);
if ($hora_salida == "") {
    $pdf->Cell(30,5,'N/A',1,0,'C');
} else {
    $pdf->Cell(30,5,$hora_salida,1,0,'C');
}

$pdf->SetXY(135,200);
$pdf->SetFont("Arial","b",8);
$pdf->MultiCell(30,7.5,utf8_decode('Fecha de probable regreso:'),1,'L');
$pdf->SetXY(165,200);
$pdf->SetFont("Arial","",10);
$pdf->Cell(35,15,$fecha_regreso,1,0,'C');

$pdf->SetXY(15,205);
$pdf->SetFont("Arial","b",8);
$pdf->MultiCell(30,5,utf8_decode('Número de días solicitados:'),1,'L');
$pdf->SetXY(45,205);
$pdf->SetFont("Arial","",10);
$pdf->Cell(30,10,$dias_solicitados,1,0,'C');
$pdf->SetFont("Arial","b",8);
$pdf->Cell(30,10,utf8_decode('Hora de Regreso:'),1,0,'L');
$pdf->SetFont("Arial","",10);
if ($hora_regreso == "") {
    $pdf->Cell(30,10,'N/A',1,0,'C');
} else {
    $pdf->Cell(30,10,$hora_regreso,1,0,'C');
}
$pdf->Ln();

/*********************
Motivos de Ausencia
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(185,5,utf8_decode('Motivos de Ausencia:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->Cell(120,5,'',1,0,'L');

switch ($motivo_ausencia) {
    case 'Retardo Justificado':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Retardo Injustificado':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Paternidad':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Tiempo por tiempo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Trabajo desde casa':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Falta Justificada':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Personal: Falta Injustificada':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Salud':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Enfermedad General':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Riesgo de trabajo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Incapacidades: Maternidad':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Vacaciones':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;

    case 'Labor de campo':
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'X',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;
    
    default:
    // Listado de Motivos
    $pdf->SetFont("Arial","b",7);
    $pdf->SetXY(16,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,220);
    $pdf->Cell(50,5,'Retardo Justificado',0,0,'L');

    $pdf->SetXY(50,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,220);
    $pdf->Cell(50,5,'Retardo Injustificado',0,0,'L');

    $pdf->SetXY(85,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,220);
    $pdf->Cell(50,5,'Paternidad',0,0,'L');

    $pdf->SetXY(110,221);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,220);
    $pdf->Cell(50,5,'Personal',0,0,'L');

    $pdf->SetXY(16,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(19,225);
    $pdf->Cell(50,5,'Salud',0,0,'L');

    $pdf->SetXY(50,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(53,225);
    $pdf->Cell(50,5,'Incapacidad',0,0,'L');

    $pdf->SetXY(85,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(88,225);
    $pdf->Cell(50,5,'Vacaciones',0,0,'L');

    $pdf->SetXY(110,226);
    $pdf->Cell(3,3,'',1,0,'C');
    $pdf->SetXY(113,225);
    $pdf->Cell(50,5,'Labor de campo',0,0,'L');
    break;
}

/*********************
Goce de sueldos
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(135,220);
$pdf->Cell(30,10,utf8_decode('Goce de sueldo:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->SetXY(15,95);
$pdf->Cell(120,5,'',1,0,'L');

switch ($goce_sueldo) {
    case 'Si':
    // Si / No
    $pdf->SetXY(150,219.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,224);
    $pdf->Cell(5,5,'X',1,0,'C');

    $pdf->SetXY(162,219.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,224);
    $pdf->Cell(5,5,'',1,0,'C');
    break;

    case 'No':
    // Si / No
    $pdf->SetXY(150,219.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,224);
    $pdf->Cell(5,5,'',1,0,'C');

    $pdf->SetXY(162,219.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,224);
    $pdf->Cell(5,5,'X',1,0,'C');
    break;
    
    default:
    // Si / No
    $pdf->SetXY(150,219.5);
    $pdf->Cell(50,5,'Si',0,0,'C');
    $pdf->SetXY(173,224);
    $pdf->Cell(5,5,'',1,0,'C');

    $pdf->SetXY(162,219.5);
    $pdf->Cell(50,5,'No',0,0,'C');
    $pdf->SetXY(184.5,224);
    $pdf->Cell(5,5,'',1,0,'C');
    break;
}

/*********************
Observaciones
*********************/
$pdf->SetXY(15,230);
$pdf->Cell(30,5,utf8_decode('Observaciones:'),1,0,'L');
$pdf->SetFont("Arial","",8);
if ($observaciones == "") {
    $pdf->Cell(155,5,'N/A',1,0,'C');
} else {
    $pdf->Cell(155,5,utf8_decode($observaciones),1,0,'C');
}

/********************
Pie de página
********************/
// Inicio de Pie de página
$pdf->SetFillColor(2, 2, 2);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(15,235);
$pdf->Cell (185,5,'Autorizaciones',1,0,'C',true);

// Encabezados
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(2,2,2);
$pdf->SetXY(15,239);
$pdf->Cell (62,5,utf8_decode('Solicitante:'),1,0,'C',true);
$pdf->SetXY(77,239);
$pdf->Cell (62,5,utf8_decode('Gerente o Jefe de área:'),1,0,'C',true);
$pdf->SetXY(137,239);
$pdf->Cell (63,5,utf8_decode('Capital Humano:'),1,0,'C',true);

// Cuadro de firmas
$pdf->SetXY(15,244);
$pdf->Cell (62,15,'',1,0,'C');
$pdf->SetXY(77,244);
$pdf->Cell (60,15,'',1,0,'C');
$pdf->SetXY(137,244);
$pdf->Cell (63,15,'',1,0,'C');

$pdf->Ln();
$pdf->output('I','Solicitud de Ausentismo #'.$folio.' para '.$nombre_colaborador.' con fecha de creación '.$fecha_creacion.'',true);