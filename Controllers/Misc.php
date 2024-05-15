<?php

    class Misc {

        public static function userSuccess(){

            if(isset($_GET['ok']) && $_GET['ok'] == 1){

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Usuario creado correctamente</p>
                    </div>";

            } elseif (isset($_GET['ok']) && $_GET['ok'] == 2) {

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Usuario modificado correctamente</p>
                    </div>";
                
            } elseif (isset($_GET['ok']) && $_GET['ok'] == 3) {

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Usuario eliminado correctamente</p>
                    </div>";

            } elseif(isset($_GET['ok']) && $_GET['ok'] = 4){

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Se ha reiniciado la contraseña.</p>
                    </div>";

            }

        }

        public static function serviceSuccess(){

            if(isset($_GET['ok']) && $_GET['ok'] == 1){

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Servicio creado correctamente</p>
                    </div>";

            } elseif (isset($_GET['ok']) && $_GET['ok'] == 2) {

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Servicio modificado correctamente</p>
                    </div>";
                
            } elseif (isset($_GET['ok']) && $_GET['ok'] == 3) {

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Servicio eliminado correctamente</p>
                    </div>";

            }

        }

        public static function employeeSuccess(){

            if(isset($_GET['ok']) && $_GET['ok'] == 1){

                echo "
                    <div class=\"alert alert success\" role=\"alert\">
                        <p>Empleado creado exitosamente</p>
                    </div>";

            } elseif (isset($_GET['ok']) && $_GET['ok'] == 2){

                echo "
                    <div class=\"alert alert success\" role=\"alert\">
                        <p>Empleado modificado exitosamente</p>
                    </div>";

            } elseif (isset($_GET['ok']) && $_GET['ok'] == 3){

                echo "
                    <div class=\"alert alert success\" role=\"alert\">
                        <p>Empleado eliminado exitosamente</p>
                    </div>";

            }

        }

        public static function formSuccess(){

            if(isset($_GET['ok']) && $_GET['ok'] == 1){

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Contraseña cambiada satisfactoriamente.</p>
                    </div>";

            } else if (isset($_GET['ok'])){

                echo "
                    <div class=\"alert alert-success\" role=\"alert\">
                        <p>Formulario enviado correctamente.</p>
                    </div>";

            }

        }

        public static function notFound(){

            echo "
            <div class=\"alert alert-danger\" role=\"alert\">
                <p>Registro no encontrado.Por favor intente mas tarde.</p>
            </div>";
            
        }

        public static function getAgrupamientos($con){

            $sql = "select * from agrupamientos";

            $resultado = $con->query($sql);

            if($resultado->rowCount() > 0){

                foreach ($resultado as $registro){

                    echo "
                        <option value=\"$registro[id_agrup]\">
                            $registro[descripcion_agrup]
                        </option>";
                    
                }

            }

            unset($resultado);

        }

        public static function conteo($con){
            $sql = "select evaluado from evaluaciones;";
            try{
                $resultado = $con->query($sql);
            } catch(PDOException $e){
                $con->bdError($e);
                die();
            }
            if($resultado != false){
                echo 
                    "<div class=\"alert alert-success\">
                        <p>Cantidad de evaluaciones realizadas hasta el momento: ".$resultado->rowCount()."</p>
                    </div>";
            }
        }

    }

?>