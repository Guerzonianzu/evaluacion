<?php

    class Servicios {

        private $nombre;

        public function __construct($nombre){

            $this->nombre = $nombre;

        }

        public function createServicio($con){

            $sql = "insert into servicios(descripcion_servicio) values ($this->nombre);";

            try {

                $resultado = $con->exec($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado > 0){

                header("Location: /App/servicios.php?ok=1");

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido registrar el nuevo servicio. Por favor intente mas tarde.</p>    
                    </div>";
                

            }
        }

        public function modifyServicio($id, $con){

                

        }

        public function disableServicio($id, $con){



        }

        public static function getServicios(){



        }

        public static function selectServicios($con){

            $sql = "call sp_getServicios";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado->rowCount() > 0){

                foreach($resultado as $registro){

                    echo "
                        <option value=\"$registro[id_servicio]\">
                            $registro[descripcion_servicio]
                        </option>";
                    

                }

            } else {

                echo "
                    <option value=\"\">
                        No hay opciones
                    </option>";

            }

        }

    }

?>