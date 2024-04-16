<?php
    session_start();
    if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1){ 
        
        $id = $_GET['id'];
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RRHH016-A-ED-ADMINISTRACIÓN</title>
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
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DE ADMINISTRACIÓN - AUXILIARES ADMINISTRATIVOS/AS</b></h1>
                    <p>Datos del prestador:</p>
                </div>
                <form method="POST" action="../envios.php">
                    <div class="row">
                        <h3>1.	PRODUCTIVIDAD: Capacidad de generar resultados con la calidad esperada y en el tiempo oportuno, a fin de lograr los objetivos y metas propuestas. Habilidad para resolver los problemas planteados en su Servicio en tiempo y forma, realizando las tareas asignadas con la calidad de servicio.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>2.	RECIBIR Y ATENDER INSTRUCCIONES: Capacidad para comprender, así como cumplir con atención y disciplina las instrucciones de trabajo, colaborando en todo lo posible o visualización de posibilidades de mejora.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>3.	SEGUIMIENTO DE PROCESO: Compromiso individual, consciente y sistemático de las diversas normas y procedimientos establecidos, para el desempeño específico de cada trabajadora y trabajador dentro de cada proceso del Hospital, y que asegura la mejor calidad de servicio y agrega valor a la organización.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>4.	ORGANIZACIÓN DEL ESPACIO DE TRABAJO: Habilidad para organizar el espacio de trabajo eficazmente y de acuerdo a los lineamientos institucionales, manteniendo orden y la limpieza. Transformación agradable del espacio físico para que sea un sitio agradable y actué como elemento motivacional.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>5.	HABILIDADES COMUNICACIONALES: La comunicación dentro del Servicio y su vinculación con los demás Servicios que intervienen en el Hospital hacen al logro de la mejor calidad de servicio para nuestros/as pacientes.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>6.	TRABAJO EN EQUIPO: El trabajo en equipo fortalece a cada integrante, desarrollando su función correctamente para el cumplimiento de los objetivos de su Servicio y del Hospital.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                    <div class="row">
                        <h3>7.	EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN: Comprende la misión y valores del Hospital, así como el rol social y la trascendencia que cumple el Hospital en la comunidad. Se muestra motivado y empático con el público y las personas con las que se vincula dentro de la Institución.</h3>
                    </div>
                    <div class="row">
                        <p>
                            <b>CALIFICACION:</b>
                        </p>
                    </div>
                </form>

            </div>
        </body>
        </html>
    <?php
    } else {
        header("Location: ../subpages/noAutorizado.html");
    }
?>