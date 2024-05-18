<?php
include("./helpers/functions.php");
$conn = include "conexion/conexion.php";

if (isset($_GET['fecha'])) {
    $fecha_consultar = $_GET['fecha'];
} else {
    date_default_timezone_set('US/Central');
    $fecha_consultar = date("Y-m-d");
}

$nahual = include 'backend/buscar/conseguir_nahual_nombre.php';
$energia = include 'backend/buscar/conseguir_energia_numero.php';
$haab = include 'backend/buscar/conseguir_uinal_nombre.php';
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';
$cholquij = $nahual . " " . strval($energia);
$nombre_nahual = $nahual;
$numero_energia = strval($energia);
$fecha_haab = $haab[0];
$nombre_uinal = $haab[1];

$urlFondo = obtenerRutaFondo($conn);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="css/turismo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #inicio {
            width: 100%;
            height: 100vh;
            background: url('<?php echo $urlFondo; ?>') top center;
            background-size: cover;
            position: relative;
        }
    </style>
</head>

<body>
    <?php include "NavBar.php" ?>
    <div>

        <section id="inicio">
            <div id="inicioContainer" class="inicio-container">
                <section class="contenedor">
                    <header>
                        <h1>Turismo Maya</h1>
                        <nav>
                            <ul>
                                <li><a href="#">Inicio</a></li>
                                <li><a href="#">Nosotros</a></li>
                                <li><a href="#">Contacto</a></li>
                                <li><a href="#">Explorar</a></li>
                            </ul>
                        </nav>
                    </header>
                    <div class="contenido">
                        <div class="linea-decorativa">
                            <div class="circulo"></div>
                            <div class="circulo"></div>
                            <div class="circulo"></div>
                        </div>
                        <div class="left">
                            <h2>Tikal</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus rem inventore id deleniti omnis, laboriosam natus quam distinctio eius provident placeat obcaecati quaerat nihil suscipit ut, accusamus debitis voluptates ullam.
                            </p>
                            <button>Explorar</button>
                            <div class="redes">
                                <a href=""><i class="fa-brands fa-facebook"></i></a>
                                <a href=""><i class="fa-brands fa-instagram"></i></a>
                                <a href=""><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="right">
                            <div class="popular">
                                Popular
                            </div>
                            <div class="contenedor-fotos">
                                <img src="./img/fondo.png" alt="">
                                <img src="./img/fondo_manana.jpg" alt="">
                                <img src="./img/fondo_noche.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
    </div>

    <?php include "blocks/bloquesJs1.html" ?>

</body>

</html>