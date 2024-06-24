<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$login = $_POST['login'];
  $password = $_POST['password'];
  $nombre = $_POST['nombre'];
  $imagen = $_POST['imagen'];
  $descripcion = $_POST['descripcion'];
  $fecha_creacion = $_POST['fecha_creacion'];
  $tematica = $_POST['tematica'];
  $resultado = $mysqli->query("SELECT MAX(idpodcast) as maximo FROM podcast");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;

  $cadenaSQL = "INSERT INTO podcast (idpodcast,login,password,nombre,numerodereproducciones,num_seguidores,imagen,descripcion,fecha_creacion,idtematica)
              VALUES ('$newId','$login','$password','$nombre','0','0','$imagen','$descripcion','$fecha_creacion', '$tematica')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Podcast.php?idpodcast=". $newId);
$mysqli->close();
?>
</body>
</html>