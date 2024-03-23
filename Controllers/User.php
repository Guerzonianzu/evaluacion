<?php

    include "Conexion.php";

    class User{

        public static function login($user, $pass){

            try{

                //Nueva conexion a base de datos.
                $con = new Conexion();

            } catch (PDOException $e){

                echo 
                    "<div class=\"alert alert-danger mt-3\" role=\"alert\">
                        <p>Fallo la conexion con el servidor:" .$e->getMessage(). "</p>
                    </div>";

                    die();

            }

            define("SQL", "select * from usuarios as usu join trabajadores as tra on tra.id_trabajador = usu.trabajador where usu.usuario = '$user' and usu.contra = '$pass' and tra.activo = 1;");

            try{

                //Consulta a base de datos.
                $resultado = $con->query(SQL);

                if($resultado->rowCount() > 0){
                    
                    foreach($resultado as $registro){

                        //Creacion de variables de sesion.
                        session_start();
                        $_SESSION['user'] = $registro['id_usuario'];
                        $_SESSION['trabajador'] = $registro['trabajador'];
                        $_SESSION['nombre'] = $registro['nombre'];
                        $_SESSION['apellido'] = $registro['apellido'];
                        $_SESSION['rol'] = $registro['rol'];
                        $_SESSION['flag'] = $registro['flag'];
                        header("Location: App/home.php");
                    }
                
                } else {

                    echo 
                        "<div class=\"alert alert-danger mt-3\" role=\"alert\">
                            <p>El nombre de usuario o contraseña es incorrecto</p>
                        </div>";

                }
                
            } catch (PDOException $e){

                echo 
                    "<div class=\"alert alert-danger mt-3\" role=\"alert\">
                        <p>Fallo la consulta de base de datos:" .$e->getMessage(). "</p>
                    </div>";

                    die();

            }

        }
    }    
?>