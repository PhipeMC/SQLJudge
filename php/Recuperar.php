<?php
include_once("../data/conexion.php");

    $conexion = conectar();
    $Sesion = $_POST['TipoSesion'];
    $Destinatario = $_POST['Correo'];
    $Asunto = "Recuperar Contraseña SQL Judge";
    $Header = "From: SQL Judge";
    $Mensaje = "Esta es tu contraseña: ";

    //echo $Sesion;
    //echo "<br>";
    //echo $Destinatario;
    //echo "<br>";
    //echo $Asunto;
    //echo "<br>";
    //echo $Header;
    //echo "<br>";
    

    $resultado = mysqli_query($conexion, "SELECT Contrasena from $Sesion where email='$Destinatario'");
	$categoria = mysqli_fetch_array($resultado);

    $Mensaje = $Mensaje.$categoria[0];
    //echo $Mensaje;

    @mail($Destinatario, $Asunto, $Mensaje, $Header);


?>