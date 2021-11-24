<?php

require_once 'usuarioDao.php';

include("../data/conexion.php");
$conexion = conectar();

$dao = new usuarioDao($conexion);

if ($dao->comprobarUsuario($_POST['correo'], $_POST['contrasenia'], $_POST['tipoUser'])) {
    $user = $dao->obtenerUsuario($_POST['correo'], $_POST['contrasenia'], $_POST['tipoUser']);

    var_dump($user);
    $conexion->close();
    // Iniciamos la sesion.
    session_start();
    $_SESSION['id'] = $user->id;
    $_SESSION['user'] = $user->usuario;
    $_SESSION['email'] = $user->email;
    $_SESSION['pass'] = $user->contrasenia;
    $_SESSION['nombres'] = $user->nombre;
    $_SESSION['apellidos'] = $user->apellidos;
    $_SESSION['escuela'] = $user->escuela; 
    $_SESSION['genero'] = $user->genero;
    $_SESSION['tipo'] = $user->tipo;


    header("location: ../php/listaProblemas.php");
    exit;
} else {
    $conexion->close();
    header("location: ../Acceso.php?error=error");
}
