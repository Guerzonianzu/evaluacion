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

            $sql ="select * from trabajadores tra join agrupamientos agr on tra.agrupamiento = agr.id_agrup join servicios ser on tra.servicio = ser.id_servicio where id_trabajador = $id and tra.activo = 1;";

            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                foreach($resultado as $registro){

                    $dni = $registro['DNI'];
                    $nombre = $registro['nombre'];
                    $apellido = $registro['apellido'];
                    $id_agrup = $registro['agrupamiento'];
                    $agrupamiento = $registro['descripcion_agrup'];
                    $id_serv = $registro['servicio'];
                    $servicio = $registro['descripcion_servicio'];
                    $id_jefe = $registro['Jefe_inmediato'];

                }

                $sql = "select concat(apellido, ' ', nombre) as nombre from trabajadores tra join usuarios usu on tra.id_trabajador = usu.trabajador where id_trabajador = $id_jefe;";

                $resultado = $con->query($sql);

                foreach ($resultado as $registro){
                    $jefe = $registro['nombre'];                    
                }

                $emp = array(
                    'dni' => $dni,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'id_agrup' => $id_agrup,
                    'agrupamiento' => $agrupamiento,
                    'id_serv' => $id_serv,
                    'servicio' => $servicio,
                    'id_jefe' => $id_jefe,
                    'jefe' => $jefe);

                return $emp;

            } else {

                return "No encontrado";

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

            $sql = "select id_trabajador, concat(nombre, ', ', apellido) as nombre_completo from trabajadores tra join usuarios usu on usu.trabajador = tra.id_trabajador where usu.rol = 2;";

            try {

                $resultado = $con->query($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            

            if($resultado != false || $resultado->rowCount() > 0){

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

            $sql = "select dni from usuarios where dni = $this->dni";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado = false){

                $sql = "insert into empleados(dni, nombre, apellido, agrupamiento, servicio, jefe_inmediato, activo) values ('$this->dni', '$this->nombre', '$this->apellido', $this->agrupamiento, $this->servicio, $this->jefe, $this->estado);";
                
                try {

                    $resultado = $con->exec($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }
    
                if($resultado != false || $resultado > 0){
    
                    header("Location: /App/home.php?ok=1");
    
                } else {
    
                    echo "
                        <div class=\"alert alert-danger\" role=\"alert\">
                            <p>No se ha podido registrar el empleado. Por favor intente mas tarde.</p>
                        </div>";
    
                }

            } else {

                echo "
                    <div class=\"alert alert-danger\">
                        <p>El Empleado ya existe en la base de datos.</p>
                    </div>";

            }

        }

        public static function selectServicios($con){

            $sql = "select * from servicios;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado->rowCount() > 0){

                foreach($resultado as $registro){

                    echo "
                        <option value=\"$registro[id_servicio]\">
                            $registro[descripcion_servicio]
                        </option>";
                    

                }

            } else {

                echo "
                    <option value=\"\">
                        No hay opciones
                    </option>";

            }

        }

        public function modifyEmpleado($con){

            $sql = "update trabajadores set dni = '$this->dni', nombre = '$this->nombre', apellido = '$this->apellido', agrupamento = $this->agrupamiento, servicio = $this->servicio, jefe_inmediato = $this->jefe, activo = $this->estado where id_trabajador = $_POST[id];";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die(); 

            }

            if($resultado > 0){

                header("Location: /App/home.php?ok=2");

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido modificar la informacion del empleado. Por favor intente mas tarde.</p>
                    </div>";
                
            }

        }

        public function deleteEmpleado($con){

            $sql = "update trabajadores set activo = 0 where id_trabajador = $_GET[id];";

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
            
            $sql = "select id_trabajador, nombre, apellido, descripcion_servicio from trabajadores tra join servicios ser on tra.servicio = ser.id_servicio;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            $max = $resultado->rowCount();

            $resultado->closeCursor();
            
            $list = new Paginador();

            $sql = "select id_trabajador, nombre, apellido, descripcion_servicio from trabajadores join servicios on servicios.id_servicio = trabajadores.servicio where nombre != 'Administrador' and activo = 1 order by trabajadores.apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos;

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }
                
            if ($max > 0){            
        
                foreach($resultado as $registro){

                    echo "
                        <tr>
                            <form>
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>
                                <td>$registro[descripcion_servicio]</td>
                                <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/modify.php\">Modificar</button></td>
                                <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/delete.php\">Eliminar</button></td>
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

            $list = new Paginador();
            
            switch($op){

                case "apellido":
                    
                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where tra.apellido like '$_GET[buscar]%' and activo = 1 order by tra.apellido asc;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        $con->bdError($e);
                        die();
        
                    }

                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

                            echo "
                                <tr>
                                    <form method=GET>
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[descripcion_servicio]</td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/modify.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/delete.php\">Eliminar</button></td>
                                    </form>
                                </tr>";

                        }

                        $list->paginado($resultado->rowCount());

                    } else {

                        echo "<td colspan=\"5\">Registro no encontrado</td>";

                    }

                    break;

                case "dni":

                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where tra.dni like '$_GET[buscar]%' and activo = 1 order by tra.apellido asc;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        $con->bdError($e);
                        die();
        
                    }

                    if ($resultado->rowCount() > 0){

                        foreach($resultado as $registro){

                            echo "
                                <tr>
                                    <form>
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[descripcion_servicio]</td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/modify.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/Empleados/delete.php\">Eliminar</button></td>
                                    </form>
                                </tr>";

                        }

                    } else {

                        echo "<td colspan=\"5\">Registro no encontrado.</td>";

                    }

                    break;

                case "servicio":

                    $sql = "select * from trabajadores as tra join servicios as ser on ser.id_servicio = tra.servicio where ser.descripcion_servicio like '$_GET[buscar]%' and activo = 1 order by tra.apellido;";

                    try{

                        $resultado = $con->query($sql);
        
                    } catch (PDOException $e){
        
                        $con->bdError($e);
                        die();
        
                    }

                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

                            echo "
                                <tr>
                                    <form>
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[descripcion_servicio]</td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/modify.php\">Modificar</button></td>
                                        <td><button class=\"btn btn-primary\" formaction=\"/Forms/User/delete.php\">Eliminar</button></td>
                                    </form>
                                </tr>";

                        }

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