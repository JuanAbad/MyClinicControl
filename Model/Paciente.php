<?php

class Paciente{
    private $dni;
    private $nombre;
    private $apellidos;
    private $edad;
    private $sexo;
    private $telefono;
    private $patologia;

    function __construct($dni,$nombre,$apellidos,$edad,$sexo,$telefono,$patologia)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
        $this->edad = $edad;
        $this->sexo = $sexo;
        $this->telefono = $telefono;
        $this->patologia = $patologia;
        
    }
    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getPatologia() {
        return $this->patologia;
    }

    public function setPatologia($patologia) {
        $this->patologia = $patologia;
    }
    
}

?>