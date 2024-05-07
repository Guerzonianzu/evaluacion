<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once "Conexion.php";

        $con = new Conexion();

        $sql = "select id_formulario from formularios order by id_formulario desc limit 1;";

        $fecha = date('Y-m-d');

        $filename = "Evaluaciones-$fecha";

        try{

            $resultado = $con->query($sql);
            
        } catch (PDOException $e){

            $con->bdError($e);
            die();

        }

        if($reusltado != false){

            foreach($resultado as $registro){

                $form = $registro['id_formulario'];

            }

            $fp = fopen('php://output', 'w');

            header('Content-type:application/csv');
            header('Content-disposition: attachment; filename='.$filename);

            for($i = 1; $i <= $form; $i++){

                

            }

        }

    }
?>