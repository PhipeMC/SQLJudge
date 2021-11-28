<?php
session_start();
if (isset($_SESSION['tipo'])) {
} else {
    header("location: ../404.php");
}
include_once("../data/problemaDAO.php");
include_once("../model/Problem.php");
include_once("../data/conexion.php");
$idAlumno = $_SESSION["id"];
$id = $_GET["id"];
$conexion = conectar();
$operaciones = new problemaDAO($conexion);
$problema = $operaciones->obtenerProblemaPorID($id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Judge - Problema</title>
    <link rel="shortcut icon" href="../img/favicon2.ico" />
    <link rel="stylesheet" href="../css/style-problems.css">
    <link rel="stylesheet" href="../css/style-main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script defer src="../js/all.js"></script>



</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php" id="logo">
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
                                <li><a class="dropdown-item " href="listaProblemas.php">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="#">Ranking</a></li>
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
                                <li><a class="dropdown-item " href="Profile.php">Perfil</a></li>
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
    </header>

    
    <div class="modal fade " id="error" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="staticBackdropLabel">Respuesta incorrecta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-black  fs-4 text-center">
                                Tienes un error de tipo: <strong> <?php
                                                    echo $_SESSION['statusProblem'];
                                                ?></strong>.
                            </div>
                            <div class="modal-footer">

                                <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade " id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="staticBackdropLabel">Respuesta correcta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black fs-4 text-center">
                                        Tu envío ha sido aceptado <strong> ¡Felicidades!</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        <div class="container mt-5 rounded">
            <div class="dark-container row align-items-start">

                <div class="col-6">
                    <div class="dark-div mt-3 mx-2 py-2 px-2">
                        <h2>
                            <strong>
                                <?php
                                echo "<i class='fas fa-scroll' style='color: #3366FF;'></i>  #" . $problema->idProblema . " - " . $problema->Titulo;
                                ?>
                            </strong>
                        </h2>

                    </div>
                    <div class="card-body">
                        <h4 class="text-center">Descripción</h4>
                        <textarea class="form-control  mb-3" name="description" id="inputDescripcion" rows="15" style="display: none;"><?php echo $problema->Descripcion; ?></textarea>
                        <p style="text-align: justify;" id="targetDiv"></p>
                    </div>
                </div>
                <div class="col-6 card-body">
                    <div class="my-3 mx-2 ">
                        <div class="row">
                            <div class="col-6">
                                <h4>
                                    <strong>
                                        <?php
                                        echo $problema->nombreBaseDatos;
                                        ?>
                                    </strong>
                                </h4>
                            </div>
                            <div class="col-6">
                                <a href="
                                <?php 
                                    if ($problema -> nombreBaseDatos == "Nwind") {
                                        echo "https://drive.google.com/file/d/19b2PN6cxEZ1Bk7mKG2YIK4ftCKj4GtGb/view?usp=sharing";
                                    }elseif($problema -> nombreBaseDatos == "World"){
                                        echo "https://drive.google.com/file/d/1xlqdrsxdCfWRrxzcuuPqf4zkZbKW26GC/view?usp=sharing";
                                    }elseif($problema -> nombreBaseDatos == "Sakila"){
                                        echo "https://drive.google.com/file/d/1Ue25PY9QvD8meCA8kxOaSB3PQF7oFMGx/view?usp=sharing";
                                    }
                                ?>
                                " class="btn btn-primary btn-sm w-100">Descargar Base de datos</a>
                                <!-- <button type="button" class="btn btn-primary btn-sm w-100">Descargar Base de Datos</button> -->
                            </div>
                        </div>
                        <div class="col-12">
                            <img src="<?php
                                        echo '../img/' . $problema->nombreBaseDatos . '.png';
                                        ?>" alt="" class="rounded-3 mx-auto d-block mb-4 mt-3" style="width: -webkit-fill-available;">

                        </div>
                        <?php
                            if($_SESSION['tipo']=="alumno"){
                        ?>
                            <div class="col-12 mb-4">
                                <div>
                                    <h5>
                                        <strong>
                                            Escribe tu solución
                                        </strong>
                                    </h5>
                                </div>
                                <div class="col-12 justify-content-center">
                                    <form action="EnviarProblema.php" class="d-grid gap-2" Method="post">
                                            <textarea class="form-control" name="solucion" id="" rows="15" required></textarea>
                                            <div class="invalid-feedback">
                                                Por favor añada la consulta de solución.
                                            </div>
                                        <button type="submit" class="btn btn-primary btn-lg" name="idProblema" value="<?php echo $problema->idProblema; ?>">Enviar solución</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                            }else{
                        ?>
                            <div class="col-12 mb-4">
                            
                                <div class="col-12 justify-content-center">
                                    <form action="../EditarProblema.php" class="d-grid gap-2" method="post">
                                        <input type="text" style="display: none;" name="problemaID" id="" value="<?php echo $problema->idProblema; ?>">
                                        <button type="submit" class="btn btn-primary btn-lg" name="" value="<?php echo $problema->idProblema; ?>">Editar Problema</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="dark-div col-12 p-4">
                    <div>
                        <h5>
                            <strong>
                                Envios
                            </strong>
                        </h5>
                    </div>
                    <table class="table table-dark mb-4">
                        <thead>
                            <tr>

                                <th scope="col">ID de envío</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['tipo'] == "alumno") {
                                $sentencia = "SELECT idEnvio, Estado, fechaEnvio, CodigoAlumno from envio 
                                    WHERE ALUMNO_idAlumno='$idAlumno' AND PROBLEMA_idProblema=$id;";
                                $resultado = mysqli_query($conexion, $sentencia);
                                while ($listaEnvios = mysqli_fetch_array($resultado)) {
                                    if($listaEnvios['Estado']=="AC"){
                                           $color = "primary";
                                           $calor = "#0d6efd";
                                    }else{
                                         $color = "danger";
                                         $calor = "red";
                                    }
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $listaEnvios['idEnvio']   ?></th>
                                        <td style="color: <?php echo $calor?>"><strong><?php echo $listaEnvios['Estado'] ?></strong></td>
                                        <td><?php echo $listaEnvios['fechaEnvio']   ?></td>
                                        <td><button type="button" class="btn btn-<?php echo $color?> btn-sm rounded-3 w-100"
                                            onclick="verCodigo('<?php echo $listaEnvios['idEnvio']  ?>','<?php echo $listaEnvios['CodigoAlumno']  ?>');">Ver</button></td>
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
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1f2533;">
                        <h5 class="modal-title" id="tituloEnvio"></h5>
                        <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <div class="h-100">
                            <textarea class="form-control h-100" name="" id="problemo" rows="25" readonly>HOLA</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    
    
</body>
<footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5">
        <p class="col-md-4 mb-0 text-light">&copy; 2021 Máquina del Mal, Inc</p>

        <a href="../index.php" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
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

<script defer src="../js/all.js"></script>
<script src="../js/Problemas.js"></script>
<script src="../js/problemaMarkDownImport.js"></script> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


</html>