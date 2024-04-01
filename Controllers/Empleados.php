<?php

    include "Conexion.php";
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

        public function __construct(){

            $this->dni = trim($_POST['dni']);

            $this->nombre = trim($_POST['nombre']);

            $this->apellido = trim($_POST['apellido']);

            $this->agrupamiento = trim($_POST['agrupamiento']);

            $this->servicio = trim($_POST['servicio']);

            $this->jefe = trim($_POST['jefe']);

            $this->fecha_ingreso = trim($_POST['fecha']);

        }

        protected function getDNI(){

            return $this->dni;

        }

        protected function getNombre(){

            return $this->nombre. " ". $this->apellido;

        }

        public function createEmpleado(){

            $con = Conexion::conectar();

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

        public function modifyEmpleado(){

            $con = Conexion::conectar();

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

        public function deleteEmpleado(){

            $con = Conexion::conectar();

            $sql = "call sp_disableEmployee;";

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


        public static function getEmpleados(){

            //Conexion a base de datos.
            $con = Conexion::conectar();
            
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


        public static function searchEmpleados($op){            

            $con = Conexion::conectar();

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