<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
    <?php
  include_once ('Conexion.php');
  $idlista = $_POST['idlista_reproduccion'];
  $idcancion = $_POST['idcanciones'];
  $cadenaSQL = "INSERT INTO contenido_lista_canciones(idlista_reproduccion,idcanciones)
              VALUES ('$idlista','$idcancion')";
    echo $cadenaSQL;
  $mysqli->query($cadenaSQL);
  header("Location: Pagina_Cancion.php?idcanciones=". $idcancion);
$mysqli->close();
?>
</body>
</html>
