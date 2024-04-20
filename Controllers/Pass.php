<?php

    class Pass{

        private $pass;

        public function __construct()
        {

            if(isset($_POST['pass'])){

                $this->pass = $_POST['pass'];

            } else {

                $this->pass = '123456';

            }
            
        }

        public function passHash(){

            return password_hash($this->pass, PASSWORD_DEFAULT, [8]);

        }

        public function adminRestart($id, $con){

            $pass = self::passHash();

            $sql = "update usuarios set contra = '$pass', flag = 1 where id_usuario = $id;";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false && $resultado > 0){

                header("Location: /App/users.php?ok=4");

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>Ha ocurrido un problema al intentar reiniciar la contraseña. Intente mas tarde.</p>
                    </div>";

                header("refresh:5;url=/App/users.php");

            }
            
        }

        public function restart($con){

            $pass = trim($_POST['string1']);
            $verif = trim($_POST['string2']);

            if (strcmp($pass, $verif) !== 0){

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        Ambas contraseñas deben ser iguales.
                    </div>";

            } else {

                $this->pass = $pass;

                $contra = self::passHash();

                $sql = "update usuarios set contra = $contra where id_usuario = $_SESSION[user];";

                try{

                    $resultado = $con->exec($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if ($resultado != false && $resultado > 0){

                    header("Location: /App/home.php?ok=4");

                } else {

                    echo "
                        <div class=\"alert alert-danger\" role=\"alert\">
                            Se ha producido un error al reiniciar la contraseña. Por favor intente mas tarde.
                        </div>";

                }

            }

        }

    }

?>