<?php

    $timeTarget = 0.05;

    $coste = 5;

    do{

        $coste++;

        $inicio = microtime(true);

        password_hash("prueba", PASSWORD_DEFAULT, ['cost' => $coste]);

        $fin = microtime(true);

    } while (($fin - $inicio) < $timeTarget);

    echo "Coste: ". $coste;

    $pass1 = password_hash('contraseña', PASSWORD_DEFAULT, [10]);

    if (password_verify('contraseña', $pass1)){

        echo "<br> Las contraseñas coiniciden.";

    } else {

        echo "<br> Las contraseñas no coiniciden.";

    }

    $pass2 = password_hash('Cuenca2023', PASSWORD_DEFAULT, [10]);

    echo "$pass2";

?>