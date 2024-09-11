<?php

    include "Pass.php";
    require_once "Paginador.php";

    class Usuario{

        private $dni;

        private $contra;

        private $flag;

        private $rol;
        

        public function __construct($dni){

            $this->dni = $dni;

            $contra = new Pass;

            $this->contra = $contra->passHash();

            unset($contra);

            $this->rol = 2;
            
            $this->flag = 1;

        }

        public function createUser($con){

            $sql = "select usuario from usuarios where usuario like '$this->dni';";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado->rowCount() == 0){

                $sql = "select dni from trabajadores where dni like '$this->dni';";

                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();
                }

                if ($resultado != false){

                    $sql = "select id_trabajador from trabajadores where dni = '$this->dni';";

                    try{

                        $resultado = $con->query($sql);

                    } catch (PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if($resultado != false){

                        $trabajador = 0;

                        foreach ($resultado as $registro){

                            $trabajador = $registro['id_trabajador'];
            
                        }

                        $sql ="insert into usuarios(trabajador, usuario, contra, rol, flag) values ($trabajador, '$this->dni', '$this->contra', $this->rol, $this->flag);";

                        try{

                            $resultado = $con->exec($sql);

                        } catch (PDOException $e){

                            $con->bdError($e);
                            die();

                        }

                        if ($resultado > 0){

                            echo "<script>
                                    location.replace('/App/users.php?ok=1');
                                </script>";

                        } else {

                            echo "
                                <div class=\"alert alert-danger\" role=\"alert\">
                                    <p>No se ha podido crear el usuario. Por favor contacte con el administrador.</p>
                                </div>";
                                var_dump($resultado);

                        }

                    } else {

                        Misc::notFound();

                    }

                } else {

                    echo "
                        <div class=\"alert alert-danger\">
                            <p>No se registra un Trabajador/a con ese DNI.</p>
                        </div>";

                }

            } else {

                echo "
                    <div class=\"alert alert-danger\">
                        <p>El usuario ya existe.</p>
                    </div>";
                
            }

            

        }

        public function enableUser($id, $con){

            $sql = "update usuarios set estado = 1 where id_usuario = $id;";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado > 0){

                echo "<script>
                        location.replace('/App/users.php?ok=2');
                    </script>";

            } else {

                echo "
                    <div class=\"alert alert danger\" role=\"alert\">
                        <p>No se ha podido modificar el usuario. Por favor intente mas tarde.</p>
                    </div>";

            }

        }

        public function deleteUser($id, $con){

            $sql = "update usuarios set estado = 0 where id_usuario = $id;";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado > 0){
                
                //header("Location: ../../App/users.php?ok=3");
                echo "<script>
                        location.replace('/App/users.php?ok=3');
                    </script>";

            } else {

                echo "
                    <div class=\"alert alert danger\" role=\"alert\">
                        <p>No se ha podido eliminar el usuario. Por favor contacte con el administrador.</p>
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

                if ($resultado != false){

                    $max = $resultado->rowCount();

                } else {

                    $max = 0;
                }

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            $list = new Paginador();

            $sql = "select * from usuarios as usu join trabajadores as tra on usu.trabajador = tra.id_trabajador where usuario != 'admin' order by tra.apellido limit ". ($list->pagina * $list->elementos). ", ". $list->elementos. ";";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if($resultado != false){

                foreach($resultado as $registro){

                    echo "
                        <tr>
                            <form action=\"../Forms/Pass/reset.php\">
                                <input type=\"hidden\" name=\"id\" id=\"id\" value=\"$registro[id_usuario]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>
                                <td>$registro[usuario]</td>
                                <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>";
                    
                    /*if ($registro['estado'] == true){

                        echo "<td><a class=\"btn btn-danger\" href=\"../Forms/Users/delete.php?id=". $_registro['id_usuario'] . "\">Deshabilitar</a></td>";

                    } else {

                        echo "<td><a class=\"btn btn-success\" href=\"../Forms/Users/enable.php?id=". $_registro['id_usuario'] . "\">Habilitar</a></td>";

                    }*/

                    echo "
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
                                    <form action=\"../Forms/Pass/reset.php\">
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_usuario]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[usuario]</td>
                                        <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>";

                            if ($registro['estado'] == true){

                                echo "<td><a class=\"btn btn-danger\" href=\"../Forms/Users/delete.php\">Deshabilitar</a></td>";
        
                            } else {
        
                                echo "<td><a class=\"btn btn-success\" href=\"../Forms/Users/enable.php\">Habilitar</a></td>";
        
                            }
                            echo "
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
                                    <form action=\"../Forms/Pass/reset.php\">
                                        <input type=\"hidden\" name=\"id\" value=\"$registro[id_usuario]\">
                                        <td>$registro[nombre]</td>
                                        <td>$registro[apellido]</td>
                                        <td>$registro[usuario]</td>
                                        <td><input type=\"submit\" class=\"btn btn-primary\" value=\"Reiniciar Contraseña\"></td>";
                                        var_dump($registro['estado_usuario']);
                            if ($registro['estado'] == 1){

                                echo "<td><input class=\"btn btn-danger\" type=\"submit\" formaction=\"../Forms/Users/delete.php\" value=\"Deshabilitar\"></td>";
        
                            } else {
        
                                echo "<td><input class=\"btn btn-success\" type=\"submit\" formaction=\"../Forms/Users/enable.php\" value=\"Habilitar\"></td>";
        
                            }
                            echo "
                                    </form>
                                </tr>";   
                        }
                    }
                    break;
            }

        }

    }    
?>