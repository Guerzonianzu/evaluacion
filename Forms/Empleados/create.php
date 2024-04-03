<?php

    session_start();

    if($_SESSION['rol'] == 1){ ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Alta de empleado</title>
            <link rel="stylesheet" href="/Style/estilo.css">
            <script src="/Style/js/bootstrap.min.js"></script>
        </head>
        <body>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/App/home.php"><img src="/Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a href="users.php" class="nav-link">Listado de usuarios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="listaServicios.php">Listado de servicios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="formularios.php">Vista previa de formularios</a>
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

                    <h1>Alta de empleado</h1>

                    <div class="input-group mb-3">
                        <span class="input-group-text">DNI:</span>
                        <input type="text" class="form-control" placeholder="12345678" name="dni" minlength="8" maxlength="8" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre:</span>
                        <input type="text" class="form-control" placeholder="Pepe" name="nombre" minlength="1" maxlength="255" required>
                        <span class="input-group-text">Apellido:</span>
                        <input type="text" class="form-control" placeholder="Gonzalez" name="apellido" minlength="1" maxlength="255" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Agrupamiento:</span>
                        <select class="custom-select" name="agrupamiento" id="">
                            <?php
                                include_once "../../Controllers/Misc.php";
                                Misc::getAgrupamientos();
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Servicio:</span>
                        <select class="custom-select" name="servicio" id="">
                            <?php
                                include_once "../../Controllers/Servicios.php";
                                Servicios::selectServicios();
                            ?>
                        </select>
                    </div>

                </form>
            
            </div>
            
        </body>
        </html>


    <?php

    } else {

        header("Location: /index.php");

    }

?>