<?php

    include "../Controllers/Conexion.php";
    include "../Controllers/User.php";
    include "../Controllers/Misc.php";
    
    session_start();

    if($_SESSION['rol'] == 1){ 
        
        $con = Conexion::conectar();

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Listado de usuarios</title>
            <link rel="stylesheet" href="../Style/estilo.css">
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="home.php"><img src="../Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="evaluaciones.php">Tabla de evaluaciones</a>
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

                <a class="btn btn-primary" href="../Forms/Users/create.php">Nuevo Usuario</a>

                <form>
                    
                    <h1>Busqueda de usuarios</h1>

                    <div class="row">

                        <div class="col-md-2">

                            <select name="op" class="form-control" id="">
                                <option value="dni">DNI</option>
                                <option value="apellido">Apellido</option>
                            </select>

                        </div>

                        <div class="col-md-10">

                            <input type="text" name="buscar" class="form-control" placeholder="Buscar...">

                        </div>

                        <div class="col">

                            <input type="submit" class="btn btn-primary mb-3 mt-3" value="Buscar">

                            <a href="users.php" class="btn btn-danger mb-3 mt-3">Limpiar busqueda</a>

                        </div>

                    </div>

                </form>

                <?php

                    Misc::userSuccess();

                ?>

                <div class="row">
                    
                    <table class="table">

                        <thead>

                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th></th>

                        </thead>

                        <tbody>

                            <?php

                                if (isset($_GET['op'])){

                                    Usuario::searchUser($_GET['op'], $con);

                                } else {

                                    Usuario::getUser($con);

                                }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </body>
        </html>

    <?php
    } else {

        header("Location: ../index.php");

    }
?>