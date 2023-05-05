<?php
session_start();
require_once("../Controller/ControllerPacientes.php");

$datos = new ControllerPacientes();
$pacientes = $datos->showDataTable("pacientes", 1);



?>
<!doctype html>
<html lang="en">

<head>
  <title>Añadir citas</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="mdtimepicker.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
  
  <div class="container w-50 shadow p-3">
    <div class="col-auto justify-content-start position-absolute top-2 start-2">
      <a href="../View/calendario.php"><i class="far fa-calendar-alt fa-3x text-info"></i></a>
    </div>

    <h1 class="text-center display-5">Añadir cita médica</h1>
    <br>
    <form action="../Controller/ControllerCitas.php" id="formCitas" method="post">
      <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" maxlength="50" required />
        <small class="form-text text-muted"><span id="titulo-characters">50</span> caracteres restantes</small>
      </div>
      <br>
      <div class="form-group">
        <label for="paciente">Paciente:</label>
        <select class="form-control" id="paciente" name="paciente" required>
          <option value="" disabled selected>Selecciona un paciente</option>
          <?php
          /*Bucle que me pone en el select option el nombre de los pacientes
          pero en el fondo, lo que nos interesa es extraer el dni que el usuario
          escoge */
          foreach ($pacientes as $paciente) :

          ?>
            <option value=" <?php echo $paciente->getDni();?> "> <?php echo $paciente->getNombre(); ?> </option>
          <?php

          endforeach;
          ?>
        </select>
      </div>
      <br>
      <!--Formulario que extrae el formulario de alta de citas-->
      <div class="form-group">
        <label for="detalles">Detalles:</label>
        <textarea class="form-control" id="detalles" name="detalles" rows="5" required></textarea>
      </div>
      <br>
      <div class="form-group">
        <label for="hora-inicio">Hora de inicio:</label>
        <div class="mb-3">
          <select class="form-select form-select" name="hora_inicio" id="" required>
            <option selected>Principio de la cita: </option>
            <!--Conjunto de opciones, para poder el fin de la cita desde las 7:00 hasta las 23:45-->
            <option value="07:00">07:00</option>
            <option value="07:15">07:15</option>
            <option value="07:30">07:30</option>
            <option value="07:45">07:45</option>
            <option value="08:00">08:00</option>
            <option value="08:15">08:15</option>
            <option value="08:30">08:30</option>
            <option value="08:45">08:45</option>
            <option value="09:00">09:00</option>
            <option value="09:15">09:15</option>
            <option value="09:30">09:30</option>
            <option value="09:45">09:45</option>
            <option value="10:00">10:00</option>
            <option value="10:15">10:15</option>
            <option value="10:30">10:30</option>
            <option value="10:45">10:45</option>
            <option value="11:00">11:00</option>
            <option value="11:15">11:15</option>
            <option value="11:30">11:30</option>
            <option value="11:45">11:45</option>
            <option value="12:00">12:00</option>
            <option value="12:15">12:15</option>
            <option value="12:30">12:30</option>
            <option value="12:45">12:45</option>
            <option value="13:00">13:00</option>
            <option value="13:15">13:15</option>
            <option value="13:30">13:30</option>
            <option value="13:45">13:45</option>
            <option value="14:00">14:00</option>
            <option value="14:15">14:15</option>
            <option value="14:30">14:30</option>
            <option value="14:45">14:45</option>
            <option value="15:00">15:00</option>
            <option value="15:15">15:15</option>
            <option value="15:30">15:30</option>
            <option value="15:45">15:45</option>
            <option value="16:00">16:00</option>
            <option value="16:15">16:15</option>
            <option value="16:30">16:30</option>
            <option value="16:45">16:45</option>
            <option value="17:00">17:00</option>
            <option value="17:15">17:15</option>
            <option value="17:30">17:30</option>
            <option value="17:45">17:45</option>
            <option value="18:00">18:00</option>
            <option value="18:15">18:15</option>
            <option value="18:30">18:30</option>
            <option value="18:45">18:45</option>
            <option value="19:00">19:00</option>
            <option value="19:15">19:15</option>
            <option value="19:30">19:30</option>
            <option value="19:45">19:45</option>
            <option value="20:00">20:00</option>
            <option value="20:15">20:15</option>
            <option value="20:30">20:30</option>
            <option value="20:45">20:45</option>
            <option value="21:00">21:00</option>
            <option value="21:15">21:15</option>
            <option value="21:30">21:30</option>
            <option value="21:45">21:45</option>
            <option value="22:00">22:00</option>
            <option value="22:15">22:15</option>
            <option value="22:30">22:30</option>
            <option value="22:45">22:45</option>
            <option value="23:00">23:00</option>
            <option value="23:15">23:15</option>
            <option value="23:30">23:30</option>
            <option value="23:45">23:45</option>
          </select>
        </div>

      </div>
      <div class="form-group">
        <label for="hora-fin">Hora de fin:</label>
        <select class="form-select form-select" name="hora_fin" id="" required>
          <!--Conjunto de opciones, para poder el fin de la cita desde las 7:15 hasta las 23:45-->
          <option selected>Fin de la cita: </option>
          <option value="07:15">07:15</option>
          <option value="07:30">07:30</option>
          <option value="07:45">07:45</option>
          <option value="08:00">08:00</option>
          <option value="08:15">08:15</option>
          <option value="08:30">08:30</option>
          <option value="08:45">08:45</option>
          <option value="09:00">09:00</option>
          <option value="09:15">09:15</option>
          <option value="09:30">09:30</option>
          <option value="09:45">09:45</option>
          <option value="10:00">10:00</option>
          <option value="10:15">10:15</option>
          <option value="10:30">10:30</option>
          <option value="10:45">10:45</option>
          <option value="11:00">11:00</option>
          <option value="11:15">11:15</option>
          <option value="11:30">11:30</option>
          <option value="11:45">11:45</option>
          <option value="12:00">12:00</option>
          <option value="12:15">12:15</option>
          <option value="12:30">12:30</option>
          <option value="12:45">12:45</option>
          <option value="13:00">13:00</option>
          <option value="13:15">13:15</option>
          <option value="13:30">13:30</option>
          <option value="13:45">13:45</option>
          <option value="14:00">14:00</option>
          <option value="14:15">14:15</option>
          <option value="14:30">14:30</option>
          <option value="14:45">14:45</option>
          <option value="15:00">15:00</option>
          <option value="15:15">15:15</option>
          <option value="15:30">15:30</option>
          <option value="15:45">15:45</option>
          <option value="16:00">16:00</option>
          <option value="16:15">16:15</option>
          <option value="16:30">16:30</option>
          <option value="16:45">16:45</option>
          <option value="17:00">17:00</option>
          <option value="17:15">17:15</option>
          <option value="17:30">17:30</option>
          <option value="17:45">17:45</option>
          <option value="18:00">18:00</option>
          <option value="18:15">18:15</option>
          <option value="18:30">18:30</option>
          <option value="18:45">18:45</option>
          <option value="19:00">19:00</option>
          <option value="19:15">19:15</option>
          <option value="19:30">19:30</option>
          <option value="19:45">19:45</option>
          <option value="20:00">20:00</option>
          <option value="20:15">20:15</option>
          <option value="20:30">20:30</option>
          <option value="20:45">20:45</option>
          <option value="21:00">21:00</option>
          <option value="21:15">21:15</option>
          <option value="21:30">21:30</option>
          <option value="21:45">21:45</option>
          <option value="22:00">22:00</option>
          <option value="22:15">22:15</option>
          <option value="22:30">22:30</option>
          <option value="22:45">22:45</option>
          <option value="23:00">23:00</option>
          <option value="23:15">23:15</option>
          <option value="23:30">23:30</option>
          <option value="23:45">23:45</option>
        </select>
      </div>
      <br>
      <input type="hidden" name="dia" id="dia" value="">
      <input type="hidden" name="mes" id="mes" value="">
      <h1 id="prueba"></h1>
      <input type="submit" class="btn btn-primary text-center" value="Añadir cita"></input>
    </form>
  </div>

  <script>
    /*Script que hace que el titulo como mucho pueda tener 50 carácteres
    ya que el titulo tiene que ser concreto, en parte para facilitarselo al doctor
    y por otra, para que luego el título sea estético en la propia visualización
    de las citas */
    const titulo = document.getElementById('titulo');
    const tituloCharacters = document.getElementById('titulo-characters');

    titulo.addEventListener('input', () => {
      const remainingCharacters = 50 - titulo.value.length;
      tituloCharacters.textContent = remainingCharacters;

      if (remainingCharacters < 0) {
        titulo.classList.add('is-invalid');
      } else {
        titulo.classList.remove('is-invalid');
      }
    });
  </script>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="//code.jquery.com/jquery.min.js"></script>
  <script src="mdtimepicker.js"></script>
  <script>
    
    dia = localStorage.getItem('dayOfMonth');
    mes = localStorage.getItem('mes');
    console.log(dia);
    console.log(mes);
    window.addEventListener('DOMContentLoaded',function(){
      document.getElementById('dia').value = dia;
      document.getElementById('mes').value = mes;  
    })
      
  </script>
</body>

</html>