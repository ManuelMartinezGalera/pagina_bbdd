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
  echo "<b> Número medio me gustas (podcast) </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Nombre: </b></td>";
  echo "<td><b> Media me gustas: </b></td>";
  echo "</tr>";
  $tematicas = "SELECT 
        p.nombre AS nombre,
        AVG(mg.idme_gusta) AS media_me_gusta
    FROM podcast p
    LEFT JOIN episodio e ON p.idpodcast = e.idpodcast
    LEFT JOIN me_gusta mg ON e.idepisodio = mg.idepisodio
    GROUP BY p.idpodcast, p.nombre;";
  $resultado = $mysqli->query($tematicas);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->nombre . "</b></td>";
     echo "<td><b>" . $fila->media_me_gusta . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";