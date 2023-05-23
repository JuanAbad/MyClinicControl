<?php

class FechaCita{
    public $dia;
    public $mes;
    public $annio;
    function __construct($dia,$mes,$annio)
    {
        $this->dia = $dia;
        $this->mes = $mes;
        $this->annio = $annio;
         
    }
    public function setDia($dia){
        $this->dia = $dia;
    }
    public function getDia() {
        return $this->dia;
    }
    public function setMes($mes){
        $this->mes = $mes;
    }
    public function getMes() {
        return $this->mes;
    }
    public function setAnnio($annio){
        $this->annio = $annio;
    }
    public function getAnnio() {
        return $this->annio;
    }
    
}

?>