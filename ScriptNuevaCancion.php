<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$titulo = $_POST['titulo'];
  $enlaceaspotify = $_POST['enlaceaspotify'];
  $minutos = $_POST['minutos'];
  $segundos = $_POST['segundos'];
  $idalbumes = $_POST['idalbumes'];
  $resultado = $mysqli->query("SELECT MAX(idcanciones) as maximo FROM canciones");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $cadenaSQL = "INSERT INTO canciones(idcanciones,titulo,enlace_cancion,numerodereproduciones,minutos,segundos,idalbumes)
              VALUES ('$newId','$titulo','$enlaceaspotify','0','$minutos','$segundos','$idalbumes')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Album.php?idalbumes=". $idalbumes);
$mysqli->close();
?>
</body>
</html>
