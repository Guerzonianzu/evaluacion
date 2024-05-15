<?php

    require_once 'Paginador.php';

    class Table{

        public function __construct(){

        }

        public static function selectForms($con){
            $sql = "select * from formularios;";
            try{
                $resultado = $con->query($sql);
            } catch (PDOException $e){
                $con->bdError($e);
                die();
            }
            if ($resultado != false){
                foreach ($resultado as $registro){
                    echo "
                        <option value=\"$registro[id_formulario]\">
                            $registro[descripcion_form]
                        </option>";
                }
            }
        }

        public static function resetForm(){
            if (isset($_GET['buscar'])){
                echo "<a href=\"evaluaciones.php\" class=\"btn btn-danger\">Reiniciar</a>";
            }
        }

        public static function getForms($con){
            $list = new Paginador();
            $sql = "select concat(tra.nombre, ' ', tra.apellido) as evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, fecha_evaluacion, total, concat(tra2.nombre, ' ', tra2.apellido) as evaluador from evaluaciones evs join trabajadores tra on tra.id_trabajador = evaluado join trabajadores tra2 on tra2.id_trabajador = evs.evaluador;";
            try{
                $resultado = $con->query($sql);
            } catch (PDOException $e){
                $con->bdError($e);
                die();
            }
            $max = $resultado->rowCount();
            $sql = "select concat(tra.nombre, ' ', tra.apellido) as evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, fecha_evaluacion, total, concat(tra2.nombre, ' ', tra2.apellido) as evaluador from evaluaciones evs join trabajadores tra on tra.id_trabajador = evaluado join trabajadores tra2 on tra2.id_trabajador = evs.evaluador limit ".(($list->pagina)*$list->elementos).", ".$list->elementos.";";
            try{
                $resultado = $con->query($sql);
            } catch(PDOException $e){
                $con->bdError($e);
                die();
            }
            if ($resultado != false){
                $list->paginado($max);
                echo 
                    "<table class=\"table\" style=\"border:1px;border-color:white\">
                        <thead>
                            <th>Evaluado</th>
                            <th colspan=\"8\"></th>
                            <th>Evaluador</th>
                            <th>Fecha de evaluación</th>
                            <th>Total</th>
                        </thead>";
                foreach($resultado as $registro){
                    echo
                        "<tbody>
                            <td>$registro[evaluado]</td>
                            <td>$registro[pregunta1]</td>
                            <td>$registro[pregunta2]</td>
                            <td>$registro[pregunta3]</td>
                            <td>$registro[pregunta4]</td>
                            <td>$registro[pregunta5]</td>
                            <td>$registro[pregunta6]</td>
                            <td>$registro[pregunta7]</td>
                            <td>$registro[pregunta8]</td>
                            <td>$registro[evaluador]</td>
                            <td>$registro[fecha_evaluacion]</td>
                            <td>$registro[total]</td>
                        </tbody>";
                }
                echo 
                    "</table>";
                
            }
        }

        public static function searchForms($con){
            $sql = "select concat(tra.nombre, ' ', tra.apellido) as evaluado, pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, pregunta6, pregunta7, pregunta8, fecha_evaluacion, total, concat(tra2.nombre, ' ', tra2.apellido) as evaluador from evaluaciones evs join trabajadores tra on tra.id_trabajador = evaluado join trabajadores tra2 on tra2.id_trabajador = evs.evaluador where form = $_GET[buscar];";
            try{
                $resultado = $con->query($sql);
            } catch (PDOException $e){
                $con->bdError($e);
                die();
            }
            if ($resultado != false){
                switch($_GET['buscar']){
                    case 1:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización del espacio de trabajo</th>
                                    <th>Habilidades Comunicacionales</th>
                                    <th>Trabajo en equipo</th>
                                    <th>Empatía y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 2:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación Tecnica Específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio / Seguimiento de proceso</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Fecha de evaluación</th>
                                    <th>Evaluador</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 3:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de los objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 4:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Productividad</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio / Seguimiento de proceso</th>
                                    <th>Habilidades comunicacionales / trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 5:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización del espacio de trabajo</th>
                                    <th>Habilidades comunicacionales</th>
                                    <th>Trabajo en equipo</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 6:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización del espacio de trabajo</th>
                                    <th>Habilidades comunicacionales</th>
                                    <th>Trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 7:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 8:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio / Seguimiento de proceso</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 9:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Productividad</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio / Seguimiento de proceso</th>
                                    <th>Habilidades comunicacionales / Trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 10:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización en el espacio de trabajo</th>
                                    <th>Comunicacion y trabajo en equipo</th>
                                    <th>Manejo de herramientas e instrumenstación especifica</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 11:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 12:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio / Seguimiento de proceso</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 13:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización del espacio de trabajo</th>
                                    <th>Habilidades comunicacionales</th>
                                    <th>Trabajo en equipo</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 14:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Registros medicos / Historias Clinicas</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planeamiento y organización</th>
                                    <th>Calidad de servicio</th>
                                    <th>Empatía y trato con el paciente</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 15:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Organización en la guardia</th>
                                    <th>Calidad de servicio</th>
                                    <th>Empatía y trato con el paciente</th>
                                    <th>Comunicacion y trabajo en equipo</th>
                                    <th></th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 16:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica especifica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Registros medicos / Historias clinicas</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th>Comunicación / Trabajo en equipo</th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 17:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 18:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formacion tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Productividad</th>
                                    <th>Organización en la guardia</th>
                                    <th>Calidad de servicio</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 19:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Productividad</th>
                                    <th>Organización</th>
                                    <th>Calidad de servicio</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th></th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 20:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Productividad</th>
                                    <th>Recibir y atender instrucciones</th>
                                    <th>Seguimiento de proceso</th>
                                    <th>Organización en el espacio de trabajo</th>
                                    <th>Trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 21:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Organización en la guardia / Administración de recursos y materiales</th>
                                    <th>Calidad de servicio / prestar atención al cliente</th>
                                    <th>Seguimiento apropiado de protocolos</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 22:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Capacidad de investigación</th>
                                    <th>Desarrollo de proyectos</th>
                                    <th>Habilidades comunicacionales</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 23:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación de proyectos de investigación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 24:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Capacidad de innovación e investigación</th>
                                    <th>Planificación</th>
                                    <th>Liderazgo</th>
                                    <th>Orientación al logro de objetivos</th>
                                    <th>Comunicación y trabajo en equipo</th>
                                    <th>Empatia y trato con el paciente</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                    case 25:
                        echo 
                            "<table>
                                <thead>
                                    <th>Evaluado</th>
                                    <th>Formación tecnica específica en el servicio</th>
                                    <th>Responsabilidad</th>
                                    <th>Productividad</th>
                                    <th>Manejo de herramientas e instrumentación especifica</th>
                                    <th>Calidad de servicio / seguimiento de procesos</th>
                                    <th>Habilidades comunicacionales / Trabajo en equipo</th>
                                    <th>Empatia y compromiso con la institución</th>
                                    <th></th>
                                    <th>Evaluador</th>
                                    <th>Fecha de evaluación</th>
                                    <th>Total</th>
                                </thead>";
                        break;
                }
                foreach($resultado as $registro){
                    echo
                        "<tbody>
                            <td>$registro[evaluado]</td>
                            <td>$registro[pregunta1]</td>
                            <td>$registro[pregunta2]</td>
                            <td>$registro[pregunta3]</td>
                            <td>$registro[pregunta4]</td>
                            <td>$registro[pregunta5]</td>
                            <td>$registro[pregunta6]</td>
                            <td>$registro[pregunta7]</td>
                            <td>$registro[pregunta8]</td>
                            <td>$registro[evaluador]</td>
                            <td>$registro[fecha_evaluacion]</td>
                            <td>$registro[total]</td>
                        </tbody>";
                }
                echo 
                    "</table>";
                
            }
        }

    }

?>