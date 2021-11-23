<?php
    include("Conexion.php");
    $conexion = conectar();
    

    //$errors = array();
        $Nombre=$_POST['nombreR'];
        $apellidos=$_POST['ApellidoR'];
        $usuario=$_POST['UsuarioR'];
        $email=$_POST['correoR'];
        $Contrasena=$_POST['contraseniaR'];
        $confcontrasena=$_POST['confcontraseniaR'];
        $tipo=$_POST['tipoUserR'];

        /*
        if(strlen(trim($nombre)) < 1 || strlen(trim($apellido)) < 1 || strlen(trim($usuario)) < 1 ||
            strlen(trim($correo)) < 1 || strlen(trim($contrasena)) < 1 || strlen(trim($confcontrasena)) < 1 || ){
            $errors[]="Debe llenar todos los campos";
        }
        if(filter_var  ($correo,FILTER_VALIDATE_EMAIL)){
            $errors[]="Debe llenar todos los campos";
        }
        if(filter_var  ($correo,FILTER_VALIDATE_EMAIL)){
            $errors[]="Direccion de correo invalida";
        }

        if(strcmp($var1,$var2)!= 0){
            $errors[]="Las contraseñas no coinciden";
        }*/
        $pass_hash = password_hash($Contrasena, PASSWORD_DEFAULT);
        if($conexion){
            if($tipo == "alumno"){
                $sentencia="INSERT into alumno (Usuario,Email, Contrasena,Nombre,Apellidos) Values
                ('%s','%s','%s','%s','%s');";
                $sql=sprintf($sentencia,$usuario,$email,$pass_hash,$Nombre,$apellidos);
                //echo $sql;
                if(mysqli_query($conexion,$sql)){
                        echo "Agegado correctamente";
                }else{
                        echo "algo salio mal";
                }  
            }else if($tipo == "docente"){
                $sentencia = "INSERT into docente (Usuario, Email, Contrasena, Nombre, Apellidos)
                    VALUES ('%s', '%s','%s', '%s', '%s');";
                $sql = sprintf($sentencia,$usuario,$email,$pass_hash,$Nombre,$apellidos);
    
                if(mysqli_query($conexion, $sql)){
                     echo "Elemento agregado";
                }else{
                     echo "Algo salió mal";
                }
                   
            }
        }else{
            echo "Conexión Fallida";
        }
        
            /*
        if(count($errors) == 0){
            
        
        }*/
    /*if(!empty($_POST)){
        

    }*/
?>