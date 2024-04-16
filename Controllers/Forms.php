<?php

    class Forms{

        private $id_jefe;

        public function __construct(){

            $this->id_jefe = $_SESSION['trabajador'];

        }

        public function getEvaluados($con){

            $list = new Paginador();

            $sql = "select * from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 order by tra.apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos;

            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError();
                die();

            }
            
            if ($resultado != false && $resultado > 0){

                foreach($resultado as $registro){

                    echo "
                        <tr>
                            <form method=\"POST\">
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>";
                            
                    if ($registro['estado'] == 1){

                        echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Evaluar\">";

                    } else {

                        echo "<td><a href=\"/Controllers/Redirect.php\"><img src=\"/Img/tilde.png\" width=\"25px\" height=\"25px\" alt=\"Vista Previa\"></a></td>";

                    }

                    echo "
                            </form>
                        </tr>";

                }

            }

            $list->paginado($resultado->rowCount());

            unset($sql, $resultado);

        }

        public function searchEvaluado($con, $op){

            switch ($op){

                case "apellido":


                    break;

                case "dni":
                    break;

            }

        }

        public static function prestador($id, $con){

            $sql = "select nombre, apellido, dni from trabajadores where id_trabajador = $id;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            foreach ($resultado as $registro){

                echo "
                    <table class=\"table\">
                        <thead>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                        </thead>
                        <tbody>
                            <td>$registro[nombre]</td>
                            <td>$registro[apellido]</td>
                            <td>$registro[dni]</td>
                        </tbody>
                    </table>";

                

            }

        }

    }

?>