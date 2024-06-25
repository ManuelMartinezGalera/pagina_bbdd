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
  $resultado = $mysqli->query("SELECT MAX(idtematica) as maximo FROM tematica");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;

  $cadenaSQL = "INSERT INTO tematica(idtematica,nombre)
              VALUES ('$newId','$nombre')";
  $mysqli->query($cadenaSQL);
  header("Location: Listas.php?idusuario=". $idusuario);
$mysqli->close();
?>
</body>
</html>