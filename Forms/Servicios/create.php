<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Servicios.php";

        $con = Conexion::conectar();

        ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Alta de servicio</title>
                <link rel="stylesheet" href="../../Style/estilo.css">
            </head>
            <body>
                
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="../../App/home.php"><img src="/Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a href="../../App/users.php" class="nav-link">Listado de usuarios</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="../../App/servicios.php">Listado de servicios</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link disable" href="../../App/formularios.php">Vista previa de formularios</a>
                            </li>
                        </ul>
                    </div>
                    <div class="justify-content-end">                        
                        <?php
                            echo "$_SESSION[apellido] $_SESSION[nombre]";
                        ?>
                        <a href="../../App/logout.php" class="btn btn-primary">Cerrar Sesion</a>
                    </div>
                </nav>

                <div class="container">

                    <div class="row justify-content-center mb-3">
                        <h1>Alta de servicios</h1>
                    </div>

                    <?php

                        if(isset($_POST['servicio'])){

                            $serv = new Servicios(trim($_POST['servicio']));

                            $serv->createServicio($con);

                            unset($serv, $con);
                            header("Location: /App/servicios.php?ok=1");

                        }

                    ?>

                    <form method="POST">

                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre del servicio:</span>
                            <input type="text" class="form-control" placeholder="Nombre del servicio" name="servicio" minlength="1" maxlength="255" required>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <input type="submit" class="btn btn-primary mr-5" value="Agregar">
                            <input type="reset" class="btn btn-danger ml-5" value="Reiniciar">
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