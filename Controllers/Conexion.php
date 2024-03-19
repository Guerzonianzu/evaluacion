<?php
    
    class Conexion extends PDO{

        private $motor = "mysql";
        private $host = "localhost";
        private $user = "root";
        private $pass = "Rathian996";
        private $bd = "evaluaciones";

        public function __construct(){
            
           parent::__construct($this->motor. ':dbname='. $this->bd. ';host='. $this->host, $this->user, $this->pass);

        }
        
    }
?>
