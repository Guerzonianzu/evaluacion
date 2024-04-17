<?php

    class Forms{

        private $id_jefe;

        public function __construct(){

            $this->id_jefe = $_SESSION['trabajador'];

        }

        public function getEvaluados($con){

            $list = new Paginador();

            $sql = "select * from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos;

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

            $list = new Paginador();

            switch ($op){

                case "apellido":

                    $sql = "select * from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and apellido = $_GET[buscar] order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos.";";

                    break;

                case "dni":

                    $sql = "select * from trabajadores where jefe_inmediato = $this->id_jefe and activo = 1 and dni = $_GET[buscar] order by apellido limit ". (($list->pagina) * $list->elementos). ", ". $list->elementos.";";

                    break;

                default:

                    break;


                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if($resultado != false && $resultado > 0){

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

        public function registrarEvaluacion($con){

            $total = $_POST['op'] + $_POST['op2'] + $_POST['op3'] + $_POST['op4'] + $_POST['op5'] + $_POST['op6'] + $_POST['op7'] + $_POST['op8'];

            $fecha = date('Y-m-d');

            $sql = "insert into evaluaciones(evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, evaluador, fecha_evaluacion, total) values ($_POST[id], $_POST[op], $_POST[op2], $_POST[op3], $_POST[op4], $_POST[op5], $_POST[op6], $_POST[op7], $_POST[op8], $_SESSION[trabajador], '$fecha', $total);";

            try {

                $resultado = $con->exec($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            header("Location: /App/home.php?ok");

        }

        public function getCalificaciones ($id, $con){

            $sql = "select pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8 from evaluaciones where evaluado = $id and evaluador = $this->id_jefe order by fecha_evaluacion asc limit 1;";

            try {

                $resultado = $con->query($sql);

            } catch(PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false && $resultado > 0){

                foreach($resultado as $registro){

                    $values = array(
                        'p1' => $registro['pregunta1'],
                        'p2' => $registro['pregunta2'],
                        'p3' => $registro['pregunta3'],
                        'p4' => $registro['pregunta4'],
                        'p5' => $registro['pregunta5'],
                        'p6' => $registro['pregunta6'],
                        'p7' => $registro['pregunta7'],
                        'p8' => $registro['pregunta8']
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                        'p7' => 0
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
                
                    break;

                case '15':
                
                    break;

                case '16':
                
                    break;
                
                case '17':
                
                    break;

                case '18':
                
                    break;

                case '19':
                
                    break;

                case '20':
                
                    break;

                case '21':
            
                    break;
                
                case '22':
                
                    break;

                case '23':
                
                    break;

                case '24':
                
                    break;

                case '25':
                
                    break;

                default:
                    
                    break;
            }

        }

    }

?>