
<?php
header('Content-Type: text/html; charset=utf-8');
require_once('../Controller/ControllerInformes.php');
require_once('../Controller/ControllerPacientes.php');
require_once('../Controller/ControllerCitas.php');

require('../fpdf/fpdf.php');

$ControllerInforme = new ControllerInformes();
$ControllerPaciente = new ControllerPacientes();
$ControllerCitas = new ControllerCitas();



$id = $_GET['id'];

$informe = $ControllerInforme->getInformesById($id);

$paciente = $ControllerPaciente->GetPacientesByData($informe[0]->getPaciente());

$fechasCitas = $ControllerCitas->getDayMesAndAnnioByDni($paciente[0]->getDni());

$detallesCitas = $ControllerCitas->getCitasByDni($paciente[0]->getDni());


$pdf = new FPDF();

$pdf->SetAutoPageBreak(true, false); // Desactiva el ajuste automático de tamaño de fuente


// Agregar una página al archivo PDF
$pdf->AddPage('PORTRAIT','letter');

// Agregar el título del informe médico
$pdf->SetFont('Arial','B',24, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('INFORME MÉDICO'), 0, 1, 'C');
$pdf->Ln(5);

$pdf->Ln(5);
// Agregar los datos del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, 'Datos del paciente:', 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('DNI: ' . $paciente[0]->getDni()), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Nombre y Apellidos: ' . $paciente[0]->getNombre() ). " ".$paciente[0]->getApellidos(), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Edad: ') .$paciente[0]->getEdad() , 0, 1);
$pdf->Cell(0, 10, utf8_decode('Sexo: ') .$paciente[0]->getSexo() , 0, 1);

$pdf->Ln(5);
// Agregar los antecedentes personales del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, 'Motivo de la consulta:', 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->MultiCell(200, 10, utf8_decode($paciente[0]->getPatologia()), 0, 1);
$pdf->Ln(5);
// Agregar los problemas de salud actuales del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'Historial de tratamiento:'), 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$i = 0;
foreach($fechasCitas as $cita){
    $pdf->SetFont('Arial','B',12, 'UTF-8');
    $pdf->Cell(0, 10, utf8_decode( $cita->getDia().'-'.($cita->getMes()).'-'.$cita->getAnnio()  ), 0, 1);
    $pdf->SetFont('Arial','',12, 'UTF-8');
    $pdf->Cell(0, 10, utf8_decode( $detallesCitas[$i]->getDetalles()), 0, 1);
    $pdf->Ln(5);    
    $i++;
}
// Agregar los tratamientos médicos y farmacológicos del paciente
$pdf->SetFont('Arial','B',14, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode( 'Detalles del informe:'), 0, 1);
$pdf->SetFont('Arial','',12, 'UTF-8');
$pdf->MultiCell(200, 10, utf8_decode($informe[0]->getInforme()), 0, 1);



// Generar el archivo PDF
$pdf->Output('informe_medico.pdf','I');

?>