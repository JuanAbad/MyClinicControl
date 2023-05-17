<!--Se llama al header, el cual es comun en los archivos view
dependiendo del archivo, en el que nos encontremos, se desctacará un
texto del menú superior u otro-->
<?php
include_once('../View/Header/header.php');

require_once("../Model/model.php");
require_once("../Controller/ControllerPacientes.php");

$datos = new ControllerPacientes();
$pacientes = $datos->showDataTable("pacientes", 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['buscarrContactos'])) {
        $pacientes = $datos->GetPacientesByData($_POST['buscarrContactos']);
    }
    if (isset($_POST['orderBy'])) {
        $pacientes = $datos->GetPacientesByOrder($_POST['orderBy']);
    }
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<br>
<link rel="stylesheet" href="../css/style.css">
<div class="container-fluid">
    <!--Container con 3 columnas con el botón que lleva a la modal
de añadir un contacto, la búsqueda de contactos, y
la lista desplegable para ordenar por...-->
    <h1 class="text-center display-5">Mis pacientes</h1>
    <div class="row justify-content-between align-items-center justify">

        <!--Botón de la modal de creación de nuevo paciente-->
        <div class="mt-3 col-lg-3 col-md-6 col-sm-12 text-star px-3">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente">
                Nuevo paciente
            </button>

            <!--Modal de creación de nuevo paciente-->
            <div class="modal fade" name="modalNuevoPaciente" id="modalNuevoPaciente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">Añadir paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--Formulario de creación de nuevo paciente-->
                            <form id="formPaciente" action="../Controller/ControllerPacientes.php" method="post" class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Introduce el dni del paciente">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre del paciente">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Introduce los apellidos del paciente">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edad" class="form-label">Edad</label>
                                    <input type="number" class="form-control" id="edad" name="edad" placeholder="Introduce la edad del paciente">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select" id="sexo" name="sexo">
                                        <option selected>Selecciona el sexo del paciente</option>
                                        <option value="H">Hombre</option>
                                        <option value="M">Mujer</option>
                                        <option value="O">Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado_civil" class="form-label">Telefono móvil</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce el telefono del paciente">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="fotos" class="form-label">Patologías</label>
                                    <textarea class="form-control" style="height: 100px;" id="patologias" name="patologias" rows="3" placeholder="Introduce las patologías del paciente"></textarea>
                                </div>
                                <div class="col-12 mt-3 d-flex justify-content-end">
                                    <input type="submit" id="btnEnviar" class="btn btn-primary mx-1" value="Añadir paciente">
                                    <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--Búsqueda de contactos-->
        <div class="col-lg-3 mt-3 col-md-6 col-sm-12">
            <form id="search-form" action="../View/contactos.php" method="POST">
                <div class="input-group">
                    <input type="text" name="buscarrContactos" class="form-control" placeholder="Buscar por DNI, Nombre o apellidos...">
                    <button class="btn btn-primary" value="" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <!--Ordenar por... -->
        <div class="col-lg-3 col-md-5 col-sm-12">
            <div class="form-group">
                <div class="dropdown">
                    <form action="contactos.php" method="post">
                        <select class="form-control dropdown-toggle" name="orderBy" onchange="this.form.submit()" id="sort">
                            <option selected value="">Ordenar por...</option>
                            <option value="id desc">Más reciente</option>
                            <option value="id asc">Más antiguo</option>
                            <option value="edad ASC">Edad (Asc)</option>
                            <option value="edad DESC">Edad (Desc)</option>
                        </select>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!--Tabla en la cual se visualizarán los contactos que tiene el doctor-->

