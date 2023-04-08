<?php

include_once("../Model/Paciente.php");

class Model
{
    private $pacientes;
    private $db;


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

    public function selectData($table, $condition)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $condition . ";";
        $result = $this->db->query(($query));

        $pacientes = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new Paciente($row['dni'],$row['nombre'], $row['apellidos'], $row['edad'], $row['sexo'], $row['telefono'], $row['patologia']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    //Función que busca por dni, nombre o apellidos
    public function selectPacientesByDni($busqueda)
    {
        $query = "SELECT * FROM pacientes where nombre like '%$busqueda%' or apellidos like '%$busqueda%'or apellidos like '%$busqueda%'";
        $result = $this->db->query(($query));

        $pacientes = array();
        

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new Paciente($row['dni'],$row['nombre'], $row['apellidos'], $row['edad'], $row['sexo'], $row['telefono'], $row['patologia']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    public function borrarPaciente($table,$dnipaciente){
        $query = "DELETE FROM pacientes WHERE dni = '" . $dnipaciente . "'";
        
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertPacientes($table, $paciente)
    {
        print_r($paciente);
        $query = "INSERT INTO pacientes (dni,nombre, apellidos, edad, sexo, patologia,telefono) 
        VALUES ('".$paciente->getDni()."','".$paciente->getNombre()."', '".$paciente->getApellidos()."', '".$paciente->getEdad()."', 
                '".$paciente->getSexo()."','".$paciente->getPatologia()."','".$paciente->getTelefono()."')";
        
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
