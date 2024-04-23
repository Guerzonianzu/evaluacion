<?php

    
    include "Empleados.php";
    include "Pass.php";

    class User extends Empleados{

        private $contra;

        private $flag;
        

        public function __construct($dni, $nombre, $apellido, $agrupamiento, $servicio, $jefe){

            parent::__construct($dni, $nombre, $apellido, $agrupamiento, $servicio, $jefe);

            $contra = new Pass;

            $this->contra = $contra->passHash();

            unset($contra);
            
            $this->flag = 1;

        }

        protected function createUser($rol, $con){

            $sql = "select dni from usuarios where usuario = $this->dni;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();
            }

            if ($resultado = false){

                $sql = "select id_trabajador from trabajadores where dni = dni;";

                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if($resultado != false || $resultado->rowCount() > 0){

                    foreach ($resultado as $registro){

                        $trabajador = $registro['id_trabajador'];
        
                    }

                } else {

                    Misc::notFound();
                    die();

                }

                if (isset($trabajador)){

                    $sql ="insert into usuarios(trabajador, usuario, contra, rol, flag) values ($trabajador, '$this->dni', '$this->contra', $rol, $this->flag);";

                    try{

                        $resultado = $con->exec($sql);

                    } catch (PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if ($resultado > 0){

                        header("Location: /App/users.php?ok=1");

                    } else {

                        echo "
                            <div class=\"alert alert danger\" role=\"alert\">
                                <p>No se ha podido crear el usuario. Por favor contacte con el administrador.</p>
                            </div>";

                    }

                }

            } else {

                echo "
                    <div class=\"alert alert-danger\">
                        <p>El usuario ya existe</p>
                    </div>";

            }

        }

        public function modifyUser($id, $rol, $con){

            $sql = "update usuarios set rol = $rol where id_usuario = $id";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado > 0){

                header("Location: /App/users.php?ok=2");

            } else {

                echo "
                    <div class=\"alert alert danger\" role=\"alert\">
                        <p>No se ha podido crear el usuario. Por favor contacte con el administrador.</p>
                    </div>";

            }

        }

        public function deleteUser($id, $con){

            $sql = "delete from usuarios where id_usuario = $id;";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado > 0){
                
                header("Location: /App/users.php?ok=3");

            } else {

                echo "
                    <div class=\"alert alert danger\" role=\"alert\">
                        <p>No se ha podido crear el usuario. Por favor contacte con el administrador.</p>
                    </div>";

            }

        }

        public static function getRoles($con){

            $sql = "select * from roles order by id_rol desc;";

            try {

                $resultado = $con->query($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado->rowCount() > 0){

                foreach ($resultado as $registro){

                    echo "
                        <option value=\"$registro[id_rol]\">
                            $registro[descripcion_rol]
                        </option>";

                }

            } else {

                echo "
                    <option value=\"\">
                        No hay opciones
                    </option>";
                
            }

        }

        public static function getUser($con){

            $sql = "select usuario from usuarios;";

            try{

                $resultado = $con->query($sql);

                $max = $resultado->rowCount();

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            $resultado->closeCursor();

            $list = new Paginador();

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
                        <form action=\"/Forms/Pass/reset.php\">
                            <input type=\"hidden\" name=\"id\" id=\"id\" value=\"$registro[id_usuario]\">
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

        public static function searchUser($op, $con){

            $list = new Paginador();

            switch($op){

                case 'dni':

                    $sql = "select * from usuarios as usu join trabajadores as tra on usu.trabajador = tra.id_trabajador where usu.usuario like '%$_GET[buscar]%';";

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
                                    <form action=\"/Forms/Pass/reset.php\">
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_usuario]\">
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

                        $con->bdError($e);
                        die();

                    }

                    if ($resultado->rowCount() > 0){

                        foreach ($resultado as $registro){

                            echo "
                                <tr>
                                    <form action=\"/Forms/Pass/reset.php\">
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_usuario]\">
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