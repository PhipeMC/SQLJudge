<?php
    include_once '../model/Problem.php';
    
    class problemaDao{
        private $mysqli;

        public function __construct($conexion)
        {
            $this->mysqli = $conexion;
        }


        /**
        *
        * Extrae un problema de la base de datos a partir de su ID
        *
        * @param type $id Id del problema en la tabla problema
        * @return $Problem
        */
        public function obtenerProblemaPorID($id){
            $sql = "SELECT idProblema,Titulo,descripcion,NombreBaseDatos FROM problema where idProblema=$id;";
            $consulta = mysqli_query($this->mysqli,$sql);
            $row = mysqli_fetch_array($consulta);

            $problema = new Problem();
            $problema->idProblema=$row[0];
            $problema->Titulo=$row[1];
            $problema->Descripcion=$row[2];
            $problema->nombreBaseDatos=$row[3];
            return $problema;
        }

    }

?>