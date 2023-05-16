<?php

require_once("../Model/Doctor.php");
require_once("../Model/model.php");

class ControllerDoctores{
    
}
if(isset($_POST['dniDoctor'])){
    echo "Estmos en la función de insertar doctor";
    $dniDoctor = $_POST['dniDoctor'];
    $nombreDoctor = $_POST['nombreDoctor'];
    $apellidosDoctor = $_POST['apellidosDoctor'];
    $telefonoDoctor = $_POST['telefonoDoctor'];
    $correoDoctor = $_POST['correoDoctor'];
    $contrasenaDoctor = $_POST['contrasenaDoctor'];
    
    $doctor = new Doctor($dniDoctor,$nombreDoctor,$apellidosDoctor,$telefonoDoctor,$correoDoctor,$contrasenaDoctor);

    $modelo = new Model();
    $modelo->insertDoctor($doctor);
    
    header("location: ../View/login.php");
}
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
if(isset($_POST['cerrarSesion'])){
    echo "Esto no funca";
    unset($_SESSION['nombreDoctor']);
    header("location: ../View/index.php");
}
?>