<?php

include_once '../model/User.php';
//include_once 'validadorFormularios.php';


class usuarioDao
{

    private $mysqli;

    public function __construct($conexion)
    {
        $this->mysqli = $conexion;
    }

    /**
     * Comprueba si existe algun usuario con los datos pasados como parametros. 
     * 
     * @param type $id Id del usuario.
     * @param type $pass Pass del usuario.
     * @param type $tipo Tipo de usuario.
     * @return boolean 
     */

    public function comprobarUsuario($id, $pass, $tipo)
    {

        $validarLogin = mysqli_query($this->mysqli, "SELECT * FROM $tipo where Email = '$id'");
        $validarArr = mysqli_fetch_array($validarLogin);
        mysqli_free_result($validarLogin);

        // var_dump($validarLogin);
        //var_dump($validarArr);

        //password_verify("$pass", "$validarArr[3]");
        //mysqli_num_rows($validarLogin) > 0

        if (password_verify(strval($pass), strval($validarArr[3]))) {
            //$result->free();
            return true;
        } else {
            //$result->free();
            return false;
        }
    }

    /**
     * Busca y retorna al usuario. 
     * 
     * @param type $id Id del usuario.
     * @param type $pass Pass del usuario.
     * @param type $tipo Tipo de usuario.
     * @return usuario 
     */

    public function obtenerUsuario($id, $pass, $tipo)
    {
        $validarLogin = mysqli_query($this->mysqli, "SELECT * FROM $tipo where Email = '$id'");
        $row = mysqli_fetch_array($validarLogin);

        $user = new Usuario();
        $user->id = $row[0];
        $user->usuario = $row[1];
        $user->email = $row[2];
        $user->contrasenia = $row[3];
        $user->nombre = $row[4];
        $user->apellidos = $row[5];
        $user->escuela = $row[6];
        $user->genero = $row[7];
        $user->tipo = $tipo;

        return $user;
    }


    public function editarUsuario($action, $name, $lastname, $school, $gender, $username)
    {
        if ($action == 0) {
            $update = mysqli_query($this->mysqli, "UPDATE alumno SET Nombre = '$name', Apellidos = '$lastname', Escuela = '$school' WHERE Usuario = '$username'");
        } else {
            $update = mysqli_query($this->mysqli, "UPDATE alumno SET Nombre = '$name', Apellidos = '$lastname', Escuela = '$school', Genero = '$gender' WHERE Usuario = '$username'");
        }

        return $update;
    }

    public function proResueltosUser($id)
    {
        $count = mysqli_query($this->mysqli, "SELECT COUNT(*) FROM envio WHERE ALUMNO_idAlumno = '$id'");
        $row = mysqli_fetch_array($count);

        return $row[0];
    }

    public function existeEnvio($idProblema)
    {
        $validarEnvio = mysqli_query($this->mysqli, "SELECT * FROM envio where idEnvio = '$idProblema'");
        if (mysqli_num_rows($validarEnvio) > 0) {
            //$result->free();
            return true;
        } else {
            //$result->free();
            return false;
        }
    }

    public function obtenerEnvio($idProblema)
    {
        $validarEnvio = mysqli_query($this->mysqli, "SELECT * FROM envio where idEnvio = '$idProblema'");
        $row = mysqli_fetch_array($validarEnvio);
        return $row;
    }

    public function obtainPass($user)
    {
        $data = mysqli_query($this->mysqli, "SELECT Contrasena FROM alumno WHERE Usuario = '$user'");
        $password = mysqli_fetch_array($data);

        return $password[0];
    }

    public function editPassword($user, $pass)
    {
        $encrypt = password_hash($pass, PASSWORD_DEFAULT);
        $data = mysqli_query($this->mysqli, "UPDATE alumno SET Contrasena = '$encrypt' WHERE Usuario = '$user'");

        return $data;
    }

    public function obtainCountProb($id){
        $data = mysqli_query($this -> mysqli, "select (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'AC') as AC, (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'CD') as CD, (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'RE') as RE, (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'NR') as NR, (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'NC') as NC, (
            select count(idEnvio) from envio where ALUMNO_idAlumno = '$id' and Estado = 'WA') as WA;");
        $arraydata = mysqli_fetch_array($data);

        return $arraydata;
    }
}
