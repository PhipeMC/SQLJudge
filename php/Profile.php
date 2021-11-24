<?php
    session_start();
if (isset($_SESSION['tipo'])) {
    $usuario = $_SESSION['tipo'];
    if ($usuario == "docente") {
        header("location: ../404.php");
    }
}else{
    header("location: ../404.php");
}
    require_once '../data/usuarioDAO.php';
    include("../data/conexion.php");
    $conexion = conectar();
    $dao = new usuarioDao($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLJudge - Perfil</title>
    <link rel="shortcut icon" href="../img/favicon.ico"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script defer src="js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php" id="logo"><i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Problemas
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item " href="../php/listaProblemas.php">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="">Ranking</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../CrearProblema.php">Crear problema</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Ayuda</a>
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

        <div class="container-profile">
            <div class="row">
                <div class="card bg-dark col-profile text-center">
                    <div class="card-header">
                        <img src="../img/default profile.jpg" class="img-thumbnail" alt="..." id="avatar">
                        <h5 id="username"><strong><?php echo $_SESSION['user']?></strong></h5>
                    </div>
                    <div class="card-body col profile-text">
                        <div class="group-container">
                            <p>Nombre</p>
                            <h5><strong><?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos'] ?></strong></h5>
                        </div>
                        <div class="group-container overflow-hidden">
                            <p>Problemas resueltos</p>
                            <h5><strong>
                            <?php 
                                echo $dao -> proResueltosUser($_SESSION['id']);
                            ?>
                            </strong></h5>
                        </div>
                        <div class="group-container">
                            <p>Institución educativa</p>
                            <h5><strong><?php echo $_SESSION['escuela'] ?></strong></h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="subbmit" class="btn btn-primary editButton" id="editProfile" data-bs-toggle="modal"
                            data-bs-target="#editData">Editar perfil</button>
                    </div>
                </div>
                <div class="card col bg-dark text-center card-stats">
                    <h1>Estadisticas</h1>
                    <canvas id="myChart"></canvas>
                    <script src="../js/charts.js"></script>
                </div>
            </div>
        </div>

        <div class="modal fade text-dark modal-dialog-scrollable" id="editData" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Datos de perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <h5 class="card-header">Edita tu perfil</h5>
                            <div class="card-body">
                                <form method="post" action="../php/profile change.php">
                                    <div class="group-input">
                                        <label for="txtUsuario" class="form-label">Correo electrónico</label>
                                        <input type="email" name="email" id="txtEmail" class="form-control" value="<?php echo $_SESSION['email'] ?>" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="" class="form-label">Nombre</label>
                                        <input type="text" name="name" id="txtName" class="form-control" value="<?php echo $_SESSION['nombres'] ?>" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="" class="form-label">Apellidos</label>
                                        <input type="text" name="lastName" id="txtLastName" class="form-control" value="<?php echo $_SESSION['apellidos'] ?>" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="txtSchool" class="form-label">Escuela</label>
                                        <input type="text" name="school" id="txtSchool" class="form-control" value="<?php echo $_SESSION['escuela'] ?>" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="selGender" class="form-label">Género</label>
                                        <select class="form-select form-select-sm" id="selGender" name="gender" required>
                                            <option selected>Prefiero no responder</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button> 
                                    <input type="text" name="username" value="<?php echo $_SESSION['user'] ?>" style="visibility: hidden; width: 0; height: 0;">
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Cambiar contraseña</h5>
                            <div class="card-body">
                                <form method="post" action="../php/profile change.php">
                                    <div class="group-input">
                                        <label for="txtPasswordOld">Contraseña anterior</label>
                                        <input type="password" name="" id="txtPasswordOld" class="form-control" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="txtPassword" class="form-label">Contraseña nueva</label>
                                        <input type="password" name="" id="txtPassword" class="form-control" required>
                                    </div>
                                    <div class="group-input">
                                        <label for="txtPasswordRpt">Repite la contraseña</label>
                                        <input type="password" name="" id="txtPasswordRpt" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary disabled">Guardar cambios</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Cambiar imagen de perfil</h5>
                            <div class="card-body">
                                <form action=""></form>
                                <div class="group-input">
                                    <label for="" class="form-label"></label>
                                    <input type="file" class="form-control" aria-label="file example"
                                        accept="image/png, image/jpeg" name="imgProfile" id="fileProfile" required>
                                    <div class="invalid-feedback">Archivo invalido</div>
                                </div>
                                <button type="button" class="btn btn-primary disabled">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script defer src="../js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
</html>