<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$usuario = $_GET['usuario'];
  $artista =  $_GET['artista'];
  $cadenaSQL = "INSERT INTO artistas_seguidos (idusuarios,idartistas) VALUES ($usuario,$artista)";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Artista.php?idartistas=". $artista);

$mysqli->close();
?>
</body>
</html>
