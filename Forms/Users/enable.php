<?php
    session_start();

    if($_SESSION['rol'] == 1){

        require_once "../../Controllers/Conexion.php";
        require_once "../../Controllers/User.php";

        $con = Conexion::conectar();

        $id = $_GET['id'];

        $sql = "select usuario from usuarios where id_usuario = $id;";

        try{

            $resultado = $con->query($sql);

        } catch (PDOException $e){

            $con->bdError($e);
            die();

        }

        if($resultado != false){

            foreach($resultado as $registro){

                $usr = new Usuario($registro['usuario']);
                
            }

            if(isset($usr)){

                $usr->enableUser($id, $con);

            }            

        }
    }
?>