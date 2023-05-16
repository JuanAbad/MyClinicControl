<?php

require_once("../Model/Informe.php");
require_once("../Model/model.php");

class ControllerInformes{
    function getInformesByPaciente($dni)
    {
      $modelo = new Model();
      $informes = $modelo->selectInformesByDni($dni);
      return $informes;
    }
}
if(isset($_POST['titulo'])){
    $titulo = $_POST['titulo'];
    $paciente = $_POST['paciente'];
    $fechainforme = date("d-m-Y");
    $informe = $_POST['informeCompleto'];

    $informe = new Informe($titulo,$paciente,$fechainforme,$informe);

    echo json_encode($informe);

    $modelo = new Model();
    $modelo->insertInforme($informe);

    header("location: ../View/informes.php");

}
if(isset($_POST['dniBuscar'])){
  $dni = $_POST['dniBuscar'];
  
  $controller = new ControllerInformes();
  $pacientesFiltrados = $controller->getInformesByPaciente($dni);
  
}

?>