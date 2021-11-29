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
	$sentenciaDocente=mysqli_query($conexion,"SELECT Solucion, `NombreBaseDatos`, OrdenFilas FROM problema where idPROBLEMA = '$idProblema'");

	$datosProblema=mysqli_fetch_array($sentenciaDocente);

	if($datosProblema != null){
		$solucionDocente=$datosProblema['Solucion'];
		//echo $solucionDocente;
		$nombreDB= $datosProblema['NombreBaseDatos'];
		$ordenLeruch= $datosProblema['OrdenFilas'];

		//echo $nombreDB;
		$conexionn= conectarPorBD($nombreDB);
		$estadoProblema=ejecutar($solucion,$solucionDocente,$ordenLeruch, $conexionn);
		//echo $estadoProblema;
		$sentencia = "INSERT INTO envio (Estado, CodigoAlumno, ALUMNO_idAlumno, PROBLEMA_idPROBLEMA, fechaEnvio) values ('{$estadoProblema}', \"$solucion\",'{$idAlumno}','{$idProblema}','{$fecha}');";
		//echo $sentencia;
        $_SESSION['statusProblem']= $estadoProblema;
		if(mysqli_query($conexion, $sentencia)){
			mysqli_close($conexion);
			mysqli_close($conexionn);
			header('Location:' . getenv('HTTP_REFERER'));
		}else{
			echo mysqli_error($conexionn);
		}
	}
	

}else{
	echo "Conexión Fallida";
}
?>