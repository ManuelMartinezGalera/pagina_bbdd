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
  $tipo = $_POST['tipo'];
  $idusuario = 7;
  $resultado = $mysqli->query("SELECT MAX(idlista_reproduccion) as maximo FROM lista_reproduccion");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $tipo_lower = strtolower($tipo);

  $cadenaSQL = "INSERT INTO lista_reproduccion(idlista_reproduccion,nombre,tipo,idusuario,is_episodio)
              VALUES ('$newId','$nombre','$tipo_lower','7','1')";
  $mysqli->query($cadenaSQL);
  header("Location: Listas.php?idusuario=". $idusuario);
$mysqli->close();
?>
</body>
</html>