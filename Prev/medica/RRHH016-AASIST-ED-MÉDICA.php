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
            <title>RRHH016-AASIST-ED-MÉDICA</title>
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
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DE MÉDICA - AUXILIARES ADMINISTRATIVOS ASISTENCIALES. </b></h1>
                    <p>Datos del prestador:</p>
                    <?php
                        $sql = "select * from trabajadores where id_trabajador = $id";
                        $resultado = mysqli_query($c, $sql);
                        if(mysqli_affected_rows($c) > 0){
                            while($registro = mysqli_fetch_assoc($resultado)){ ?>
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
                        <h3>1.	PRODUCTIVIDAD: Capacidad de generar resultados con la calidad esperada y en el tiempo oportuno, a fin de lograr los objetivos y metas propuestas. Habilidad para resolver los problemas planteados en su Servicio en tiempo y forma, realizando las tareas asignadas con la calidad de servicio.</h3>
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
                        <h3>2.	RECIBIR Y ATENDER INSTRUCCIONES: Capacidad para comprender, así como cumplir con atención y disciplina las instrucciones de trabajo, colaborando en todo lo posible o visualización de posibilidades de mejora.</h3>
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
                    <div class="row";>
                        <h3>3.	SEGUIMIENTO DE PROCESO: Compromiso individual, consciente y sistemático de las diversas normas y procedimientos establecidos, para el desempeño específico de cada trabajadora y trabajador dentro de cada proceso del Hospital, y que asegura la mejor calidad de servicio y agrega valor a la organización.</h3>
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
                        <h3>4.	ORGANIZACIÓN DEL ESPACIO DE TRABAJO: Habilidad para organizar el espacio de trabajo eficazmente y de acuerdo a los lineamientos institucionales, manteniendo orden y la limpieza. Transformación agradable del espacio físico para que sea un sitio agradable y actué como elemento motivacional.</h3>
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
                        <h3>5.	HABILIDADES COMUNICACIONALES: La comunicación dentro del Servicio y su vinculación con los demás Servicios que intervienen en el Hospital hacen al logro de la mejor calidad de servicio para nuestros/as pacientes.</h3>
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
                        <h3>6.	TRABAJO EN EQUIPO: El trabajo en equipo fortalece a cada integrante, desarrollando su función correctamente para el cumplimiento de los objetivos de su Servicio y del Hospital.</h3>
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
                        <h3>7.	EMPATÍA Y TRATO CON EL PACIENTE: Conocimiento y aplicación de la Ley 26.529 de Derechos del Paciente en su Relación con los Profesionales e Instituciones de la Salud. Asimismo, la habilidad para sentir empatía por el paciente que es la comprensión de sus emociones, perspectivas y experiencias.</h3>
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