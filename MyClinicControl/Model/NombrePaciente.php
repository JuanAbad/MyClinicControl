<?php

class NombrePaciente{
    public $nombre;
    function __construct($nombre)
    {
        $this->nombre = $nombre; 
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function __toString() {
        return $this->nombre;
    }
}

?>