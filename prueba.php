<?php

    $timeTarget = 0.05;

    $coste = 3;

    do {

        $coste++;
        $inicio = microtime(true);
        password_hash('prueba', PASSWORD_DEFAULT, ['cost' => $coste]);
        $fin = microtime(true);

    } while (($fin - $inicio) > $timeTarget);

    echo "Coste = ". $coste;

    echo "<br>". password_hash('Cuenca2023', PASSWORD_DEFAULT, [8]);

        echo "<form action= method=POST>
            <input type=\"date\" name=\"ingreso\">
            <input type=\"submit\" value=\"Agregar\">
        </form>";

        if (isset ($_POST['ingreso'])){

            var_dump($_POST['ingreso']);

        }
    



?>