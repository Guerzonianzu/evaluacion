<?php
    session_start();
    include "../Controllers/Empleados.php";
    include "../Controllers/Misc.php";
    
    //Verificacion para reinicio de contraseñas.
    if($_SESSION['flag'] == 1){

        header("Location: /Forms/reset.php");

    }

    //Verificacion del rol del usuario.
    if ($_SESSION['rol'] == 1){ ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Administrador</title>
            <link rel="stylesheet" href="/Style/estilo.css">
            <script src="/Style/js/bootstrap.min.js"></script>
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="../img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
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

                <a class="btn btn-primary" href="/Forms/Empleados/create.php">Nuevo empleado</a>
                
                <form>
                    
                    <h1>Busqueda de Empleados</h1>

                    <div class="row">
                        
                        <div class="col-md-2">
                            
                            <select name="op" class="form-control" id="">
                                <option value="apellido" selected>Apellido</option>
                                <option value="dni">DNI</option>
                                <option value="servicio">Servicio</option>
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

                <?php

                    Misc::employeeSuccess();

                ?>
                
                <div class="row">
                    
                    <table class="table">

                        <thead>

                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Servicio</th>
                            <th colspan="2">Acciones</th>

                        </thead>

                        <tbody>

                            <?php

                                if (isset($_GET['op'])){

                                    Empleados::searchEmpleados($_GET['op']);

                                } else {

                                    Empleados::getEmpleados();

                                }
                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </body>
        </html>

    <?php

    } else if ($_SESSION['rol'] == 2){



    } else {

        header("Location: ../index.php");

    }
?>