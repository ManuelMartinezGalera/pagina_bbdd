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
  echo "<b> Podcast más seguidos </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre podcast: </b></td>";
  echo "<td><b> Número de seguidores: </b></td>";
  echo "</tr>";
  $tematicas = "SELECT podcast.nombre AS nombre, 
    COUNT(DISTINCT pods.idusuarios) AS total
    FROM podcast_seguidos AS pods
    JOIN podcast ON pods.idpodcast = podcast.idpodcast
    JOIN usuarios ON pods.idusuarios = usuarios.idusuarios
    GROUP BY nombre 
    HAVING COUNT(DISTINCT pods.idusuarios) = (
        SELECT COUNT(DISTINCT pod2.idusuarios) 
        FROM podcast_seguidos AS pod2
        GROUP BY pod2.idpodcast
        ORDER BY COUNT(DISTINCT pod2.idusuarios) DESC
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