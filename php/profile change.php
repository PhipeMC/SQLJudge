<?php
    require_once '../data/usuarioDAO.php';
    include("../data/conexion.php");
    $conexion = conectar();

    $dao = new usuarioDao($conexion);

    if($gender == "Prefiero no responder"){
        $result = $dao -> editarUsuario(0, $_POST['email'], $_POST['name'], $_POST['lastName'], 
        $_POST['school'], null, $_POST['username']);
    }else{
        $result = $dao -> editarUsuario(1, $_POST['email'], $_POST['name'], $_POST['lastName'], 
        $_POST['school'], $_POST['gender'], $_POST['username']);
    }

    $conexion = null;
    header("location: ../php/Profile.php");
    exit;
?>