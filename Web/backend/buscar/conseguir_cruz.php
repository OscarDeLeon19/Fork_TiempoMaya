<?php

function getNahualSignificado($nahual, $conn) {
    $Query = $conn->query("SELECT significado FROM nahual WHERE nombre=\"".$nahual."\";");
    $row = mysqli_fetch_assoc($Query);
    return $row['significado'];
}

function getCruzInfo($nahual, $conn) {
    $Query = $conn->query("SELECT cruz.* FROM cruz INNER JOIN nahual ON cruz.nacimiento = nahual.idweb WHERE nahual.nombre =\"".$nahual."\";");
    $row = mysqli_fetch_assoc($Query);
    $row['nacimiento'] = $nahual;

    $Query = $conn->query("SELECT nombre FROM nahual WHERE idweb=".$row['izquierdo'].";");
    $izq = mysqli_fetch_assoc($Query);
    $row['izquierdo'] = $izq['nombre'];

    $Query = $conn->query("SELECT nombre FROM nahual WHERE idweb=".$row['derecho'].";");
    $der = mysqli_fetch_assoc($Query);
    $row['derecho'] = $der['nombre'];

    $Query = $conn->query("SELECT nombre FROM nahual WHERE idweb=".$row['concepcion'].";");
    $conc = mysqli_fetch_assoc($Query);
    $row['concepcion'] = $conc['nombre'];

    $Query = $conn->query("SELECT nombre FROM nahual WHERE idweb=".$row['destino'].";");
    $des = mysqli_fetch_assoc($Query);
    $row['destino'] = $des['nombre'];
    
    return $row;
}

function getEnergiaInfo($id, $conn) {
    $Query = $conn->query("SELECT nombre, significado FROM energia WHERE id=".$id.";");
    $row = mysqli_fetch_assoc($Query);
    return $row;
}

function getAnimalGuia($nahual, $conn) {
    $Query = $conn->query("SELECT animal_guia.animal FROM animal_guia 
    INNER JOIN nahual ON animal_guia.idweb_nahual = nahual.idweb WHERE nahual.nombre=\"". $nahual ."\";");
    $row = mysqli_fetch_assoc($Query);
    return $row['animal'];
}
?>