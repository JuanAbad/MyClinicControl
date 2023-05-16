<?php
header('Content-Type: text/html; charset=utf-8');
require('../fpdf/fpdf.php');

$pdf = new FPDF();


// Agregar una página al archivo PDF
$pdf->AddPage('PORTRAIT','letter');

// Agregar el título del informe médico
$pdf->SetFont('Arial','B',16, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('INFORME MÉDICO'), 0, 1, 'C');
$pdf->Ln(5);

// Agregar los datos del centro médico
$pdf->SetFont('Arial','B',16, 'UTF-8');
$pdf->Cell(0, 10, 'DATOS DEL CENTRO:', 0, 1);
$pdf->Cell(0, 10, 'Nombre: [Nombre del Centro]', 0, 1);
$pdf->Cell(0, 10, utf8_decode('Dirección: [Dirección del Centro]'), 0, 1);
$pdf->Ln(5);
// Agregar los datos del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, 'DATOS DEL PACIENTE:', 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('Nombre y Apellidos: [Nombre y Apellidos del Paciente]'), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Fecha de Nacimiento: [Fecha de Nacimiento del Paciente]'), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Nº de Seguridad Social: [Nº de Seguridad Social del Paciente]'), 0, 1);
$pdf->Ln(5);
// Agregar los antecedentes personales del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, 'ANTECEDENTES PERSONALES:', 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('Antecedentes de enfermedades, quirúrgicos y tratamientos farmacológicos: [Antecedentes del Paciente]'), 0, 1);
$pdf->Ln(5);
// Agregar los problemas de salud actuales del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'PROBLEMAS DE SALUD ACTUALES:'), 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'Fecha estimada de inicio: [Fecha de inicio de los problemas]'), 0, 1);
$pdf->Ln(5);
// Agregar los tratamientos médicos y farmacológicos del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'TRATAMIENTOS MEDICOS Y FARMACOLÓGICOS:'), 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'Prescripciones crónicas: [Tratamientos y prescripciones del Paciente]'), 0, 1);



// Generar el archivo PDF
$pdf->Output('informe_medico.pdf','I');

?>