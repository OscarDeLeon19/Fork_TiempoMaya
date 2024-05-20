<?php

$conn = include '../conexion/conexion.php';
$kinesNav = $conn->query("SELECT nombre FROM tiempomaya.kin order by nombre;");
$uinalesNav = $conn->query("SELECT nombre FROM tiempomaya.uinal order by nombre;");
$nahualesNav = $conn->query("SELECT nombre FROM tiempomaya.nahual order by nombre;");
$energiasNav = $conn->query("SELECT nombre FROM tiempomaya.energia order by id;");
$periodosNav = $conn->query("SELECT nombre FROM tiempomaya.periodo order by orden ;");

?>
<?php include "../mensaje.php"; ?>


<header id="header" style="padding-left: 600px;">
  <div class="container">
    <nav class="navbar navbar-expand-lg" id="nav-menu-container">
      <div class="container-fluid">
        <a id="title" class="navbar-brand" href="../index.php" style="color: white;font-size: 24px;"><strong>TIEMPO</strong> MAYA</a>
        <button class="navbar-toggler" type="button" onclick="rellenar()" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span><i style="color: white;" class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav nav-menu">
            <li>
              <a class="nav-link" href="../models/paginaModelo.php?pagina=Calendario Haab">Calendario Haab &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario Haab
              </button>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kin
                  </button>
                  <a class="nav-link" href="../models/paginaModeloElemento.php?elemento=kin" style="font-size: 13px;">Kines </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php if (is_array($kinesNav) || is_object($kinesNav)) {
                        foreach ($kinesNav as $kin) {
                          $nombre = $kin['nombre'];
                          $strstring = "<li class='nav-item'>";
                          $strstring.= "<a class='nav-link' href='../models/paginaModeloElemento.php?elemento=kin#" . $kin['nombre'] . "'>";
                          $strstring.= $kin['nombre'];
                          $strstring.= "<img class=\"imageNav\" src=\"../img/kin/$nombre.png\" />";
                          $strstring.= "</a>";
                          $strstring.= "</li>";
                          echo $strstring;
                        }
                      } ?>
                  </ul>
                </li>
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Uinal
                  </button>
                  <a class="nav-link" href="../models/paginaModeloElemento.php?elemento=uinal" style="font-size: 13px;">Uniales </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php if (is_array($uinalesNav) || is_object($uinalesNav)) {
                        foreach ($uinalesNav as $uinal) {
                          $nombre = $uinal['nombre'];
                          $strstring = "<li class='nav-item'>";
                          $strstring.= "<a class='nav-link' href='../models/paginaModeloElemento.php?elemento=uinal#" . $uinal['nombre'] . "'>";
                          $strstring.= $uinal['nombre'];
                          $strstring.= "<img class=\"imageNav\" src=\"../img/uinal/$nombre.png\" />";
                          $strstring.= "</a>";
                          $strstring.= "</li>";
                          echo $strstring;
                        }
                      } ?>
                  </ul>
                </li>
              </ul>
            </li>

            <li>
              <a class="nav-link" href="../models/paginaModelo.php?pagina=Calendario Cholquij">Calendario Cholq'ij &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Calendario Cholquij
              </button>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Nahual
                  </button>
                  <a class="nav-link" href="../models/paginaModeloElemento.php?elemento=nahual" style="font-size: 13px;">Nahuales </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height: 400px; overflow-y: scroll;">
                      <?php if (is_array($nahualesNav) || is_object($nahualesNav)) {
                        foreach ($nahualesNav as $nahual) {
                          $nombre = $nahual['nombre'];
                          $strstring = "<li class='nav-item'>";
                          $strstring.= "<a class='nav-link' href='../models/paginaModeloElemento.php?elemento=nahual#" . $nahual['nombre'] . "'>";
                          $strstring.= $nahual['nombre'];
                          $strstring.= "<img class=\"imageNav\" src=\"../img/nahual/$nombre.png\" />";
                          $strstring.= "</a>";
                          $strstring.= "</li>";
                          echo $strstring;
                        }
                      } ?>
                    </div>
                  </ul>
                </li>
                <li>
                  <button type="button" style="opacity: 0; height: 0;" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Energia
                  </button>
                  <a class="nav-link" href="../models/paginaModeloElemento.php?elemento=energia" style="font-size: 13px;">Energias </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div div style="width: 200px; height:400px; overflow-y: scroll;">
                      <?php if (is_array($energiasNav) || is_object($energiasNav)) {
                        foreach ($energiasNav as $energia) {
                          $nombre = $energia['nombre'];
                          $strstring = "<li class='nav-item'>";
                          $strstring.= "<a class='nav-link' href='../models/paginaModeloElemento.php?elemento=energia#" . $energia['nombre'] . "'>";
                          $strstring.= $energia['nombre'];
                          $strstring.= "<img class=\"imageNav\" src=\"../img/energia/$nombre.png\" />";
                          $strstring.= "</a>";
                          $strstring.= "</li>";
                          echo $strstring;;
                        }
                      } ?>
                    </div>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../models/paginaModelo.php?pagina=Rueda Calendarica">Rueda Calendarica</a>
            </li>
            
            <li>
              <a class="nav-link" href="#">Calculadoras &nbsp;&nbsp;&nbsp;&nbsp; </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li class="nav-item"><a class="nav-link" href="../calculadora.php">Calculadora</a></li>
                <li class="nav-item">
                  <a class="nav-link" href="../numeros.php">Numeros Mayas</a>
                </li>
              </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="../turismo.php">Turismo</a></li>
           
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>


<script type="text/javascript">
  var relleno = false;

  function rellenar() {
    if (!relleno) {
      $('#header').addClass('header-fixed1');
      $('#inicioContainer').addClass('iniciofixed');
      relleno = true
    } else {
      relleno = false
      $('#header').removeClass('header-fixed1');
      $('#inicioContainer').removeClass('iniciofixed');
    }
  }
</script>