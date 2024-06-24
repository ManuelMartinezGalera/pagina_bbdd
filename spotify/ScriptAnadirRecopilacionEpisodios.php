<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$idlista = $_POST['idlista'];
  $idcancion = $_POST['idcancion'];
  $cadenaSQL = "INSERT INTO canciones_de_listas(canciones_idcanciones,listasdereproduccioncanciones_idlistasdereproduccioncanciones)
              VALUES ('$idcancion','$idlista')";
	echo $cadenaSQL;
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Cancion.php?idcanciones=". $idcancion);
$mysqli->close();
?>
</body>
</html>
