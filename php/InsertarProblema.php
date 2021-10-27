<?php
	include("Conexion.php");

	$conexion = conectar();
	$nombre = $_POST['nombre'];
	$db = $_POST['database'];
	$tema = $_POST['tema'];
	$descripcion = $_POST['description'];
	$consulta = $_POST['consulta'];
	$dificultad = $_POST['dificultad'];

	
	if($dificultad=='Básico'){
		$dificultad='Basico';
	}

	$resultado = mysqli_query($conexion, sprintf("SELECT idCATEGORIA from categoria where NombreCategoria='%s';",$tema));
	$categoria = mysqli_fetch_array($resultado);

	//echo $nombre; echo "<br>";
	//echo $db; echo "<br>";
	//echo $tema; echo "<br>";
	//echo $descripcion; echo "<br>";
	//echo $consulta; echo "<br>";
	//echo $dificultad; echo "<br>";
	//echo $categoria[0]; echo "<br>";;

	if($conexion){
		//echo "Conexion exitosa <br>";

		$sentencia = "INSERT into problema (Titulo, Descripcion, DOCENTE_idUsuario, Solucion, CATEGORIA_idCATEGORIA, dificultad, BaseDatos) VALUES ('%s', '%s', 1, '%s', %d, '%s', '%s');";
		$sql = sprintf($sentencia, $nombre, $descripcion, $consulta, $categoria[0] , $dificultad, $db);

		if(mysqli_query($conexion, $sql)){
			//echo "Elemento agregado";
			header('Location:' . getenv('HTTP_REFERER'));
		}else{
			echo "Algo salió mal";
		}

	}else{
		echo "Conexión Fallida";
	}


?>