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
  $anodepublicacion = $_POST['anopublicacion'];
  $imagendeportada = $_POST['imagendeportada'];
  $idartistas = $_POST['idartistas'];
  $resultado = $mysqli->query("SELECT MAX(idalbumes) as maximo FROM albumes");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $cadenaSQL = "INSERT INTO albumes(idalbumes,titulo,anodepublicacion,imagendeportada,idartistas)
              VALUES ('$newId','$titulo','$anodepublicacion','$imagendeportada','$idartistas')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Album.php?idalbumes=". $newId);
$mysqli->close();
?>
</body>
</html>