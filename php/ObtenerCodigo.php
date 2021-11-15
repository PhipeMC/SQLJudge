<?php
    session_start();
    include("Conexion.php");
	$conexion = conectar();
    $grupo =  $_POST['grupo'];
    $idProfesor = $_SESSION['id'];
    //echo $idProfesor;

    $sentenciaDocente=mysqli_query($conexion,"SELECT Nombre, Apellidos FROM DOCENTE WHERE
    IdDocente='$idProfesor'");
    
    $datosDocente=mysqli_fetch_array($sentenciaDocente);
    if($datosDocente!=null){
        //echo $datosDocente['Nombre'] . " " . $datosDocente['Apellidos'];
        $inicialNombre=substr($datosDocente['Nombre'],0,1);
        $incialApellido=substr($datosDocente['Apellidos'],0,1);

        
        
        //echo $randomNum1 . " " . $randomNum2;

        function generateRandomString($length) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $randomKey = $incialApellido . generateRandomString(3) . $inicialNombre  . generateRandomString(1) .$grupo;
        //echo $randomKey;

        $sentenciaUpdate = sprintf("UPDATE GRUPO 
        SET CodigoGrupo ='%s' 
        WHERE idGrupo='%s';",$randomKey,$grupo);
        if(mysqli_query($conexion, $sentenciaUpdate)){
            header('Location:' . getenv('HTTP_REFERER'));
        }else{
            echo "no jaló";
        }
    }else{
        echo "usuario invalido";
    }
?>