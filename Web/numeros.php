<?php session_start(); ?>
<?php
date_default_timezone_set('US/Central');

$conn = include "conexion/conexion.php";
include('./helpers/functions.php');


$urlFondo = obtenerRutaFondo($conn);
$numerosMayas = ["0"];
$numIngresado = 0;

if (isset($_POST['calcularMaya'])) {
    $numerosMayas = [];
    $numero = $_POST["numero"];
    $numIngresado = $numero;
    $textoMaya = convertirANumeroMaya($numero);

    $numerosObtenidos = explode("-", $textoMaya);
    $techo = 0;
    $conteo = 0;
    foreach ($numerosObtenidos as $num) {
        $conteo++;
        if ($num == "0") {
            if ($techo == 1 || $conteo == 5) {
                array_push($numerosMayas, $num);
            }
        } else {
            array_push($numerosMayas, $num);
            $techo = 1;
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya - Numeros Mayas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="css/numeros.css?v=<?php echo (rand()); ?>" />
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
                <h1>Numeros Mayas</h1>
                <a href="#Informacion" class='btn-get-started'>Informacion</a>
                <a href="#Calculadora" class='btn-get-started'>Calculadora Decimal - Maya</a>
            </div>
        </section>
    </div>

    <div class="bodyNumeros" id="Informacion">
        <div class="containerNumeros">
            <h1>
                Informacion de los numeros mayas
            </h1>
            <p>
                Los mayas idearon y utilizaron durante el primer milenio de nuestra era un sistema de numeración posicional vigesimal de una gran eficacia y cuya representación solo requería de tres símbolos: el punto, la raya y el óvalo.
            </p>
            <p>
                Empleaban un sistema de numeración vigesimal, que usaba de manera auxiliar otro de base 5. El punto redondo representaba el 1, la raya o barra el 5. El resto de los números entre el 1 y 19, se obtenían mediante sus combinaciones.
            </p>
            <p>
                El sistema era posicional, se escribía vertical, de arriba hacia abajo, comenzando en el nivel superior, con las unidades en la parte inferior. En el uso no relacionado con la cuenta del tiempo todos los niveles son múltiplos de 20.
            </p>
            <img src="./img/numeros-mayas.png" alt="Imagen de numeracion maya">

            <p>
                Se necesitaba un signo o símbolo que indicase cuando en una posición no había ninguna cantidad, y por lo tanto su valor era cero. El símbolo generalmente utilizado era un óvalo horizontal, que representaba la caparazón de un caracol.
            </p>

            <p>
                Algunos autores piensan que la presencia de un símbolo para el número cero, indica la aparición del concepto del número cero algunos siglos antes del establecimiento del sistema de numeración arábigo. Otros sostienen que a los mayas no les interesaba el concepto de la cantidad nula, y que el signo era un separador eficaz, que indicaba la ausencia de otro número.
            </p>

        </div>
    </div>
    
    <div class="bodyNumeros">
        <h1>Calculadora Decimales a Maya</h1>
    </div>
    <div class="bodyNumeros" id="Calculadora">
        <div class="containerForm">
            <div class="prueba">
                <h1>Numero Decimal</h1>
                <form action="" method="post" id="formulario">
                    <label for="numero">Ingrese un número para la conversion:</label>
                    <input type="number" id="numero" name="numero" min="0" value="<?php echo $numIngresado; ?>" required>
                    <button type="submit" name="calcularMaya" value="Calcular">Calcular</button>
                </form>
            </div>
        </div>

        <div class="containerForm">
            <h1>Numero en Maya</h1>
            <div class="torre" id="torre">
                <?php 
                    foreach($numerosMayas as $num){
                        $strprint = "<div class=\"nivel\">";
                        $strprint.= "<img src=\"./img/numeros/$num.png\" alt=\"Número Maya 2\">";
                        $strprint.= "</div>";
                        echo $strprint;
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include "blocks/bloquesJs1.html" ?>

</body>

</html>