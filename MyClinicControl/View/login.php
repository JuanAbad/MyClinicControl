<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <header class="bg-light py-3">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col-auto justify-content-start">
                    <a href="../View/index.php"><i class="fas fa-home fa-3x text-info"></i></a>
                </div>
                <div class="col">
                    <h1 class="text-center mb-0 display-4">Iniciar sesión - MyClinicControl</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center min-vh-100">
            <div class="col-md-6">
                <form action="../Controller/ControllerDoctores.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="emailogindoctor" autocomplete="off" class="form-control"  id="emailogindoctor" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="contrasenalogindoctor" autocomplete="off" class="form-control"  required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Iniciar sesión</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    ¿No tienes cuenta? <a href="../View/registro.php" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta">Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" name="modalCrearCuenta" id="modalCrearCuenta" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Crea tu propia cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Formulario de creación de nuevo paciente-->
                    <form id="formDoctores" action="../Controller/ControllerDoctores.php" method="post" class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dniDoctor" name="dniDoctor" placeholder="Introduzca su dni">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreDoctor" name="nombreDoctor" placeholder="Introduzca su nombre">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidosDoctor" name="apellidosDoctor" placeholder="Introduzca sus apellidos">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="estado_civil" class="form-label">Telefono móvil</label>
                            <input type="text" class="form-control" id="telefonoDoctor" name="telefonoDoctor" placeholder="Introduzca su telefono">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edad" class="form-label">Correo electronico</label>
                            <input type="text" class="form-control" id="correoDoctor" name="correoDoctor" placeholder="Introduzca su correo">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="fotos" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenaDoctor" name="contrasenaDoctor" placeholder="Introduzca una contraseña">
                        </div>
                        <div class="col-12 mt-3 d-flex justify-content-end">
                            <input type="submit" id="btnEnviar" class="btn btn-primary mx-1" value="Registrarme">
                            <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>