<?php

    class Forms{

        private $id_jefe;

        public function __construct(){

            $this->id_jefe = $_SESSION['trabajador'];

        }

        public function getEvaluados($con){

            $list = new Paginador();

            $sql = "select id_trabajador from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and formulario != 0;";

            try {

                $resultado = $con->query($sql);

                $max = $resultado->rowCount();

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            $sql = "select id_trabajador, nombre, apellido, estado from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and formulario != 0 order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos;
            
            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }
            
            if ($resultado != false && $resultado->rowCount() > 0){

                foreach($resultado as $registro){

                    echo "
                        <tr>
                            <form method=\"POST\" action=\"/Controllers/Redirect.php\">
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>";
                            
                    if ($registro['estado'] == 1){

                        echo "<td><input type=\"submit\" class=\"btn btn-primary\" value=\"Evaluar\"></td>";

                    } else {

                        echo "<td><button type=\"submit\" formaction=\"/Controllers/Redirect.php\"><img src=\"/Img/tilde.png\" width=\"25px\" height=\"25px\" alt=\"Vista Previa\"></button></td>";

                    }

                    echo "
                            </form>
                        </tr>";

                }

            }

            $list->paginado($max);

            unset($sql, $resultado);

        }

        public function searchEvaluado($con, $op){

            $list = new Paginador();

            switch ($op){

                case "apellido":

                    $sql = "select id_trabajador, nombre, apellido, estado from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and apellido like '%$_GET[buscar]%' and formulario != 0 and order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos.";";

                    break;

                case "dni":

                    $sql = "select id_trabajador, nombre, apellido, estado from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and dni like '%$_GET[buscar]%' and formulario != 0 order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos.";";

                    break;

                default:

                    $sql = "Error";

                    break;


                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if($resultado != false && $resultado->rowCount() > 0){

                    foreach($resultado as $registro){

                        echo "
                            <tr>
                                <form method=\"POST\" action=\"/Controllers/Redirect.php\">
                                    <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                    <td>$registro[nombre]</td>
                                    <td>$registro[apellido]</td>";
                        
                        if ($registro['estado'] == 1){

                            echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Evaluar\">";

                        } else {

                            echo "<button type=\"submit\" formaction=\"/Controllers/Redirect.php\"><img src=\"/Img/tilde.png\" width=\"25px\" height=\"25px\" alt=\"Vista Previa\"></button>";
                            
                        }

                        echo "
                                </form>
                            </tr>";

                    }

                    $list->paginado($resultado->rowCount());

                    unset($resultado);
                }

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

        public static function evaluador($id, $con){

            $sql = "select jefe_inmediato from trabajadores where id_trabajador = $id;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                foreach ($resultado as $registro){

                    $id_eval = $registro['jefe_inmediato'];

                }

                $sql = "select nombre, apellido, dni from trabajadores where id_trabajador = $id_eval;";

                try {

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if ($resultado != false){

                    foreach($resultado as $registro){

                        $nombre = $registro['nombre'];
                        $apellido = $registro['apellido'];
                        $dni = $registro['dni'];

                    }

                    echo "
                    <table class=\"table\">
                        <thead>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                        </thead>
                        <tbody>
                            <td>$nombre</td>
                            <td>$apellido</td>
                            <td>$dni</td>
                        </tbody>
                    </table>";

                }

            }
            

        }

        public static function getFormularios($con){

            $sql = "select id_trabajador, nombre, apellido, dni from trabajadores where estado = 0;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                foreach ($resultado as $registro){

                    echo 
                        "<tr>
                            <form method=\"POST\">
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>
                                <td>$registro[dni]</td>
                                <td><button class=\"btn btn-primary\" formaction=\"/Controllers/redirect.php\"><img src=\"/Img/tilde.png\" width=\"25px\" height=\"25px\" alt=\"Vista previa\"></button></td>
                            </form>
                        </tr>";

                }                

            }

        }

        public static function searchFormularios($con){

            $list = new Paginador();

            $buscar = $_GET['buscar'];

            switch ($_GET['op']){

                case "apellido":
                    
                    $sql = "select id_trabajador, nombre, apellido, dni from trabajadores where apellido like '%$buscar%;'";
                    break;
                    
                case "dni":

                    $sql = "select id_trabajador, nombre, apellido, dni from trabajadores where dni like '%$buscar%'";
                    break;
            }

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                foreach ($resultado as $registro){

                    echo 
                        "<tr>
                            <form method=\"POST\">
                                <input type=\"hidden\" name=\"id\" value=\"$registro[id_trabajador]\">
                                <td>$registro[nombre]</td>
                                <td>$registro[apellido]</td>
                                <td>$registro[dni]</td>
                                <td><button formaction=\"/Controllers/redirect.php\"><img src=\"/Img/tilde.png\" width=\"25px\" height=\"25px\" alt=\"Vista previa\"></button></td>
                            </form>
                        </tr>";

                }

            }

        }

        public function registrarEvaluacion($con){

            $total = $_POST['op'] + $_POST['op2'] + $_POST['op3'] + $_POST['op4'] + $_POST['op5'] + $_POST['op6'] + $_POST['op7'] + $_POST['op8'];

            $fecha = date('Y-m-d');

            $sql = "insert into evaluaciones(evaluado, form, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, evaluador, fecha_evaluacion, total) values ($_POST[id], $_POST[id_form], $_POST[op], $_POST[op2], $_POST[op3], $_POST[op4], $_POST[op5], $_POST[op6], $_POST[op7], $_POST[op8], $this->id_jefe, '$fecha', $total);";

            try {

                $resultado = $con->exec($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }



            if ($resultado > 0){

                $sql = "update trabajadores set estado = 0 where id_trabajador = $_POST[id];";

                try {

                    $resultado = $con->exec($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }
                
                if ($resultado > 0){

                    header("Location: /App/home.php?ok");

                }
                
            }

            

        }

        public function getCalificaciones ($id, $con){

            $sql = "select pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, evaluador, total from evaluaciones where evaluado = $id order by fecha_evaluacion desc limit 1;";

            try {

                $resultado = $con->query($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false && $resultado->rowCount() > 0){

                foreach($resultado as $registro){

                    $values = array(
                        'p1' => $registro['pregunta1'],
                        'p2' => $registro['pregunta2'],
                        'p3' => $registro['pregunta3'],
                        'p4' => $registro['pregunta4'],
                        'p5' => $registro['pregunta5'],
                        'p6' => $registro['pregunta6'],
                        'p7' => $registro['pregunta7'],
                        'p8' => $registro['pregunta8'],
                        'total' => $registro['total'],
                        'evaluador' => $registro['evaluador']
                    );

                }

                return $values;

            }

        }

        private function verificacion40($cal){

            if($cal == 40){

                return "Excelente";

            } elseif ($cal == 32){

                return "Muy bueno";

            } elseif ($cal == 24){

                return "Bueno";

            } elseif ($cal == 16){

                return "Regular";

            } elseif ($cal == 8){

                return "Deficiente";

            }

        }

        private function verificacion20($cal){

            if($cal == 20){

                return "Excelente";

            } elseif ($cal == 16){

                return "Muy bueno";

            } elseif ($cal == 12){

                return "Bueno";

            } elseif ($cal == 8){

                return "Regular";

            } elseif ($cal == 4){

                return "Deficiente";

            }

        }

        private function verificacion15($cal){

            if($cal == 15){

                return "Excelente";

            } elseif ($cal == 12){

                return "Muy bueno";

            } elseif ($cal == 9){

                return "Bueno";

            } elseif ($cal == 6){

                return "Regular";

            } elseif ($cal == 3){

                return "Deficiente";

            }

        }

        private function verificacion10($cal){

            if($cal == 10){

                return "Excelente";

            } elseif ($cal == 8){

                return "Muy bueno";

            } elseif ($cal == 6){

                return "Bueno";

            } elseif ($cal == 4){

                return "Regular";

            } elseif ($cal == 2){

                return "Deficiente";

            }

        }

        private function verificacion5($cal){

            if($cal == 5){

                return "Excelente";

            } elseif ($cal == 4){

                return "Muy bueno";

            } elseif ($cal == 3){

                return "Bueno";

            } elseif ($cal == 2){

                return "Regular";

            } elseif ($cal == 1){

                return "Deficiente";

            }

        }

        public function showCalificaciones($id, $con){

            $values = self::getCalificaciones($id, $con);

            $sql = "select formulario from trabajadores where id_trabajador = $id;";

            try {

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            foreach($resultado as $registro){

                $form = $registro['formulario'];

            }

            unset($sql, $resultado);

            switch ($form) {
                case '1':
                    
                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;

                    break;
                
                case '2':
                
                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;

                    break;

                case '3':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion5($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion20($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion5($values['p7']);

                    return $calificaciones;
                
                    break;

                case '4':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion15($values['p3']);
                    $calificaciones['p4'] = self::verificacion5($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '5':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion5($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion15($values['p7']);

                    return $calificaciones;
                
                    break;

                case '6':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;
                
                case '7':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion15($values['p3']);
                    $calificaciones['p4'] = self::verificacion15($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion5($values['p6']);
                    $calificaciones['p7'] = self::verificacion5($values['p7']);

                    return $calificaciones;
                
                    break;

                case '8':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);

                    return $calificaciones;
                
                    break;

                case '9':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion15($values['p3']);
                    $calificaciones['p4'] = self::verificacion5($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '10':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '11':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;
                
                case '12':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '13':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '14':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '15':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion15($values['p3']);
                    $calificaciones['p4'] = self::verificacion15($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);

                    return $calificaciones;
                
                    break;

                case '16':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'p8' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion5($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion5($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);
                    $calificaciones['p8'] = self::verificacion10($values['p8']);

                    return $calificaciones;
                
                    break;
                
                case '17':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '18':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '19':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion15($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion15($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);

                    return $calificaciones;
                
                    break;

                case '20':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);

                    return $calificaciones;
                
                    break;

                case '21':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
            
                    break;
                
                case '22':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '23':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '24':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                case '25':

                    $calificaciones = array(
                        'p1' => 0,
                        'p2' => 0,
                        'p3' => 0,
                        'p4' => 0,
                        'p5' => 0,
                        'p6' => 0,
                        'p7' => 0,
                        'total' => $values['total']
                    );

                    $calificaciones['p1'] = self::verificacion40($values['p1']);
                    $calificaciones['p2'] = self::verificacion10($values['p2']);
                    $calificaciones['p3'] = self::verificacion10($values['p3']);
                    $calificaciones['p4'] = self::verificacion10($values['p4']);
                    $calificaciones['p5'] = self::verificacion10($values['p5']);
                    $calificaciones['p6'] = self::verificacion10($values['p6']);
                    $calificaciones['p7'] = self::verificacion10($values['p7']);

                    return $calificaciones;
                
                    break;

                default:

                    echo "No se ha encontrado el formulario. Se lo redireccionara a la pagina de inicio.";
                    echo "Si no lo redirecciona por favor haga clic <a href=\"/App/home.php\">Aquí</a>";
                    
                    break;
            }

        }

    }

?>