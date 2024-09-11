<?php

    class Paginador {

        public $pagina;

        public $elementos;



        public function __construct(){

            /*
            *   Si la variable pag contiene algun valor se lo pasara a la variable pagina.
            *   Caso contrario esta estara seteada en 0.
            */
            if (isset($_GET['pag'])){

                $this->pagina = $_GET['pag'];

            } else {
                
                $this->pagina = 0;

            }
            
            $this->elementos = 15;

        }

        public function paginado($cont){


            $actual = $_SERVER['PHP_SELF'];
            
            /*
            *   Si el valor de la variable pagina es mayor a 0 entonces habilita el boton de anterior.
            *   Caso contrario el boton aparecera deshabilitado
            */
            if ($this->pagina > 0){

                $anterior = $this->pagina - 1;
                
                echo "<a href=\"$actual?pag=$anterior\"><button>Anterior</button></a>";
                

            } else {

                echo "<a href=\"#\"><button disabled>Anterior</button></a>";

            }

            /*
            *   Mientras la cantidad de elementos sea menor a la cantidad maxima de elementos nos habilita el boton de siguiente.
            *   Caso contrario el boton aparece deshabilitado.
            */
            if (($this->pagina * $this->elementos) < $cont){

                $siguiente = $this->pagina + 1;

                echo "<a href=\"$actual?pag=$siguiente\"><button>Siguiente</button></a>";

            } else {

                echo "<a href=\"#\"><button disabled>Siguiente</button></a>";

            }

        }

    }

?>