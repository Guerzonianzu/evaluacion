<?php
    
    class Conexion extends PDO{

        private $motor = "mysql";
        private $host = "10.1.0.104";
        private $user = "user_evaluaciones";
        private $pass = "Rathian996";
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
            error_log($e->getMessage(), 0);
            echo "<script>
                    alert('Ha ocurrido un error. Por favor intente mas tarde.');
                    location.replace('/');
                </script>";
        }

    }
?>
