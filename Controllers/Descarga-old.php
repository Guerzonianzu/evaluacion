<?php

    class Descarga{

        private $f_inicio;

        private $f_fin;

        public function construct(){

            $this->f_inicio = date('Y-m-d', $_POST['inicio']);

            $this->f_fin = date('Y-m-d', $_POST['fin']);

        }

        public function download($con){

            $sql = "select id_formulario from formularios order by id_formulario desc limit 1;";

            try{

                $resultado = $con->query($sql);

            } catch (PDOException $e){

                $con->bdError($e);
                die();

            }

            $filename = "Evaluaciones.csv";

            if ($resultado != false){

                foreach($resultado as $registro){

                    $form = $registro['id_formulario'];

                }

                $fp = fopen('php://output', 'w');

                header('Content-type: application/csv');
                header('Content-disposition: attachment; filename='.$filename);

                for($i = 1; $i <= $form; $i++){

                    $header = array();

                    switch($i){

                        case 1:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización del espacio de trabajo', 'Habilidades Comunicacionales', 'Trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 2:

                            $header = array('Evaluado', 'Formación Técnica Específica en el servicio', 'Responsabilidad', 'Capacidad de innovación e investigación', 'Organización', 'Calidad de servicio / Seguimiento de proceso', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 3:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Planificación', 'Liderazgo', 'Orientación al logro de los objetivos', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 4:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Responsabilidad', 'Productividad', 'Organización', 'Calidad de servicio / Seguimiento de proceso', 'Habilidades comunicacionales / trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 5:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatía y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 6:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 7:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Planificación', 'Liderazgo', 'Orientación al logro de objetivos', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 8:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Organización', 'Calidad de servicio / Seguimiento de proceso', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 9:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Responsabilidad', 'Productividad', 'Organización', 'Calidad de servicio / Seguimiento de proceso', 'Habilidades comunicacionales / Trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 10:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización en el espacio de trabajo', 'Comunicación y trabajo en equipo', 'Manejo de herramientas e instrumenstación específica', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 11:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Planificación', 'Liderazgo', 'Orientación al logro de objetivos', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 12:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Responsabilidad', 'Capacidad de innovación e investigación', 'Organización', 'Calidad de servicio / Seguimiento de proceso', 'Comunicación y trabajo en equipo', 'Empatía y compromiso con la institución', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 13:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatía y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 14:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Responsabilidad', 'Registros médicos / Historias Clínicas', 'Capacidad de innovación e investigación', 'Planeamiento y organización', 'Calidad de servicio', 'Empatía y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 15:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Organización en la guardia', 'Calidad de servicio', 'Empatía y trato con el paciente', 'Comunicación y trabajo en equipo', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 16:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Responsabilidad', 'Registros médicos / Historias clínicas', 'Capacidad de innovación e investigación', 'Organización', 'Calidad de servicio', 'Empatía y trato con el paciente', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 17:

                            $header = array('Evaluado', 'Formación técnica específica en el servicio', 'Capacidad de innovación e investigación', 'Planificación', 'Liderazgo', 'Orientación al logro de objetivos', 'Comunicación y trabajo en equipo', 'Empatía y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;
                            
                        case 18:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'PRODUCTIVIDAD', 'ORGANIZACIÓN EN LA GUARDIA', 'CALIDAD DE SERVICIO', 'EMPATÍA Y TRATO CON EL PACIENTE', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 19:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'PRODUCTIVIDAD', 'ORGANIZACIÓN', 'CALIDAD DE SERVICIO', 'EMPATÍA Y TRATO CON EL PACIENTE', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 20:

                            $header = array('Evaluado', 'PRODUCTIVIDAD', 'RECIBIR Y ATENDER INSTRUCCIONES', 'SEGUIMIENTO DE PROCESO', 'ORGANIZACIÓN DEL ESPACIO DE TRABAJO', 'TRABAJO EN EQUIPO', 'EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 21:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'ORGANIZACIÓN EN LA GUARDIA / ADMINISTRACIÓN DE LOS RECURSOS Y MATERIALES', 'CALIDAD DE SERVICIO / PRESTAR ATENCIÓN AL PACIENTE', 'SEGUIMIENTO DE ADECUADO DE PROTOCOLOS', 'EMPATÍA Y TRATO CON EL PACIENTE', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 22:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'CAPACIDAD DE INVESTIGACIÓN', 'DESARROLLO DE PROYECTOS', 'HABILIDADES COMUNICACIONALES', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', 'EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 23:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'CAPACIDAD DE INNOVACIÓN E INVESTIGACIÓN', 'PLANIFICACIÓN DE PROYECTOS DE INVESTIGACIÓN', 'LIDERAZGO', 'ORIENTACIÓN AL LOGRO DE LOS OBJETIVOS', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', 'EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 24:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'CAPACIDAD DE INNOVACIÓN E INVESTIGACIÓN', 'PLANIFICACIÓN', 'LIDERAZGO', 'ORIENTACIÓN AL LOGRO DE LOS OBJETIVOS', 'COMUNICACIÓN Y TRABAJO EN EQUIPO', 'EMPATÍA Y TRATO CON EL PACIENTE', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 25:

                            $header = array('Evaluado', 'FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'PRODUCTIVIDAD', 'MANEJO DE HERRAMIENTAS E INSTRUMENTACIÓN ESPECÍFICAS', 'CALIDAD DE SERVICIO / SEGUIMIENTO DE PROCESOS', 'HABILIDADES COMUNICACIONALES / TRABAJO EN EQUIPO', 'EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN', '', 'Formulario', 'Evaluador', 'Total');
                            break;
                            
                    }

                    fputcsv($fp, $header);

                    $sql = "select evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, descripcion_formulario, evaluador, total from evaluaciones evs join formularios form on evs.form = form.id_formulario where fecha_evaluacion between '$this->f_inicio' and '$this->f_fin' and form = $i;";

                    try{

                        $resultado = $con->query($sql);

                    } catch (PDOException $e){

                        $con->bdError($e);
                        die();

                    }

                    if ($resultado != false){

                        foreach($resultado as $registro){

                            fputcsv($fp, $registro);

                        }

                    }

                }

            }

        }

    }

?>