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
  echo "<b> Artistas más seguidos </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre artista: </b></td>";
  echo "<td><b> Número de seguidores: </b></td>";
  echo "</tr>";
  $tematicas = "SELECT u.nombre AS nombre, 
    COUNT(DISTINCT ars.idusuarios) AS total
    FROM artistas_seguidos ars
    JOIN usuarios u ON ars.idartistas = u.idusuarios
    GROUP BY nombre 
    HAVING COUNT(DISTINCT ars.idusuarios) = (
        SELECT COUNT(DISTINCT ars2.idusuarios) 
        FROM artistas_seguidos ars2
        GROUP BY ars2.idartistas
        ORDER BY COUNT(DISTINCT ars2.idusuarios) DESC
        LIMIT 1
    )
    ORDER BY total DESC;";
  $resultado = $mysqli->query($tematicas);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->nombre . "</b></td>";
     echo "<td><b>" . $fila->total . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";