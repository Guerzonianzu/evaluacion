<?php

    include "Conexion.php";
    
    class Empleados {

        public static function getEmpleados(){

            $con = new Conexion;

            //Recoge el parametro pag, en caso de que no exista, lo setea a 1.
            if(isset($_GET['pag'])){
                
                $pagina = $_GET['pag'];
            
            } else {

                $pagina = 1;
            
            }

            $elementos = 15;

            //(($pagina - 1) * $elementos) indica donde debe empezar a mostrar registros.
            $sql = "select * from trabajadores join servicios on servicios.id_servicio = trabajadores.servicio where nombre != 'Administrador' order by trabajadores.apellido limit ". (($pagina - 1) * $elementos). ", ". $elementos;

            $resultado = $con->query($sql);

            $max = $resultado->rowCount();

            echo "
                <table class=\"table\">
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Servicio</th>
                        <th colspan=\"2\">Acciones</th>
                    </thead>";
                
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

            } else {
                echo "
                <tbody>
                    <td colspan=5>Aun no hay registros</td>
                </tbody>";
            }

            echo "</table>";

        }


        public static function searchEmpleados($op){
            


        }
    }

?>