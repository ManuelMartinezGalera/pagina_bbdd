<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<link rel="stylesheet" href="micss.css">
</head>
<body>
	<?php
	include_once ('Conexion.php');
  session_start();


    $idlista = $_GET['idlista'];
    $nombre = $_GET['nombre'];
    $publica = $_GET['publica'];
    echo "<table style='width:100%'>";
    if ($publica) { echo "<p style='font-size:30px; '><b>Lista pública de Reproducción</b></p>";} else {echo "<p style='font-size:30px; '><b>Lista privada de Reproducción</b></p>";}
    echo "<p style='font-size:20px; '><b>". $nombre ."</b></p>";

    $canciones = "SELECT *, episodio.titulo as tituloepisodio FROM episodio INNER JOIN contenido_lista_reproducciones as lista INNER JOIN podcast as pod WHERE
    lista.idlista_reproduccion='$idlista'
    and episodio.idepisodio = lista.idepisodios and episodio.idepisodio = pod.idpodcast";
    $resultado = $mysqli->query($canciones);

    while ($fila = $resultado->fetch_object()){
       echo "<tr>";
       echo "<td><img src=" . $fila->imagendeportada . " width='40' height='40'/></td>";
       echo "<td><a class='menu' href='Pagina_Episodio.php?idcanciones=" . $fila->idepisodio . "'>" . $fila->titulo . " </a></td>";

       echo "<td><b>" . $fila->minutos . " min" . "</b></td>";

       echo "</tr>";

     }
  echo "</table>";




$mysqli->close();
?>
</body>
</html>
