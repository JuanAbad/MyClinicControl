<!--Se llama al header, el cual es comun en los archivos view
dependiendo del archivo, en el que nos encontremos, se desctacará un
texto del menú superior u otro-->
<?php
include_once('../View/Header/header.php');

require_once("../Model/model.php");
require_once("../Controller/ControllerPacientes.php");

$datos = new ControllerPacientes();
$pacientes = $datos->showDataTable("pacientes", "1=1");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<script src="../View/pacientes.js" type="text/javascript"></script>
<br>
<link rel="stylesheet" href="../css/style.css">
<div class="container-fluid">
    <!--Container con 3 columnas con el botón que lleva a la modal
de añadir un contacto, la búsqueda de contactos, y
la lista desplegable para ordenar por...-->
    <h1 class="text-center">Mis pacientes</h1>
    <div class="row justify-content-between align-items-center justify">

        <!--Botón de la modal-->
        <div class="mt-3 col-lg-3 col-md-6 col-sm-12 text-star px-3">
            <!-- Modal trigger button -->
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente">
                Nuevo paciente
            </button>

            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" name="modalNuevoPaciente" id="modalNuevoPaciente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">Añadir paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                        <option value="hombre">Hombre</option>
                                        <option value="mujer">Mujer</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado_civil" class="form-label">Telefono móvil</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce el telefono del paciente">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="fotos" class="form-label">Patologías</label>
                                    <textarea class="form-control" id="patologias" name="patologias" rows="3" placeholder="Introduce las patologías del paciente"></textarea>
                                </div>
                                <div class="col-12 mt-3 d-flex justify-content-end">
                                    <input type="submit" class="btn btn-primary mx-1" value="Añadir paciente">
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
            <form id="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar por DNI, Nombre o apellidos...">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <!--Ordenar por... -->
        <div class="col-lg-3 col-md-5 col-sm-12">
            <div class="form-group">
                <div class="dropdown">
                    <select class="form-control dropdown-toggle" id="sort">
                        <option selected value="">Ordenar por...</option>
                        <option value="recent">Más reciente</option>
                        <option value="recent">Más reciente</option>
                        <option value="old">Más antiguo</option>
                        <option value="az">A - Z</option>
                        <option value="za">Z - A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!--Tabla en la cual se visualizarán los contactos que tiene el doctor-->

</div>
<?php

if ($pacientes == null) {
?>
    <br><br><br><br><br>
    <h1 class="text-center">No tienes pacientes</h1>

<?php
} else {
?>
    <div class="table-responsive rounded px-3">
        <table class="table rounded table table-striped table-hover table-borderless table-primary align-middle shadow">
            <thead class="table-primary">
                <tr>
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

                foreach ($pacientes as $paciente) : ?>
                    <tr class="table-primary">
                        <td class="text-center" scope="row"> <?php echo $paciente->getDni(); ?> </td>
                        <td class="text-center" scope="row"> <?php echo $paciente->getNombre(); ?> </td>
                        <td class="text-center"><?php echo $paciente->getApellidos(); ?></td>
                        <td class="text-center"><?php echo $paciente->getEdad(); ?></td>
                        <td class="text-center"><?php echo $paciente->getSexo(); ?></td>
                        <td class="text-center"><?php echo $paciente->getTelefono(); ?></td>
                        <td class="text-center"><?php echo $paciente->getPatologia(); ?>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary me-1">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal -->
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
                            </div>
                        </td>

                    </tr>
                <?php endforeach;

                ?>

            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php
}
?>



</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>



</body>

</html>