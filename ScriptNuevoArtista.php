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
  $imagen = $_POST['imagen'];
  $descripcion = $_POST['descripcion'];
  $resultado = $mysqli->query("SELECT MAX(idartistas) as maximo FROM artistas");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;

  $resultado1 = $mysqli->query("SELECT MAX(idusuarios) as maximo FROM artistas");
  $fila1 = $resultado1->fetch_object();
  $idusuario = $fila1->maximo + 1;

  $cadenaSQL = "INSERT INTO artistas(idartistas,idusuarios,login,password,numerodereproducciones,imagen,descripcion,idtematica)
              VALUES ('$newId','$idusuario','$login','$password','0','$imagen','$descripcion','6')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Artista.php?idartista=". $newId);
$mysqli->close();
?>
</body>
</html>