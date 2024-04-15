<?php

    class Forms{

        private $id_jefe;

        public function __construct(){

            $this->id_jefe = $_SESSION['trabajador'];

        }

        public function getEvaluados($con){

            $sql = "select * from trabajadores tra join servicios ser on tra.servicio = ser.id_servicio where tra.jefe_inmediato = $this->id_jefe;";

            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError();
                die();

            }
            
                       

        }

    }

?>