<?php

    class Paginador {

        private $pagina;

        private $elementos;

        private $cont;

        public function __construct($cont){

            /*
                Si la variable pag contiene algun valor se lo pasara a la variable pagina.
                Caso contrario esta estara seteada en 1
            */
            if (isset($_GET['pag'])){

                $this->pagina = $_GET['pag'];

            } else {
                
                $this->pagina = 1;

            }
            
            $this->elementos = 15;

            $this->cont = $cont;

        }

        public function paginado(){

            if ($this->pagina > 0){

                $anterior = $this->pagina - 1;
                
                echo "<a href=\"home.php?pag=$anterior\"><button>Anterior</button></a>";
                

            } else {

                echo "<a href=\"#\"><button disabled>Anterior</button></a>";

            }

            if (($this->pagina * $this->elementos) < $this->cont){

                $siguiente = $this->pagina + 1;

                echo "<a href=\"home.php?pag=$siguiente\"><button>Siguiente</button></a>";

            } else {

                echo "<a href=\"#\"><button disabled>Siguiente</button></a>";

            }

        }

    }

?>