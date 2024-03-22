<?php

    include "Conexion.php";
    include "Paginador.php";
    
    class Empleados {

        private $pagina = 1;

        private $elementos = 15;

        public function getEmpleados(){

            if (isset($_GET['pag'])){

                $this->pagina = $_GET['pag'];

            }

            //Nueva conexion a base de datos.
            $con = new Conexion;

            $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where nombre != 'Administrador';";

            $resultado = $con->query($sql);

            //Cantidad maxima de elementos.
            $max = $resultado->rowCount();

            //Nueva instancia de objeto: Paginador.
            $list = new Paginador($max);

            //(($pagina - 1) * $elementos) indica donde debe empezar a mostrar registros.
            $sql = "select * from trabajadores join servicios on servicios.id_servicio = trabajadores.servicio where nombre != 'Administrador' order by trabajadores.apellido limit ". (($this->pagina) * $this->elementos). ", ". $this->elementos;

            $resultado = $con->query($sql);
                
            /*
                Si la consulta a la base de datos nos trae al menos un registro mostrara la informacion dentro de una tabla.
                Caso contrario avisara que aun no se han cargado los registros.
            */ 
            if ($max > 0){            
        
                foreach($resultado as $registro){

                    echo "
                        <tr>
                            <form>
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>
                                <td>$registro[descripcion_servicio]</td>
                                <td><button class=\"btn btn-primary\" formaction=\"../Forms/User/Modificar.php\">Modificar</button></td>
                                <td><button class=\"btn btn-primary\" formaction=\"../Forms/User/Eliminar.php\">Eliminar</button></td>
                            </form>
                        </tr>";

                }

                $list->paginado();

            } else {
                echo "
                <tbody>
                    <td colspan=5>Aun no hay registros</td>
                </tbody>";
            }

        }


        public function searchEmpleados($op){

            if (isset($_GET['pag'])){

            }
            
            switch($op){

                case "apellido":
                    
                    break;

                case "dni":
                    break;

                case "servicio":
                    break;

                default:
                    echo "Llamar a sistemas. Interno 1017";
            }

        }
    }

?>