</div>
<?php
/*Si no hay pacientes en la base de datos, saldrá este texto*/
if ($pacientes == null) {
?>
    <br><br><br><br><br>
    <h1 class="text-center">No tienes pacientes</h1>

<?php
    /*Si hay pacientes en la base de datos, se entrará en este apartado*/
} else {

?>
    <!--Cabecera de la tabla de pacientes-->
    <div class="table-responsive rounded px-3" style="overflow-y: scroll; max-height:590px;">
        <table class="table rounded table table-striped table-borderless table-primary align-middle shadow table-scrollable">
            <thead class="table-primary">
                <tr style="position: sticky; top: 0;">
                    <th class="text-center">DNI</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Edad</th>
                    <th class="text-center">Sexo</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">Patologia</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php
                /*Bucle que recorre el array de pacientes extraido de la bbdd*/
                foreach ($pacientes as $paciente) : ?>
                    <tr class="table-primary">
                        <td class="text-center" scope="row"> <?php echo $paciente->getDni(); ?> </td>
                        <td class="text-center" scope="row"> <?php echo $paciente->getNombre(); ?> </td>
                        <td class="text-center"><?php echo $paciente->getApellidos(); ?></td>
                        <td class="text-center"><?php echo $paciente->getEdad(); ?></td>
                        <td class="text-center"><?php echo $paciente->getSexo(); ?></td>
                        <td class="text-center"><?php echo $paciente->getTelefono(); ?></td>
                        <td class="text-center"><?php $patologia = $paciente->getPatologia();
                                                echo strlen($patologia) > 40 ? substr($patologia, 0, 40) . "..." : $patologia; ?>
                            <div class="d-flex justify-content-end">
                                <!--Botón que llama a la modal para modificar la 
                                información de los pacientes-->
                                <button class="btn btn-primary me-1 btn-editar" name="btn-editar" data-id='<?php echo $paciente->getDni() ?>'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--Modal que da una modal de confirmación de
                                eliminación de pacientes y si se acepta se elimina
                                de la base de datos, identificando por el dni,
                                ya que se supone que cada persona tiene su
                                propio dni-->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                <?php endforeach;

                ?>
                <!--Modal de confirmación de eliminación de pacientes-->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <!--Pequeño from que llama al controller y si existe
                                dnipaciente, se eliminará en el controller el paciente-->
                                <form action="../Controller/ControllerPacientes.php" method="post">
                                    <input type="hidden" name="dnipaciente" value="<?php echo $paciente->getDni(); ?>">

                                    <button class="btn btn-danger ms-1">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php
}
?>



</div>
<script>
    /*Script de Javascript hecho sin JQuery, que hace un bucle
    de todas los botones de editar, y si en alguna se pulsa, se activa
    el evento que permite activar la modal con los datos de la base de datos

    */
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Prueba 1");
        var botonesEditar = document.querySelectorAll('.btn-editar');
        botonesEditar.forEach(function(botonEditar) {
            console.log("Estamos en el bucle");
            botonEditar.addEventListener('click', function() {
                console.log("boton pulsado");
                var dni = botonEditar.getAttribute('data-id');
                editarPaciente(dni);
            });
        });
    });
    /*Llama desde AJAX al ControllerPacientes para coger los datos de un paciente
    e inyectar los datos en la modal*/
    function editarPaciente(dni) {
        console.log("Estamos en la funcion");
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../Controller/ControllerPacientes.php?dni=' + dni);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("La solocitud es correcta");
                if (xhr.responseText) {
                    console.log("Hay respuesta nano");
                    var paciente = xhr.responseText;
                    var pacienteJSON = JSON.parse(paciente);
                    var dniPacienteModificar;
                    pacienteJSON.forEach(function(paciente) {
                        document.querySelector('#dni').value = paciente.dni;
                        document.querySelector('#nombre').value = paciente.nombre;
                        document.querySelector('#apellidos').value = paciente.apellidos;
                        document.querySelector('#edad').value = paciente.edad;
                        var select = document.querySelector('#sexo');
                        for (var i = 0; i < select.options.length; i++) {
                            if (select.options[i].value === paciente.sexo) {
                                select.selectedIndex = i;
                                break;
                            }
                        }
                        document.querySelector('#telefono').value = paciente.telefono;
                        document.querySelector('#patologias').value = paciente.patologia;
                        document.getElementById('btnEnviar').value = "Modificar paciente";
                        dniPacienteModificar = paciente.dni;
                    });
                    var actionForm = document.getElementById('formPaciente');
                    console.log(dniPacienteModificar);
                    actionForm.action = "../Controller/ControllerPacientes.php?dnimodificar=" + dniPacienteModificar
                    var modal = new bootstrap.Modal(document.getElementById('modalNuevoPaciente'));
                    document.querySelector('#modalTitleId').innerHTML = "Editar paciente";
                    modal.show();
                    var MyModal = modal._element;
                    /*Función que se activa cuando se cierra la modal, y la vacia
                    y cambia el título de la modal por si se inserta un nuevo paciente
                    */
                    MyModal.addEventListener('hidden.bs.modal', function(event) {
                        document.querySelector('#dni').value = "";
                        document.querySelector('#nombre').value = "";
                        document.querySelector('#apellidos').value = "";
                        document.querySelector('#edad').value = "";
                        document.querySelector('#sexo').value = "";
                        document.querySelector('#telefono').value = "";
                        document.querySelector('#patologias').value = "";
                        document.getElementById('btnEnviar').value = "Añadir paciente";
                        document.querySelector('#modalTitleId').innerHTML = "Añadir paciente";
                    });

                } else {
                    console.log("La respuesta del servidor esta vacia");
                }
            } else {
                console.log('Error en la solicitud AJAX');
            }
        };
        xhr.send();

    }
</script>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>



</body>

</html>