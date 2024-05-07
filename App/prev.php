<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../Controllers/Forms.php";
        include "../Controllers/Conexion.php";
        $con = Conexion::conectar();

    ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vista previa de formularios</title>
            <link rel="stylesheet" href="../Style/estilo.css">
        </head>
        <body>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/App/home.php"><img src="../img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a href="users.php" class="nav-link">Listado de usuarios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="servicios.php">Listado de servicios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link " href="prev.php">Vista previa(Evaluaciones realizadas)</a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="download.php">Descarga de calificaciones</a>
                            </li>
                    </ul>
                </div>
                <div class="justify-content-end">                        
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </div>
            </nav>

            <div class="container">

                <form>
            
                    <h1>Busqueda de Empleados</h1>

                    <div class="row">
                    
                        <div class="col-md-2">
                        
                            <select name="op" class="form-control" id="">
                                <option value="apellido" selected>Apellido</option>
                                <option value="dni">DNI</option>
                            </select>

                        </div>

                        <div class="col-md-10">

                            <input type="text" name="buscar" class="form-control mb-3" placeholder="Buscar...">

                        </div>

                        <div class="col">

                            <input type="submit" value="Buscar" class="btn btn-primary mt-3 mb-3">

                            <a href="home.php" class="btn btn-danger mb-3 mt-3">Limpiar busqueda</a>

                        </div>
                    
                    </div>

                </form>

                <div class="row">

                <table class="table">
                        <thead>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th></th>
                        </thead>
                        <tbody>

                        <?php
                            if (isset($_GET['op'])){
                                Forms::searchFormularios($con);
                            } else {
                                Forms::getFormularios($con);
                            }
                        ?>

                        </tbody>
                    </table>
                </div>

            </div>
            
        </body>
        </html>

    <?php

    }

?>