<?php

    include "Conexion.php";
    include "Misc";

    class User{

        private $dni;

        private $rol;

        private $contra = '123456';

        private $flag = 1;
        

        public function __construct($dni){

            $this->dni = $dni;

        }

        protected function createUser($rol){

            try {

                $con = Conexion::conectar();

            } catch (PDOException $e){

                Misc::bdError($e);
                die();

            }

            try{

                $sql = "select id_trabajador from trabajadores where dni = '$this->dni';";

                $resultado = $con->query($sql);

                if($resultado->rowCount() > 0) {

                    foreach ($resultado as $registro){

                        $id = $registro['id_trabajador'];
    
                    }

                } else {
                    
                    echo "
                        <div class=\"alert alert-danger\"> 
                            <p>El empleado no existe en la base de datos. Sera redireccionado a la pagina principal en 5 segundos.</p>
                        </div>";
                    
                    header("refresh:5;url=/App/users.php");

                }

            } catch (PDOException $e){

                Misc::bdError($e);
                die();

            }

            try{

                $sql = "insert into usuarios(trabajador, usuario, contra, rol, flag) values ($id, $this->dni, $this->contra, $rol, $this->flag);";

                $resultado = $con->exec($sql);

                if ($resultado > 0){

                    header("Location:/App/users.php?ok=1");

                }

            } catch (PDOException $e){

                Misc::bdError($e);
                die();

            }

            unset($con, $sql, $resultado);

        }

        public function modifyUser(){

        }

        public function deleteUser(){

        }

        public static function getUser(){

            

        }

        public static function searchUser($op){

        }
    }    
?>