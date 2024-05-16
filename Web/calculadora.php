<?php session_start(); ?>
<?php
$conn = include "conexion/conexion.php";
include('./helpers/functions.php');

date_default_timezone_set('US/Central');

if (isset($_GET['fecha'])) {
    $fecha_consultar = $_GET['fecha'];
} else {
    $fecha_consultar = date("Y-m-d");
}

$nahual = include 'backend/buscar/conseguir_nahual_nombre.php';
$nahualImg = $nahual;
$energia = include 'backend/buscar/conseguir_energia_numero.php';
$haab = include 'backend/buscar/conseguir_uinal_nombre.php';
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';
$cholquij = $nahual . " " . strval($energia);

$urlFondo = obtenerRutaFondo($conn);

$fechaDia = date('d');
$fechaMes = date('m');
$fechaAnio = date('Y');

$DatosCuentaLarga = obtenerCuentaLarga($fechaAnio . "-" . $fechaMes . "-" . $fechaDia);
$componentes = explode(".", $DatosCuentaLarga);

$kinC = intval($componentes[4]);
$uinalC = intval($componentes[3]);
$tun = intval($componentes[2]);
$katun = intval($componentes[1]);
$baktun = intval($componentes[0]);

$datosNagual = obtenerDescripcionNahual($conn, $nahualImg);
$significadoNagual = $datosNagual[0];
$descNagual = $datosNagual[1];

$datosEnergia = obtenerDescripcionEnergia($conn, $energia);

$nombreEnergia = $datosEnergia[0];
$significadoEnergia = $datosEnergia[1];
$yucatecoEnergia = $datosEnergia[2];

$datosCruz = obtenerCruzNahual($conn, $nahualImg);
$parrafosCruz = explode("\n", $datosCruz[5]);

if (isset($_POST['calcular'])) {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];

    $fechaDia = $dia;
    $fechaMes = $mes;
    $fechaAnio = $ano;

    $fechaCuentaLarga = obtenerCuentaLarga($fechaAnio . "-" . $fechaMes . "-" . $fechaDia);
    $componentes = explode(".", $fechaCuentaLarga);

    // Obtener los valores de los componentes
    $kinC = intval($componentes[4]);
    $uinalC = intval($componentes[3]);
    $tun = intval($componentes[2]);
    $katun = intval($componentes[1]);
    $baktun = intval($componentes[0]);
}

