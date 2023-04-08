
<!doctype html>
<html lang="en">

<head>
  <title>MyClinicControl</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="icon" href="../PlantillaLogo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-info">
    <div class="container-fluid">
    <img src="../img/PlantillaLogo.png" alt="" width="70" class="rounded img-fluid shadow">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'contactos.php') echo 'active'?> " href="../View/contactos.php">
            <i class="bi bi-people"></i>
            Pacientes
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'calendario.php') echo 'active'?> " href="../View/calendario.php">
            <i class="bi bi-calendar"></i>
            Calendario
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'informes.php') echo 'active'?> " href="../View/informes.php">
            <i class="bi bi-file-earmark-bar-graph"></i>
            Informes
          </a>
        </li>
      </ul>
    </div>
  </div>
    </nav>