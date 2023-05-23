<?php

class Doctor{
    public $dni;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $correo;
    public $contrasena;
    

    function __construct($dni,$nombre,$apellidos,$telefono,$correo,$contrasena)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->telefono = $telefono;
        
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

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setcontrasena($contrasena) {
        $this->contrasena = $contrasena;
    }
}
?>