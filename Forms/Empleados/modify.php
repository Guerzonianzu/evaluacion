<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/User.php";
        include "../../Controllers/Misc.php";
        include "../../Controllers/Conexion.php";
        $con = Conexion::conectar();
        $id = $_GET['id'];
        $emp = Empleados::getInfo($_GET['id'], $con);

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar Empleado</title>
            <link rel="stylesheet" href="/Style/estilo.css">
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/App/home.php"><img src="/Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a href="/App/users.php" class="nav-link">Listado de usuarios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/App/servicios.php">Listado de servicios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link disable" href="formularios.php">Vista previa de formularios</a>
                        </li>
                    </ul>
                </div>
                <div class="justify-content-end">                        
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="/App/logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </div>
            </nav>

            <div class="container">

                <div class="row justify-content-center mb-3">
                    <h1>Modificacion de datos del empleado.</h1>
                </div>

                <?php

                    if(isset($_POST['dni']) && isset($_POST['nombre']) && isset($_POST['apellido'])){

                        $emp = new User(trim($_POST['dni']), trim($_POST['nombre']), trim($_POST['apellido']), $_POST['agrupamiento'], $_POST['servicio'], $_POST['jefe']);

                        $emp->modifyEmpleado($con);

                        if($_POST['rol'] == 1 || $_POST['rol'] == 2){

                            $emp->createUser($_POST['rol'], $con);

                        }

                        unset($emp, $con);
                        header("Location: /App/home.php?ok=2");

                    }

                ?>

                <form method="POST">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="input-group mb-3">
                        <span class="input-group-text">DNI:</span>
                        <input type="text" class="form-control" name="dni" value="<?php echo $emp['dni']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre:</span>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $emp['nombre']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Apellido:</span>
                        <input type="text" class="form-control" name="apellido" value="<?php echo $emp['apellido']; ?>">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Agrupamiento:</span>
                        <select class="custom-select" name="agrupamiento" id="">
                            <option value="<?php echo $emp['id_agrup']; ?>"><?php echo $emp['agrupamiento']; ?></option>
                            <?php
                                Misc::getAgrupamientos($con);
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Servicio:</span>
                        <select class="custom-select" name="servicio" id="">
                            <option value="<?php echo $emp['id_serv']; ?>"><?php echo $emp['servicio']; ?></option>
                            <?php
                                Empleados::selectServicios($con);
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Jefe Inmediato:</span>
                        <select class="custom-select" name="jefe" id="">
                            <option value="<?php echo $emp['id_jefe']; ?>"><?php echo $emp['jefe']; ?></option>
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
                        <input type="submit" class="btn btn-primary mr-5" value="Modificar">
                        <a href="/App/home.php" class="btn btn-danger">Cancelar</a>
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