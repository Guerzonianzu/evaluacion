<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Empleados.php";
        $con = Conexion::conectar();
        $id = $_GET['id'];
        $emp = Empleados::getInfo($id, $con);
        $empleado = new Empleados($emp['dni'], $emp['nombre'], $emp['apellido'], $emp['fecha'], $emp['id_agrup'], $emp['id_serv'], $emp['id_jefe']);
        unset($emp);

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Baja de Empleado</title>
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

                <form>

                    <h1>¿Esta seguro que desea eliminar este Empleado?</h1>

                    <?php

                        $empleado->showEmpleado();

                        if (isset($_GET['y'])){

                            $empleado->deleteEmpleado($con);

                        }

                    ?>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="y" value="1">
                    <input type="submit" class="btn btn-primary" value="Si">
                    <a href="/App/home.php" class="btn btn-primary">No</a>

                </form>

            </div>
            
        </body>
        </html>

    <?php
    } else {

        header("Location: /index.php");

    }

?>