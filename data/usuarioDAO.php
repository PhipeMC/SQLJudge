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
     * Comprueba si todos los datos del usuario son validos.
     * 
     * @param type $usuario Usuario que se quiere validar.
     * @return boolean 
     */

    public function validarUsuario($usuario)
    {
    }

    /**
     * Añade el usuario a la base de datos. 
     * 
     * @param type $usuario El usuario que se quiere añadir a la base de datos.
     * @return boolean 
     */

    public function insertarUsuario($usuario)
    {
    }

    /**
     * Comprueba si existe algun usuario con el id pasado por parametro.
     * 
     * @param type $id Identidicador del usuario.
     * 
     * @return boolean 
     */

    public function existeUsuario($id)
    {
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
        $validarLogin = mysqli_query($this->mysqli, "SELECT * FROM $tipo where Email = '$id' and Contrasena = '$pass'");
        $validarArr = mysqli_fetch_array($validarLogin);

        // var_dump($validarLogin);
        //var_dump($validarArr);


        if (mysqli_num_rows($validarLogin) > 0) {
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
        $validarLogin = mysqli_query($this->mysqli , "SELECT * FROM $tipo where Email = '$id' and Contrasena = '$pass'");
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
}
