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
                
            }

        }

        public static function notFound(){

            echo "
            <div class=\"alert alert-danger\" role=\"alert\">
                <p>Registro no encontrado.Por favor intente mas tarde.</p>
            </div>";
            
        }

    }

?>