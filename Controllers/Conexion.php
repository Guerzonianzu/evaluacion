<?php
    
    class Conexion extends PDO{

        private $motor = "mysql";
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $bd = "evaluaciones";

        public function __construct(){
            
            parent::__construct($this->motor. ':dbname='. $this->bd. ';host='. $this->host, $this->user, $this->pass);

        }

        public static function conectar(){

            try{

                $con = new Conexion();

            } catch (PDOException $e){

                echo "
                    <div class=\"alert alert-danger\">
                        <p>Fallo la conexion con el servidor: ". $e->getMessage(). "</p>
                    </div>"; 
                die();

            }
            
            return $con;

        }

        public function bdError($e){

            echo "
                <div class=\"alert alert-danger\">
                    <p>Fallo la conexion con el servidor: ". $e->getMessage(). "</p>
                </div>"; 

        }

    }
?>
