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

	$idpodcast = $_SESSION['id'];
  $podcast = "SELECT * 
  FROM 
  podcast
  WHERE 
  idpodcast='$idpodcast'";
	$resultado = $mysqli->query($podcast);

		$fila = $resultado->fetch_object();
    echo "<br/>";
    echo "<br/>";
    echo "<div>";
    echo "<img src=" . $fila->imagen ." width='40%' height='500'/>";
	 	echo "<p style='font-size:50px; '><b>" . $fila->nombre .  "</b></p>";
		echo "<p><b> Descripción: " . $fila->descripcion .  "</b></p>";
    echo "<p><b> Número de reproducciones: " . $fila->numerodereproducciones .  "</b></p>";

	
		echo "<p><b> Temática: " . "musica" .  "</b></p>";

    echo "<p><b> Ingresos Actuales </b></p>";
		$ingresos = "SELECT * FROM ingresos_podcast WHERE idpodcast='$idpodcast'";
		$resultadoi = $mysqli->query($ingresos);

		IF ($resultadoi->num_rows==0) {
	  echo "<p><b> Cantidad: 0 </b></p>";
		} ELSE
    {
	  $filai = $resultadoi->fetch_object();
		echo "<p><b> Fecha: " . $filai->fecha .  "</b></p>";
    echo "<p><b> Cantidad: " . $filai->cantidad .  "</b></p>";
	  }
    echo "</div>";



  $canciones = "SELECT *, epi.titulo as titulo
  FROM episodio as epi 
  INNER JOIN podcast as pod
  WHERE pod.idpodcast = '$idpodcast'
  and epi.idpodcast = pod.idpodcast ORDER BY epi.numerodereproducciones";
  $resultado2 = $mysqli->query($canciones);
  $count = 1;
  if ($resultado2->num_rows>0){
		echo "<hr>";
    echo "<p style='font-size:30px; '><b>Episodios más vistos</b></p>";
	  echo "<table style='width:100%'>";
    while ($fila2 = $resultado2->fetch_object() and $count<=4) {
		echo "<tr>";
		echo "<td>". $count . ".</td>";
		echo "<td><img src=" . $fila2->imagen . " width='40' height='40'/></td>";
		echo "<td><a class='menu' href='Pagina_Episodio.php?idcanciones=" . $fila2->idepisodio . "'>" . $fila2->titulo . " </a></td>";
		echo "<td><b>" . $fila2->minutos . " min" . "</b></td>";
		echo "</tr>";
    $count = $count +1;
	}
	echo "<table>";
  }
  echo "<a href='NuevoEpisodio.php?idpodcast=". $idpodcast . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Nuevo Episodio</button></a><br/>";

  $podcast1 = "SELECT * FROM podcast WHERE idpodcast = '$idpodcast'";
  $resultado3 = $mysqli->query($podcast1);
  if ($resultado3->num_rows>0){
		echo "<hr>";
		echo "<div>";
	  echo "<p style='font-size:30px; '><b>Pagina Podcast</b></p>";
    while ($fila3 = $resultado3->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='Pagina_Podcast.php?idpodcast=" . $fila3->idpodcast . "'> <img src=" . $fila3->imagen ." width='200' height='200'/></a>";
	 	echo "<p><b>" . $fila3->nombre .  "</b></p>";
		echo "<p><b> Año de Publicación: " . $fila3->fecha_creacion .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $recopilaciones = "SELECT * FROM recopilaciones as rec  WHERE EXISTS (SELECT * FROM contenido_recopilaciones as rcan
    INNER JOIN podcast as pod
    INNER JOIN episodio as e
    WHERE pod.idpodcast = '$idpodcast'
    and e.idpodcast = pod.idpodcast
    and rcan.idepisodio = e.idepisodio
    and rcan.idrecopilaciones = rec.idrecopilaciones)";

  $resultado4 = $mysqli->query($recopilaciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Recopilaciones en las que aparece</b></p>";
    while ($fila4 = $resultado4->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
    echo "<img src=" . $fila4->imagen ." width='200' height='200'/>";
	 	echo "<p><b>" . $fila4->nombre .  "</b></p>";
    echo "</div>";
	}
	echo "<div>";
  }


  $listas = "SELECT * FROM lista_reproduccion as rec  WHERE EXISTS (SELECT * FROM contenido_lista_reproducciones as rcan
    INNER JOIN episodio as e
    INNER JOIN podcast as pod
    WHERE pod.idpodcast = '$idpodcast'
    and e.idpodcast = pod.idpodcast
    and rcan.idepisodios = e.idepisodio
    and rcan.idlista_reproduccion = rec.idlista_reproduccion)";

  $resultado5 = $mysqli->query($listas);
  if ($resultado5->num_rows>0){
		echo "<hr>";
	  echo "<div>";
	  echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila5->idlista_reproduccion . "&nombre=". $fila5->nombre . "'>
														 <p>" . $fila5->nombre .  "</p></a>";
    echo "</div>";
	}
	echo "<div>";
  }


  $seguidores = "SELECT * FROM usuarios as usu 
  INNER JOIN artistas_seguidos as seg 
  WHERE seg.idusuarios = usu.idusuarios";

  $resultado6 = $mysqli->query($seguidores);
  if ($resultado6->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Usuarios que lo siguen</b></p>";
    while ($fila6 = $resultado6->fetch_object()) {
      echo "<div width='100%''>";
      echo "<img src=" . $fila6->imagen ."  class='avatar'/>";
  		echo "<br/>";
  	 	echo "<p><b>" . $fila6->nick .  "</b></p>";
      echo "</div>";
  }
  echo "<div>";
}


$mysqli->close();
?>
</body>
</html>