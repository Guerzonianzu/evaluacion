<?php

    include "Conexion.php";

    session_start();

    if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){

        $con = Conexion::conectar();

        $id = $_POST['id'];

        $sql = "select formulario, estado from trabajadores where id_trabajador = $_POST[id];";

        try{

            $resultado = $con->query($sql);

        } catch (PDOException $e){

            $con->bdError($e);
            die();

        }

        if ($resultado != false && $resultado > 0){

            foreach ($resultado as $registro){

                $form = $registro['formulario'];
                $estado = $registro['estado'];

            }

            if ($estado == 1){

                switch($form){

                    case 1:
                        header("Location: /Eval/administracion/RRHH016-A-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 2:
                        header("Location: /Eval/administracion/RRHH016-P-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 3:
                        header("Location: /Eval/administracion/RRHH016-PJQCO-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 4:
                        header("Location: /Eval/administracion/RRHH016-T-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 5:
                        header("Location: /Eval/ejecutiva/RRHH016-AASIST-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 6:
                        header("Location: /Eval/ejecutiva/RRHH016-A-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 7:
                        header("Location: /Eval/ejecutiva/RRHH016-PJQCO-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 8:
                        header("Location: /Eval/ejecutiva/RRHH016-PMS-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 9:
                        header("Location: /Eval/ejecutiva/RRHH016-TSM-ED-EJECUTIVA.php?id=$id");
                        break;
                        
                    case 10:
                        header("Location: /Eval/infraestructura/RRHH016-A-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 11:
                        header("Location: /Eval/infraestructura/RRHH016-PJQCO-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 12:
                        header("Location: /Eval/infraestructura/RRHH016-PMS-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 25:
                        header("Location: /Eval/infraestructura/RRHH016-TSM-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
                        
                    case 13:    
                        header("Location: /Eval/medica/RRHH016-AASIST-ED-MEDICA.php?id=$id");
                        break;
        
                    case 14:
                        header("Location: /Eval/medica/RRHH016-PE-ED-MEDICA.php?id=$id");
                        break;
        
                    case 15:
                        header("Location: /Eval/medica/RRHH016-PG-ED-MEDICA.php?id=$id");
                        break;
        
                    case 16:
                        header("Location: /Eval/medica/RRHH016-PHS-ED-MEDICA.php?id=$id");
                        break;
        
                    case 17:
                        header("Location: /Eval/medica/RRHH016-PJQCO-ED-MEDICA.php?id=$id");
                        break;
        
                    case 18:
                        header("Location: /Eval/medica/RRHH016-TGM-ED-MEDICA.php?id=$id");
                        break;
        
                    case 19:
                        header("Location: /Eval/medica/RRHH016-TSM-ED-MEDICA.php?id=$id");
                        break;
        
                    case 20:
                        header("Location: /Eval/docencia/RRHH016-A-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 21:
                        header("Location: /Eval/enfermeria/RRHH016-E-ED-ENFERMERIA.php?id=$id");
                        break;
        
                    case 22:
                        header("Location: /Eval/docencia/RRHH016-P-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 23:
                        header("Location: /Eval/docencia/RRHH016-PJQCO-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 24:
                        header("Location: /Eval/enfermeria/RRHH016-PJQCO-ED-ENFERMERIA.php?id=$id");
                        break;

                    case 25:
                        header("Location: /Eval/infraestructura/RRHH016-TSM-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    default:
                        echo "Llamar a sistemas interno 1017";
                        echo "$form";

                }

            } elseif ($estado == 0) {

                switch($form){
                
                    case 1:
                        header("Location: /Prev/administracion/RRHH016-A-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 2:
                        header("Location: /Prev/administracion/RRHH016-P-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 3:
                        header("Location: /Prev/administracion/RRHH016-PJQCO-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 4:
                        header("Location: /Prev/administracion/RRHH016-T-ED-ADMINISTRACION.php?id=$id");
                        break;
        
                    case 5:
                        header("Location: /Prev/ejecutiva/RRHH016-AASIST-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 6:
                        header("Location: /Prev/ejecutiva/RRHH016-A-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 7:
                        header("Location: /Prev/ejecutiva/RRHH016-PJQCO-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 8:
                        header("Location: /Prev/ejecutiva/RRHH016-PMS-ED-EJECUTIVA.php?id=$id");
                        break;
        
                    case 9:
                        header("Location: /Prev/ejecutiva/RRHH016-TSM-ED-EJECUTIVA.php?id=$id");
                        break;
                        
                    case 10:
                        header("Location: /Prev/infraestructura/RRHH016-A-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 11:
                        header("Location: /Prev/infraestructura/RRHH016-PJQCO-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 12:
                        header("Location: /Prev/infraestructura/RRHH016-PMS-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    case 25:
                        header("Location: /Prev/infraestructura/RRHH016-TSM-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
                        
                    case 13:    
                        header("Location: /Prev/medica/RRHH016-AASIST-ED-MEDICA.php?id=$id");
                        break;
        
                    case 14:
                        header("Location: /Prev/medica/RRHH016-PE-ED-MEDICA.php?id=$id");
                        break;
        
                    case 15:
                        header("Location: /Prev/medica/RRHH016-PG-ED-MEDICA.php?id=$id");
                        break;
        
                    case 16:
                        header("Location: /Prev/medica/RRHH016-PHS-ED-MEDICA.php?id=$id");
                        break;
        
                    case 17:
                        header("Location: /Prev/medica/RRHH016-PJQCO-ED-MEDICA.php?id=$id");
                        break;
        
                    case 18:
                        header("Location: /Prev/medica/RRHH016-TGM-ED-MEDICA.php?id=$id");
                        break;
        
                    case 19:
                        header("Location: /Prev/medica/RRHH016-TSM-ED-MEDICA.php?id=$id");
                        break;
        
                    case 20:
                        header("Location: /Prev/docencia/RRHH016-A-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 21:
                        header("Location: /Prev/enfermeria/RRHH016-E-ED-ENFERMERIA.php?id=$id");
                        break;
        
                    case 22:
                        header("Location: /Prev/docencia/RRHH016-P-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 23:
                        header("Location: /Prev/docencia/RRHH016-PJQCO-ED-DOCENCIA.php?id=$id");
                        break;
        
                    case 24:
                        header("Location: /Prev/enfermeria/RRHH016-PJQCO-ED-ENFERMERIA.php?id=$id");
                        break;

                    case 25:
                        header("Location: /Prev/infraestructura/RRHH016-TSM-ED-INFRAESTRUCTURA.php?id=$id");
                        break;
        
                    default:
                        echo "Llamar a sistemas interno 1017";
                        echo "$form";
                }

            } else {

                echo "
                    <div class=\"alert alert-danger\">
                        <p>No se ha encontrado el registro. Redirigiendo a la pagina de inicio, si no lo redirige haga clic <a href=\"/App/home.php\">aquí</a></p>
                    </div>";
                
                header("refresh:5;url=/App/home.php");

            }

        }

    } else {

        header("Location:/index.php");

    }

?>