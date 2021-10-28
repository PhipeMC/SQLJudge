        <?php
        // put your code here

    include_once("Conexion.php");

    //Sentencia ingresada por el usuario
    $strSQL = $_GET['strSQL'];
  
    //Solucion del problema planteado
    $strSolucion = $_GET['strSolucion'];
   
    //Orden de Evaluación
    $EvaluaOrden = $_GET['EvaluaOrden'];
  
    //Número de columnas correctas
    $NumeroColumnas = $_GET['NumeroColumnas'];
   
    //BD con la que se va a conectar
    $BD = $_GET['BD'];
    
    $con = conectarPorBD($BD); 

    echo ejecutar($strSQL,$strSolucion,$EvaluaOrden,$NumeroColumnas,$con);

    function CadenaOrderBy($columnas)
    {
        $strCadenaOrderBy = " order by 1";
        $i = 0;
        for ($i = 2; $i <= $columnas; $i++)
        {
            $strCadenaOrderBy = $strCadenaOrderBy + ", " + $i;
        }
        return $strCadenaOrderBy;
    }
    
    function ejecutar($strSQL,$strSolucion,$EvaluaOrden, $NumeroColumnas,$con){        
        $sql1="";
        $sql2="";
        $strSQL= str_replace(";","", $strSQL);
        $strSQL = strtoupper($strSQL);
        if ($EvaluaOrden == false)
            {
                $strSQL = "select * from ( " + $strSQL + ") as Consulta " + CadenaOrderBy($NumeroColumnas);
            }
            try
            {
                $sql1 = $strSQL;                                           
                $resultadosAlumno = mysqli_query($con, $sql1);    
            }
            catch (Exception $e)
            {
                echo $e->getCode();
                if ($e->getCode() == 1060)
                {
                   
                    return "CD"; 
                   
                    // "Columnas Duplicadas"
                }
                else
                {
                    return "RE";
                
                    // "Runtime Error"
                }
            }
            $sql2= $strSolucion;
            $resultadosDocente = mysqli_query($con,$sql2);
            $row_cnt1 = mysqli_num_rows($resultadosAlumno);
            $row_cnt2 = mysqli_num_rows($resultadosDocente);
            echo $row_cnt1;
            echo "<br>";
            echo $row_cnt2;
            echo "<br>";
            $clm_cnt1 = mysqli_num_fields($resultadosAlumno);
            $clm_cnt2 = mysqli_num_fields($resultadosDocente);
            echo $clm_cnt1;
            echo "<br>";
            echo $clm_cnt2;
            echo "<br>";
            if($row_cnt1!=$row_cnt2){
                return "NR";            
            }
            if($clm_cnt1!=$clm_cnt2){
                return "NC";
            }
            $resultado = true;
            $arreglo1 = mysqli_fetch_array($resultadosAlumno,MYSQLI_NUM);
            var_dump($arreglo1);
            echo "division";
            $arreglo2 = mysqli_fetch_array($resultadosDocente,MYSQLI_NUM);
            var_dump($arreglo2);
            for ($i = 0; $i <= $clm_cnt1 - 1; $i++)
            {                
                if ($arreglo1[$i]!==$arreglo2[$i])
                {
                    $resultado = false;
                }
            }
            
            if ($resultado == true)
            {
                return "AC";
                // "ACEPTADO"
            }
            else
            {
                return "WA";
                // "RESPUESTA INCORRECTA"
            }
            //Libera los resultados
            mysqli_free_result($resultadosDocente);
            mysqli_free_result($resultadosAlumno);
            // CIERRA LA CONEXION A LA BASE DE DATOS
            mysqli_close($con);            
    }
    
        ?>