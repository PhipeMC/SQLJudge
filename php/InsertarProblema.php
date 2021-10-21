<?php
	include("Conexion.php");

	$conexion = conectar();
	$nombre = $_POST['nombre'];
	$db = $_POST['database'];
	$tema = $_POST['tema'];
	$descripcion = $_POST['description'];
	$consulta = $_POST['consulta'];

	if($conexion){
		echo "Conexion exitosa <br>";

		$sentencia = "INSERT into problema (Titulo, Descripcion, DOCENTE_idUsuario, Solucion, CATEGORIA_idCATEGORIA) VALUES ('%s', '%s', 1, '%s', 1)";
		$sql = sprintf($sentencia, $nombre, $descripcion, $consulta);

		if(mysqli_query($conexion, $sql)){
			echo "Elemento agregado";
		}else{
			echo "Algo salió mal";
		}

	}else{
		die("Conexión Fallida: " . mysqli_connect_error());
	}


?>