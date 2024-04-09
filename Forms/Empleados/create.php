<?php

    session_start();

    if($_SESSION['rol'] == 1){ 
        
        include "../../Controllers/User.php";
        include "../../Controllers/Servicios.php";
        include "../../Controllers/Misc.php";
        include "../../Controllers/Conexion.php";
        $con = Conexion::conectar();

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Alta de empleado</title>
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

                <div class="row justify-content-center mb-3">
                    <h1>Alta de empleado</h1>
                </div>

                <?php

                    if(isset($_POST['dni']) && isset($_POST['nombre']) && isset($_POST['apellido'])){

                        $emp = new User(trim($_POST['dni']), trim($_POST['nombre']), trim($_POST['apellido']), $_POST['agrupamiento'], $_POST['servicio'], $_POST['jefe']);

                        $emp->createEmpleado($con);

                        if($_POST['rol'] == 2 || $_POST['rol'] == 1){

                            $emp->createUser($_POST['rol'],$con);

                        }
                        
                        unset($con, $emp);
                        header("Location: /App/home.php?ok=1");

                    } else {

                        echo "
                            <div class=\"alert alert-danger\" role=\"alert\">
                                <p>Error: Por favor compruebe que todos los campos estan completos.</p>
                            </div>";
                        
                    }

                ?>

                <form method="POST">

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
                                
                                Misc::getAgrupamientos($con);

                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Servicio:</span>
                        <select class="custom-select" name="servicio" id="">
                            <?php
                                
                                Servicios::selectServicios($con);

                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Jefe inmediato:</span>
                        <select class="custom-select" name="jefe" id="">
                            <?php

                                Empleados::getJefes($con);

                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Rol:</span>
                        <select class="custom-select" name="rol" id="">
                            <?php

                                User::getRoles($con);

                            ?>
                        </select>
                    </div>

                    <div class="row justify-content-center">
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