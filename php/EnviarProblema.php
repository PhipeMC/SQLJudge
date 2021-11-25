<?php
include_once("../data/conexion.php");
session_start();
    $conexion = conectar();
    $solucion = $_POST['solucion'];
    $idAlumno = $_SESSION['id'];
    $idProblema = $_POST["idProblema"];
    $fecha = strval(date("Y-m-d H:i:s"));

    //echo $solucion;
    //echo $idAlumno;
    //echo $idProblema;
    //echo $fecha;

    if($conexion){
		//echo "Conexion exitosa <br>";

		$sentencia = "INSERT INTO envio (Estado, CodigoAlumno, ALUMNO_idAlumno, PROBLEMA_idPROBLEMA, fechaEnvio) values ('WA','{$solucion}','{$idAlumno}','{$idProblema}','{$fecha}');";

		if(mysqli_query($conexion, $sentencia)){
			//echo "Elemento editado";
			header('Location:' . getenv('HTTP_REFERER'));
		}else{
			echo "Algo salió mal";
		}

	}else{
		echo "Conexión Fallida";
	}
?>