<?php
	
	function conectar(){

		$servername = "localhost";  //Servidor
		$database = "sql_judge";	//Base de datos
		$username = "root";		//Usuario
		$password = "";			//Contraseña

		// Crear conexión

		$conexion = mysqli_connect($servername, $username, $password, $database);

		return $conexion;
	}

	
?>