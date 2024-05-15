<?php
    session_start();
    if($_SESSION['rol'] == 1){

        require_once "../Controllers/Conexion.php";
        require_once "../Controllers/Table.php";

        $con = Conexion::conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaciones realizadas</title>
    <link rel="stylesheet" href="../Style/estilo.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php"><img src="../Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
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

        <form method="GET">
            <h1>Formularios Realizados</h1>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Formulario:</span>
                <select clas="custom-select" name="buscar">
                    <?php
                        Table::selectForms($con);
                    ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <input type="submit" class="btn btn-primary" value="Buscar">
                <?php
                    Table::resetForm();
                ?>
            </div>

        </form>

        <div class="row">
            <?php
                if(isset($_GET['buscar'])){
                    Table::searchForms($con);
                } else {
                    Table::getForms($con);
                }
            ?>
        </div>

    </div>
</body>
</html>
<?php
    }
?>