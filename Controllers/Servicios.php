<?php

    include "Paginador.php";

    class Servicios {

        private $nombre;

        public function __construct($nombre){

            $this->nombre = $nombre;

        }

        public function createServicio($con){

            $sql = "insert into servicios(descripcion_servicio) values ('$this->nombre');";

            try {

                $resultado = $con->exec($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado > 0){

                echo "<script>
                        location.replace('/App/servicios.php?ok=1');
                    </script>";

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido registrar el nuevo servicio. Por favor intente mas tarde.</p>    
                    </div>";
                

            }
        }

        public function modifyServicio($con){

            $sql = "update servicios set descripcion_servicio = '$this->nombre' where id_servicio = $_POST[id];";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado > 0){

                echo "<script>
                        location.replace('/App/servicios.php?ok=2');
                    </script>";

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido modificar la informacion del servicio. Por favor intente mas tarde.</p>
                    </div>";

            }

        }

        public function deleteServicio($con){

            $sql = "delete from servicios where id_servicio = $_GET[id];";

            try {

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado > 0){

                echo "<script>
                        location.replace('/App/servicios.php?ok=3');
                    </script>";

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido eliminar el servicio. Por favor intente mas tarde.</p>
                    </div>";

            }

        }

        public static function getServicios($con){

            $sql = "select * from servicios;";

            try{

                $resultado2 = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado2 != false){

                $max = $resultado2->rowCount();

                $resultado2->closeCursor();

                $list = new Paginador();

                $sql = "select * from servicios limit ".($list->pagina)*$list->elementos.", ". $list->elementos. ";";

                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if ($max > 0){

                    foreach ($resultado as $registro){

                        echo "
                            <tr>
                                <form>
                                    <input type=\"hidden\" name=\"id\" value=\"$registro[id_servicio]\">
                                    <td>$registro[descripcion_servicio]</td>
                                    <td><button class=\"btn btn-primary\" formaction=\"../Forms/Servicios/modify.php\">Modificar</button></td>
                                    <td><button class=\"btn btn-danger\" formaction=\"../Forms/Servicios/delete.php\">Eliminar</button></td>
                                </form>
                            </tr>";

                    }

                    $list->paginado($max);

                } else {

                    echo "
                        <tbody>
                            <td colspan=5>Aun no hay registros.</td>
                        </tbody>";

                }

            }

        }

        public static function searchServicio($serv, $con){

            $list = new Paginador();

            $sql = "select * from servicios where descripcion_servicio like '%$serv%' order by descripcion_servicio asc;";

            try {

                $resultado = $con->query($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();
                
            }

            if ($resultado != false){

                foreach ($resultado as $registro){

                    echo "
                        <tr>
                            <form>
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_servicio]\">
                                <td>$registro[descripcion_servicio]</td>
                                <td><button class=\"btn btn-primary\" formaction=\"../Forms/Servicios/modify.php\">Modificar</button></td>
                                <td><button class=\"btn btn-danger\" formaction=\"../Forms/Servicios/delete.php\">Eliminar</button></td>
                            </form>
                        </tr>";

                }

                $list->paginado($resultado->rowCount());

            } else {

                echo "<td colspan=\"5\">Registro no encontrado</td>";

            }

        }

        public static function getInfo($con){

            $sql = "select * from servicios where id_servicio = $_GET[id];";

            
            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado != false || $resultado > 0){

                foreach ($resultado as $registro){

                    $id = $registro['id_servicio'];
                    $desc = $registro['descripcion_servicio'];

                }

                $serv = array('id' => $id, 'desc' => $desc);

                unset ($id, $desc);

                return $serv;

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se ha podido encontrar el servicio deseado. Por favor intente mas tarde</p>
                    </div>";
                die();

            }

        }

    }

?>