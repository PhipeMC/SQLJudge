<?php
include("Conexion.php");

    $conexion = conectar();
    $Sesion = $_POST['TipoSesion'];
    $Destinatario = $_POST['Correo'];
    $Asunto = "Recuperar Contraseña SQL Judge";
    $Header = "From: SQL Judge";
    $Mensaje = "Esta es tu contraseña: ";

    $resultado = mysqli_query($conexion, sprintf("SELECT ContrasenaA from '%S' where Correo='%S';",$Sesion,$Destinatario));
	$categoria = mysqli_fetch_array($resultado);

    $Mensaje = $Mensaje + $categoria[0];

    @mail($Destinatario, $Asunto, $Mensaje, $Header);


?>