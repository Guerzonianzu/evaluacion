<?php

    include "Conexion.php";
    include "Paginador.php";

    class User{

        private $dni;

        private $contra = '123456';

        private $flag = 1;
        

        public function __construct($dni){

            $this->dni = $dni;

        }

        protected function createUser($rol){

            try {

                //Conexion a base de datos.
                $con = Conexion::conectar();

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            try{

                //Consulta para verificar que el empleado exista.
                $sql = "select id_trabajador from trabajadores where dni = '$this->dni';";

                $resultado = $con->query($sql);

                if($resultado->rowCount() > 0) {

                    foreach ($resultado as $registro){

                        $id = $registro['id_trabajador'];
    
                    }

                } else {
                    
                    //Aviso de que el empleado no existe y redireccion a la lista de usuarios
                    echo "
                        <div class=\"alert alert-danger\"> 
                            <p>El empleado no existe en la base de datos. Sera redireccionado a la pagina principal en 5 segundos.</p>
                        </div>";
                    
                    header("refresh:5;url=/App/users.php");

                }

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            try{

                //Consulta para agregar el usuario a la base de datos.
                $sql = "insert into usuarios(trabajador, usuario, contra, rol, flag) values ($id, $this->dni, $this->contra, $rol, $this->flag);";

                $resultado = $con->exec($sql);

                if ($resultado > 0){

                    header("Location:/App/users.php?ok=1");

                }

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            unset($con, $sql, $resultado);

        }

        public function modifyUser(){

        }

        public function deleteUser(){

        }

        public static function getUser(){

            //Conexion a base de datos.
            $con = Conexion::conectar();

            //Consulta a base de datos
            $sql = "select * from usuarios where usuario != 'admin';";

            try{

                $resultado = $con->query($sql);

                //Cantidad Maxima de elementos
                $max = $resultado->rowCount();

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            //Nueva instancia de objeto. Paginador
            $list = new Paginador();

            //Selecciona todos los usuarios de los trabajadores y los ordena por apellido.
            $sql = "select * from usuarios as usu join trabajadores as tra on usu.trabajador = tra.id_trabajador where usuario != 'admin' order by tra.apellido limit ". ($list->pagina * $list->elementos). ", ". $list->elementos. ";";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($max > 0){

                foreach($resultado as $registro){

                    echo "
                    <tr>
                        <form action=\"/Forms/Pass/Reinicio.php\">
                            <input type=\"hidden\" name=\"id\" id=\"id\" value=\"$registro[id_trabajador]\">
                            <td>$registro[nombre]</td>
                            <td>$registro[apellido]</td>
                            <td>$registro[usuario]</td>
                            <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>
                        </form>
                    </tr>";

                }

                $list->paginado($max);

            } else {

                echo "<td colspan=\"4\">Aun no hay registros</td>";

            }

        }

        public static function searchUser($op){

            $con = Conexion::conectar();

            $list = new Paginador();

            switch($op){

                case 'dni':

                    $sql = "select * from usuarios as usu join trabajadores as tra on usu.trabajador = tra.id_trabajador where usu.usuario = '%$_GET[buscar]%';";

                    try {

                        $resultado = $con->query($sql);

                    } catch (PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

                            echo "
                                <tr>
                                    <form>
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[usuario]</td>
                                        <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>
                                    </form>
                                </tr>";

                        }

                    }

                    break;

                case 'apellido':

                    $sql = "select * from usuarios as usu join trabajadores as tra on usu.trabajador = tra.id_trabajador where tra.apellido like '%$_GET[buscar]%';";

                    try{

                        $resultado = $con->query($sql);

                    } catch (PDOException $e){

                        $con->dbError($e);
                        die();

                    }

                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

                            echo "
                                <tr>
                                    <form action=\"/Forms/Pass/formReinicio.php\">
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[usuario]</td>
                                        <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>
                                    </form>
                                </tr>";
                            
                        }

                    }

                    break;

            }

        }

    }    
?>