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
  echo "<b> Número apariciones de una canción </b>";
  echo "<br/>";
  echo "<table style='width:100%'>";
  echo "<tr>";
  echo "<td><b> Título </b></td>";
  echo "<td><b> Número de listas de reproducción: </b></td>";
  echo "<td><b> Número de recopilaciones: </b></td>";
  echo "</tr>";
  $tematicas = "SELECT 
        c.titulo AS titulo_cancion,
        COUNT(DISTINCT clr.idlista_reproduccion) AS num_listas_reproduccion,
        COUNT(DISTINCT cr.idrecopilaciones) AS num_recopilaciones
    FROM canciones AS c
    LEFT JOIN contenido_lista_reproducciones clr ON c.idcanciones = clr.idcanciones
    LEFT JOIN contenido_recopilaciones cr ON c.idcanciones = cr.idcanciones
    GROUP BY c.idcanciones, c.titulo;";
  $resultado = $mysqli->query($tematicas);

  while ($fila = $resultado->fetch_object()){
     echo "<tr>";
     echo "<td><b>" . $fila->titulo_cancion . "</b></td>";
     echo "<td><b>" . $fila->num_listas_reproduccion . "</b></td>";
     echo "<td><b>" . $fila->num_recopilaciones . "</b></td>";
     echo "</tr>";

   }
   echo "</table>";