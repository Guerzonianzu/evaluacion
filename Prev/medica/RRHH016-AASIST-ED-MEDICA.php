<?php
    session_start();
    if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1){ 
        
        include "../../Controllers/Conexion.php";
        include "../../Controllers/Forms.php";
        
        $id = $_GET['id'];
        $con = Conexion::conectar();
        $form = new Forms;
        $values = $form->showCalificaciones($id, $con);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RRHH016-AASIST-ED-MÉDICA</title>
            <link rel="stylesheet" href="../../Style/estilo.css">
        </head>
        <body>
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../../App/home.php"><img src="../../Img/hcank.png" width="70px" heigth="50px" alt="inicio"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                </div>
                <div class="justify-content-end">                        
                    <?php
                        echo "$_SESSION[apellido] $_SESSION[nombre]";
                    ?>
                    <a href="../../App/logout.php" class="btn btn-primary">Cerrar Sesion</a>
                </div>
            </nav>

            <div class="container">
                
                <div class="row">
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DE MÉDICA - AUXILIARES ADMINISTRATIVOS ASISTENCIALES. </b></h1>
                </div>
                
                <div class="row">

                    <div class="col">

                        <p>Datos del trabajador/a:</p>

                        <?php

                            $form->prestador($id, $con);

                        ?>

                    </div>

                    <div class="col">

                        <p>Datos del evaluador/a:</p>

                        <?php

                            $form->evaluador($id, $con);

                        ?>

                    </div>
                    
                </div>

                <form method="POST">
                    <div class="row">
                        <h3>1.	PRODUCTIVIDAD: Capacidad de generar resultados con la calidad esperada y en el tiempo oportuno, a fin de lograr los objetivos y metas propuestas. Habilidad para resolver los problemas planteados en su Servicio en tiempo y forma, realizando las tareas asignadas con la calidad de servicio.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p1']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>2.	RECIBIR Y ATENDER INSTRUCCIONES: Capacidad para comprender, así como cumplir con atención y disciplina las instrucciones de trabajo, colaborando en todo lo posible o visualización de posibilidades de mejora.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p2']; ?>
                        </p>
                    </div>
                    <div class="row";>
                        <h3>3.	SEGUIMIENTO DE PROCESO: Compromiso individual, consciente y sistemático de las diversas normas y procedimientos establecidos, para el desempeño específico de cada trabajadora y trabajador dentro de cada proceso del Hospital, y que asegura la mejor calidad de servicio y agrega valor a la organización.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p3']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>4.	ORGANIZACIÓN DEL ESPACIO DE TRABAJO: Habilidad para organizar el espacio de trabajo eficazmente y de acuerdo a los lineamientos institucionales, manteniendo orden y la limpieza. Transformación agradable del espacio físico para que sea un sitio agradable y actué como elemento motivacional.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p4']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>5.	HABILIDADES COMUNICACIONALES: La comunicación dentro del Servicio y su vinculación con los demás Servicios que intervienen en el Hospital hacen al logro de la mejor calidad de servicio para nuestros/as pacientes.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p5']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>6.	TRABAJO EN EQUIPO: El trabajo en equipo fortalece a cada integrante, desarrollando su función correctamente para el cumplimiento de los objetivos de su Servicio y del Hospital.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p6']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <h3>7.	EMPATÍA Y TRATO CON EL PACIENTE: Conocimiento y aplicación de la Ley 26.529 de Derechos del Paciente en su Relación con los Profesionales e Instituciones de la Salud. Asimismo, la habilidad para sentir empatía por el paciente que es la comprensión de sus emociones, perspectivas y experiencias.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                            <?php echo $values['p7']; ?>
                        </p>
                    </div>
                </form>

                <?php

                    if($_SESSION['rol'] == 1){

                        echo "<p><b>Resultado:</b></p>";
                        Forms::ponderacion($values['total']);

                        echo "
                            <div class=\"row mt-5\">
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>
                                    <p>Firma del evaluador/a</p>
                                </div>
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>
                                            <p>Aclaración</p>
                                </div>
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>        
                                                <p>DNI</p>
                                </div>
                            </div>";

                            echo "
                            <div class=\"row mt-5\">
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>
                                    <p>Firma del evaluado/a</p>
                                </div>
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>
                                            <p>Aclaración</p>
                                </div>
                                <div class=\"col\">
                                    <p>----------------------</p>
                                    <br>        
                                                <p>DNI</p>
                                </div>
                            </div>";
                        

                    }
                

                ?>
                
            </div>
        </body>
        </html>
    <?php
    } else {
        header("Location: ../subpages/noAutorizado.html");
    }
?>