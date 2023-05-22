<?php
session_start();
require_once("../Controller/ControllerPacientes.php");

$datos = new ControllerPacientes();
$pacientes = $datos->showDataTable("pacientes", 1);



?>
<!doctype html>
<html lang="en">

<head>
    <title>Añadir informe</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="mdtimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleadd.css">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>

<body>
    <!--Formulario para añadir los informes médicos-->
    <div class="container w-50  p-3">
        <div class="col-auto justify-content-start position-absolute top-2 start-2">
            <a href="../View/informes.php"><i class="fas fa-file-medical fa-3x text-info"></i></a>
        </div>

        <h1 class="text-center display-5">Añadir informe médico</h1>
        <hr>
        <br>
        <form action="../Controller/ControllerInformes.php" id="formCitas" method="post">
            <div class="form-group text-center">

                <h3>Título del informe: </h3>
                <br>
                <input type="text" class="form-control" id="titulo" name="titulo" required />
            </div>
            <br>
            <div class="form-group text-center">
                <h3>Paciente: </h3>
                <br>
                
                <select class="form-control" id="paciente" name="paciente" required>
                    <option value="" disabled selected>Selecciona un paciente</option>
                    <?php
                    /*Bucle que me pone en el select option el nombre de los pacientes
          pero en el fondo, lo que nos interesa es extraer el dni que el usuario
          escoge */
                    foreach ($pacientes as $paciente) :

                    ?>
                        <option value=" <?php echo $paciente->getDni(); ?> "> <?php echo $paciente->getNombre(); echo " "; echo $paciente->getApellidos() ?> - <?php echo $paciente->getDni() ?> </option>
                    <?php

                    endforeach;
                    ?>
                </select>
            </div>
            <br>
            <!--Formulario que extrae el formulario de alta de citas-->
            <div class="form-group text-center">
                
                <h3>Informe: </h3>
                <textarea class="form-control" id="informeCompleto" name="informeCompleto" rows="5" required></textarea>
            </div>
            <br>

            <br>
            <input type="hidden" name="dia" id="dia" value="">
            <input type="hidden" name="mes" id="mes" value="">
            <input type="hidden" name="annio" id="annio" value="">

            <h1 id="prueba"></h1>
            <input type="submit" class="btn btn-primary text-center" value="Añadir informe médico"></input>
        </form>
    </div>
    

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
        annio = localStorage.getItem('annio');
        console.log(dia);
        console.log(mes);
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('dia').value = dia;
            document.getElementById('mes').value = mes;
            document.getElementById('annio').value = annio;
        })
    </script>
</body>

</html>