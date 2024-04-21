<?php

    if(isset($_POST)){

        $_SESSION['rol'] = $_POST;

        header("refresh:1;url=/App/home.php");

    }

?>