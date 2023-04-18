<?php
require_once("../Model/model.php");
require_once("../Model/Paciente.php");
class ControllerPacientes{
  private $nombre;
  private $apellidos;
  private $edad;
  private $sexo;
  private $estadoCivil;
  private $patologias;
  private $pacientes;
  private $paciente;
  
  function guardarDatos() {
    $datos = array(
      'nombre' => $this->nombre,
      'apellidos' => $this->apellidos,
      'edad' => $this->edad,
      'sexo' => $this->sexo,
      'estado_civil' => $this->estadoCivil,
      'patologias' => $this->patologias,
      
    );
    
    // En este caso, simplemente imprimimos los datos en formato JSON para comprobar que se han recibido correctamente:
    echo json_encode($datos);
  }

    function showDataTable($table,$condition){
        
        $datos = new Model();
        $this->pacientes = $datos->selectData($table,$condition);
        
        return $this->pacientes;
    }
    function savePaciente($table,$paciente){
        $datos = new Model();
        $this->pacientes = $datos->insertPacientes($table,$paciente);
    }
    

}

  
  if([$_SERVER['REQUEST_METHOD']=='POST']){
    
    if(isset($_POST['dnipaciente'])){
      $dnipaciente = $_POST['dnipaciente'];
      echo $dnipaciente;
      $modelo = new Model();
      $modelo->borrarPaciente("pacientes",$dnipaciente);
      header("location: ../View/contactos.php");
    }

   if(isset($_POST['nombre'])&& isset($_POST['apellidos'])){
      $dni = $_POST['dni'];
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $edad = $_POST['edad'];
      $sexo = $_POST['sexo'];
      $telefono = $_POST['telefono'];
      $patologia = $_POST['patologias'];
      
      $paciente = new Paciente($dni,$nombre,$apellidos,$edad,$sexo,$telefono,$patologia);

      $modelo = new Model();
      $modelo->insertPacientes("pacientes",$paciente);

      header("location: ../View/contactos.php");
  }
}
?>