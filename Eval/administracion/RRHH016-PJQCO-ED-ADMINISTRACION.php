<?php
    session_start();
    if($_SESSION['rol'] == 2){ 
        $id = $_GET['id'];
        include "../../Controllers/Conexion.php";
        include "../../Controllers/Forms.php";

        $con = Conexion::conectar();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RRHH016-PJQCO-ED-ADMINISTRACION</title>
            <link rel="stylesheet" href="/style/estilo.css">
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="/Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="justify-content-end">                        
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="/App/logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DE ADMINISTRACIÓN - PERSONAL JERÁRQUICO.</b></h1>
                    <h3>Datos del prestador:</h3>
                </div>

                <div class="row">
                    <?php

                        if(isset($_POST['op']) && isset($_POST['op2']) && isset($_POST['op3']) && isset($_POST['op4']) && isset($_POST['op5']) && isset($_POST['op6']) && isset($_POST['op7']) && isset($_POST['op8'])){

                            $form = new Forms();
                            
                            $form->registrarEvaluacion($con);

                        }

                        Forms::prestador($id, $con);

                    ?>
                </div>

                <form method="POST">
                    <div class="row">
                        <h3>1.	FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO: Es la que aborda los saberes técnicos específicos propios de cada campo, así como también la contextualización de los contenidos desarrollados en la formación científico-tecnológica de acuerdo a la función a desempeñar y al Servicio del que forma parte.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op' value="40" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op' value="32" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op' value="24" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op' value="16" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op' value="8" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row";>
                        <h3>2.	CAPACIDAD DE INNOVACIÓN E INVESTIGACIÓN: Curiosidad, agilidad y capacidad de aprendizaje, permeabilidad al cambio y desarrollo tecnológico, en constante evolución. Capacidad para fomentar la investigación y nuevos proyectos, así como la innovación y adaptación a los cambios.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op2' value="10" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op2' value="8" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op2' value="6" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op2' value="4" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op2' value="2" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row";>
                        <h3>3.	PLANIFICACIÓN: Habilidad para organizar las actividades y recursos, siguiendo un proceso ordenado en su ejecución, optimizando tiempos y maximizando la eficiencia y eficacia de la Institución. Administración del tiempo.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="5" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="4" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="3" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="2" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="1" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>4.	LIDERAZGO: Habilidad para influir en el personal, dar instrucciones y conducir exitosamente las actividades del grupo, hacia el logro de los objetivos fijados.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op4' value="10" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op4' value="8" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op4' value="6" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op4' value="4" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op4' value="2" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>5.	ORIENTACIÓN AL LOGRO DE LOS OBJETIVOS: Es la habilidad para coordinar los diferentes recursos humanos y materiales asignados a su Servicio para alcanzar los resultados de rendimiento previamente establecidos en función de la actividad individual y colectiva. </h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="20" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="16" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="12" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="8" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="4" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>6.	COMUNICACIÓN Y TRABAJO EN EQUIPO: La comunicación dentro del Servicio y su vinculación con los demás Servicios que intervienen en el Hospital hacen al logro de la mejor calidad de servicio para nuestros/as pacientes. Así como el trabajo en equipo fortalece a cada integrante desarrollando su función en cada Servicio de para cumplir con los objetivos cada une y en conjuntos del Hospital.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op6' value="10" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op6' value="8" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op6' value="6" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op6' value="4" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op6' value="2" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>7.	EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN: Comprende la misión y valores del Hospital, así como el rol social y la trascendencia que cumple el Hospital en la comunidad. Se muestra motivado y empático con el público y las personas con las que se vincula dentro de la Institución.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op7' value="5" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op7' value="4" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op7' value="3" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op7' value="2" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op7' value="1" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                    <input type="hidden" name="op8" value="0">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </form>
                
            </div>
        </body>
        </html>
    <?php
    } else {
        header("Location: ../subpages/noAutorizado.html");
    }
?>