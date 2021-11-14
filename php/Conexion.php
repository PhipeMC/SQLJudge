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
	
	function conectarPorBD($BD){

		$servername = "localhost";  //Servidor
		$database = $BD;	//Base de datos
		$username = "root";		//Usuario
		$password = "Tulumbas500*";			//Contraseña

		// Crear conexión

		$conexion = mysqli_connect($servername, $username, $password, $database);

		return $conexion;
	}
	
?>