<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
	$busqueda = $_POST['busqueda'];

	$bartistas = "SELECT * FROM artistas
	INNER JOIN usuarios ON artistas.idusuarios = usuarios.idusuarios 
	WHERE nombre 
	LIKE '%$busqueda%'";
	$rartistas = $mysqli->query($bartistas);
	if ($rartistas->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Artistas</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rartistas->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagen . " width='40' height='40'/></td>";
			echo "<td><a class='menu' href='Pagina_Artista.php?idartistas=" . $fila->idartistas . "'><b>" . $fila->nombre . "</b></a></td>";
		}
		echo "</table>";
	}
	$bcanciones = "SELECT * FROM canciones WHERE titulo LIKE '%$busqueda%'";
	$rcanciones = $mysqli->query($bcanciones);
	if ($rcanciones->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Canciones</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rcanciones->fetch_object()) {
			echo "<tr>";
				echo "<td><a class='menu' href='Pagina_Cancion.php?idcanciones=" . $fila->idcanciones . "'><b>" . $fila->titulo . "</b></a></td>";

		}
		echo "</table>";
	}
	$balbumes = "SELECT * FROM albumes WHERE titulo LIKE '%$busqueda%'";
	$ralbumes = $mysqli->query($balbumes);
	if ($ralbumes->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Albumes</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $ralbumes->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagendeportada . " width='40' height='40'/></td>";
			echo "<td><a class='menu' href='Pagina_Album.php?idalbumes=" . $fila->idalbumes . "'><b>" . $fila->titulo . "</b></a></td>";

		}
		echo "</table>";
	}
	$blista_reproduccion = "SELECT * FROM lista_reproduccion WHERE nombre LIKE '%$busqueda%'";
	$rlista_reproduccion = $mysqli->query($blista_reproduccion);
	
	if ($rlista_reproduccion->num_rows > 0) {
		echo "<hr>";
		echo "<p style='font-size:30px;'><b>Listas de reproducción de canciones</b></p>";
		echo "<table style='width:100%'>";
	
		while ($fila = $rlista_reproduccion->fetch_object()) {
			echo "<tr>";
	
			if ($fila->is_episodio == 0) {
				echo "<td><a class='menu' href='ListaReproduccionCanciones.php?idlista=" .
				$fila->idlista_reproduccion . "&nombre=" . $fila->nombre . "&publica=Publica'><b>" . $fila->nombre . "</b></a></td>";
			} else if ($fila->is_episodio == 1) {
				echo "<td><a class='menu' href='ListaReproduccionEpisodios.php?idlista=" .
				$fila->idlista_reproduccion . "&nombre=" . $fila->nombre . "&publica=Publica'><b>" . $fila->nombre . "</b></a></td>";
			}
	
			echo "</tr>";
		}
	
		echo "</table>";
	}
	
	
	
	$busuarios = "SELECT * FROM usuarios WHERE nick LIKE '%$busqueda%'";
	$rusuarios = $mysqli->query($busuarios);
	if ($rusuarios->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Usuarios</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rusuarios->fetch_object()) {
			echo "<tr>";
			echo "<td><img src=" . $fila->imagen ."  width='40' height='40'/></td>";
			echo "<td><b>" . $fila->nick . "</b></td>";

		}
		echo "</table>";
	}

	$bpodcast = "SELECT * FROM podcast WHERE nombre LIKE '%$busqueda%'";
	$rpodcast = $mysqli->query($bpodcast);
	if ($rpodcast->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Podcast</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $rpodcast->fetch_object()) {
			echo "<tr>";
				echo "<td><a class='menu' href='Pagina_Podcast.php?idpodcast=" . $fila->idpodcast . "'><b>" . $fila->nombre . "</b></a></td>";

		}
		echo "</table>";
	}

	$bepisodio = "SELECT * FROM episodio WHERE titulo LIKE '%$busqueda%'";
	$repisodio = $mysqli->query($bepisodio);
	if ($repisodio->num_rows>0){
		echo "<hr>";
		echo "<p style='font-size:30px; '><b>Episodio</b></p>";
		echo "<table style='width:100%'>";
		while ($fila = $repisodio->fetch_object()) {
			echo "<tr>";
				echo "<td><a class='menu' href='Pagina_Episodio.php?idepisodio=" . $fila->idepisodio . "'><b>" . $fila->titulo . "</b></a></td>";

		}
		echo "</table>";
	}

$mysqli->close();
?>
</body>
</html>
