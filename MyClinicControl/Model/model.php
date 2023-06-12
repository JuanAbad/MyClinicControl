<?php

include_once("../Model/Paciente.php");
include_once("../Model/Cita.php");
include_once("../Model/FechaCita.php");

include_once("../Model/NombrePaciente.php");
include_once("../Model/NombreDoctor.php");



class Model
{
    private $pacientes;
    private $db;
    /*Establecemos conexión con la base de datos*/
    public function __construct()
    {
        $this->pacientes = array();
        try {
            $this->db = new PDO('mysql:host=192.168.0.178;dbname=mycliniccontrol', "root", "");
        } catch (PDOException $e) {
            echo "Error en la conexión a la base de datos: " . $e->getMessage();
            exit;
        }
    }
 
    /*Función que saca los pacientes ordenados por...*/
    public function selectData($table,$order)
    {   
        $dnidoctor = $_SESSION['dniDoctor'];
        
        $query = "SELECT * FROM " . $table . " WHERE dni_doctor= 
        '".$dnidoctor."' ORDER BY ".$order.";";
        
        $result = $this->db->query(($query));

        $pacientes = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new Paciente($row['dni'],$row['nombre'], $row['apellidos'], $row['edad'], $row['sexo'], $row['telefono'], $row['patologia']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    /*Selecciona el dia, el mes y el año de todas las citas*/
    public function selectDayMonthAndYear(){
        $dnidoctor = $_SESSION['dniDoctor'];
        $query = "select dia,mes,annio from citas where dnidoctor = '".$dnidoctor."'";
        
        $result = $this->db->query(($query));

        $fechasCitas = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fechaCita = new FechaCita($row['dia'],$row['mes'],$row['annio']);
            $fechasCitas[] = $fechaCita;
        }
        return $fechasCitas;     
    }
    public function selectDayMonthAndYearByDni($dni){
        $query = "select dia,mes,annio from citas where dnipaciente= ' ".$dni."'order by annio ASC, Mes ASC, Dia ASC ";
        $result = $this->db->query(($query));

        $fechasCitas = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fechaCita = new FechaCita($row['dia'],$row['mes'],$row['annio']);
            $fechasCitas[] = $fechaCita;
        }
        return $fechasCitas;
        
    }
    /*Función que busca por dni, nombre o apellidos*/
    public function selectPacientesByDni($busqueda)
    {
        $dnidoctor = $_COOKIE['dniDoctor'];

        $query = "SELECT * FROM pacientes WHERE
         dni_doctor='".$dnidoctor."' and (dni like'%$busqueda%' 
         or nombre like '%$busqueda%' or apellidos like '%$busqueda%'
         or apellidos like '%$busqueda%')";
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
    public function borrarCita($dnipaciente){
        $query = "DELETE FROM citas WHERE dnipaciente = ' " .$dnipaciente . "'";
        echo  $query;
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function borrarInforme($dnipaciente){
        $query = "DELETE FROM informes WHERE Paciente = ' " .$dnipaciente . "'";
        echo  $query;
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
    public function getNombreDoctorByDni($dni){
        $query = "SELECT nombre FROM doctores WHERE dni = '".$dni."'";
        $result = $this->db->query(($query));

        $doctores = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doctor = new NombreDoctor($row['nombre']);
            $doctores[] = $doctor;
        }
        return $doctores;
    }
    public function getNombrePacienteByDni($dni){
        $query = "SELECT nombre FROM pacientes WHERE dni = '".$dni."'";
        $result = $this->db->query(($query));

        $doctores = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doctor = new NombreDoctor($row['nombre']);
            $doctores[] = $doctor;
        }
        return $doctores;
    }
    /*Método que recoge los informes por el dni del paciente, y obviamente solo podrás acceder
    a tus pacientes */
    public function selectInformesByDni($dni)
    {
        if($dni==null){
            $dni = 1;
        }
        $model = new Model(); 
        $dnidoctor = $_COOKIE['dniDoctor'];
        $query = "SELECT * FROM informes WHERE dnidoctor='".$dnidoctor."' and paciente =' $dni'";
        
        $result = $this->db->query(($query));

        $informes = array();

        $nombreDoctorArray = $model->getNombreDoctorByDni($dnidoctor);
        $nombreDoctor = isset($nombreDoctorArray[0]) ? $nombreDoctorArray[0] : '';

        $nombrePacienteArray = $model->getNombrePacienteByDni($dni);
        $nombrePaciente = isset($nombrePacienteArray[0]) ? $nombrePacienteArray[0] : '';

        
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $informe = new Informe($row['id'],$row['titulo'],$row['Paciente'],$row['dnidoctor'], $row['FechaInforme'], $row['Informe']);
            $informe->setDoctor($nombreDoctor);
            $informe->setPaciente($nombrePaciente);
            $informes[] = $informe;
        }
        return $informes;
    }
    public function selectInformesById($id)
    {
        $query = "SELECT * FROM informes WHERE id='".$id."'";
        
        $result = $this->db->query(($query));

        $informes = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $informe = new Informe($row['id'],$row['titulo'],$row['Paciente'],$row['dnidoctor'], $row['FechaInforme'], $row['Informe']);
            $informes[] = $informe;
        }
        return $informes;
    }
    /*Método que inserta los informes */
    public function insertInforme($informe){
        session_start();
        $dnidoctor = $_SESSION['dniDoctor'];
        
        $query = "INSERT INTO informes (titulo,paciente,dnidoctor,fechainforme,informe) 
        VALUES ('".$informe->getTitulo()."','".$informe->getPaciente()."', '".$dnidoctor."', '".$informe->getFechaInforme()."', '".$informe->getInforme()."')";

        $result = $this->db->query($query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /*Como obtenemos el dni del paciente, este método me busca el nombre del paciente
    para añadirmelo en la base de datos, para posteriormente, visualizarmelo*/
    public function selectNombreByDni($dni) {
        
        $query = "SELECT nombre FROM pacientes WHERE dni = '".$dni."'";
        $result = $this->db->query(($query));

        $pacientes = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paciente = new NombrePaciente($row['nombre']);
            $pacientes[] = $paciente;
        }
        return $pacientes;
    }
    /*Método que me inserta los datos de las citas, incluido el nombre del paciente
    obtenido del propio método "selectNombreByDni()"*/
    public function insertCitas($cita)
    {
        session_start();
        $dnidoctor = $_SESSION['dniDoctor'];
        $model = new Model();
        $nombrePacienteArray = $model->selectNombreByDni(trim($cita->getDniPaciente()));
        echo "El nombre del paciente es: " .json_encode($nombrePacienteArray);
        $nombre = $nombrePacienteArray[0];
        echo $nombre;
        $dnidoctor = $_SESSION['dniDoctor'];
        $query = "INSERT INTO citas (titulo, paciente, detalles, hora_inicio, hora_fin, mes, dia, dnidoctor,dnipaciente,annio) 
              VALUES ('".$cita->getTitulo()."', '".$nombre."', '".$cita->getDetalles()."', 
                      '".$cita->getHoraInicio()."', '".$cita->getHoraFinal()."', '".$cita->getMes()."', 
                      '".$cita->getDia()."', '".$dnidoctor."','".$cita->getDniPaciente()."','".$cita->getAnnio()."')";
        
        $result = $this->db->query($query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /*Método que me obtiene las citas de la base de datos con un dia, mes
    y doctor específico */
    public function getCitasByDate($dia,$mes,$annio){
        
        $dnidoctor = $_SESSION['dniDoctor'];
        $query = "SELECT * FROM citas where dia = '" .$dia. "' and annio = '".$annio."' and mes = '" .$mes. "' and dnidoctor = '" .$dnidoctor. "'order by hora_inicio ASC";
        $citas = array();

        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $cita = new Cita($row['Titulo'],$row['dnipaciente'],$row['Paciente'], $row['Detalles'], $row['hora_inicio'], $row['hora_fin'], $row['Mes'], $row['Dia'], $row['dnidoctor'],$row['annio']);

            $citas[] = $cita;
        }
        return $citas;
    }
    public function getCitasByDni($dni){
        
        $query = "SELECT * FROM citas where dnipaciente = ' " .$dni. "' order by annio ASC, Mes ASC, Dia ASC ";
        $citas = array();

        $result = $this->db->query($query);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $cita = new Cita($row['Titulo'],$row['dnipaciente'],$row['Paciente'], $row['Detalles'], $row['hora_inicio'], $row['hora_fin'], $row['Dia'], $row['Mes'],$row['annio']);

            $citas[] = $cita;
        }
        return $citas;
    }
    /* Método que inserta nuevos pacientes */
    public function insertDoctor($Doctor)
    {
        $query = "INSERT INTO doctores (dni, nombre, apellidos, 
        telefono, correo, contraseña) 
        VALUES ('".$Doctor->getDni()."', '".$Doctor->getNombre()."',
         '".$Doctor->getApellidos()."', 
                '".$Doctor->getTelefono()."', '".$Doctor->getCorreo()."',
                 '".$Doctor->getContrasena()."')";
        
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /*Método que me hace un sistema de login de un doctor */
    public function loginDoctor($correo,$contrasena){
        $query = "SELECT * FROM doctores where correo = '".$correo."' 
        and contraseña = '".$contrasena."';";
        $result = $this->db->query($query);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $doctor = new Doctor($row['dni'],$row['nombre'],
             $row['apellidos'],
             $row['telefono'], $row['correo'], $row['contraseña']);
        }

        if ($result && $result->rowCount() == 1) {
            return $doctor;
        } else {
            return false;
        }
    }
    /*Obviamente, este método, me modifica el paciente una vez que cogemos los
    datos de la modal de modificar los pacientes*/
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
