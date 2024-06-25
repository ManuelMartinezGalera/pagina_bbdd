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
   $idadmin = isset($_GET['idadmin']) ? $_GET['idadmin'] : 1;
   
   $recopilaciones = "SELECT rec.* 
       FROM recopilaciones AS rec
       INNER JOIN administrador ON rec.idadmin = administrador.idadmin
       WHERE administrador.idadmin = '$idadmin'
   ";
   
   $resultado4 = $mysqli->query($recopilaciones);
   if ($resultado4->num_rows > 0) {
       echo "<div>";
       echo "<p style='font-size:30px;'><b>Recopilaciones Admin</b></p>";
       while ($fila4 = $resultado4->fetch_object()) {
           echo "<div class='column' style='margin: 20pt;'>";
           echo "<img src='" . $fila4->imagen . "' width='200' height='200'/>";
           echo "<p><b>" . $fila4->nombre . "</b></p>";

           if ($fila4->nombre == 'Best Music') {
               echo "<td><a class='menu' href='RecopilacionCanciones.php?idrecopilacion=" . $fila4->idrecopilaciones . "'>Descubrir</a></td>";
           } elseif ($fila4->nombre == 'Best Podcast') {
               echo "<td><a class='menu' href='RecopilacionEpisodios.php?idrecopilacion=" . $fila4->idrecopilaciones . "'>Descubrir</a></td>";
           }
   
           echo "</div>";
       }
       echo "</div>";
   }

   

$mysqli->close();
?>
</body>
</html>
