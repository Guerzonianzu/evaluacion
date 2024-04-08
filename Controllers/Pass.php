<?php

    class Pass{

        private $id;

        public function __construct($id)
        {
            $this->id = $id;
        }


        public function adminRestart($con){

            $sql = "update usuarios set contra = '123456', flag = 1 where id_usuario = $this->id;";

            try{

                $resultado = $con->exec($sql);

            } catch (PDOException $e){

                $con->bdError();
                die();

            }

            if ($resultado != false){

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

                $sql = "update usuarios set contra = $pass where id_usuario = $_SESSION[user];";

                try{

                    $resultado = $con->exec($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

            }

        }

    }

?>