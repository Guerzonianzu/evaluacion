<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaciones de desempeño laboral</title>
    <link rel="stylesheet" href="style/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Sistema de evaluacion</h1>
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
                include "Controllers/User.php";
                User::login(trim($_POST['user']), trim($_POST['pass']));
            }
            
            ?>
            
    </div>
</body>
</html>