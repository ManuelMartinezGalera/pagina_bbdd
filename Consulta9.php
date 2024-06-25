<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<link rel="stylesheet" href="micss.css">
</head>
<body>
    <?php
    include_once ('Conexion.php');
  session_start();
  echo "<b> Canciones que no gustan: </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Título: </b></td>";
  echo "</tr>";
  $tematicas = "SELECT 
        c.titulo AS titulo_cancion
    FROM canciones c
    LEFT JOIN me_gusta mg ON c.idcanciones = mg.idcancion
    WHERE mg.idme_gusta IS NULL;";
  $resultado = $mysqli->query($tematicas);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->titulo_cancion . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";