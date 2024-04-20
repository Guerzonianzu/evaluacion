<?php

    include "Conexion.php";
    include "Pass.php";

    class Auth{

        public static function login($user){

            $con = Conexion::conectar();

            $sql = "select fn_getPass('$user') as contra;";

            try{

                $resultado = $con->query($sql);
                
            } catch (PDOException $e){

                $con->bdError($e);

            }

            if (isset($resultado)){

                if( $resultado != false || $resultado > 0){
                    
                    foreach ($resultado as $registro){

                        $contra = $registro['contra'];
    
                    }
    
                    unset($resultado, $registro);
    
                    if(password_verify($_POST['pass'], $contra)){
    
                        $sql = "call sp_login('$user');";
    
                        try{
    
                            $resultado = $con->query($sql);
    
                        } catch (PDOException $e){
    
                            $con->bdError($e);
                            die();
    
                        }
    
                        foreach ($resultado as $registro){
    
                            session_start();
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
    }

?>