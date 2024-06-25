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
  $idpodcast = isset($_GET['idpodcast']) ? $_GET['idpodcast'] : 2;
  $idusuarios = isset($_GET['idusuarios']) ? $_GET['idusuarios'] : 2;
  $podcast = "SELECT 
  podcast.*
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
    
    $tipotematica = 6;
		$tematica = "SELECT 
    tematica.* 
    FROM 
      tematica 
    WHERE 
      idtematica='$tipotematica'";
		
    $resultadot = $mysqli->query($tematica);
	  
    $filat = $resultadot->fetch_object();
		echo "<p><b> Temática: " . " $filat->nombre " .  "</b></p>";

    
		$seguimiento = "SELECT * FROM podcast_seguidos WHERE idpodcast='$idpodcast' and idusuarios='$idusuarios'";
		$seguido = $mysqli->query($seguimiento);
		if ($seguido->num_rows==0){
		echo "<a href='ScriptSeguimiento.php?usuario=" . $idusuarios . "&artista=" . $idpodcast . "' class='menu'><button style='width:100%; margin:10pt;  background-color:green;color:white;'>Seguir</button></a><br/>";
	  }

		echo "</div>";



  $episodios = "SELECT *, epi.titulo as tituloepisodio FROM episodio as epi INNER JOIN podcast as pod ON epi.idpodcast = pod.idpodcast WHERE pod.idpodcast = '$idpodcast'
  ORDER BY epi.numerodereproducciones";
  $resultado2 = $mysqli->query($episodios);
  $count = 1;
  if ($resultado2->num_rows>0){
		echo "<hr>";
    echo "<p style='font-size:30px; '><b>Episodios Más Vistos</b></p>";
	  echo "<table style='width:100%'>";
    while ($fila2 = $resultado2->fetch_object() and $count<=3) {
		echo "<tr>";
		echo "<td>". $count . ".</td>";
		echo "<td><img src=" . $fila2->imagendeportada . " width='40' height='40'/></td>";
		echo "<td><a class='menu' href='Pagina_Episodio.php?idcanciones=" . $fila2->idepisodio . "'>" . $fila2->tituloepisodio . " </a></td>";
		echo "<td><b>" . $fila2->minutos . " min" . "</b></td>";
		echo "</tr>";
    $count = $count +1;
	}
	echo "<table>";
  }

  $recopilaciones = "SELECT * FROM recopilaciones as rec  WHERE EXISTS 
  (SELECT * FROM 
    contenido_recopilaciones as rcan
  INNER JOIN episodio
  INNER JOIN podcast
    WHERE podcast.idpodcast = '$idpodcast'
    and episodio.idpodcast = podcast.idpodcast
    and rcan.idepisodio = episodio.idepisodio
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


  $lista = "SELECT * FROM lista_reproduccion as rec  WHERE EXISTS (SELECT * FROM contenido_lista_reproducciones as rcan
    INNER JOIN episodio
    INNER JOIN podcast
    WHERE podcast.idpodcast = '$idpodcast' 
    and episodio.idpodcast = podcast.idpodcast 
    and rcan.idepisodios = episodio.idepisodio 
    and rcan.idcontenido_lista_reproducciones = rec.idlista_reproduccion)";

  $resultado5 = $mysqli->query($lista);
  if ($resultado5->num_rows>0){
		echo "<hr>";
	  echo "<div>";
	  echo "<p style='font-size:30px; '><b>Listas de reproducción en las que aparece</b></p>";
    while ($fila5 = $resultado5->fetch_object()) {
  	echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='ListaReproduccionCanciones.php?idlista=" . $fila5->idlista_reproduccion . "&nombre=". $fila5->nombre ."&publica=". $fila5->tipo . "'>
														 <p>" . $fila5->nombre .  "</p></a>";
    echo "</div>";
	}
	echo "<div>";
  }


  $seguidores = "SELECT * FROM usuarios as usu INNER JOIN podcast_seguidos as seg WHERE seg.idusuarios = usu.idusuarios and seg.idpodcast='$idpodcast'";

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
