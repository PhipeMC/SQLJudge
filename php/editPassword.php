<?php 
    require_once '../data/usuarioDAO.php';
    include("../data/conexion.php");
    $conexion = conectar();
    $dao = new usuarioDao($conexion);
    $data = $dao -> obtainPass($_POST['usern']);

    if (password_verify($_POST['oldPass'], $data)) {
        if($_POST['newPass'] == $_POST['repPass']){
            $dao -> editPassword($_POST['usern'], $_POST['newPass']);
            $conexion = null;
            header("location: ../php/Profile.php");
        }else{
            $conexion = null;
            header("location: ../php/Profile.php");
        }
    } else {
        $conexion = null;
        header("location: ../php/Profile.php");
    }
?>