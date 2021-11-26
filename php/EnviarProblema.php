<?php
include_once("../php/algoritmo.php");
include_once("../data/conexion.php");
session_start();
    $conexion = conectar();
    $solucion = $_POST['solucion'];
    $idAlumno = $_SESSION['id'];
    $idProblema = $_POST["idProblema"];
    $fecha = strval(date("Y-m-d H:i:s"));

   /*  echo $solucion;
    echo $idAlumno;
    echo $idProblema;
    echo $fecha;
 */


    if($conexion){
		//echo "Conexion exitosa <br>";
		$sentenciaDocente=mysqli_query($conexion,"SELECT Solucion FROM `sql_judge`.`problema` where idProblema = '$idProblema'");
    
    	$datosProblema=mysqli_fetch_array($sentenciaDocente);

    	if($datosProblema != null){
        	$solucionDocente=$datosProblema['Solucion'];
			$estadoProblema=ejecutar($solucion,$solucionDocente,true, 0,$conexion);
			var_dump($estadoProblema);
		}
		$sentencia = "INSERT INTO envio (Estado, CodigoAlumno, ALUMNO_idAlumno, PROBLEMA_idPROBLEMA, fechaEnvio) values ('{$estadoProblema}','{$solucion}','{$idAlumno}','{$idProblema}','{$fecha}');";

		if(mysqli_query($conexion, $sentencia)){
			//echo "Elemento editado";
			header('Location:' . getenv('HTTP_REFERER'));
		}else{
			echo mysqli_error($conexion);
		}

	}else{
		echo "Conexión Fallida";
	}
?>