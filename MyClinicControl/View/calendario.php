<?php
include_once('../View/header/header.php');
include_once('../Controller/ControllerCitas.php');
$controllerCita = new ControllerCitas();
$dnidoctor = $_SESSION['dniDoctor'];
$diaActual = date("j");
$mesActual = date("m");
$mesActualSinCero = ltrim($mesActual, '0');
if (isset($_GET['diaVisualizar'])) {
  $diaVisualizar = $_GET['diaVisualizar'];
  $mesVisualizar = $_GET['mesVisualizar'];
  $citas = $controllerCita->getCitasByData($diaVisualizar, $mesVisualizar, $dnidoctor);
} else {

  $citas = $controllerCita->getCitasByData($diaActual, $mesActualSinCero - 1, $dnidoctor);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="../View/stylecalendar.css">
<div class="container-fluid">
  <h1 class="text-center mt-3 display-5"><b>Mi calendario</b></h1>
  <br><br><br>
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
        $numeroDiaHoy = date('d');
        $numeroMesHoy = date('m');
        
        if (isset($_GET['diaVisualizar'])) {
          $diaVisualizar = $_GET['diaVisualizar'];
          $mesVisualizar = $_GET['mesVisualizar'];
          
          $diaHoySinCero = ltrim($numeroDiaHoy,'0');
          $mesHoySinCero = ltrim($numeroMesHoy-1);

          $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

          $mesAño = 0; // El número del mes que deseas imprimir

          if ($mesVisualizar >= 0 && $mesVisualizar <= 11) {
            $nombreMes = $meses[$mesVisualizar];
          } else {
            echo "Número de mes inválido";
          }
            if($diaVisualizar == $diaHoySinCero && $mesVisualizar == $mesHoySinCero){
              ?>
              Tus citas de hoy:
            <?php
            }else{
              echo "Tus citas médicas: " ?> <br /> <h5 class="display-6"> <?php echo "( $diaVisualizar  de $nombreMes )" ?> </h5> <?php ;
            }
          }  else {
          ?>
          Tus citas de hoy:
        <?php
          }

        ?>
      </h3>
      <?php foreach ($citas as $cita) : ?>
    <ul class="mt-3 bg-grisclarito p-3" id="estiloAgenda">
        <li class="position-relative text-center" style="width: 450px; margin: 0 auto;">
            <div>
                <?php echo $cita->getHoraInicio() ?> - <?php echo $cita->getHoraFinal() ?><br>
                <?php echo $cita->getTitulo() ?><br>
                <a href="" class="text-primary text-decoration-none"><?php echo $cita->getDniPaciente() ?></a>
            </div>
            <a href="#" class="btn btn-primary btn-sm position-absolute top-50 end-0 translate-middle-y"><i class="fas fa-info-circle"></i></a>
        </li>
    </ul>
<?php endforeach; ?>

    </div>
  </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js"></script>
  <script>
    function subirVariableSesion(dia, mes) {
      localStorage.setItem('dayOfMonth', dia);
      localStorage.setItem('mes', mes);
    }

    function pasarDatosFecha(dia, mes) {
      console.log("Estoy dentro de la función pasarDatosFecha");

      var xhr = new XMLHttpRequest();
      var url = "calendario.php";

      var diaVisualizar = localStorage.getItem('dayOfMonth');
      var mesVisualizar = localStorage.getItem('mes');

      // Crear los datos que deseas enviar al servidor
      var data = "diaVisualizar=" + diaVisualizar + "&mesVisualizar=" + mesVisualizar;

      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Redirigir al sitio web después de que la solicitud se haya completado exitosamente
          window.location.href = "calendario.php?diaVisualizar=" + diaVisualizar + "&mesVisualizar=" + mesVisualizar;
        }
      };
      xhr.send(data);
    }

    $(document).ready(function() {

      // Obtiene la fecha actual
      let currentDate = moment();

      // Obtiene el mes actual
      let currentMonth = currentDate.month();

      // Obtiene el año actual
      const currentYear = currentDate.year();

      // Función que renderiza el calendario para una fecha dada
      function renderCalendar(date) {

        // Muestra la fecha actual en formato "Mes Año"
        $(".current-date").text(date.format("MMMM [del] YYYY"));

        // Obtiene el día de la semana del primer día del mes
        const firstDayOfMonth = moment(date).startOf("month").day();

        // Obtiene el último día del mes
        const lastDateOfMonth = moment(date).endOf("month").date();

        // Inicializa la variable que contendrá el contenido de la tabla del calendario
        let dayOfMonth = 1;
        let tableCells = "";

        // Itera sobre cada fila del calendario
        for (let i = 0; i < 6; i++) {
          let tableRows = "<tr>";

          // Itera sobre cada día de la semana en la fila actual
          for (let j = 0; j < 7; j++) {
            console.log(firstDayOfMonth);
            console.log(lastDateOfMonth);
            console.log()
            // Si el día actual no pertenece al mes actual, se agrega una celda vacía
            if (i === 0 && j < firstDayOfMonth) {
              tableRows += '<td class="m-0"></td>';
            }
            // Si el día actual ya sobrepasa el último día del mes, se agrega una celda vacía
            else if (dayOfMonth > lastDateOfMonth) {
              tableRows += "<td></td>";
              dayOfMonth++;
            }
            // Si el día actual pertenece al mes actual, se agrega una celda con el número del día
            else {
              var encodeDayOfMonth = encodeURIComponent(dayOfMonth);
              console.log(encodeDayOfMonth);
              tableRows += `<td class="text-center p-0 m-0 cell"><button type="button"  data-bs-toggle="modal" data-bs-target="#ModalEleccion" class="btn btn-transparent btn-hover w-100 h-100" onclick="subirVariableSesion(${dayOfMonth},${currentMonth})">${dayOfMonth}</button></td>`;
              console.log(currentMonth);
              dayOfMonth++;

            }
          }
          tableRows += "</tr>";
          tableCells += tableRows;
        }
        // Inserta el contenido de la tabla del calendario en el HTML
        $(".days").html(tableCells);
      }

      // Renderiza el calendario para la fecha actual
      renderCalendar(currentDate);

      // Agrega un evento al botón de "mes anterior"
      $("#prev").on("click", function() {
        // Resta un mes a la fecha actual y vuelve a renderizar el calendario
        currentDate = moment(currentDate).subtract(1, "month");
        currentMonth--;
        renderCalendar(currentDate);
      });

      // Agrega un evento al botón de "mes siguiente"
      $("#next").on("click", function() {
        // Agrega un mes a la fecha actual y vuelve a renderizar el calendario
        currentDate = moment(currentDate).add(1, "month");
        currentMonth++;
        renderCalendar(currentDate);
      });


    })
  </script>
  </body>

  </html>