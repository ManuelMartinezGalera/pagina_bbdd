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
  $enlace = $_POST['enlace'];
  $minutos = $_POST['minutos'];
  $imagendeportada = $_POST['imagendeportada'];
  $descripcion_episodio = $_POST['descripcion_episodio'];
  $fecha_publicacion = $_POST['fecha_publicacion'];
  $idpodcast = $_POST['idpodcast'];
  $resultado = $mysqli->query("SELECT MAX(idepisodio) as maximo FROM episodio");
  $fila = $resultado->fetch_object();
  $newId = $fila->maximo + 1;
  $cadenaSQL = "INSERT INTO episodio(idepisodio,titulo,enlace,numerodereproducciones,minutos,descripcion_episodio,imagendeportada,fecha_publicacion,idpodcast)
                             VALUES ('$newId','$titulo','$enlace','0','$minutos','$descripcion_episodio','$imagendeportada','$fecha_publicacion','$idpodcast')";
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Episodio.php?idalbumes=". $newId);
$mysqli->close();
?>
</body>
</html>