<?php

    class Paginador {

        private $pagina;

        private $elementos;

        public function __construct(){

            /*
                Si la variable pag contiene algun valor se lo pasara a la variable pagina.
                Caso contrario esta estara seteada en 1.
            */
            if (isset($_GET['pag'])){

                $this->pagina = $_GET['pag'];

            } else {
                
                $this->pagina = 1;

            }
            
            $this->elementos = 15;

        }

        public function paginado($cont){

            /*
                Si el valor de la variable pagina es mayor a 0 entonces habilita el boton de anterior.
                Caso contrario el boton aparecera deshabilitado
            */
            if ($this->pagina > 0){

                $anterior = $this->pagina - 1;
                
                echo "<a href=\"home.php?pag=$anterior\"><button>Anterior</button></a>";
                

            } else {

                echo "<a href=\"#\"><button disabled>Anterior</button></a>";

            }

            /*
                Mientras la cantidad de elementos sea menor a la cantidad maxima de elementos nos habilita el boton de siguiente.
                Caso contrario el boton aparece deshabilitado.
            */
            if (($this->pagina * $this->elementos) < $cont){

                $siguiente = $this->pagina + 1;

                echo "<a href=\"home.php?pag=$siguiente\"><button>Siguiente</button></a>";

            } else {

                echo "<a href=\"#\"><button disabled>Siguiente</button></a>";

            }

        }

    }

?>