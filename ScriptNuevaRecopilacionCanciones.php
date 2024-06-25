<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
  include_once ('Conexion.php');
  $nombre = $_POST['nombre'];
  $imagen = $_POST['imagen'];
  $usuario = ['1'];
  $resultado = $mysqli->query("SELECT MAX(idrecopilaciones) as maximo FROM recopilaciones");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;

  $cadenaSQL = "INSERT INTO recopilaciones (idrecopilaciones,nombre,imagen,idadmin)
              VALUES ('$newId','$nombre','$imagen','1')";
  $mysqli->query($cadenaSQL);
  header("Location: Recopilaciones.php?idadmin=". $usuario);
$mysqli->close();
?>
</body>
</html>