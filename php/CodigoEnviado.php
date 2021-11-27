<?php
    session_start();
    
    include("../data/conexion.php");
    $conexion = conectar();

    $dao = new usuarioDao($conexion);
    $idEnvio = $_GET['idEnvio'];

    ///Comprobar existencia del envio

    if($dao->existeEnvio($idEnvio)){
        //Llenar el modal 
        $infoEnvio = $dao->obtenerEnvio($idEnvio);
        $conexion->close();

        echo '<textarea class="form-control" name="txtSol" id="viewSol" rows="15" required>'.$infoEnvio[2].'</textarea>';

    }else{
        echo 'Content not found....'; 
        $conexion->close();
        header('Location:' . getenv('HTTP_REFERER'));
    }