if (isset($_POST['calcularGregoriano'])) {
    $baktunF = $_POST['baktun'];
    $katunF = $_POST['katun'];
    $tunF = $_POST['tun'];
    $uinalF = $_POST['uinal'];
    $kinF = $_POST['kin'];

    $kinC = $kinF;
    $uinalC = $uinalF;
    $tun = $tunF;
    $katun = $katunF;
    $baktun = $baktunF;

    $fechaNormal = cuentaLargaAMayorGregoriano($baktun . "." . $katun . "." . $tun . "." . $uinalC . "." . $kinC);

    $componentesFecha = explode("-", $fechaNormal);
    $fechaAnio = $componentesFecha[0];
    $fechaMes = $componentesFecha[1];
    $fechaDia = $componentesFecha[2];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya - Calculadora de Mayas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="css/calculadora.css?v=<?php echo (rand()); ?>" />
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

                <div id='formulario'>
                    <h1>Calculadora</h1>
                    <form action="#" method="GET">
                        <div class="mb-1">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo isset($fecha_consultar) ? $fecha_consultar : ''; ?>">
                        </div>
                        <button type="submit" class="btn btn-get-started"><i class="far fa-clock"></i> Calcular</button>
                    </form>

                    <div id="tabla">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Calendario</th>
                                    <th scope="col" style="width: 60%;">Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Calendario Haab</th>
                                    <td><?php echo $haab[0]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Calendario Cholquij</th>
                                    <td><?php echo isset($cholquij) ? $cholquij : ''; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cuenta Larga</th>
                                    <td><?php echo isset($cuenta_larga) ? $cuenta_larga : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>

    <!-- Infografia del Nahual del dia -->
    <h2 class="containerCard">
        Nahual del Dia y Energia
    </h2>
    <div class="containerCard">
        <div class="card-ward">
            <div class="card">
                <div class="header-card">
                    <img src="<?php echo "./img/nahual/" .  $nahualImg . ".png"; ?>" alt="Imagen de nagual <?php echo $nahualImg; ?>">
                </div>
                <div class="footer-card">
                    <div class="categoria-card">
                        <span><?php echo $significadoNagual; ?></span>
                    </div>
                    <div class="texto-card">
                        <h3><?php echo $cholquij; ?></h3>
                        <p><span><?php echo $descNagual; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Informacion de Energia -->
        <div class="card-ward">
            <div class="card">
                <div class="header-card">
                    <img src="<?php echo "./img/energia/" .  $nombreEnergia . ".png"; ?>" alt="Imagen de energia <?php echo $nombreEnergia; ?>">
                </div>
                <div class="footer-card">
                    <div class="categoria-card">
                        <span>Energia</span>
                    </div>
                    <div class="texto-card">
                        <h3><?php echo $nombreEnergia; ?></h3>
                        <h6>Significado</h6>
                        <p><span><?php echo $significadoEnergia; ?></span></p>
                        <h6>Nombre en Yucateco</h6>
                        <p><span><?php echo $yucatecoEnergia; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cruz Maya -->
    <h2 class="containerCard">
        Cruz maya de <?php echo $datosCruz[0]; ?>
    </h2>
    <div class="containerCard">
        <div class="cruz">
            <div class="centro">
                <img src="<?php echo "./img/nahual/" .  $nahualImg . ".png"; ?>" alt="Imagen" width="100" height="100">
            </div>
            <div class="texto texto-arriba">
                <span class="tituloTexto">
                    Concepcion
                </span>
                <div> <?php echo $datosCruz[1]; ?> </div>
            </div>
            <div class="texto texto-abajo"><span class="tituloTexto">
                    Destino
                </span>
                <div> <?php echo $datosCruz[4]; ?> </div>
            </div>
            <div class="texto texto-izquierda"><span class="tituloTexto">
                    Mano Izquierda
                </span>
                <div> <?php echo $datosCruz[3]; ?> </div>
            </div>
            <div class="texto texto-derecha"><span class="tituloTexto">
                    Mano Derecha
                </span>
                <div> <?php echo $datosCruz[2]; ?> </div>
            </div>
        </div>
    </div>

    <div class="containerCalculadora">
        <h3>Significado de la Cruz Maya</h3>
        <?php
            foreach ($parrafosCruz as $parrafo) {
                echo "<p> $parrafo </p>";
            }
        ?>
    </div>

    <!-- Calculadora  -->
    <div class="containerCalculadora">
        <div class="calculadora">
            <h1> Calculadora Gregoriano - Cuenta Larga </h1>
            <h3> Calendario Gregoriano </h3>
            <form method="post" action="" class="formCalculadora">
                <label class="labelCalculadora" for="dia">Día:</label>
                <input class="inputNumber" type="number" id="dia" name="dia" min="1" max="31" value="<?php echo $fechaDia; ?>" required>
                <br><br>
                <label class="labelCalculadora" for="mes">Mes:</label>
                <select id="mes" name="mes" value="<?php echo date('m'); ?>" required>
                    <option value="01" <?php if ($fechaMes == '01') echo 'selected'; ?>>Enero</option>
                    <option value="02" <?php if ($fechaMes  == '02') echo 'selected'; ?>>Febrero</option>
                    <option value="03" <?php if ($fechaMes  == '03') echo 'selected'; ?>>Marzo</option>
                    <option value="04" <?php if ($fechaMes  == '04') echo 'selected'; ?>>Abril</option>
                    <option value="05" <?php if ($fechaMes  == '05') echo 'selected'; ?>>Mayo</option>
                    <option value="06" <?php if ($fechaMes  == '06') echo 'selected'; ?>>Junio</option>
                    <option value="07" <?php if ($fechaMes  == '07') echo 'selected'; ?>>Julio</option>
                    <option value="08" <?php if ($fechaMes  == '08') echo 'selected'; ?>>Agosto</option>
                    <option value="09" <?php if ($fechaMes  == '09') echo 'selected'; ?>>Septiembre</option>
                    <option value="10" <?php if ($fechaMes  == '10') echo 'selected'; ?>>Octubre</option>
                    <option value="11" <?php if ($fechaMes  == '11') echo 'selected'; ?>>Noviembre</option>
                    <option value="12" <?php if ($fechaMes  == '12') echo 'selected'; ?>>Diciembre</option>
                </select>
                <br><br>
                <label class="labelCalculadora" for="ano">Año:</label>
                <input class="inputNumber" type="number" id="ano" name="ano" min="1900" max="2100" value="<?php echo $fechaAnio; ?>" required>
                <br><br>
                <input class="inputSubmit" type="submit" name="calcular" value="Calcular">
            </form>
        </div>

        <div class="calculadora">
            <h3> Cuenta Larga </h3>
            <form method="post" action="" class="formCalculadora">
                <label class="labelCalculadora" for="baktun">Baktun:</label>
                <input class="inputNumber" type="number" id="baktun" name="baktun" min="0" value="<?php echo $baktun; ?>" required>
                <label class="labelCalculadora" for="katun">Katun:</label>
                <input class="inputNumber" type="number" id="katun" name="katun" min="0" value="<?php echo $katun; ?>" max="19" required>
                <label class="labelCalculadora" for="tun">Tun:</label>
                <input class="inputNumber" type="number" id="tun" name="tun" min="0" value="<?php echo $tun; ?>" max="19" required>
                <label class="labelCalculadora" for="uinal">Uinal:</label>
                <input class="inputNumber" type="number" id="uinal" name="uinal" min="0" max="17" value="<?php echo $uinalC; ?>" required>
                <label class="labelCalculadora" for="kin">Kin:</label>
                <input class="inputNumber" type="number" id="kin" name="kin" min="0" max="19" value="<?php echo $kinC ?>" required>
                <input class="inputSubmit" type="submit" name="calcularGregoriano" value="Calcular">
            </form>
        </div>
    </div>

    <?php include "blocks/bloquesJs1.html" ?>

    <?php

    ?>

</body>

</html>