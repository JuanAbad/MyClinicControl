<?php
include_once('../View/header/header.php');
include_once('../Controller/ControllerInformes.php');

$controller = new ControllerInformes();
$informesPacientes=null;
if(isset($_POST['dniBuscar'])){
  
  $informesPacientes = $controller->getInformesByPaciente($_POST['dniBuscar']);
}
?>

<div class="container">
  <h1 class="mt-4 display-5 text-center">Informes Médicos</h1>

  <!-- Búsqueda de pacientes -->
  <br>
  <div class="row mt-4 d-flex justify-content-center">
    <div class="col-md-6">
      <form action="informes.php" method="POST">
        <div class="mb-3">
          <div class="input-group">
              <input type="text" class="form-control" name="dniBuscar" id="inputBuscarPaciente" placeholder="Buscar por DNI...">
              <button type="submit" class="btn btn-success">Buscar informes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Lista de informes médicos -->
  <br><br>
  <div class="d-flex justify-content-center">
    <a href="addInforme.php" class="btn btn-danger btn-lg btn-block">Añadir informe</a>
  </div>
  <hr>

  <div class="row mt-4">
    <div class="col">
      <h2>Informes Médicos de Paciente</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID del Informe</th>
            <th scope="col">Fecha</th>
            <th scope="col">Médico</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id = 0;
          if($informesPacientes !=null ){
            $id++;
            foreach($informesPacientes as $informe){
            ?>
            <tr>
              <td> <?php echo $id ?> </td>
              <td> <?php echo $informe->getFechaInforme() ?> </td>
              <td> <?php echo $informe->getPaciente() ?> </td>
              <td> <?php echo $informe->getTitulo() ?> </td>
              <td><a href="../View/MiPdf.php" class="btn btn-primary">Ver Informe</a></td>
          </tr>
          <?php
             
            }
          }
          ?>
          
          
        </tbody>
      </table>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>


</body>

</html>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>

</html>