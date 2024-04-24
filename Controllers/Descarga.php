<?php

    class Descarga{

        private $f_inicio;

        private $f_fin;

        public function construct(){

            $this->f_inicio = $_POST['f_inicio'];

            $this->f_fin = $_POST['f_fin'];

        }

        public function download($con){

            $sql = "select evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, evaluador from evaluaciones evs join trabajadores tra on evs.evaluado = tra.id_trabajador where fecha_evaluacion between '$this->f_inicio' and '$this->f_fin';";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            if ($resultado != false){

                $out = fopen('php://output', 'w');

                foreach ($resultado as $registro){

                    $evaluado = $registro['evaluado'];
                    $p1 = $registro['pregunta1'];
                    $p2 = $registro['pregunta2'];
                    $p3 = $registro['pregunta3'];
                    $p4 = $registro['pregunta4'];
                    $p5 = $registro['pregunta5'];
                    $p6 = $registro['pregunta6'];
                    $p7 = $registro['pregunta7'];
                    $p8 = $registro['pregunta8'];
                    $evaluador = $registro['evaluador'];
    
                    $sql = "select concat(nombre, ' ', apellido) as nombre from trabajadores tra join evaluaciones evs on evs.evaluado = tra.id_trabajador where id_trabajador = $evaluado;";

                    try{

                        $resultado = $con->query($sql);

                    } catch(PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if ($resultado != false){

                        foreach($resultado as $registro){

                            $evaluado = $registro['nombre'];
    
                        }

                    }

                    $sql = "select concat(nombre, ' ', apellido) as nombre from trabajadores tra join evaluaciones evs on evs.evaluador = tra.id_trabajador where id_trabajador = $evaluador;";

                    try{

                        $resultado = $con->query($sql);

                    } catch(PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if ($resultado != false){

                        foreach ($resultado as $registro){

                            $evaluador = $registro['nombre'];

                        }

                    }

                    $evaluacion = array('evaluado' =>$evaluado,
                                        'p1' => $p1,
                                        'p2' => $p2,
                                        'p3' => $p3,
                                        'p4' => $p4,
                                        'p5' => $p5,
                                        'p6' => $p6,
                                        'p7' => $p7,
                                        'p8' => $p8,
                                        'evaluador' => $evaluador);

                    //unset($evaluador, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $evaluador);

                    fputcsv($out,$evaluacion, ",", '"');

                }

                fclose($out);

            } else {

                echo "
                    <div class=\"alert alert-danger\" role=\"alert\">
                        <p>No se han encontrado evaluaciones en ese rango de fechas.</p>
                    </div>";

            }

            
        }

    }

?>