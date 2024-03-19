<?php
    session_start();
    if($_SESSION['flag'] == 1){

    }
    echo "HOLA";
    session_destroy();
?>