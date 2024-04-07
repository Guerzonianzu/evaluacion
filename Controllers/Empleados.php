<?php

    include "Paginador.php";
    
    
    class Empleados {

        protected $dni;

        private $nombre;

        private $apellido;

        private $agrupamiento;

        private $servicio;

        private $jefe;

        private $fecha_ingreso;

        private $formulario = 0;

        private $estado = 1;

        public function __construct($dni, $nombre, $apellido, $agrupamiento, $servicio, $jefe){

            $this->dni = trim($dni);

            $this->nombre = trim($nombre);

            $this->apellido = trim($apellido);

            $this->agrupamiento = trim($agrupamiento);

            $this->servicio = trim($servicio);

            $this->jefe = trim($jefe);

        }

        protected function getDNI(){

            return $this->dni;

        }

        protected function getNombre(){

            return $this->nombre. " ". $this->apellido;

        }

        public static function getInfo($id, $con){

            $sql ="select * from trabajadores where id_trabajador = $id;";

            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                foreach($resultado as $registro){

                    $dni = $registro['dni'];
                    $nombre = $registro['nombre'];
                    $apellido = $registro['apellido'];
                    $agrupamiento = $registro['agrupamiento'];
                    $servicio = $registro['servicio'];
                    $jefe = $registro['jefe'];

                }

                $emp = new self($dni, $nombre, $apellido, $agrupamiento, $servicio, $jefe);

                return $emp;

            }

        }

        public function showEmpleado(){

            echo "
                    <table class=\"table\">
                        <thead>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                        </thead>
                        <tbody>
                            <td>$this->dni</td>
                            <td>$this->nombre</td>
                            <td>$this->apellido</td>
                        </tbody>
                    </table>";

        }

        public static function getJefes($con){

            $sql = "call sp_getJefes;";

            $resultado = $con->query($sql);

            if($resultado->rowCount() > 0){

                foreach($resultado as $registro){

                    echo "
                        <option value=\"$registro[id_trabajador]\">
                            $registro[nombre_completo]
                        </option>";

                }

            } else {

                echo "
                    <option value=\"\">
                        No hay opciones
                    </option>";

            }

        }

        public function createEmpleado($con){

            $sql = "call sp_createEmployee('$this->dni', '$this->nombre', '$this->apellido', $this->agrupamiento, $this->servicio, $this->jefe, $this->fecha_ingreso, $this->formulario, $this->estado);";

            $resultado = $con->exec($sql);

            if($resultado > 0){

                header("Location: /App/home.php?ok=1");

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido registrar el empleado. Por favor intente mas tarde.</p>
                    </div>";

            }

        }

        public function modifyEmpleado($con){

            $sql = "call sp_modifyEmployee('$this->dni', '$this->nombre', '$this->apellido', $this->agrupamiento, $this->servicio, $this->jefe, $this->fecha_ingreso, $this->formulario, $this->estado, $_GET[id]);";

            $resultado = $con->exec($sql);

            if($resultado > 0){

                header("Location: /App/home.php?ok=2");

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido registrar el empleado. Por favor intente mas tarde.</p>
                    </div>";
                

            }

        }

        public function deleteEmpleado($con){

            $sql = "call sp_disableEmployee($_GET[id]);";

            $resultado = $con->exec($sql);

            if($resultado > 0){

                header("Location: /App/home.php?ok=3");

            } else {

                echo "
                <div class=\"alert alert-danger\" role=\"alert\">
                    <p>No se ha podido deshabilitar al empleado. Por favor intente mas tarde.</p>
                </div>";

            }

        }


        public static function getEmpleados($con){
            
            //Consulta a base de datos.
            $sql = "call sp_getEmployees;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            //Cantidad maxima de elementos.
            $max = $resultado->rowCount();

            $resultado->closeCursor();
            
            //Nueva instancia de objeto: Paginador.
            $list = new Paginador();

            //(($pagina - 1) * $elementos) indica donde debe empezar a mostrar registros.
            $sql = "select * from trabajadores join servicios on servicios.id_servicio = trabajadores.servicio where nombre != 'Administrador' order by trabajadores.apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos;

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
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
                                <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Modificar.php\">Modificar</button></td>
                                <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Eliminar.php\">Eliminar</button></td>
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


        public static function searchEmpleados($op, $con){

            //Nueva instancia de objeto: Paginador. 
            $list = new Paginador();
            
            //Seleccion de tipo de busqueda.
            switch($op){

                case "apellido":
                    
                    //Sentencia SQL para buscar un apellido dentro de la base de datos.
                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where tra.apellido like '$_GET[buscar]%' order by tra.apellido asc;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        $con->bdError($e);
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
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Modificar.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Eliminar.php\">Eliminar</button></td>
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
        
                        $con->bdError($e);
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
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Modificar.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Eliminar.php\">Eliminar</button></td>
                                    </form>
                                </tr>";

                        }

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
        
                        $con->bdError($e);
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
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Modificar.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/Eliminar.php\">Eliminar</button></td>
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