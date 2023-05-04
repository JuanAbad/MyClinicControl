<?php

include_once("../Model/Paciente.php");
include_once("../Model/Cita.php");
include_once("../Model/NombrePaciente.php");


class Model
{
    private $pacientes;
    private $db;

    /*Establecemos conexión con la base de datos*/
    public function __construct()
    {
        $this->pacientes = array();
        try {
            $this->db = new PDO('mysql:host=192.168.0.168;dbname=mycliniccontrol', "root", "");
        } catch (PDOException $e) {
            echo "Error en la conexión a la base de datos: " . $e->getMessage();
            exit;
        }
    }
    /*Función que saca los pacientes ordenados por...*/
    public function selectData($table,$order)
    {   
        $dnidoctor = $_SESSION['dniDoctor'];
        
        $query = "SELECT * FROM " . $table . " WHERE dni_doctor= '".$dnidoctor."' ORDER BY ".$order.";";
        
        $result = $this->db->query(($query));

        $pacientes = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new Paciente($row['dni'],$row['nombre'], $row['apellidos'], $row['edad'], $row['sexo'], $row['telefono'], $row['patologia']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    /*Función que busca por dni, nombre o apellidos*/
    public function selectPacientesByDni($busqueda)
    {
        $dnidoctor = $_COOKIE['dniDoctor'];
        $query = "SELECT * FROM pacientes WHERE dni_doctor='".$dnidoctor."' and (dni like'%$busqueda%' or nombre like '%$busqueda%' or apellidos like '%$busqueda%'or apellidos like '%$busqueda%')";
        
        $result = $this->db->query(($query));

        $pacientes = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new Paciente($row['dni'],$row['nombre'], $row['apellidos'], $row['edad'], $row['sexo'], $row['telefono'], $row['patologia']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    
    /*Función que borra los pacientes, identificandolos por su dni
    ya que este es único por paciente*/
    public function borrarPaciente($table,$dnipaciente){
        $query = "DELETE FROM pacientes WHERE dni = '" . $dnipaciente . "'";
        
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /*Función que inserta los pacientes a traves de su objeto*/
    public function insertPacientes($table, $paciente)
    {
        session_start();
        $dnidoctor = $_SESSION['dniDoctor'];
        echo $paciente->getDni();
        $query = "INSERT INTO pacientes (dni,nombre, apellidos, edad, sexo, patologia,telefono,dni_doctor) 
        VALUES ('".$paciente->getDni()."','".$paciente->getNombre()."', '".$paciente->getApellidos()."', '".$paciente->getEdad()."', 
                '".$paciente->getSexo()."','".$paciente->getPatologia()."','".$paciente->getTelefono()."','".$dnidoctor."')";
        
        $result = $this->db->query($query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
      
    }
    public function selectNombreByDni($dni) {
        
        $query = "SELECT nombre FROM pacientes WHERE dni = '".$dni."'";
        echo $query;
        $result = $this->db->query(($query));

        $pacientes = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new NombrePaciente($row['nombre']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    public function insertCitas($cita)
    {
        session_start();
        $dnidoctor = $_SESSION['dniDoctor'];
        $model = new Model();
        $nombrePacienteArray = $model->selectNombreByDni(trim($cita->getDniPaciente()));
        echo "El nombre del paciente es: " .json_encode($nombrePacienteArray);
        $nombre = $nombrePacienteArray[0];
        echo $nombre;
        $dnidoctor = $_SESSION['dniDoctor'];
        $query = "INSERT INTO citas (titulo, paciente, detalles, hora_inicio, hora_fin, mes, dia, dnidoctor) 
              VALUES ('".$cita->getTitulo()."', '".$nombre."', '".$cita->getDetalles()."', 
                      '".$cita->getHoraInicio()."', '".$cita->getHoraFinal()."', '".$cita->getMes()."', 
                      '".$cita->getDia()."', '".$dnidoctor."')";
        echo $query;
        
        $result = $this->db->query($query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getCitasByDate($dia,$mes){
        
        $dnidoctor = $_SESSION['dniDoctor'];
        $query = "SELECT * FROM citas where dia = '" .$dia. "' and mes = '" .$mes. "' and dnidoctor = '" .$dnidoctor. "'order by hora_inicio ASC";
        $citas = array();

        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $cita = new Cita($row['Titulo'],$row['Paciente'], $row['Detalles'], $row['hora_inicio'], $row['hora_fin'], $row['Mes'], $row['Dia'], $row['dnidoctor']);

            $citas[] = $cita;
        }
        return $citas;
    }
    /* Método que inserta nuevos pacientes */
    public function insertDoctor($Doctor)
    {
        $query = "INSERT INTO doctores (dni, nombre, apellidos, telefono, correo, contraseña) 
        VALUES ('".$Doctor->getDni()."', '".$Doctor->getNombre()."', '".$Doctor->getApellidos()."', 
                '".$Doctor->getTelefono()."', '".$Doctor->getCorreo()."', '".$Doctor->getContrasena()."')";
        
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function loginDoctor($correo,$contrasena){
        $query = "SELECT * FROM doctores where correo = '".$correo."' and contraseña = '".$contrasena."';";
        $result = $this->db->query($query);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doctor = new Doctor($row['dni'],$row['nombre'], $row['apellidos'], $row['telefono'], $row['correo'], $row['contraseña']);
        }

        if ($result && $result->rowCount() == 1) {
            return $doctor;
        } else {
            return false;
        }
    }
    public function modificarPaciente($paciente)
    {
        print_r($paciente);
        $query = "UPDATE pacientes SET dni = '".$paciente->getDni()."', nombre = '".$paciente->getNombre()."', apellidos = '"
        .$paciente->getApellidos()."', edad = '".$paciente->getEdad()."', sexo = '"
        .$paciente->getSexo()."', patologia = '".$paciente->getPatologia()."', telefono = '".$paciente->getTelefono()."' WHERE dni = '".$paciente->getDni()."'";
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}