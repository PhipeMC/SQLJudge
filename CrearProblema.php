<?php
session_start();
if (isset($_SESSION['tipo'])) {
    $usuario = $_SESSION['tipo'];
    if ($usuario == "alumno") {
        header("location: 404.php");
    }
} else {
    header("location: 404.php");
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Problema</title>
    <link rel="shortcut icon" href="img/favicon2.ico" />
    <link rel="stylesheet" href="css/style-main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="../SQLJudge/pluggin/codemirror/lib/codemirror.css">
    <script src="../SQLJudge/pluggin/codemirror/lib/codemirror.js"></script>
    <script src="../SQLJudge/pluggin/codemirror/mode/sql/sql.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" id="logo">
                    <i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
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
                                <li><a class="dropdown-item " href="php/listaProblemas.php">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="">Ranking</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="CrearProblema.php">Crear problema</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../SQLJudge/php/Profile.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Ayuda</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item dropdown mx-5">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user" style="color: #0247fe;"></i> <?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos'] ?>
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item " href="php/Profile.php">Perfil</a></li>
                                <li>
                                    <strong>
                                        <hr class="dropdown-divider text-primary">
                                    </strong>
                                </li>
                                <li><a class="dropdown-item" href="../SQLJudge/data/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="dark-container card mt-4">
            <div class="dark-div mt-3 mx-3 py-2 px-2">
                <h2 style="color: snow;"><i class="fas fa-edit" style="color: #0247fe;"></i> <strong>Crear
                        problema</strong></h2>
            </div>
            <div class="form-container card-body">
                <form class="form row g-3 needs-validation" novalidate name="formulario" method="post" action="php/InsertarProblema.php">
                    <div class="col-md-6">
                        <label for="inputTitulo" class="form-label">Título</label>
                        <input type="text" name="nombre" class="form-control" id="inputTitulo" minlength="4" maxlength="45" required>
                        <div class="valid-feedback">
                            Luce bien!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Base de datos</label>
                        <select id="inputState" name="database" class="form-select" required>
                            <option selected>Elije...</option>
                            <option>Sakila</option>
                            <option>Nwind</option>
                            <option>World</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione una base de datos.
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="inputTema" class="form-label">Categoría</label>
                        <select id="inputTema" name="tema" class="form-select" required>
                            <option selected>Elije...</option>
                            <option>Consultas básicas</option>
                            <option>Consultas de varias tablas</option>
                            <option>Agrupaciones</option>
                            <option>Subconsultas anidadas</option>
                            <option>Subconsultas correlacionadas</option>
                            <option>Funciones(text, date, numéricas...)</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione una categoría.
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="inputDificultad" class="form-label">Dificultad</label>
                        <select id="inputDificultad" name="dificultad" class="form-select" required>
                            <option selected>Elije...</option>
                            <option>Básico</option>
                            <option>Intermedio</option>
                            <option>Avanzado</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione una dificultad.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="inputLenguaje" class="form-label">Lenguaje</label>
                        <input type="text" name="leng" class="form-control" id="inputLenguaje" disabled placeholder="MySQL">
                    </div>
                    <div class="col-md-6 g-3">
                        <label for="inputDescripcion" class="form-label">Descripción del problema</label>
                        <textarea class="form-control  mb-3" name="description" id="inputDescripcion" rows="15" onkeyup="run()" required>Escribe tu ejemplo aquí</textarea>
                        <div class="invalid-feedback">
                            Por favor añada una descripción.
                        </div>
                        <label for="inputSolucion" class="form-label">Consulta de solución</label>
                        <div class="form-control" id="solution">
                            <textarea class="form-control" name="consulta" id="inputSolucion" rows="15" required></textarea>
                            <div class="invalid-feedback">
                                Por favor añada la consulta de solución.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPrevia" class="form-label">Vista previa del texto</label>
                        <div class="dark-div px-3 py-3" id="targetDiv" style="height: 96.3%;">Escribe tu ejemplo aquí
                        </div>

                        <!-- <textarea class="form-control" id="targetDiv" rows="10" disabled="true"></textarea> -->
                    </div>
                    <div class="form-check form-switch d-flex align-items-center justify-content-center mt-4">
                        <input class="form-check-input" type="checkbox" id="switchRevision" name="revisionOrden">
                        <label class="form-check-label px-2" for="flexSwitchCheckDefault">Evaluar orden de filas</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary mb-3">Crear problema</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

<footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5 page-footer">
    <p class="col-md-4 mb-0 text-light">&copy; 2021 Máquina del Mal, Inc</p>

    <a href="../index.html" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <h4><i class="fas fa-terminal" style="color: #0247fe;"></i></h4>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Inicio</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Acerca de</a></li>
        <li class="nav-item"><a href="https://www.facebook.com/ITSURGTO" class="nav-link px-2 text-muted">
                <i class="h4 fab fa-facebook-square" style="color: rgb(255, 255, 255);"></i></a>
        </li>
    </ul>
</footer>


<script defer src="js/all.js"></script>
<script src="js/markdown.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>