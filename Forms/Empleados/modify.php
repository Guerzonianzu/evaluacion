<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/User.php";

        $con = Conexion::conectar();
        $emp = Empleados::getInfo($_GET['id'], $con);

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar Empleado</title>
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

                    if(isset($_POST['dni']) && isset($_POST['nombre']) && isset($_POST['apellido'])){

                        $emp = new User(trim($_POST['dni']), trim($_POST['nombre']), trim($_POST['apellido']), $_POST['agrupamiento'], $_POST['servicio'], $_POST['jefe']);

                        $emp->modifyEmpleado($con);

                        if($_POST['rol'] == 1 || $_POST['rol'] == 2){

                            $emp->createUser($_POST['rol'], $con);

                        }

                        header("Location: /App/home.php?ok=2");

                    }

                ?>

                <form method="POST">



                </form>

            </div>

        </body>
        </html>


        <?php
    }

?>