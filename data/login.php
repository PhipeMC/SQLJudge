<?php

require_once 'usuarioDao.php';

include("../data/conexion.php");
$conexion = conectar();

$dao = new usuarioDao($conexion);

if ($dao->comprobarUsuario($_POST['usuario'], $_POST['password'], $_POST['tipoUser'])) {
    $conexion->close();
    // Iniciamos la sesion.
    session_start();
    $_SESSION['id'] = $_POST['usuario'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['password'] = $_POST['password'];

    header("Location:../pagina1.php");
} else {
    $conexion->close();
    header("Location:../Acceso.php?error=error");
}
