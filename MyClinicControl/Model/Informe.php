<?php

class Informe{
    public $id;
    public $titulo;
    public $paciente;
    public $doctor;
    public $fechaInforme;
    public $informe;

    function __construct($id,$titulo,$paciente,$doctor,$fechaInforme,$informe)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->paciente = $paciente;
        $this->doctor = $doctor;
        $this->fechaInforme = $fechaInforme;
        $this->informe = $informe;    
    }

public function setId($id)
{
    $this->id = $id;
}
    
public function getId()
{
    return $this->id;
}

public function getTitulo()
{
    return $this->titulo;
}

public function setTitulo($titulo)
{
    $this->titulo = $titulo;
}

public function getPaciente()
{
    return $this->paciente;
}

public function setPaciente($paciente)
{
    $this->paciente = $paciente;
}
public function getDoctor()
{
    return $this->doctor;
}

public function setDoctor($doctor)
{
    $this->doctor = $doctor;
}

public function getFechaInforme()
{
    return $this->fechaInforme;
}

public function setFechaInforme($fechaInforme)
{
    $this->fechaInforme = $fechaInforme;
}

public function getInforme()
{
    return $this->informe;
}

public function setInforme($informe)
{
    $this->informe = $informe;
}   
}
?>