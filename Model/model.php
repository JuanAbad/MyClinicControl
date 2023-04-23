<?php

include_once("../Model/Paciente.php");

class Model
{
    private $pacientes;
    private $db;

    /*Establecemos conexión con la base de datos*/
    public function __construct()
    {
        $this->pacientes = array();
        try {
            $this->db = new PDO('mysql:host=192.168.0.167;dbname=mycliniccontrol', "root", "");
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
