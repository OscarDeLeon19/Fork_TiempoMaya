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

$result = $conn->query("SELECT nombre, descripcion, precio, horario, imagen FROM tiempomaya.lugar;");

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
                                <li><a href="#explorar">Explorar</a></li>
                                <li><a href="#mapa">Mapa</a></li>
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
                            <h2>Lugares Turisticos Mayas en Guatemala</h2>
                            <p>
                                Las Ruinas Mayas son el testimonio viviente de una de las civilizaciones antiguas más avanzadas del mundo.Los Mayas habitaron en Mesoamérica entre 700AC y 900DC y sus magníficas construcciones tienen una historia muy interesante detrás de ellas
                            </p>
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
                                <img src="./img/turismo/inicio1.jpg" alt="">
                                <img src="./img/turismo/inicio2.png" alt="">
                                <img src="./img/turismo/inicio3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
    </div>

    <div class="center">
        <div class="contenedor">
            <h1 id="explorar">Los Mejores Lugares Turisticos Mayas en Guatemala</h1>
            <p>
                Los Mayas sobresalieron por ser excelentes astrólogos, agrónomos, matemáticos, desarrollaron un excelente sistema de escritura y uno de sus mayores logros fue, por supuesto, la arquitectura. Los restos de pirámides y templos que hoy vemos, un día albergaron a una población de millones de personas.
            </p>
            <p>
                Su distintiva arquitectura varía en las diferentes regiones de Mesoamérica porque los Mayas vivían en ciudades-estado independientes; a pesar de eso, un estilo en general prevalece en todas las ciudades Mayas. Gracias a su avanzado conocimiento de matemática y astronomía, los Mayas alineaban sus templos y pirámides con los movimientos de los astros. Eran sin duda, ambiciosos observadores del cielo.
            </p>
            <p>
                Viviendo entre la selva tropical, los Mayas estaban rodeados por un sofisticado sistema de acueductos, templos, pirámides, palacios, estelas, calzadas y canchas de juego de pelota. Los Mayas de las tierras bajas utilizaron piedra caliza, un tipo de material fuerte que ayuda a la preservación de las edificaciones que siguen en pie siglos después de su construcción. Restos de ciudades de esta magnífica civilización se encuentran esparcidos por toda el área que cubre Mesoamerica.
            </p>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nombre = $row["nombre"];
                    $descripcion = $row["descripcion"];
                    $precio = $row["precio"];
                    $horario = $row["horario"];
                    $imagen = $row["imagen"];

                    $parrafos = explode("<>", $descripcion);
                    echo "<div class='tarjeta'>";
                    echo "<div class='info'>";
                    echo "<h2>" . htmlspecialchars($nombre) . "</h2>";
                    foreach ($parrafos as $parrafo) {
                        echo "<p>" . htmlspecialchars($parrafo) . "</p>";
                    }
                    echo "<p><span class='spanLugar'>Precio: </span>" . htmlspecialchars($precio) . "</p>";
                    echo "<p><span class='spanLugar'>Horario: </span>" . htmlspecialchars($horario) . "</p>";
                    echo "</div>";
                    echo "<div class='imagen'>";
                    echo "<img src='" . htmlspecialchars($imagen) . "' alt='Imagen de " . htmlspecialchars($nombre) . "'>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
            <div class="contenedor">
                <h3 id="mapa">
                    Mapa
                </h3>
                <p>
                    En este puedes obtener las ubicaciones de los lugares que hemos mencionado
                </p>
                <div>
                    <div class="mapa">
                        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1kOZji459Zpn4MsYIbsegq9_jtX0n1SA&ehbc=2E312F" width="640" height="480"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php include "blocks/bloquesJs1.html" ?>

</body>

</html>