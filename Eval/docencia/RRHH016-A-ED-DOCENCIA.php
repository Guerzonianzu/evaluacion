<?php
    session_start();
    if($_SESSION['rol'] == 2){ 
        $id = $_GET['id'];
        require '../../conexion.php';
        $c = conectar();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RRHH016-A-ED-DOCENCIA</title>
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
                    <h1><b>EVALUACIÓN DE DESEMPEÑO DIRECCIÓN DE DOCENCIA, ÉTICA APLICADA E INVESTIGACIÓN - AUXILIARES ADMINISTRATIVOS/AS</b></h1>
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
                        <h3>1.	PRODUCTIVIDAD: Capacidad de promover producción científica/clínica que redunde en mejorar la calidad de la atención al paciente. Habilidad para resolver los problemas planteados en su Servicio en tiempo y forma, realizando las tareas asignada.</h3>
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
                    <div class="row">
                        <h3>2.	RECIBIR Y ATENDER INSTRUCCIONES: Capacidad para comprender, así como cumplir con atención y disciplina las instrucciones de trabajo, colaborando en todo lo posible o visualización de posibilidades de mejora.</h3>
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
                        <h3>3.	SEGUIMIENTO DE PROCESO: : Compromiso individual respecto del cumplimiento de las diversas normas y procedimientos establecidos, para el desempeño institucional de cada trabajadora y trabajador dentro de cada área del Hospital, y que asegura la mejor calidad de atención, la cual agrega valor organizacional.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="10" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="8" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="6" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="4" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op3' value="2" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>4.	ORGANIZACIÓN DEL ESPACIO DE TRABAJO: Habilidad para organizar el espacio de trabajo eficazmente y de acuerdo a los lineamientos institucionales, manteniendo orden y la limpieza. Transformación agradable del espacio físico para que sea un sitio agradable y actué como elemento motivacional.</h3>
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
                        <h3>5.	TRABAJO EN EQUIPO: El trabajo en equipo fortalece a cada integrante, desarrollando su función correctamente para el cumplimiento de los objetivos de su Servicio y del Hospital.</h3>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="10" required><label for="" style="margin-left:40px"><b>Excelente</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="8" required><label for="" style="margin-left:40px"><b>Muy Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="6" required><label for="" style="margin-left:40px"><b>Bueno</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="4" required><label for="" style="margin-left:40px"><b>Regular</b></label>
                    </div>
                    <div class="row">
                        <input class='form-check-input mt-2 ml-3' type='radio' name='op5' value="2" required><label for="" style="margin-left:40px"><b>Deficiente</b></label>
                    </div>
                    <div class="row">
                        <h3>6.	EMPATÍA Y COMPROMISO CON LA INSTITUCIÓN: Comprende la misión y valores del Hospital, así como el rol social y la trascendencia que cumple el Hospital en la comunidad. Se muestra motivado y empático con el público y las personas con las que se vincula dentro de la Institución.</h3>
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
                    <input type="hidden" name="op7" value= 0>
                    <input type="hidden" name="op8" value="0">
                    <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                    <input type="submit" value="Enviar" class="btn btn-primary">
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