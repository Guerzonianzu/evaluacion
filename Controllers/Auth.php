<?php

    include "Conexion.php";
    include "Pass.php";

    class Auth{

        public static function login($user){

            $con = Conexion::conectar();

            $sql = "call sp_getPass('$user');";

            try{

                $resultado = $con->query($sql);
                
            } catch (PDOException $e){

                $con->bdError($e);

            }

            if ($resultado != false){

                foreach ($resultado as $registro){

                    $contra = $registro['contra'];

                }

                if(password_verify($_POST['pass'], $contra)){

                    $sql = "call sp_login('$user');";

                    try{

                        $resultado = $con->query($sql);

                    } catch (PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    foreach ($resultado as $registro){

                        $_SESSION['user'] = $registro['id_usuario'];
                        $_SESSION['trabajador'] = $registro['trabajador'];
                        $_SESSION['nombre'] = $registro['nombre'];
                        $_SESSION['apellido'] = $registro['apellido'];
                        $_SESSION['rol'] = $registro['rol'];
                        $_SESSION['flag'] = $registro['flag'];

                    }

                    header("Location: /App/home.php");

                } else {

                    echo "
                        <div class=\"alert alert-danger\">
                            <p>
                                La contraseña es incorrecta.
                            </p>
                        </div>";

                }

            } else {

                echo "
                    <div class=\"alert alert-danger\">
                        <p>
                            El usuario o contraseña son incorrectos.
                        </p>
                    </div>";
                
            }

        }

    }

?>