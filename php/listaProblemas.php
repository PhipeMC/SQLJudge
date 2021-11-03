
<?php
    include("Conexion.php");
	$conexion = conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLJudge - Lista de problemas</title>
    <link rel="shortcut icon" href="img/favicon2.ico"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">  

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleListadoProblemas.css">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html" id="logo"><i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Problemas
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item " href="listaProblemas.php">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="">Ranking</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../CrearProblema.html">Crear problema</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../profile.html">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Ayuda</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="btn btn-sm btn-outline-secondary" href="../login.html">Iniciar sesion</a>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container mt-3">
            <h1> Problemas </h1>
                <table id="tablasLista" class="table table-dark table-hover" style="width:100%">
                        <thead>
                            <tr >
                            <th scope="col" >ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dicultad</th>
                            <th scope="col">Resuelto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select P.idPROBLEMA,P.titulo,P.dificultad,
                                (

                                    select count(E.ALUMNO_idAlumno) from envio E where E.Estado= 'AC' AND E.PROBLEMA_idPROBLEMA = P.idPROBLEMA
                                )as Resueltos
                                from PROBLEMA P ;";
                                $resultado = mysqli_query($conexion,$sql);

                                while($mostra=mysqli_fetch_array($resultado)){
                            ?>

                              <tr>
                                <th><?php echo $mostra['idPROBLEMA'] ?></th>
                                <td><?php echo $mostra['titulo'] ?></td>
                                <td><?php echo $mostra['dificultad'] ?></td>
                                <td><?php echo $mostra['Resueltos'] ?></td>
                              </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                </table>
        </div>
    </div>
</body>

<script defer src="js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $('#tablasLista').DataTable();
</script>
</html>