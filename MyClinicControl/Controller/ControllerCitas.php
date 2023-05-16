<?php

require_once("../Model/Cita.php");
require_once("../Model/model.php");

class ControllerCitas{
    /*Método que llama al model para obtener todos los datos de las citas
    por el mes y por el dia */
    public function getCitasByData($dia,$mes,$annio){
        $modelo = new Model();
        
        $personas = $modelo->getCitasByDate($dia,$mes,$annio);
        return $personas;
    }
    public function getDayMesAndAnnio(){
        $modelo = new Model();
        $fechaCitas = $modelo->selectDayMonthAndYear();
        return $fechaCitas;
    }
}
/*Ya que los campos de añadir citas son required, si existe el campo titulo,
Me recogerá los datos de añadir cita para añadirlos en la bbdd
PD: Los datos del nombre del paciente, lo pongo en vacio, ya que esos he optado
por cogerlos en la model  */
if(isset($_POST['titulo'])){
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $annio = $_POST['annio'];
    $titulo = $_POST['titulo'];
    $dnipaciente = $_POST['paciente'];
    $detalles = $_POST['detalles'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    
    $cita = new Cita($titulo,$dnipaciente,"",$detalles,$hora_inicio,$hora_fin,$dia,$mes,$annio);

        $modelo = new Model();
        $modelo->insertCitas($cita);
    header("location: ../View/calendario.php");
}
?>
