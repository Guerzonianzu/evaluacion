<?php

    session_start();

    if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1){

        include "../../Controllers/Conexion.php";
        include "../../Controllers/Pass.php";

        $con = Conexion::conectar();

        $pass = new Pass($_GET['id']);

        $pass->restart($con);

    } elseif (isset($_POST['rol']) && $_SESSION['rol'] == 2){



    } else {

        header("Location: /index.php");

    }

?>