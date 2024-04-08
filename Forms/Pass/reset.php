<?php

    session_start();

    if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Pass.php";

        $con = Conexion::conectar();

        $pass = new Pass($_GET['id']);

        $pass->adminRestart($con);

    } elseif (isset($_POST['rol']) && $_SESSION['rol'] == 2){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Pass.php";

        $con = Conexion::conectar();

        $pass = new Pass($_SESSION['user']);

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reiniciar contraseña</title>
            <link rel="stylesheet" href="/Style/estilo.css">
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

                <?php
                    
                    if(isset($_POST['string1']) && isset($_POST['string2'])){

                    $pass->restart();    

                    }

                ?>

                <form method="POST">

                    <h1>Reinicio de Contraseña</h1>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nueva contraseña</span>
                        <input type="password" class="form-control" placeholder="Nueva Contraseña" name="string1" minlength="1" maxlength="255">
                    </div>

                    <div class="input-group-mb-3">
                        <span class="input-group-text">Repetir contraseña</span>
                        <input type="password" class="form-control" placeholder="Repetir Contraseña" name="string2" minlength="1" maxlength="255">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Aceptar">

                </form>

            </div>

        </body>
        </html>

        <?php    
    } else {

        header("Location: /index.php");

    }

?>