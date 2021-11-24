<?php

include_once './modelo/Usuario.php';
//include_once 'validadorFormularios.php';


class usuarioDao {
    
    private $mysqli;

    public function __construct($conexion){
        $this->mysqli = $conexion;
    }
    
    /**
     * Comprueba si todos los datos del usuario son validos.
     * 
     * @param type $usuario Usuario que se quiere validar.
     * @return boolean 
     */

    public function validarUsuario($usuario){

    }
    
    /**
     * Añade el usuario a la base de datos. 
     * 
     * @param type $usuario El usuario que se quiere añadir a la base de datos.
     * @return boolean 
     */

    public function insertarUsuario($usuario){
        
    }
    
    /**
     * Comprueba si existe algun usuario con el id pasado por parametro.
     * 
     * @param type $id Identidicador del usuario.
     * 
     * @return boolean 
     */

    public function existeUsuario($id){

    }
    
    /**
     * Comprueba si existe algun usuario con los datos pasados como parametros. 
     * 
     * @param type $id Id del usuario.
     * @param type $pass Pass del usuario.
     * @param type $tipo Tipo de usuario.
     * @return boolean 
     */

    public function comprobarUsuario($id, $pass, $tipo){
        $consulta = sprintf("SELECT id FROM '%s' WHERE email='%s' AND contrasenia='%s'",
            $this->mysqli->real_escape_string($tipo),
            $this->mysqli->real_escape_string($id),
            $this->mysqli->real_escape_string($pass)
        );

        $result = $this->mysqli->query($consulta);
        $row = $result->fetch_array();
        
        if ($this->mysqli->affected_rows){
            $result->free();
            return true;
        } else {
            $result->free();
            return false;
        }
    }

        /**
     * Comprueba si existe algun usuario con los datos pasados como parametros. 
     * 
     * @param type $id Id del usuario.
     * @param type $pass Pass del usuario.
     * @param type $tipo Tipo de usuario.
     * @return boolean 
     */

    public function obtenerUsuario($id, $pass, $tipo){
        $consulta = sprintf("SELECT * FROM '%s' WHERE email='%s' AND contrasenia='%s'",
            $this->mysqli->real_escape_string($tipo),
            $this->mysqli->real_escape_string($id),
            $this->mysqli->real_escape_string($pass)
        );

        $result = $this->mysqli->query($consulta);
        $row = $result->fetch_array();

        $user = new Usuario();
        $user->id = $row[0];
        $user->usuario = $row[0];
        $user->email = $row[0];
        $user->contrasenia = $row[0];
        $user->nombre = $row[0];
        $user->apellidos = $row[0];
        $user->escuela = $row[0];
        $user->genero = $row[0];
        $user->tipo = $row[0];


        return $user;

    }
    
}
