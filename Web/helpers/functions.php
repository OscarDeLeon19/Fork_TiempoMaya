<?php

function obtenerRutaFondo($conexion)
{

    $hora_actual = date('H:i:s');

    if ($hora_actual >= '06:00:00' && $hora_actual < '12:00:00') {
        $momento = "manana";
    } elseif ($hora_actual >= '12:00:00' && $hora_actual < '19:00:00') {
        $momento = "tarde";
    } else {
        $momento = "noche";
    }

    $sql = "SELECT ruta  FROM tiempomaya.fondos WHERE momento = '$momento'";
    $result = $conexion->query($sql);

    $row = $result->fetch_assoc();
    $url = $row["ruta"];
    return $url;
}

function resultToString($result)
{
    $output = ''; // Inicializa una cadena vacía

    // Verifica si hay resultados
    if ($result && $result->num_rows > 0) {
        // Itera sobre cada fila en el resultado
        while ($row = $result->fetch_assoc()) {
            // Itera sobre cada columna en la fila
            foreach ($row as $key => $value) {
                // Agrega el nombre de la columna y su valor a la cadena de salida
                $output .= "$key: $value\n";
            }
            // Agrega una línea en blanco entre las filas
            $output .= "\n";
        }
    } else {
        // Si no hay resultados, agrega un mensaje indicando eso
        $output = "No se encontraron resultados.";
    }

    return $output;
}

function obtenerCuentaLarga($fechaConsultar)
{
    $fecha1 = new DateTime("01-01-2001");
    $fecha2 = new DateTime($fechaConsultar);
    $fecha_actual = strtotime(date("d-m-Y H:i:00", $fecha1->getTimestamp()));
    $fecha_entrada = strtotime($fechaConsultar);
    $diff = $fecha1->diff($fecha2);
    $dias = $diff->days;
    $reversa = false;
    if ($fecha_actual > $fecha_entrada) {
        $reversa = true;
    }

    $number_4 = 0;
    if ($dias > 7200) {
        $number_4 = floor($dias / 7200);
        $number_3 = floor(($dias % 7200) / 360);
        $number_2 = floor((($dias % 7200) % 360) / 20);
        $number_1 = (($dias % 7200) % 360) % 20;
    } else {
        $number_3 = floor($dias / 360);
        $number_2 = floor(($dias % 360) / 20);
        $number_1 = ($dias % 360) % 20;
    }

    if ($reversa) {
        $number_1 *= -1;
        $number_2 *= -1;
        $number_3 *= -1;
        $number_4 *= -1;
    }

    $number1 = 8 + $number_1;
    $pivot = 0;
    if ($number1 > 19) {
        $number1 = $number1 - 20;
        $pivot = 1;
    } elseif ($number1 < 0) {
        $number1 = 20 + $number1;
        $pivot = -1;
    }

    $number2 = 15 + $number_2 + $pivot;
    $pivot = 0;
    if ($number2 > 17) {
        $number2 = $number2 - 18;
        $pivot = 1;
    } elseif ($number2 < 0) {
        $number2 = 18 + $number2;
        $pivot = -1;
    }
    $number3 = 7 + $number_3 + $pivot;
    $pivot = 0;
    if ($number3 > 19) {
        $number3 = $number3 - 20;
        $pivot = 1;
    } elseif ($number3 < 0) {
        $number3 = 20 + $number3;
        $pivot = -1;
    }
    $number4 = 19 + $number_4 + $pivot;
    $pivot = 0;
    if ($number4 > 19) {
        $number4 = $number4 - 20;
        $pivot = 1;
    } elseif ($number4 < 0) {
        $number4 = 20 + $number4;
        $pivot = -1;
    }
    $number5 = 12 + $pivot;

    return strval($number5) . "." . strval($number4) . "." . strval($number3) . "." . strval($number2) . "." . strval($number1);
}

function cuentaLargaAMayorGregoriano($cuentaLarga) {
    // Separar los componentes de la cuenta larga maya
    $componentes = explode(".", $cuentaLarga);

    // Obtener los valores de los componentes
    $number1 = intval($componentes[4]);
    $number2 = intval($componentes[3]);
    $number3 = intval($componentes[2]);
    $number4 = intval($componentes[1]);
    $number5 = intval($componentes[0]);

    // Calcular los días julianos desde el inicio del calendario maya
    $diasJulianos = ($number5 - 12) * 144000 + ($number4 - 19) * 7200 + ($number3 - 7) * 360 + ($number2 - 15) * 20 + ($number1 - 8);

    // Convertir los días julianos a una fecha en formato gregoriano
    $fechaGregoriano = date("Y-m-d", strtotime("2001-01-01 +$diasJulianos days"));

    return $fechaGregoriano;
}

function obtenerDescripcionNahual($conexion, $nombre)
{
    $sql = "SELECT significado, descripcion FROM tiempomaya.nahual WHERE nombre = "."\"".$nombre."\""."";
    $result = $conexion->query($sql);

    $row = $result->fetch_assoc();
    $significado = $row["significado"];
    $descripcion = $row["descripcion"];
    return Array($significado, $descripcion);
}

function obtenerDescripcionEnergia($conexion, $energia)
{
    $sql = "SELECT nombre, significado, nombreYucateco FROM tiempomaya.energia WHERE id = ".$energia.";";
    $result = $conexion->query($sql);

    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $significado = $row["significado"];
    $nombreYucateco = $row["nombreYucateco"];
    return Array($nombre, $significado, $nombreYucateco);
}

?>