<?php
    include_once("../data/conexion.php");
    $conexion = conectar();
    session_start();
    

        $Nombre=$_POST['nombreR'];
        $apellidos=$_POST['ApellidoR'];
        $usuario=$_POST['UsuarioR'];
        $email=$_POST['correoR'];
        $Contrasena=$_POST['contraseniaR'];
        $confcontrasena=$_POST['confcontraseniaR'];
        //$tipo=$_POST['tipoUserR'];
        $codigo=$_POST['codigoR'];
        //echo($Contrasena);
        //echo($confcontrasena);
        $_SESSION = null;
        if(strcmp($Contrasena, $confcontrasena) == 0){
            $validarCodigo = mysqli_query($conexion," SELECT * FROM grupo where CodigoGrupo = '$codigo' ");
            //$validacionCodigo = mysqli_fetch_array($validarCodigo);
            if(mysqli_num_rows($validarCodigo) > 0){
                $validarUser=mysqli_query($conexion, "SELECT * FROM alumno where Usuario = '$usuario' || Email = '$email'");
                //$validacionUsuario = mysqli_fetch_array($validarUser);
                if(mysqli_num_rows($validarUser) < 1){
                    $pass_hash = password_hash($Contrasena, PASSWORD_DEFAULT);
                    $sentencia="INSERT into alumno (Usuario,Email, Contrasena,Nombre,Apellidos) Values
                    ('%s','%s','%s','%s','%s');";
                    $sql=sprintf($sentencia,$usuario,$email,$pass_hash,$Nombre,$apellidos);
                    //echo $sql;
                    if(mysqli_query($conexion,$sql)){
                        $_SESSION['errorRegistroCorrecto'] = "<h5 class='text-succes  text-center'> Usuario Registrado </h5>";
                        header("Location: ../Acceso.php");
                    }else{
                        
                        $_SESSION['errorRegistroErroneo'] = "<h5 class='text-danger text-center'> No se ha podido registrar, intente de nuevo </h5>";
                        header("Location: ../Acceso.php");
                    }  
                }else{
                    $_SESSION['errorUsuario'] = "<h5 class='text-danger text-center'> El usuario y/o Email ya estan registrados </h5>";
                    header("Location: ../Acceso.php");
                }
            }else{
                $_SESSION['errorCodigo'] = "<h5 class='text-danger text-center'> Codigo Incorrecto </h5>";
                header("Location: ../Acceso.php");
            }
        }else{
            $_SESSION['errorContra'] = "<h5 class='text-danger text-center'> Las contrase??as no coinciden </h5>";
            header("Location: ../Acceso.php");     
        }
        
        

        
