<?php
    session_start();
    include "../Controllers/Conexion.php";
    include "../Controllers/Empleados.php";
    include "../Controllers/Misc.php";

    
    //Verificacion para reinicio de contraseñas.
    if($_SESSION['flag'] == 1){

        header("Location: ../Forms/Pass/reset.php");

    }

    //Verificacion del rol del usuario.
    if ($_SESSION['rol'] == 1){ 
        
        $con = Conexion::conectar();

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Administrador</title>
            <link rel="stylesheet" href="../Style/estilo.css">
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="../Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
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

                <a class="btn btn-primary" href="../Forms/Empleados/create.php">Nuevo empleado</a>
                
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
                    Misc::conteo($con);
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

                                    Empleados::searchEmpleados($_GET['op'], $con);

                                } else {

                                    Empleados::getEmpleados($con);

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

        include "../Controllers/Forms.php";
        $con = Conexion::conectar();

        $form = new Forms();

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Evaluacion de desempeño</title>
            <link rel="stylesheet" href="../Style/estilo.css">
        </head>
        <body>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="/Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        
                    <h1>Busqueda de Empleados</h1>

                    <div class="row">
                    
                        <div class="col-md-2">
                        
                            <select name="op" class="form-control" id="">
                                <option value="apellido" selected>Apellido</option>
                                <option value="dni">DNI</option>
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

                    Misc::formSuccess();

                ?>

                <div class="row">
                    
                    <table class="table">

                        <thead>

                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th></th>

                        </thead>

                        <tbody>

                            <?php

                                if (isset($_GET['op'])){

                                    $form->searchEvaluado($con, $_GET['op']);

                                } else {

                                    $form->getEvaluados($con);

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