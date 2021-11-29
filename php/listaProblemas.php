<?php
include_once("../data/conexion.php");
$conexion = conectar();
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLJudge - Lista de problemas</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="../css/style-main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.7/css/autoFill.bootstrap5.min.css">

</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php" id="logo"><i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
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
                                <li><a class="dropdown-item " href="listaProblemas.php">Lista de problemas</a></li>
                                
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../CrearProblema.php">Crear problema</a></li>
                            </ul>
                        </li>
                        <?php
                        if (isset($_SESSION['tipo'])) {
                            $usuario = $_SESSION['tipo'];
                            if ($usuario != "alumno") {

                        ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        Grupos
                                    </a>
                                    <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Crear Grupo</a></li>
                                        <li><a class="dropdown-item" href="GenerarCodigo.php">Generar claves</a></li>
                                    </ul>
                                </li>

                        <?php

                            }
                        }
                        ?>
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
                                <li><a class="dropdown-item " href="../php/Profile.php">Perfil</a></li>
                                <li>
                                    <strong>
                                        <hr class="dropdown-divider text-primary">
                                    </strong>
                                </li>
                                <li><a class="dropdown-item" href="../data/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="dark-container container card-body mt-4 p-4">
            <div class="dark-div mt-1 mx-1 mb-4 py-2 px-2">
                <h2 style="color: snow;"><i class="far fa-list-alt" style="color: #0247fe;"></i> <strong>Lista de problemas</strong></h2>
            </div>
            <table id="tablasLista" class="table table-dark table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dicultad</th>
                        <th scope="col">Resuelto</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "select P.idPROBLEMA,P.titulo,P.dificultad,
                                (

                                    select count(distinct E.ALUMNO_idAlumno) from envio E where E.Estado= 'AC' AND E.PROBLEMA_idPROBLEMA = P.idPROBLEMA
                                )as Resueltos
                                from PROBLEMA P ;";
                    $resultado = mysqli_query($conexion, $sql);

                    while ($mostra = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <th><?php echo $mostra['idPROBLEMA'] ?></th>
                            <td><?php echo $mostra['titulo'] ?></td>
                            <td><?php echo $mostra['dificultad'] ?></td>
                            <td><?php echo $mostra['Resueltos'] ?></td>
                            <form action="Problema.php">
                                <td><button type="submit" class="btn btn-primary btn-sm w-100 rounded-3" name="id" value="<?php echo $mostra['idPROBLEMA'] ?>">Ver</button></td>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5">
        <p class="col-md-4 mb-0 text-light">&copy; 2021 Máquina del Mal, Inc</p>

        <a href="../index.php" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <h4><i class="fas fa-terminal" style="color: #0247fe;"></i></h4>
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Inicio</a></li>
            <li class="nav-item"><a href="http://www.itsur.edu.mx/ing_sistemas.php" class="nav-link px-2 text-muted">Acerca de</a></li>
            <li class="nav-item">
                <a href="https://www.facebook.com/ITSURGTO" class="nav-link px-2 text-muted">
                    <i class="h4 fab fa-facebook-square" style="color: rgb(255, 255, 255);"></i></a>
            </li>
        </ul>
</footer>

<script defer src="../js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script>

    $(document).ready(function() {
        var table = $('#tablasLista').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
        });
    });
</script>

</html>