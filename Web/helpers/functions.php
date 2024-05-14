<?php 

function obtenerRutaFondo($conexion){

    $hora_actual = date('H:i:s');

    if($hora_actual >= '06:00:00' && $hora_actual < '12:00:00'){
        $momento = "manana";
    } elseif($hora_actual >= '12:00:00' && $hora_actual < '19:00:00'){
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

function resultToString($result) {
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

?>