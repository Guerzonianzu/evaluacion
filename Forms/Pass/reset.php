<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Pass.php";

        $con = Conexion::conectar();

        $pass = new Pass();

        $pass->adminRestart($_GET['id'], $con);

    } elseif ($_SESSION['rol'] == 2){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Pass.php";

        $con = Conexion::conectar();

        $pass = new Pass();

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
                </div>
                <div class="justify-content-end">                        
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="/App/logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </div>
            </nav>

            <div class="container">

                <?php
                    
                    if(isset($_POST['string1']) && isset($_POST['string2'])){

                    $pass->restart($con);

                    } else {

                        echo "
                            <div class=\"alert alert-danger\" role=\"alert\">
                                Debe ingresar la contraseña en ambos campos para continuar.
                            </div>";
                        

                    }

                ?>

                <form method="POST">

                    <h1>Reinicio de Contraseña</h1>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nueva contraseña</span>
                        <input type="password" class="form-control" placeholder="Nueva Contraseña" name="string1" minlength="1" maxlength="255" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Repetir contraseña</span>
                        <input type="password" class="form-control" placeholder="Repetir Contraseña" name="string2" minlength="1" maxlength="255" required>
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