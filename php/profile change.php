<?php
        include_once("../data/conexion.php");
    $conexion = conectar();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname = $_POST['lastName'];
    $school = $_POST['school'];
    $gender = $_POST['gender'];

    if($gender == "Prefiero no responder"){
        $result = mysqli_query($conexion, "UPDATE alumno SET Email = '$email', Nombre = '$name', Apellidos = '$lastname', Escuela = '$school' WHERE Usuario = '$username'");
    }else{
        $result = mysqli_query($conexion, "UPDATE alumno SET Email = '$email', Nombre = '$name', Apellidos = '$lastname', Escuela = '$school', Genero = '$gender' WHERE Usuario = '$username'");
    }

    header("location: ../php/Profile.php");
    exit;
?>