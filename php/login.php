<?php
session_start();
include("Conexion.php");
$conexion = conectar();

$correo = $_POST['correo'];
$pass = $_POST['contrasenia'];
$tipo = $_POST['tipoUser'];

echo $tipo;

$validarLogin = mysqli_query($conexion, "SELECT * FROM $tipo where Email = '$correo' and ContrasenaA = '$pass'");
$validarArr = mysqli_fetch_array($validarLogin);

if (mysqli_num_rows($validarLogin) > 0) {
    $_SESSION['id'] = $validarArr['0'];
    $_SESSION['user'] = $validarArr['1'];
    $_SESSION['email'] = $validarArr['2'];
    $_SESSION['pass'] = $validarArr['3'];
    $_SESSION['nombres'] = $validarArr['4'];
    $_SESSION['apellidos'] = $validarArr['5'];

    if($tipo == "alumno"){
        $_SESSION['tipo'] ="alumno";
    }else{
        $_SESSION['tipo'] ="docente";
    }

    header("location: listaProblemas.php");
    exit;
} else {
    echo '
                <script>
                    alert("El usuario no existe, por favor verifique los datos o registrese");
                    window.location = "../login.html"
                </script>
            ';
    exit;
}
?>