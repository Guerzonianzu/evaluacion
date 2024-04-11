<?php

    session_start();

    if($_SESSION['rol'] == 1){

        $con = Conexion::conectar();

        ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Listado de servicios</title>
            </head>
            <body>

                
                
                <div class="container">



                </div>

            </body>
            </html>

        <?php

    } else {

        header("Location: /index.php");

    }

?>