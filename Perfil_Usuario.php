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

	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	$usuario = "SELECT * FROM usuarios WHERE login='$login' AND password='$password'";
	$resultado = $mysqli->query($usuario);

		$fila = $resultado->fetch_object();
		echo "<br/>";
		echo "<br/>";
    echo "<div width='100%''>";
    echo "<img src=" . $fila->imagen ."  class='avatar'/>";
		echo "<br/>";
		echo "<br/>";
	 	echo "<p><b> Perfil de " . $fila->nick .  "</b></p>";
		echo "<p><b> Nombre: " . $fila->nombre .  "</b></p>";
    echo "</div>";




 $usuario = $fila->idusuarios;
 $artistas ="SELECT *, ua.nombre as nombre_usuario
 FROM usuarios AS u
 INNER JOIN artistas_seguidos AS aseg ON u.idusuarios = aseg.idusuarios
 INNER JOIN artistas AS a ON aseg.idartistas = a.idartistas
 INNER JOIN usuarios AS ua ON a.idusuarios = ua.idusuarios
 WHERE u.idusuarios = $usuario";
 $resultado2 = $mysqli->query($artistas);
 if ($resultado2->num_rows>0){
	 	echo "<hr>";
	 echo "<div>";
	 echo "<p style='font-size:30px; '><b>Artistas que sigues</b></p>";
		while ($fila2 = $resultado2->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
			echo "<a class='menu' href='Pagina_Artista.php?idartistas=" . $fila2->idartistas . "'> <img width='200' height='200' src='". $fila2->imagen ."'></img></a>";
			echo "<p>" . $fila2->nombre_usuario . "</p>";
			echo "</div>";
		}
	}
	echo "</div>";


	$usuario = $fila->idusuarios;
  $podcasts ="SELECT * FROM podcast INNER JOIN podcast_seguidos as pseg
	WHERE pseg.idusuarios=$usuario AND
  pseg.idpodcast = podcast.idpodcast";
  $resultado3 = $mysqli->query($podcasts);
  if ($resultado3->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Podcasts que sigues</b></p>";
 		while ($fila3 = $resultado3->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
			echo "<a class='menu' href='Pagina_Podcast.php?idpodcast=" . $fila3->idpodcast . "'> <img src=" . $fila3->imagen . " width='200' height='200'/>" ;
			echo "<p>" . $fila3->nombre . "</p>";
			echo "</div>";
 		}
 	}
	echo "</div>";


	$usuario = $fila->idusuarios;
  $canciones ="SELECT * FROM canciones as can 
  INNER JOIN me_gusta_canciones as gcan 
  INNER JOIN albumes as alb 
  WHERE 
  gcan.idusuarios=$usuario and can.idcanciones = gcan.idcanciones and alb.idalbumes = can.idalbumes";
  $resultado4 = $mysqli->query($canciones);
  if ($resultado4->num_rows>0){
		echo "<hr>";
  	echo "<div>";
  	echo "<p style='font-size:30px; '><b>Canciones que te gustan</b></p>";
 	 while ($fila4 = $resultado4->fetch_object()) {
		echo "<div class='column' style='margin: 20pt;'>";
		echo "<a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila4->idcanciones . "'> <img src=" . $fila4->imagendeportada . " width='200' height='200'/></a>";
 		echo "<p>" . $fila4->titulo . "</p>";
 		echo "</div>";
 	 }
  }
	echo "</div>";


	$usuario = $fila->idusuarios;
  $episodios ="SELECT * FROM episodio as epi INNER JOIN me_gusta_canciones as gep INNER JOIN podcast as pod WHERE gep.idusuarios=$usuario
	and epi.idepisodio = gep.idepisodio and pod.idpodcast = epi.idpodcast";
  $resultado5 = $mysqli->query($episodios);
  if ($resultado5->num_rows>0){
		echo "<hr>";
		echo "<div>";
		echo "<p style='font-size:30px; '><b>Episodios que te gustan</b></p>";
 		while ($fila5 = $resultado5->fetch_object()) {
			echo "<div class='column' style='margin: 20pt;'>";
	 		echo "<img src=" . $fila5->imagen . " width='200' height='200'/>" ;
	 		echo "<p style='max-width: 150pt; overflow: hidden;'>" . $fila5->descripcion_episodio . "</p>";
	 		echo "</div>";
 		}
 	}
	echo "</div>";
$mysqli->close();
?>
</body>
</html>
