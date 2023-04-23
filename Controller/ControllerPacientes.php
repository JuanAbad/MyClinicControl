<?php
require_once("../Model/model.php");
require_once("../Model/Paciente.php");
class ControllerPacientes
{
  private $pacientes;
  /*Función incial que llama a la model para mostrar TODOS los pacientes del usuario
    que esté usando la aplicación*/
  function showDataTable($table, $condition)
  {

    $datos = new Model();
    $this->pacientes = $datos->selectData($table, 1);

    return $this->pacientes;
  }
  /*Función que llama a la model para guardar los pacientes*/
  function savePaciente($table, $paciente)
  {
    $datos = new Model();
    $this->pacientes = $datos->insertPacientes($table, $paciente);
  }
  function updatePaciente($paciente){
    $datos = new Model();
    $this->pacientes = $datos->modificarPaciente($paciente);
    return $this->pacientes;
  }
  /*Función que llama a la model para poder sacar los pacientes
    por dni,nombre o apellidos*/
  function GetPacientesByData($identificador)
  {

    $modelo = new Model();

    $this->pacientes = $modelo->selectPacientesByDni($identificador);

    return $this->pacientes;
  }
  function getJsonFromPacienteByData($identificador)
  {
    $modelo = new Model();

    $pacientes = $modelo->selectPacientesByDni($identificador);
    
    header('Content-Type: application/json');
    
  }
  /*Función que recoge el orden elegido en la view para enviarselo
    a la model*/
  function GetPacientesByOrder($orden)
  {
    $modelo = new Model();
    $personasOrdenadas = $modelo->selectData("pacientes", $orden);
    return $personasOrdenadas;
  }
}


if ([$_SERVER['REQUEST_METHOD'] == 'POST']) {
  /*Función que llama a la clase del controller para coger los datos de un solo
  paciente, ya que se identifica por su dni*/
  if (isset($_GET['dni'])) {
    $identificador = $_GET['dni'];
    $controller = new ControllerPacientes();
    $pacientesFiltrados = $controller->GetPacientesByData($identificador);
    echo json_encode($pacientesFiltrados);
  }
  if(isset($_GET['dnimodificar'])){
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $patologia = $_POST['patologias'];

    $paciente = new Paciente($dni, $nombre, $apellidos, $edad, $sexo, $telefono, $patologia);

    $controller = new ControllerPacientes();
    $pacientes = $controller->updatePaciente($paciente);
    header("location: ../View/contactos.php");
  }
  /* Función que borra a un paciente identificandolo por su dni llamando a la 
  clase del controller que se encarga de llamar a la model para eliminarlo */
  if (isset($_POST['dnipaciente'])) {
    $dnipaciente = $_POST['dnipaciente'];
    echo $dnipaciente;
    $modelo = new Model();
    $modelo->borrarPaciente("pacientes", $dnipaciente);
    header("location: ../View/contactos.php");
  }
  /*Función que recoge el texto de busqueda de busqueda de paciente
    Y llama a la model para buscar ese contacto en específico*/
  if (isset($_POST['nombre']) && isset($_POST['apellidos'])&& !isset($_GET['dnimodificar'])) {
    /*Como esta comprobación esta fuera de la clase, crearemos atributos propios
    dni,nombre...*/
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $patologia = $_POST['patologias'];

    $paciente = new Paciente($dni, $nombre, $apellidos, $edad, $sexo, $telefono, $patologia);
    $modelo = new Model();
    $modelo->insertPacientes("pacientes", $paciente);

    header("location: ../View/contactos.php");
  }
}
