<?php
        function CadenaOrderBy($columnas)
        {
            $strCadenaOrderBy = " order by 1";
            $i = 0;
            for ($i = 2; $i <= $columnas; $i++) {
                $strCadenaOrderBy = $strCadenaOrderBy + ", " + $i;
            }
            return $strCadenaOrderBy;
        }

        function ejecutar($strSQL, $strSolucion, $EvaluaOrden, $NumeroColumnas, $con)
        {
            $sql1 = "";
            $sql2 = "";
            $strSQL = str_replace(";", "", $strSQL);
            $strSQL = strtoupper($strSQL);
            if ($EvaluaOrden == false) {
                $strSQL = "select * from ( " + $strSQL + ") as Consulta " + CadenaOrderBy($NumeroColumnas);
            }

            $sql1 = $strSQL;
            $resultadosAlumno = mysqli_query($con, $sql1);

            if ($resultadosAlumno == false) {

                if (mysqli_errno($con) == 1060) {
                    // "Columnas Duplicadas"                  
                    return "CD";
                } else {
                    // Runtime Error
                    return "RE";
                }
            }
            $sql2 = $strSolucion;
            $resultadosDocente = mysqli_query($con, $sql2);
            $row_cnt1 = mysqli_num_rows($resultadosAlumno);
            $row_cnt2 = mysqli_num_rows($resultadosDocente);
            // echo $row_cnt1;
            // echo "<br>";
            // echo $row_cnt2;
            // echo "<br>";
            $clm_cnt1 = mysqli_num_fields($resultadosAlumno);
            $clm_cnt2 = mysqli_num_fields($resultadosDocente);
            // echo $clm_cnt1;
            // echo "<br>";
            // echo $clm_cnt2;
            // echo "<br>";
            if ($row_cnt1 != $row_cnt2) {
                //Libera los resultados
                mysqli_free_result($resultadosDocente);
                mysqli_free_result($resultadosAlumno);
                // Número de renglones no coincide
                return "NR";
            }
            if ($clm_cnt1 != $clm_cnt2) {
                //Libera los resultados
                mysqli_free_result($resultadosDocente);
                mysqli_free_result($resultadosAlumno);
                // Número de columnas no coincide
                return "NC";
            }
            $resultado = true;
            $arreglo1 = mysqli_fetch_array($resultadosAlumno, MYSQLI_NUM);
            //var_dump($arreglo1);
            $arreglo2 = mysqli_fetch_array($resultadosDocente, MYSQLI_NUM);
            //var_dump($arreglo2);
            for ($i = 0; $i <= $clm_cnt1 - 1; $i++) {
                if ($arreglo1[$i] !== $arreglo2[$i]) {
                    $resultado = false;
                }
            }

            if ($resultado == true) {
                //Libera los resultados
                mysqli_free_result($resultadosDocente);
                mysqli_free_result($resultadosAlumno);
                // "ACEPTADO"
                return "AC";
            } else {
                //Libera los resultados
                mysqli_free_result($resultadosDocente);
                mysqli_free_result($resultadosAlumno);
                // "RESPUESTA INCORRECTA"
                return "WA";
            }
        }
        ?>