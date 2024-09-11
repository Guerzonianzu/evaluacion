<?php

    session_start();

    if($_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Servicios.php";
        $con = Conexion::conectar();

        $serv = Servicios::getInfo($con);

        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Baja de servicio</title>
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

                    <h1>¿Esta seguro que desea eliminar el siguiente servicio?</h1>

                    <?php

                        echo "
                            <div class=\"row mb-3\">
                                $serv[desc]
                            </div>";
                        

                        if (isset($_GET['y'])){

                            $serv = new Servicios($serv['desc']);

                            $serv->deleteServicio($con);

                        }

                    ?>

                    <input type="hidden" name="id" value="<?php echo $serv['id'] ?>">
                    <input type="hidden" name="y" value="1">
                    <input type="submit" class="btn btn-primary" value="Si">
                    <a href="/App/servicios.php" class="btn btn-primary">No</a>

                </form>

            </div>
            
        </body>
        </html>

        <?php

    } else {

        header("Location: /index.php");

    }

?>