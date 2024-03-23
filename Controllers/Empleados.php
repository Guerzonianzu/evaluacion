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

            try{

                //Nueva conexion a base de datos.
                $con = new Conexion;

            } catch (PDOException $e){
                    
                echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la conexion con el servidor: ". $e->getMessage().".</div>";
                die();

            }
            
            $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where nombre != 'Administrador' order by tra.apellido;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la consulta con la base de datos: ". $e->getMessage().".</div>";
                die();

            }
            

            //Cantidad maxima de elementos.
            $max = $resultado->rowCount();

            //Nueva instancia de objeto: Paginador.
            $list = new Paginador($max);

            //(($pagina - 1) * $elementos) indica donde debe empezar a mostrar registros.
            $sql = "select * from trabajadores join servicios on servicios.id_servicio = trabajadores.servicio where nombre != 'Administrador' order by trabajadores.apellido limit ". (($this->pagina) * $this->elementos). ", ". $this->elementos;

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la consulta con la base de datos: ". $e->getMessage().".</div>";
                die();

            }
                
            /*
            *   Si la consulta a la base de datos nos trae al menos un registro mostrara la informacion dentro de una tabla.
            *   Caso contrario avisara que aun no se han cargado los registros.
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

                $list->paginado($max);

            } else {
                echo "
                <tbody>
                    <td colspan=5>Aun no hay registros</td>
                </tbody>";
            }

        }


        public function searchEmpleados($op){

            try {

                //Nueva conexion a base de datos.
                $con = new Conexion;

            } catch (PDOException $e) {

                echo "<div class=\"alert alert danger\" role=\"alert\">Fallo en la consulta de base de datos: ". $e->getMessage(). ".</div>";
                die();

            }

            //Nueva instancia de objeto: Paginador.
            $list = new Paginador;
            
            //Seleccion de tipo de busqueda.
            switch($op){

                case "apellido":
                    
                    //Sentencia SQL para buscar un apellido dentro de la base de datos.
                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where tra.apellido like '$_GET[buscar]%' order by tra.apellido asc;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la consulta con la base de datos: ". $e->getMessage().".</div>";
                        die();
        
                    }

                    /*
                    *   Si el resultado de la consulta es mayor a 0 nos mostrara los resultados ordenados por apellido.
                    *   Caso contrario avisara que no pudo encontrar el registro
                    */
                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

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

                        //Llamada la funcion paginado.
                        $list->paginado($resultado->rowCount());

                    } else {

                        echo "<td colspan=\"5\">Registro no encontrado</td>";

                    }

                    break;

                case "dni":

                    //Sentencia SQL para buscar un registro en la base de datos por DNI. Ordenado por apellido.
                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where tra.dni like '$_GET[buscar]%' order by tra.apellido;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la consulta con la base de datos: ". $e->getMessage().".</div>";
                        die();
        
                    }

                    /*
                    *   Si el resultado de la consulta es mayor a 0 nos mostrara los resultados ordenados por apellido.
                    *   Caso contrario avisara que no pudo encontrar el registro
                    */
                    if ($resultado->rowCount() > 0){

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

                        //Llamada la funcion paginado.
                        $list->paginado($resultado->rowCount());

                    } else {

                        echo "<td colspan=\"5\">Registro no encontrado.</td>";

                    }

                    break;

                case "servicio":

                    //Sentencia SQL para buscar registros por descripcion del servicio. Ordenado por apellido del trabajador.
                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where ser.descripcion_servicio like '$_GET[buscar]%' order by tra.apellido;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Fallo la consulta con la base de datos: ". $e->getMessage().".</div>";
                        die();
        
                    }

                    /*
                    *   Si el resultado de la consulta es mayor a 0 nos mostrara los resultados ordenados por apellido.
                    *   Caso contrario avisara que no pudo encontrar el registro
                    */
                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

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

                        //Llamada la funcion paginado.
                        $list->paginado($resultado->rowCount());

                    } else {

                        echo "<td colspan=\"5\">Registro no encontrado.</td>";

                    }

                    break;

                default:
                    echo "Llamar a sistemas. Interno 1017";
            }

        }
    }

?>