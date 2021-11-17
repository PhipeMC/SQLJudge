<?php
    include("Conexion.php");
    $conexion = conectar();
    

    //$errors = array();
        $nombre=$_POST['nombreR'];
        $apellido=$_POST['ApellidoR'];
        $usuario=$_POST['UsuarioR'];
        $correo=$_POST['correoR'];
        $contrasena=$_POST['contraseniaR'];
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
        $pass_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        if($tipo == "alumno"){
            $registroAlumno = "INSERT into alumno (Usuario, Email, Contrasena, Nombre, Apellidos)
                VALUES ('%s', '%s','%s', '%s', '%s');";
		    $sql = sprintf($usuario,$correo,$pass_hash,$nombre,$apellido);

		    if(mysqli_query($conexion, $sql)){
			     echo "Elemento agregado";
		    }else{
			     echo "Algo salió mal";
		    }
        }else if($tipo == "docente"){
            $registroAlumno = "INSERT into docente (Usuario, Email, Contrasena, Nombre, Apellidos)
                VALUES ('%s', '%s','%s', '%s', '%s');";
		    $sql = sprintf($usuario,$correo,$pass_hash,$nombre,$apellido);

		    if(mysqli_query($conexion, $sql)){
			     echo "Elemento agregado";
		    }else{
			     echo "Algo salió mal";
		    }
               
        }
            /*
        if(count($errors) == 0){
            
        
        }*/
    /*if(!empty($_POST)){
        

    }*/
?>