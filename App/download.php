<?php

    session_start();

    if($_SESSION['rol'] == 1){

        
    ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Descarga de calificaciones</title>
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
                            <a class="nav-link" href="prev.php">Vista previa(Evaluaciones realizadas)</a>
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

                <form method="POST" action="../Controllers/Descarga.php">

                    <h1>Descarga de calificaciones</h1>

                    <div class="input-group mb-3">

                        <span class="input-group-text">Desde:</span>
                        <input type="date" name="inicio" class="form-control">

                    </div>

                    <div class="input-group mb-3">

                        <span class="input-group-text">Hasta:</span>
                        <input type="date" name="fin" class="form-control">

                    </div>

                    <div class="col justify-content-center">

                        <input type="submit" class="btn btn-primary" value="Descargar">

                    </div>

                </form>



            </div>

        </body>
        </html>

    <?php

    } else {

        header("Location: home.php");

    }

?>