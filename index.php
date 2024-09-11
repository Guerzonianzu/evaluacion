<?php
    $today = date('Y') - 1;

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaciones de desempeño laboral</title>
    <link rel="stylesheet" href="Style/estilo.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <h1>EVALUACIÓN DE DESEMPEÑO 2023</h1>
        </div>
        <div class="row justify-content-center">
            <H1>HCANK</H1>    
        </div>
        
        
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" name="user" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="pass" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
            <?php

            if (isset($_POST['user'])){
                require_once "Controllers/Auth.php";
                Auth::login(trim($_POST['user']), trim($_POST['pass']));
            }
            
            ?>
            
    </div>

    <footer>
        <div class="row justify-content-center mt-5">
            <h6>Gestion de RRHH - Direccion de Admisión</h6>
        </div>
    </footer>
</body>
</html>