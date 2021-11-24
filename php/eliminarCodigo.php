<?php
session_start();
include_once("../data/conexion.php");
    $conexion = conectar();
    $grupo =  $_POST['inputGrupo'];
    $sql = sprintf(
    "UPDATE grupo 
    SET CodigoGrupo ='' 
    WHERE idgrupo='%s';",$grupo);
    if(mysqli_query($conexion, $sql)){
        header('Location:' . getenv('HTTP_REFERER'));
    }else{
        echo "no jaló";
    }

?>