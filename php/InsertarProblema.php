<?php
include_once("../data/conexion.php");
	session_start();
	$idProfesor=$_SESSION['id'];
	$conexion = conectar();
	$nombre = $_POST['nombre'];
	$db = $_POST['database'];
	$tema = $_POST['tema'];
	$descripcion = $_POST['description'];
	$consulta = $_POST['consulta'];
	$dificultad = $_POST['dificultad'];
	$juanpice;

	if(isset($_POST['revisionOrden'])){
		$juanpice = '1';
	}else{
		$juanpice = '0';
	}

	
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
		$sql = "INSERT into problema 
		(Titulo, Descripcion, DOCENTE_idUsuario, Solucion, CATEGORIA_idCATEGORIA, dificultad, NombreBaseDatos, OrdenFilas)
		values ('$nombre', \"$descripcion\", $idProfesor, \"$consulta\", $categoria[0], '$dificultad', '$db', $juanpice);";
		echo $sql;
		if(mysqli_query($conexion, $sql)){
			//echo "Elemento agregado";
			$conexion->close();
			header('Location:' . getenv('HTTP_REFERER'));
		}else{
			
			echo $conexion->error;
			$conexion->close();
			
		}

	}else{
		echo "Conexión Fallida";
		
	}

	//$conexion->close();

