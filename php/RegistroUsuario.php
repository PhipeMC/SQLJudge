<?php
    include_once("../data/conexion.php");
    $conexion = conectar();
    

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
                        echo("Regirto exitoso");
                        //$menseje="<h5 class='text-succes  text-center'> El usuario y/0 Email ya se 
                       // encuentran registrados </h5>";
                        header("Location: ../Acceso.php");
                    }else{
                        echo("Algo salio mal");
                        //$menseja="<h5 class='text-danger text-center'> No se ha podido completar el 
                        //registro... Intente nuevamente </h5>";
                    }  
                }else{
                    echo("El usuario o email ya estan registrados");
                    //$menseje="<h5 class='text-danger text-center'> El usuario y/0 Email ya se 
                    //encuentran registrados </h5>";
                }
            }else{
                echo("El coidgo es incorrecto");
                //$menseje="<h5 class='text-danger text-center'> El codigo es incorrecto </h5>";
            }
        }else{
            echo("Las contraseñas no coinciden");
        }
        
        

        
