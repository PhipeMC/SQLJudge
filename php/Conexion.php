<?php
	
	function conectar(){

		$servername = "localhost";  //Servidor
		$database = "sql_judge";	//Base de datos
		$username = "user123";		//Usuario
		$password = "root";			//Contraseña

		// Crear conexión

		$conexion = mysqli_connect($servername, $username, $password, $database);

		return $conexion;
	}

	
?>