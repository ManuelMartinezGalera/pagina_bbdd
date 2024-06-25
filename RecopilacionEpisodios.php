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


    $idlista = 2;

    $canciones = "SELECT *, episodio.titulo as tituloepisodio FROM episodio INNER JOIN contenido_recopilaciones_episodios as lista INNER JOIN podcast as pod WHERE
    lista.idrecopilaciones='$idlista'
    and episodio.idepisodio = lista.idepisodio and episodio.idepisodio = pod.idpodcast";
$resultado = $mysqli->query($canciones);

echo "<ul>"; 

while ($fila = $resultado->fetch_object()) {
    echo "<li>"; 
    echo "<img src=" . $fila->imagendeportada . " width='40' height='40'/>";
    echo "<a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila->idepisodio . "'>" . $fila->titulo . "</a>";
    echo " <b>" . $fila->minutos . " min" . "</b>";
    echo "</li>"; 
}

echo "</ul>"; 




$mysqli->close();
?>
</body>
</html>
