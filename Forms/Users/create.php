<?php
    session_start();

    if($_SESSION['rol'] == 1){

        require_once "../../Controllers/Conexion.php";
        require_once "../../Controllers/User.php";

        $con = Conexion::conectar();
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Alta de usuarios</title>
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
                <div class="row justify-content-center mb-3">
                    <h1>Alta de usuarios</h1>
                    <h6>Advertencia: el usuario esta ligado a un Empleado/a si no se encuentra registrado o hay algun error al ingresar el DNI este formulario no creara un usuario.</h6>
                </div>

                <?php
                    if(isset($_POST['dni'])){
                        $usr = new Usuario($_POST['dni']);

                        $usr->createUser($con);
                    }
                ?>

                <form method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text">DNI:</span>
                        <input type="text" class="form-control" placeholder="N° de documento" name="dni" minlength="8" maxlength="9" required>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <input type="submit" class="btn btn-primary mr-5" value="Crear">
                        <a href="../../App/home.php" class="btn btn-danger ml-5">Cancelar</a>
                    </div>
                </form>
            </div>
        </body>
        </html>
<?php
    }
?>