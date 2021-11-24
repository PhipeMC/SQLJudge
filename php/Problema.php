<?php
session_start();
if (isset($_SESSION['tipo'])) {
    
}else{
    header("location: ../404.php");
}
include_once("../data/conexion.php");
$conexion = conectar();
$idAlumno = $_SESSION["id"];
$id = $_GET["id"];
$sql = "SELECT idProblema,Titulo,descripcion,NombreBaseDatos FROM problema where idProblema=$id;";
$res = mysqli_query($conexion, $sql);
$rows = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Problema</title>
    <link rel="shortcut icon" href="../img/favicon2.ico" />
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../css/style-problems.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script defer src="../js/all.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html" id="logo">
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
                            <a class="nav-link dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link active" aria-current="page" href="Profile.php">Perfil</a>
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

    <body>
        <div class="container mt-5 rounded">
            <div class="dark-container row align-items-start rounded">

                <div class="col mb-5 p-2">
                    <h1><?php
                        echo "#" . $rows['idProblema'] . "-" . $rows['Titulo'];
                        ?></h1>

                    <h3>Descripción</h3>
                    <p style="text-align: justify;">
                        <?php
                        echo $rows['descripcion'];
                        ?>
                    </p>

                </div>
                <div class="col-6 mb-3 p-3">
                    <h4>Base de datos <?php
                                        echo $rows['NombreBaseDatos'];
                                        ?>
                    </h4>
                    <img src="<?php
                                if ($rows['NombreBaseDatos'] == 'Nwind') {
                                    echo '../img/nwind.jpg';
                                }
                                if ($rows['NombreBaseDatos'] == 'World') {
                                    echo '../img/world.png';
                                }
                                if ($rows['NombreBaseDatos'] == 'Sakila') {
                                    echo '../img/sakila.png';
                                }
                                ?>" alt="" class="rounded-3 mx-auto d-block mb-4 mt-3" style="width: -webkit-fill-available;">
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
                            $sentencia = "SELECT idEnvio, Estado, fechaEnvio from envio 
                                WHERE ALUMNO_idAlumno='$idAlumno' AND PROBLEMA_idProblema=$id;";
                            $resultado = mysqli_query($conexion, $sentencia);
                            while ($listaEnvios = mysqli_fetch_array($resultado)) {
                            ?>

                                <tr>
                                    <th scope="row"><?php echo $listaEnvios['idEnvio']   ?></th>
                                    <td><?php echo $listaEnvios['Estado']   ?></td>
                                    <td><?php echo $listaEnvios['fechaEnvio']   ?></td>
                                    <td><button type="button" class="btn btn-primary btn-sm rounded-3">Ver</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="">
                        <div class="row justify-content-center m-2">
                            <form action="" class="col-6 d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg">Nuevo Envío</button>
                            </form>
                            <form action="" class="col-6 d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg">Descargar Base de datos</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>

    </body>
    <footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>