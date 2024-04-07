<?php

    session_start();

    if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1){

        

    } elseif (isset($_POST['rol']) && $_SESSION['rol'] == 2){



    } else {

        header("Location: /");

    }

?>