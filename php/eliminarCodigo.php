<?php
session_start();
if(isset($_SESSION['tipo'])){
    $usuario= $_SESSION['tipo'];
    if($usuario=="alumno"){
        header("location: 404.php");
    }
}
    include("Conexion.php");
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