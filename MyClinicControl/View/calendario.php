<?php
include_once('../View/header/header.php');
include_once('../Controller/ControllerCitas.php');
include_once('../Controller/ControllerPacientes.php');

$controllerCita = new ControllerCitas();
$dnidoctor = $_SESSION['dniDoctor'];
/*Se extrae las fechas actuales*/
$diaActual = date("j");
$mesActual = date("m");
$annioActual = date("Y");
$mesActualSinCero = ltrim($mesActual, '0');
/*Si en la url hay un dia y mes a visualizar se extraen los datos de esos días
Si no, se extraen los datos de el día actual (Por ejemplo, cuando
escribo esto, el 4 de mayo de 2023) */
if (isset($_GET['diaVisualizar'])) {
  $diaVisualizar = $_GET['diaVisualizar'];
  $mesVisualizar = $_GET['mesVisualizar'];
  
  if(isset($_GET['annioVisualizar'])){
    $annioVisualizar = $_GET['annioVisualizar'];
  }
  $citas = $controllerCita->getCitasByData($diaVisualizar, $mesVisualizar,$annioVisualizar, $dnidoctor);
} else {
  $annioVisualizar = $annioActual;
  $citas = $controllerCita->getCitasByData($diaActual, $mesActualSinCero - 1,$annioVisualizar, $dnidoctor);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<link rel="stylesheet" href="../View/stylecalendar.css">
<!--Modal que muestar los detalles de las citas médicas-->
<div class="modal fade custom-modal" id="modalDetalleCita" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitleId">Detalles de la cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h1 class="text-center display-5">Revisión craneal</h1>
          <hr>
          <h2 class="text-center display-6">08:00 - 08:15</h2>
          <br><br>
          <ul>
            <li id="txtPacienteCita"><strong>Paciente: </strong> Sergio Sobrinos Bermejo </li>
            <li id="txtDetalleCita"><strong>Detalles: </strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, eveniet voluptate perspiciatis voluptas sequi eaque animi expedita optio nostrum excepturi. Commodi iste atque saepe enim veritatis animi, blanditiis ducimus repellendus. </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<div class="container-fluid">
  <h1 class="text-center mt-3 display-5"><b>Mi calendario</b></h1>
  <br><br><br>
  
  
  
  
  <!-- Optional: Place to the bottom of scripts -->
  <script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
  
  </script>
  <div class="row justify-content-center" id="horario">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0 current-date text-center"></h5>
          <div class="btn-group">
            <button type="button" class="btn btn-link" id="prev"><i class="fas fa-chevron-left"></i></button>
            <button type="button" class="btn btn-link" id="next"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>
        <div class="card-body p-0">
          <!--Tabla que luego se rellenará con Javascript-->
          <div class="table">
            <table class="table table-bordered mb-0">
              <thead class="thead-light">
                <tr>
                  <th class="text-center">Sun</th>
                  <th class="text-center">Mon</th>
                  <th class="text-center">Tue</th>
                  <th class="text-center">Wed</th>
                  <th class="text-center">Thu</th>
                  <th class="text-center">Fri</th>
                  <th class="text-center">Sat</th>
                </tr>
              </thead>
              <tbody class="days"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="agenda shadow">
      <h3 class="text-center mt-3 display-5">
        <?php
        /*Se extrae la fecha actual con php para poner el titulo a las citas */
        $numeroDiaHoy = date('d');
        $numeroMesHoy = date('m');
        $numeroAnnioHoy = date('y');

        /*Método que se activa cuando se pulsa un día del calendario */
        if (isset($_GET['diaVisualizar'])) {
          $diaVisualizar = $_GET['diaVisualizar'];
          $mesVisualizar = $_GET['mesVisualizar'];

          $diaHoySinCero = ltrim($numeroDiaHoy, '0');
          $mesHoySinCero = ltrim($numeroMesHoy - 1);
          /*Como el numero del mes, el cual va de 0 a 11, va por numeros
          se compara eso con el array */
          $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

          $mesAño = 0; // El número del mes que deseas imprimir
          if($mesVisualizar>=12){
            $mesVisualizar = $mesVisualizar%12;
            echo $mesVisualizar;
          }
          if ($mesVisualizar >= 0 && $mesVisualizar <= 11) {
            $nombreMes = $meses[$mesVisualizar];
          } else {
            echo "Número de mes inválido";
          }
          /*Si el dia y el mes a visualizar es igual que el dia y el mes actual
          se imprime el título "Tus citas de hoy", si no, se imprimirá la fecha
          en la cual se están visualizando esos datos de las citas*/
          if ($diaVisualizar == $diaHoySinCero && $mesVisualizar == $mesHoySinCero) {
        ?>
            Tus citas de hoy:
          <?php
          } else {
            echo "Tus citas médicas: " ?> <br />
            <h5 class="display-6"> <?php echo "( $diaVisualizar  de $nombreMes )" ?> </h5> <?php ;
              }
            } else {
              ?>
          Tus citas de hoy:
          
          <br />
        <?php
          }
        ?>
      </h3>
      <!--Bucle que llena las citas con los datos del objeto Cita-->
      <?php
      $numeroAccordeon = 0;
      foreach ($citas as $cita) : 
        $numeroAccordeon++;
        $identificadorAcordeon = 'acordeon' . $numeroAccordeon;
        $controllerPaciente = new ControllerPacientes();
        
        $cita->getDniPaciente();
        $detallesPaciente = $controllerPaciente->GetPacientesByData( $cita->getDniPaciente());
        $primerPaciente = $detallesPaciente[0];
        ?>
        
        <ul class="mt-3 bg-grisclarito p-3" id="estiloAgenda">
          <li class="position-relative text-center" style="width: 450px; margin: 0 auto;">
            <div>
              <?php echo $cita->getHoraInicio() ?> - <?php echo $cita->getHoraFinal() ?><br>
              <strong> <?php echo $cita->getTitulo() ?></strong> <br>
              <p class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDetallePacientes"><?php echo $cita->getNombrePaciente(); ?>  <?php echo $primerPaciente->getApellidos() ?></p>
              <br><br><br>
              <!--Accordion que me mostrará los detalles del paciente-->
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $identificadorAcordeon ?>" aria-expanded="true" aria-controls="collapseOne">
                      Detalles del paciente <?php echo $cita->getNombrePaciente(); ?>
                    </button>
                  </h2>
                  <div id="<?php echo $identificadorAcordeon ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <div class="detallesPacientes">
                    <h4 class="fw-bold mb-4">Detalles del paciente:</h4>
                    <?php  ?>
                    <div class="card mb-4">
                      <div class="card-body">
                        <p class="card-text"><strong>DNI:</strong> <?php echo $primerPaciente->getDni(); ?>  </p>
                        <p class="card-text"><strong>Nombre:</strong> <?php echo $primerPaciente->getNombre(); ?> </p>
                        <p class="card-text"><strong>Apellidos:</strong> <?php echo $primerPaciente->getApellidos(); ?> </p>
                        <p class="card-text"><strong>Teléfono:</strong> <?php echo $primerPaciente->getTelefono(); ?> </p>
                        <p class="card-text"><strong>Patología:</strong></p>
                        <p class="card-text"> <?php echo $primerPaciente->getPatologia(); ?> </p>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
            </div>

            <a href="#" class="btn btn-primary btn-sm position-absolute top-0 end-0 translate-middle-y" data-bs-toggle="modal" data-citanombre=<?php echo $cita->getNombrePaciente() ?> data-horafin=<?php echo $cita->getHoraFinal() ?> data-citadetalles=<?php echo $cita->getDetalles() ?> data-horaprincipio=<?php echo $cita->getHoraInicio() ?> data-bs-target="#modalDetalleCita"><i class="fas fa-info-circle"></i></a>
          </li>
        </ul>
      <?php endforeach; ?>

    </div>
  </div>
  
  <!--Modal que se activa al pulsar un día en el calendario, con la cual se podrá
  elegir netre añadir una nueva cita para una fecha específica, o visualizar
  las citas de ese día específico-->
  <div class="modal fade bottom-modal shadow" id="ModalEleccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-bottom modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center mx-auto" id="exampleModalLabel">Elegir opción</h5>

        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center">
            <a href="../View/citas.php?"><button type="button" class="btn btn-primary">
                <i class="bi bi-plus"></i> Añadir cita
              </button></a>
            <button type="button" class="btn btn-primary" onclick="pasarDatosFecha()">
              <i class="bi bi-calendar2-check"></i> Ver citas
            </button>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-transparent ms-auto mx-auto text-center" data-bs-dismiss="modal">
            X
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>
  <script>
    /* Se sube al localStorage el dia y mes seleccionado */
    function subirVariableSesion(dia, mes,annio) {
      localStorage.setItem('dayOfMonth', dia);
      localStorage.setItem('mes', mes);
      localStorage.setItem('annio',annio);
      console.log("El año es: "+annio);
    }
    /*Pasar datos del objeto Cita a la modal */
    var modalDetalleCita = document.getElementById('modalDetalleCita');
    modalDetalleCita.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que abrió la modal
    
    var nombrepaciente = button.getAttribute('data-citanombre'); 
    var horaprincipio = button.getAttribute('data-horainicio');
    var horafin = button.getAttribute('data-horafin');
    var detalles = button.getAttribute('data-detalles');
    
    
    // Actualizamos los campos de la modal con los datos de la cita
    document.getElementById('txtPacienteCita').innerText = cita.nombrepaciente;
    document.getElementById('txtDetalleCita').innerText = cita.detalles;
  });

    function pasarDatosFecha(dia, mes) {
      /*Se envia al propio archivo archivo calendario.php con AJAX los datos
       del dia y mes a visualizar*/
      console.log('Estoy dentro del metodo');
      var xhr = new XMLHttpRequest();
      var url = "calendario.php";

      var diaVisualizar = localStorage.getItem('dayOfMonth');
      var mesVisualizar = localStorage.getItem('mes');
      var annioVisualizar = localStorage.getItem('annio');

      // Crear los datos que deseas enviar al servidor
      var data = "diaVisualizar=" + diaVisualizar + "&mesVisualizar=" + mesVisualizar + "&annioVisualizar="+ annioVisualizar;

      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Redirigir al sitio web después de que la solicitud se haya completado exitosamente
          window.location.href = "calendario.php?diaVisualizar=" + diaVisualizar + "&mesVisualizar=" + mesVisualizar + "&annioVisualizar="+annioVisualizar;
        }
      };
      xhr.send(data);
    }

    $(document).ready(function() {

      /*Obtiene la fecha actual*/
      let currentDate = moment();

      /*Obtiene el mes actual*/
      let currentMonth = currentDate.month();

      /*Obtiene el año actual*/
      const currentYear = currentDate.year();

      /*Función que renderiza el calendario para una fecha dada*/
      function renderCalendar(date) {

        /*Muestra la fecha actual en formato "Mes Año*/
        $(".current-date").text(date.format("MMMM [del] YYYY"));

        /*Obtiene el día de la semana del primer día del mes*/
        const firstDayOfMonth = moment(date).startOf("month").day();

        /*Obtiene el último día del mes*/
        const lastDateOfMonth = moment(date).endOf("month").date();

        /*Inicializa la variable que contendrá el contenido de la tabla del calendario*/
        let dayOfMonth = 1;
        let tableCells = "";

        /*Itera sobre cada fila del calendario*/
        for (let i = 0; i < 6; i++) {
          let tableRows = "<tr>";

          /*Itera sobre cada día de la semana en la fila actual*/
          for (let j = 0; j < 7; j++) {
            console.log(firstDayOfMonth);
            console.log(lastDateOfMonth);
            console.log()
            /*Si el día actual no pertenece al mes actual, se agrega una celda vacía*/
            if (i === 0 && j < firstDayOfMonth) {
              tableRows += '<td class="m-0"></td>';
            }
            /*Si el día actual ya sobrepasa el último día del mes, se agrega una celda vacía*/
            else if (dayOfMonth > lastDateOfMonth) {
              tableRows += "<td></td>";
              dayOfMonth++;
            }
            /*Si el día actual pertenece al mes actual, se agrega una celda con el número del día*/
            else {
              var encodeDayOfMonth = encodeURIComponent(dayOfMonth);
              console.log(encodeDayOfMonth);
              tableRows += `<td class="text-center p-0 m-0 cell"><button type="button"  data-bs-toggle="modal" data-bs-target="#ModalEleccion" class="btn btn-transparent btn-hover w-100 h-100" onclick="subirVariableSesion(${dayOfMonth},${currentMonth},${currentDate.year()})">${dayOfMonth}</button></td>`;
              console.log(currentMonth);
              dayOfMonth++;

            }
          }
          tableRows += "</tr>";
          tableCells += tableRows;
        }
        /*Inserta el contenido de la tabla del calendario en el HTML*/
        $(".days").html(tableCells);
      }

      /*Renderiza el calendario para la fecha actual*/
      renderCalendar(currentDate);

      /*Agrega un evento al botón de "mes anterior"*/
      $("#prev").on("click", function() {
        /*Resta un mes a la fecha actual y vuelve a renderizar el calendario*/
        currentDate = moment(currentDate).subtract(1, "month");
        currentMonth--;
        renderCalendar(currentDate);
      });

      /*Agrega un evento al botón de "mes siguiente"*/
      $("#next").on("click", function() {
        /*Agrega un mes a la fecha actual y vuelve a renderizar el calendario*/
        currentDate = moment(currentDate).add(1, "month");
        currentMonth++;
        renderCalendar(currentDate);
      });


    })
  </script>
  </body>

  </html>