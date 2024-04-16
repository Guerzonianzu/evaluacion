<?php
    session_start();
    if($_SESSION['rol'] == 2){ 
        $id = $_GET['id'];
        require '../../conexion.php';
        $c = conectar();
        $sql = "select * from evaluaciones where evaluado = $id";
        $resultado = mysqli_query($c, $sql);
        while($registro = mysqli_fetch_assoc($resultado)){
            $p1 = $registro['pregunta1'];
            $p2 = $registro['pregunta2'];
            $p3 = $registro['pregunta3'];
            $p4 = $registro['pregunta4'];
            $p5 = $registro['pregunta5'];
            $p6 = $registro['pregunta6'];
            $p7 = $registro['pregunta7'];
            $p8 = $registro['pregunta8'];
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RRHH016-P-ED-DOCENCIA</title>
            <link rel="stylesheet" href="../../style/estilo.css">
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../../subpages/main.php"><img src="../img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../../subpages/main.php">Inicio<span class="sr-only">(current)</span></a>
                        </li>               
                    </ul>
                </div>
                <div class="justify-content-end">
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="salida.php"><button class="btn btn-primary">Cerrar sesion</button></a>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DOCENCIA ÉTICA APLICADA E INVESTIGACIÓN - PROFESIONALES GENERALES</b></h1>
                    <p>Datos del prestador:</p>
                    <?php
                        $sql = "select * from trabajadores where id_trabajador = $id";
                        $resultado = mysqli_query($c, $sql);
                        if(mysqli_affected_rows($c) > 0){
                            while($registro = mysqli_fetch_assoc($resultado)){?>
                                <div class="col" style="margin-top: 10px"><p><b>Nombre: <?php echo "$registro[nombre]"; ?></b></p></div>
                                <div class="col" style="margin-top: 10px"><p><b>Apellido: <?php echo "$registro[apellido]"; ?></b></p></div>
                                <div class="col" style="margin-top: 10px"><p><b>DNI: <?php echo "$registro[DNI]"; ?></b></p></div>
                            <?php
                            }
                        }
                    ?>
                </div>
                <form method="POST" action="../envios.php">
                    <div class="row">
                        <h3>1.	FORMACIÓN TÉCNICA ESPECÍFICA EN EL SERVICIO: Es la que aborda los saberes técnicos específicos propios de cada campo, así como también la contextualización de los contenidos desarrollados en la formación científico-tecnológica de acuerdo a la función a desempeñar y al Servicio del que forma parte.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p1){
                                    
                                    case 40:
                                        echo "Excelente.";
                                        break;

                                    case 32:
                                        echo "Muy bueno.";
                                        break;

                                    case 24:
                                        echo "Bueno.";
                                        break;

                                    case 16:
                                        echo "Regular.";
                                        break;

                                    case 8:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>2.	RESPONSABILIDAD: Cualidad que tiene la persona de cumplir con exactitud y seriedad sus funciones y compromisos laborales, demuestra esfuerzo, dedicación y preocupación por el trabajo. Cumple su asistencia completa y horario convenido.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p2){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>3.	CAPACIDAD DE INVESTIGACIÓN: Formación y metodología de investigación, capacidad de análisis e implementación de instrumentos capaces de validar científicamente las prácticas en salud.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p3){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>4.	DESARROLLO DE PROYECTOS: Capacidad para desarrollar proyectos de investigación, proyectos de formación y capacitación y docencia del Hospital.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p4){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>5.	HABILIDADES COMUNICACIONALES: Habilidad para asegurar que las tareas que se realizan sean de acuerdo con los procesos estandarizados que garanticen las soluciones a las problemáticas y que esto conlleve a la máxima satisfacción de los/las pacientes que concurren al Hospital, en el marco de un proceso de mejora continua, planteando ideas para tender a la mejora continua.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p5){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>6.	COMUNICACIÓN Y TRABAJO EN EQUIPO: La comunicación dentro del Servicio y su vinculación con los demás Servicios que intervienen en el Hospital hacen al logro de la mejor calidad de servicio para nuestros/as pacientes. Así como el trabajo en equipo fortalece a cada integrante desarrollando su función en cada Servicio de para cumplir con los objetivos cada une y en conjuntos del Hospital.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p6){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>7.	EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN: Comprende la misión y valores del Hospital, así como el rol social y la trascendencia que cumple el Hospital en la comunidad. Se muestra motivado y empático con el público y las personas con las que se vincula dentro de la Institución.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php 
                                switch($p7){
                                    
                                    case 10:
                                        echo "Excelente.";
                                        break;

                                    case 8:
                                        echo "Muy bueno.";
                                        break;

                                    case 6:
                                        echo "Bueno.";
                                        break;

                                    case 4:
                                        echo "Regular.";
                                        break;

                                    case 2:
                                        echo "Deficiente.";
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                </form>
                <?php
                    mysqli_close($c);
                ?>
            </div>
        </body>
        </html>
    <?php
    } else {
        header("Location: ../subpages/noAutorizado.html");
    }
?>