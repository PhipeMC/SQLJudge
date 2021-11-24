<?php
session_start();
// Se comprueba si ya se habia iniciado la sesion y en ese caso le redirigimos a la pagina de inicio
if (isset($_SESSION['id'])) {
    header("Location: ../SQLJudge/php/listaProblemas.php");
}
?>
<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>SQL Code Judge</title>
    <link rel="shortcut icon" href="img/favicon2.ico" />
    <link rel="stylesheet" href="../SQLJudge/css/style-main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script defer src="js/all.js"></script>

    <!--ACTUALIZAR STYLE FAST-->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" id="logo"><i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Problemas
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item " href="../SQLJudge/php/listaProblemas.php">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="../SQLJudge/php/Profile.php">Ranking</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="CrearProblema.html">Crear problema</a></li>
                                <!--Eliminar essta linea a futuro-->
                                <li><a class="dropdown-item" href="EditarProblema.html">Editar problema</a></li>
                                <!--Eliminar essta linea a futuro-->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Grupos
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Crear Grupo</a></li>
                                <li><a class="dropdown-item" href="php/GenerarCodigo.php">Generar claves</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile.html">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Ayuda</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="btn btn-sm btn-outline-secondary" href="Acceso.php">Iniciar sesion</a>
                    </form>
                </div>
            </div>
        </nav>
        <!-- </div>-->
    </header>

    <main>
        <div class="d-flex justify-content-center my-4">
            <div class="blue-container d-md-flex flex-md-equal my-md-5 mx-md-4 ps-md-5">
                <div class="bg-white d-flex align-items-center me-md-3 py-3 px-3 py-md-5 px-md-5">
                    <div class="imagen m-3">
                        <img src="img/imgGroup.jpg" alt="" width="500px"">
                    </div>
                </div>
                <div class=" dark-container d-flex flex-column justify-content-center me-md-4 py-3 px-3 py-md-3 px-md-4 text-center text-white">
                        <div class="my-3 py-3 px-md-5" style="background-color: #0247fe; ">
                            <h1><strong> <i class="fas fa-terminal"></i> SQL CODE JUDGE</strong></h1>
                        </div>
                        <div class="my-4 pt-5 pb-3">
                            <h1>
                                <i class="fas fa-users" style="color: #0247fe;"></i>
                            </h1>
                            <h3>DE ALUMNOS PARA ALUMNOS</h3>
                            <p>
                                SQL Code Judge es una plataforma educativa creada por alumnos del ITSUR
                                para mejorar tus habilidades en consultas a base de datos no relacionales
                            </p>
                        </div>
                        <div class="my-3 py-3">
                            <a class="btn btn-SQL btn-primary" href="Acceso.php">Unete aquí</a>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>
<footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5">
    <p class="col-md-4 mb-0 text-light">&copy; 2021 Máquina del Mal, Inc</p>

    <a href="index.html" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <h4><i class="fas fa-terminal" style="color: #0247fe;"></i></h4>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Inicio</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Acerca de</a></li>
        <li class="nav-item">
            <a href="https://www.facebook.com/ITSURGTO" class="nav-link px-2 text-muted">
                <i class="h4 fab fa-facebook-square" style="color: rgb(255, 255, 255);"></i></a>
        </li>
    </ul>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>