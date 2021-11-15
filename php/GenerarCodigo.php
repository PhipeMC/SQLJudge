<?php
    session_start();
    include("Conexion.php");
	$conexion = conectar();
    $id=$_SESSION['id'];
    echo $id;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Codigos</title>
    <link rel="shortcut icon" href="../img/favicon2.ico" />
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../css/style-problems.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"
        integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script defer src="../js/all.js"></script>
    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html" id="logo">
                    <i class="fas fa-terminal" style="color: #0247fe;"></i> SQL Code Judge</a>
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
                                <li><a class="dropdown-item " href="../listaProblemas.html">Lista de problemas</a></li>
                                <li><a class="dropdown-item" href="../profile.html">Ranking</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../CrearProblema.html">Crear problema</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Grupos
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Crear Grupo</a></li>
                                <li><a class="dropdown-item" href="GenerarCodigo.php">Generar claves</a></li>
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
    </header>
    <body>
        
    

    <main class="container">
        <div class="abs-center">
            
            <div class="dark-container card mt-4 rounded ">
                <form method="post"  action="ObtenerCodigo.php" id="frmGenerarClave" class="form-inline justify-content-center">
                        <div class="modal fade " id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirmar cambio de código</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-black fs-4 text-center">
                                    ¿Está seguro que desea cambiar el código del grupo <label for="" class="fw-bold" id="gAgregar"></label> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" onclick="return aceptar();" class="btn btn-primary">Confirmar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    <div class="row mt-4 mx-2 text-center">
                        <h1>Genera un código de registro</h1>
                    </div>
                    
                        <div class="row mb-4 mx-5 text-center">
                            <label for="" class="form-label fs-4 mb-4">Selecciona un grupo</label>
                            <div class="col">
                                <div class="input-group input-group-lg">
                                <select class="form-select" onchange="return getGrupo();" name="grupo" id="txtGrupo">
                                    <option value="default" selected>Seleccione una opción</option>
                                    <?php
                                        $sentencia = sprintf("select idGrupo from grupo where DOCENTE_idDocente1 = %d;",$id);
                                        $resultado = mysqli_query($conexion,$sentencia);
                                        if($resultado){
                                        
                                        while($rows=mysqli_fetch_array($resultado)){
                                            echo $rows['idGrupo'];
                                    ?>

                                    <option value="<?php echo $rows['idGrupo']; ?>">Grupo <?php echo $rows['idGrupo']; ?></option>

                                    <?php
                                        }}
                                    ?>
                                </select>
                                </div>
                            </div>
                        </div>
                    
                    <div class="row mb-4 mx-5">
                        <div class="col" style="display: flex; justify-content: center;">
                            <button type="button"   id="btnAgregar" class="btn btn-primary btn-lg ">Generar nueva clave</button>
                        </div>
                    </div>
                </form>
                <form action="eliminarCodigo.php" method="post">
                    <div class="modal fade " id="modalEliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirmar eliminar la clave</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-black fs-4 text-center">
                                    ¿Está seguro que desea eliminar el código del grupo <strong id="gEliminar"></strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" onclick="return confirmarEliminar();" class="btn btn-danger">Confirmar</button>
                                </div>
                                </div>
                        </div>
                    </div>
                <input type="text" id="inputGrupo" name="inputGrupo" style="display: none;">
                <div class="row mb-4 mx-5">
                        <div class="col" style="display: flex; justify-content: center;">
                            <button type="button" onclick="eliminar();"  id="btnEliminar" class="btn btn-danger btn-lg ">Eliminar clave seleccionada</button>
                        </div>
                    </div>
                </form>
                
                    <div class="row mx-4">
                        <table class="table table-dark table-stripped">
                            <thead>
                                <tr>
                                    <th>IdGrupo</th>
                                    <th>Clave</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <?php
                                        $sql = sprintf("select idGrupo, CodigoGrupo from grupo where DOCENTE_idDocente1 = %d;",$id);
                                        $res = mysqli_query($conexion,$sql);
                                        if($res){
                                        while($rowsTable=mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                    
                                        
                                        <th><?php echo $rowsTable['idGrupo'] ?></th>
                                        <td>
                                        <?php
                                            if($rowsTable['CodigoGrupo']!=null) 
                                            echo $rowsTable['CodigoGrupo']; 
                                            else
                                            echo "Aún no hay clave de registro";
                                        ?></td>
                                        
                                    
                                    </tr>
                                    <?php
                                        }}
                                    ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

             <!-- Modal -->
            

             <!-- Modal -->
             <div class="modal fade " id="error" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="staticBackdropLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-black  fs-4 text-center">
                        Seleccione un grupo por favor
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Aceptar</button>
                    </div>
                    </div>
                </div>
            </div>
        
             
        </div>
    </main>

    

    </body>
    <footer class="footer-color d-flex flex-wrap justify-content-between align-items-center py-3 mt-5">
        <p class="col-md-4 mb-0 text-light">&copy; 2021 Máquina del Mal, Inc</p>

        <a href="../index.html"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <h4><i class="fas fa-terminal" style="color: #0247fe;"></i></h4>
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Inicio</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Acerca de</a></li>
            <li class="nav-item"><a href="https://www.facebook.com/ITSURGTO" class="nav-link px-2 text-muted">
                    <i class="h4 fab fa-facebook-square" style="color: rgb(255, 255, 255);"></i></a>
            </li>
        </ul>
    </footer>
<script>
window.onload=function(){
  
    document.querySelector("#btnAgregar").addEventListener('click', function(){
        debugger;
        var et = document.getElementById("gAgregar");
        var grupo = document.getElementById("txtGrupo").value;
        et.innerHTML = grupo;
        if(grupo=="default"){
            var modalError = new bootstrap.Modal(document.getElementById('error'), {
                keyboard: false
            });
            modalError.show();
        }else{
            
            var modalAgregar = new bootstrap.Modal(document.getElementById('modal'), {
                keyboard: false
            });
            modalAgregar.show();
            //var etiqueta= document.querySelector("#code");
            //etiqueta.value= grupo;
        }
    });
}

function getGrupo(){
    var grupo = document.getElementById("txtGrupo").value;
    var inputGrupo=document.getElementById("inputGrupo");
    inputGrupo.value=grupo;  

}

function eliminar(){
    
    var et = document.getElementById("gEliminar");
    var inputGrupo=document.getElementById("inputGrupo");
    et.innerHTML = inputGrupo.value;
    if(inputGrupo.value==""){
        var modalError = new bootstrap.Modal(document.getElementById('error'), {
            keyboard: false
        });
        modalError.show();
    }else{
        var modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'), {
            keyboard: false
        });
        modalEliminar.show();
    }
}

function confirmarEliminar(){
    return true;
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
</body>
</html>