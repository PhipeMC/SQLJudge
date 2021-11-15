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
	$nombre = $_POST['nombre'];
	$db = $_POST['database'];
	$tema = $_POST['tema'];
	$descripcion = $_POST['description'];
	$consulta = $_POST['consulta'];
	$dificultad = $_POST['dificultad'];
    $id = mysqli_fetch_array(mysqli_query($conexion, sprintf("SELECT idPROBLEMA from problema where Titulo='%s';",$nombre)));

	

	
	if($dificultad=='Básico'){
		$dificultad='Basico';
	}

    $resultado = mysqli_query($conexion, sprintf("SELECT idCATEGORIA from categoria where NombreCategoria='%s';",$tema));
	$categoria = mysqli_fetch_array($resultado);

    //echo $id[0];
    //echo $nombre; echo "<br>";
	//echo $db; echo "<br>";
	//echo $tema; echo "<br>";
	//echo $descripcion; echo "<br>";
	//echo $consulta; echo "<br>";
	//echo $dificultad; echo "<br>";
	//echo $categoria[0]; echo "<br>";;

	if($conexion){
		//echo "Conexion exitosa <br>";

		$sentencia = "UPDATE problema SET Titulo='$nombre', Descripcion='$descripcion', DOCENTE_idUsuario='1', Solucion='$consulta', CATEGORIA_idCATEGORIA='$categoria[0]', dificultad='$dificultad', NombreBaseDatos='$db' WHERE idPROBLEMA='$id[0]';";
		//$sql = sprintf($sentencia, $nombre, $descripcion, $consulta, $categoria[0] , $dificultad, $db);

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