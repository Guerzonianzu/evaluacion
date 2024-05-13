<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        require_once "Conexion.php";

        $con = new Conexion();

        $sql = "select id_formulario from formularios order by id_formulario desc limit 1;";

        $fecha = date('Y-m-d');

        $filename = "Evaluaciones-$fecha.csv";

        try{

            $resultado = $con->query($sql);
            
        } catch (PDOException $e){

            $con->bdError($e);
            die();

        }

        if($resultado != false){

            foreach($resultado as $registro){

                $form = $registro['id_formulario'];

            }

            $fp = fopen('php://output', 'w');

            header('Content-type:application/csv');
            header('Content-disposition: attachment; filename='.$filename);

            for($i = 1; $i <= $form; $i++){

                $header = array();

                    switch($i){

                        case 1:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organizacion del espacio de trabajo', 'Habilidades Comunicacionales', 'Trabajo en equipo', 'Empatía y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 2:

                            $header = array('Evaluado', 'Formacion Tecnica Específica en el servicio', 'Responsabilidad', 'Capacidad de innovacion e investigacion', 'Organizacion', 'Calidad de servicio / Seguimiento de proceso', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 3:

                            $header = array('Evaluado', 'Formacion tecnica específica en el servicio', 'Capacidad de innovacion e investigacion', 'Planificacion', 'Liderazgo', 'Orientacion al logro de los objetivos', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 4:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Responsabilidad', 'Productividad', 'Organizacion', 'Calidad de servicio / Seguimiento de proceso', 'Habilidades comunicacionales / trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 5:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organizacion del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatia y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 6:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organizacion del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 7:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Capacidad de innovacion e investigacion', 'Planificacion', 'Liderazgo', 'Orientacion al logro de objetivos', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 8:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Capacidad de innovacion e investigacion', 'Organizacion', 'Calidad de servicio / Seguimiento de proceso', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 9:

                            $header = array('Evaluado', 'Formacion tecnica específica en el servicio', 'Responsabilidad', 'Productividad', 'Organizacion', 'Calidad de servicio / Seguimiento de proceso', 'Habilidades comunicacionales / Trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 10:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organización en el espacio de trabajo', 'Comunicacion y trabajo en equipo', 'Manejo de herramientas e instrumenstación especifica', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 11:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Capacidad de innovacion e investigacion', 'Planificacion', 'Liderazgo', 'Orientacion al logro de objetivos', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 12:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Responsabilidad', 'Capacidad de innovacion e investigacion', 'Organizacion', 'Calidad de servicio / Seguimiento de proceso', 'Comunicacion y trabajo en equipo', 'Empatia y compromiso con la institucion', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 13:

                            $header = array('Evaluado', 'Productividad', 'Recibir y atender instrucciones', 'Seguimiento de proceso', 'Organizacion del espacio de trabajo', 'Habilidades comunicacionales', 'Trabajo en equipo', 'Empatia y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 14:

                            $header = array('Evaluado', 'Formacion tecnica específica en el servicio', 'Responsabilidad', 'Registros medicos / Historias Clinicas', 'Capacidad de innovacion e investigacion', 'Planeamiento y organizacion', 'Calidad de servicio', 'Empatía y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 15:

                            $header = array('Evaluado', 'Formacion tecnica específica en el servicio', 'Capacidad de innovacion e investigacion', 'Organizacion en la guardia', 'Calidad de servicio', 'Empatía y trato con el paciente', 'Comunicacion y trabajo en equipo', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 16:

                            $header = array('Evaluado', 'Formacion tecnica especifica en el servicio', 'Responsabilidad', 'Registros medicos / Historias clinicas', 'Capacidad de innovacion e investigacion', 'Organizacion', 'Calidad de servicio', 'Empatia y trato con el paciente', 'COMUNICACION TRABAJO EN EQUIPO', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 17:

                            $header = array('Evaluado', 'Formacion tecnica específica en el servicio', 'Capacidad de innovacion e investigacion', 'Planificacion', 'Liderazgo', 'Orientacion al logro de objetivos', 'Comunicacion y trabajo en equipo', 'Empatia y trato con el paciente', '', 'Formulario', 'Evaluador', 'Total');
                            break;
                            
                        case 18:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'PRODUCTIVIDAD', 'ORGANIZACION EN LA GUARDIA', 'CALIDAD DE SERVICIO', 'EMPATIA Y TRATO CON EL PACIENTE', 'COMUNICACION Y TRABAJO EN EQUIPO', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 19:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'PRODUCTIVIDAD', 'ORGANIZACION', 'CALIDAD DE SERVICIO', 'EMPATIA Y TRATO CON EL PACIENTE', 'COMUNICACION Y TRABAJO EN EQUIPO', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 20:

                            $header = array('Evaluado', 'PRODUCTIVIDAD', 'RECIBIR Y ATENDER INSTRUCCIONES', 'SEGUIMIENTO DE PROCESO', 'ORGANIZACION DEL ESPACIO DE TRABAJO', 'TRABAJO EN EQUIPO', 'EMPATÍA Y COMPROMISO CON LA INSTITUCION', '', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 21:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'ORGANIZACIÓN EN LA GUARDIA / ADMINISTRACION DE LOS RECURSOS Y MATERIALES', 'CALIDAD DE SERVICIO / PRESTAR ATENCION AL PACIENTE', 'SEGUIMIENTO DE ADECUADO DE PROTOCOLOS', 'EMPATIA Y TRATO CON EL PACIENTE', 'COMUNICACION Y TRABAJO EN EQUIPO', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 22:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'CAPACIDAD DE INVESTIGACION', 'DESARROLLO DE PROYECTOS', 'HABILIDADES COMUNICACIONALES', 'COMUNICACION Y TRABAJO EN EQUIPO', 'EMPATIA Y COMPROMISO CON LA INSTITUCION', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 23:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'CAPACIDAD DE INNOVACION E INVESTIGACION', 'PLANIFICACION DE PROYECTOS DE INVESTIGACION', 'LIDERAZGO', 'ORIENTACION AL LOGRO DE LOS OBJETIVOS', 'COMUNICACION Y TRABAJO EN EQUIPO', 'EMPATIA Y COMPROMISO CON LA INSTITUCION', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 24:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'CAPACIDAD DE INNOVACION E INVESTIGACION', 'PLANIFICACION', 'LIDERAZGO', 'ORIENTACION AL LOGRO DE LOS OBJETIVOS', 'COMUNICACION Y TRABAJO EN EQUIPO', 'EMPATIA Y TRATO CON EL PACIENTE', '', 'Formulario', 'Evaluador', 'Total');
                            break;

                        case 25:

                            $header = array('Evaluado', 'FORMACION TECNICA ESPECIFICA EN EL SERVICIO', 'RESPONSABILIDAD', 'PRODUCTIVIDAD', 'MANEJO DE HERRAMIENTAS E INSTRUMENTACION ESPECIFICAS', 'CALIDAD DE SERVICIO / SEGUIMIENTO DE PROCESOS', 'HABILIDADES COMUNICACIONALES / TRABAJO EN EQUIPO', 'EMPATIA Y COMPROMISO CON LA INSTITUCION', '', 'Formulario', 'Evaluador', 'Total');
                            break;
                            
                    }

                fputcsv($fp, $header);
                
                $sql = "select descripcion_form, concat(tra.nombre, ' ', tra.apellido) as evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, concat(tra2.nombre, ' ', tra2.apellido) as evaluador, total from evaluaciones evs join formularios form on evs.form = form.id_formulario join trabajadores tra on evs.evaluado = tra.id_trabajador join trabajadores tra2 on evs.evaluador = tra2.id_trabajador where fecha_evaluacion between '$_POST[inicio]' and '$_POST[fin]' and form = $i;";

                try{

                    $resultado = $con->query($sql);

                } catch (PDOException $e){

                    $con->bdError($e);
                    die();

                }

                if ($resultado != false){

                    foreach($resultado as $registro){
                        fputcsv($fp, array(
                            $registro['evaluado'], 
                            $registro['pregunta1'], 
                            $registro['pregunta2'], 
                            $registro['pregunta3'], 
                            $registro['pregunta4'], 
                            $registro['pregunta5'], 
                            $registro['pregunta6'], 
                            $registro['pregunta7'], 
                            $registro['pregunta8'], 
                            $registro['evaluador'], 
                            $registro['total']));
                    }
                    

                }

            }

        }

    }
?>