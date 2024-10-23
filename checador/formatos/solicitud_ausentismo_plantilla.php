<?php
require "../../lib/fpdf/fpdf.php";

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
    // Folio de Permiso
    $this->SetXY(163,20);
    $this->Cell(15,5,utf8_decode('Folio:'),0,1,'C',true);
    $this->SetXY(175,20);
    $this->Cell(25,5,'',0,1,'C',true);
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
$pdf->Cell(90,10,'',1,0,'L');
$pdf->SetFont("Arial","b",9);
$pdf->Cell(30,10,utf8_decode('Fecha de Solicitud:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->Ln();

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Puesto:'),1,0,'L');
$pdf->Cell(90,5,'',1,0,'L');
$pdf->Cell(30,5,utf8_decode('Línea:'),1,0,'L');
$pdf->Cell(35,5,'',1,0,'L');
$pdf->Ln();

$pdf->Cell(30,10,utf8_decode('Área:'),1,0,'L');
$pdf->Cell(90,10,'',1,0,'L');
$pdf->Ln();
$pdf->MultiCell(30,5,utf8_decode('Gerente / Jefe Inmediato:'),1,'L');
$pdf->SetXY(45,55);
$pdf->Cell(90,10,'',1,0,'L');
$pdf->SetXY(135,45);
$pdf->MultiCell(30,10,utf8_decode('¿Quién notifica?:'),1,'L');
$pdf->SetXY(165,45);
$pdf->MultiCell(35,20,'',1,'L');

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
$pdf->Cell(3,3,'',1,0,'C');
$pdf->SetXY(192,58);
$pdf->Cell(50,10,'Otro',0,0,'L');

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
$pdf->Cell(30,5,'',1,0,'L');
$pdf->Cell(30,5,utf8_decode('Hora de Salida:'),1,0,'L');
$pdf->Cell(30,5,'',1,0,'L');

$pdf->SetXY(135,70);
$pdf->MultiCell(30,7.5,utf8_decode('Fecha de probable regreso:'),1,'L');
$pdf->SetXY(165,70);
$pdf->Cell(35,15,'',1,0,'L');

$pdf->SetXY(15,75);
$pdf->MultiCell(30,5,utf8_decode('Número de días solicitados:'),1,'L');
$pdf->SetXY(45,75);
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,utf8_decode('Hora de Regreso:'),1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Ln();

/*********************
Motivos de Ausencia
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(185,5,utf8_decode('Motivos de Ausencia:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->Cell(120,5,'',1,0,'L');

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

/*********************
Goce de sueldos
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(135,90);
$pdf->Cell(30,10,utf8_decode('Goce de sueldo:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->SetXY(15,95);
$pdf->Cell(120,5,'',1,0,'L');

// Si / No
$pdf->SetXY(150,89.5);
$pdf->Cell(50,5,'Si',0,0,'C');
$pdf->SetXY(173,94);
$pdf->Cell(5,5,'',1,0,'C');

$pdf->SetXY(162,89.5);
$pdf->Cell(50,5,'No',0,0,'C');
$pdf->SetXY(184.5,94);
$pdf->Cell(5,5,'',1,0,'C');

/*********************
Observaciones
*********************/
$pdf->SetXY(15,100);
$pdf->Cell(30,5,utf8_decode('Observaciones:'),1,0,'L');
$pdf->Cell(155,5,'',1,0,'C');

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
FORMATO 1
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
// Folio de Permiso
$pdf->SetXY(163,150);
$pdf->Cell(15,5,utf8_decode('Folio:'),0,1,'C',true);
$pdf->SetXY(175,150);
$pdf->Cell(25,5,'',0,1,'C',true);
$pdf->Cell (185,5,utf8_decode('Datos del Personal:'),0,1,'C',true);

/********************
Datos del Personal
********************/
$pdf->SetXY(15,160);
$pdf->SetTextColor(2,2,2);

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,10,utf8_decode('Nombre:'),1,0,'L');
$pdf->Cell(90,10,'',1,0,'L');
$pdf->SetFont("Arial","b",9);
$pdf->Cell(30,10,utf8_decode('Fecha de Solicitud:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->Ln();

$pdf->SetFont("Arial","b",10);
$pdf->Cell(30,5,utf8_decode('Puesto:'),1,0,'L');
$pdf->Cell(90,5,'',1,0,'L');
$pdf->Cell(30,5,utf8_decode('Línea:'),1,0,'L');
$pdf->Cell(35,5,'',1,0,'L');
$pdf->Ln();

$pdf->Cell(30,10,utf8_decode('Área:'),1,0,'L');
$pdf->Cell(90,10,'',1,0,'L');
$pdf->Ln();
$pdf->MultiCell(30,5,utf8_decode('Gerente / Jefe Inmediato:'),1,'L');
$pdf->SetXY(45,185);
$pdf->Cell(90,10,'',1,0,'L');
$pdf->SetXY(135,175);
$pdf->MultiCell(30,10,utf8_decode('¿Quién notifica?:'),1,'L');
$pdf->SetXY(165,175);
$pdf->MultiCell(35,20,'',1,'L');

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
$pdf->Cell(3,3,'',1,0,'C');
$pdf->SetXY(192,187.5);
$pdf->Cell(50,10,'Otro',0,0,'L');

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
$pdf->Cell(30,5,'',1,0,'L');
$pdf->Cell(30,5,utf8_decode('Hora de Salida:'),1,0,'L');
$pdf->Cell(30,5,'',1,0,'L');

$pdf->SetXY(135,200);
$pdf->MultiCell(30,7.5,utf8_decode('Fecha de probable regreso:'),1,'L');
$pdf->SetXY(165,200);
$pdf->Cell(35,15,'',1,0,'L');

$pdf->SetXY(15,205);
$pdf->MultiCell(30,5,utf8_decode('Número de días solicitados:'),1,'L');
$pdf->SetXY(45,205);
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Cell(30,10,utf8_decode('Hora de Regreso:'),1,0,'L');
$pdf->Cell(30,10,'',1,0,'L');
$pdf->Ln();

/*********************
Motivos de Ausencia
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(185,5,utf8_decode('Motivos de Ausencia:'),0,1,'C',true);
$pdf->SetTextColor(2,2,2);
$pdf->Cell(120,5,'',1,0,'L');

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

/*********************
Goce de sueldos
*********************/
$pdf->SetFont("Arial","b",10);
$pdf->SetXY(135,220);
$pdf->Cell(30,10,utf8_decode('Goce de sueldo:'),1,0,'L');
$pdf->Cell(35,10,'',1,0,'L');
$pdf->SetXY(15,95);
$pdf->Cell(120,5,'',1,0,'L');

// Si / No
$pdf->SetXY(150,219.5);
$pdf->Cell(50,5,'Si',0,0,'C');
$pdf->SetXY(173,224);
$pdf->Cell(5,5,'',1,0,'C');

$pdf->SetXY(162,219.5);
$pdf->Cell(50,5,'No',0,0,'C');
$pdf->SetXY(184.5,224);
$pdf->Cell(5,5,'',1,0,'C');

/*********************
Observaciones
*********************/
$pdf->SetXY(15,230);
$pdf->Cell(30,5,utf8_decode('Observaciones:'),1,0,'L');
$pdf->Cell(155,5,'',1,0,'C');

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
$pdf->output('I','Solicitud de Ausentismo # para ___ con fecha de creación ___',true);