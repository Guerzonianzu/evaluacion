<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../Controllers/Conexion.php";
        include "../Controllers/Servicios.php";
        include "../Controllers/Misc.php";

        $con = Conexion::conectar();

        ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Listado de servicios</title>
                <link rel="stylesheet" href="/Style/estilo.css">
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

                    <a class="btn btn-primary" href="/Forms/Servicios/create.php">Nuevo servicio</a>

                    <form>

                        <h1>Busqueda de servicios</h1>

                        <div class="row">

                            <div class="input-group mb-3">

                                <span class="input-group-text">Nombre del servicio:</span>
                                <input type="text" class="form-control" placeholder="Nombre de servicio" name="op" minlength=1 maxlength=255>

                            </div>

                            <div class="col">

                                <input type="submit" class="btn btn-primary" value="Buscar">
                                <a href="servicios.php" class="btn btn-danger">Limpiar Busqueda</a>

                            </div>

                        </div>

                    </form>

                    <?php

                        if(isset($_GET['ok'])){

                            Misc::serviceSuccess();

                        }                        

                    ?>

                    <div class="row">

                        <table class="table">

                            <thead>
                                <th>Nombre del servicio</th>
                                <th colspan="2">Acciones</th>
                            </thead>

                            <tbody>

                                <?php

                                    if(isset($_GET['op'])){

                                        Servicios::searchServicio($_GET['op'], $con);

                                    } else {

                                        Servicios::getServicios($con);

                                    }

                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </body>
            </html>

        <?php

        unset($con);

    } else {

        header("Location: /index.php");

    }

?>