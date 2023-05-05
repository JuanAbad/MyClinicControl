<?php

class Cita{
    private $titulo;
    private $dnipaciente;
    private $nombrepaciente;
    private $detalles;
    private $hora_inicio;
    private $hora_final;
    private $dia;
    private $mes;
    
    public function __construct($titulo, $dnipaciente, $nombrepaciente, $detalles, $hora_inicio, $hora_final,$dia,$mes) {
        $this->titulo = $titulo;
        $this->dnipaciente = $dnipaciente;
        $this->nombrepaciente = $nombrepaciente;
        $this->detalles = $detalles;
        $this->hora_inicio = $hora_inicio;
        $this->hora_final = $hora_final;
        $this->dia = $dia;
        $this->mes = $mes;
    }
    
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    public function getDniPaciente() {
        return $this->dnipaciente;
    }
    
    public function setDniPaciente($dnipaciente) {
        $this->dnipaciente = $dnipaciente;
    }
    public function getNombrePaciente() {
        return $this->nombrepaciente;
    }
    
    public function setNombrePaciente($nombrepaciente) {
        $this->nombrepaciente = $nombrepaciente;
    }
    
    public function getDetalles() {
        return $this->detalles;
    }
    
    public function setDetalles($detalles) {
        $this->detalles = $detalles;
    }
    
    public function getHoraInicio() {
        return $this->hora_inicio;
    }
    
    public function setHoraInicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }
    
    public function getHoraFinal() {
        return $this->hora_final;
    }
    
    public function setHoraFinal($hora_final) {
        $this->hora_final = $hora_final;
    }
    public function getDia() {
        return $this->dia;
    }
    
    public function setDia($dia) {
        $this->dia = $dia;
    }
    public function getMes() {
        return $this->mes;
    }
    
    public function setMes($mes) {
        $this->$mes = $mes;
    }
    

    
}
?>