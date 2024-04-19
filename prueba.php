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

    echo "<br>". password_hash('prueba', PASSWORD_DEFAULT);



?>