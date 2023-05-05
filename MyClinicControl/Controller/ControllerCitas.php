<?php

require_once("../Model/Cita.php");
require_once("../Model/model.php");

class ControllerCitas{
    /*Método que llama al model para obtener todos los datos de las citas
    por el mes y por el dia */
    public function getCitasByData($dia,$mes){
        $modelo = new Model();
        $personas = $modelo->getCitasByDate($dia,$mes);
        return $personas;
    }
}
/*Ya que los campos de añadir citas son required, si existe el campo titulo,
Me recogerá los datos de añadir cita para añadirlos en la bbdd  */
if(isset($_POST['titulo'])){
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $titulo = $_POST['titulo'];
    $dnipaciente = $_POST['paciente'];
    $detalles = $_POST['detalles'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    
    $cita = new Cita($titulo,$dnipaciente,"",$detalles,$hora_inicio,$hora_fin,$dia,$mes);

        $modelo = new Model();
        $modelo->insertCitas($cita);
    header("location: ../View/calendario.php");
}
/*Método para poder loguearme el doctor, y comprobarme que el email y la contraseña
son correctos, en caso contrario, me redirigirá a login.php */
if(isset($_POST['emailogindoctor'])){
    $emailogindoctor = $_POST['emailogindoctor'];
    $contrasenalogindoctor = $_POST['contrasenalogindoctor'];
    echo $emailogindoctor;
    echo $contrasenalogindoctor;
    $modelo = new Model();
    $doctorLogueado = $modelo->loginDoctor($emailogindoctor,$contrasenalogindoctor);
    if($doctorLogueado){
        header("location: ../view/contactos.php");
        session_start();
        $_SESSION['nombreDoctor'] = $doctorLogueado->getNombre();
        $_SESSION['dniDoctor'] = $doctorLogueado->getDni();
        echo $_SESSION['nombreDoctor'];
        setcookie("dniDoctor",$doctorLogueado->getDni(),time()+(86400 * 30),"/");
    }
    else{
        header("location: ../View/login.php");
    } 
}
/*Método que me eliminará de la sesion el dato de la sesión, redirigiendome
a index.php*/
if(isset($_POST['cerrarSesion'])){
    unset($_SESSION['nombreDoctor']);
    header("location: ../View/index.php");
}
?>
