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
  $idcanciones = isset($_GET['idcanciones']) ? $_GET['idcanciones'] : 1;
  session_start();

   $id = $_SESSION['id'];
   $cancion = "SELECT * FROM canciones WHERE idcanciones='$idcanciones'";
   $resultado = $mysqli->query($cancion);
   $fila = $resultado->fetch_object();
   echo "<div>";

   echo "<iframe style='border-radius:12px'
   src='" . $fila->enlace_cancion ."'
   width='100%' height='352' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture' loading='lazy'></iframe>";

   echo "<p><b> Número de reproducciones: " . $fila->numerodereproduciones .  "</b></p>";
    echo "<p><b> Duración: " . $fila->minutos . ":" . $fila->segundos .  "</b></p>";

  if ($_SESSION['type'] == 'usuario') {
    echo "<a href='ScriptMeGustaCancion.php' class='menu'><button style='width:100%; background-color:green; color:white;'>Me Gusta</button></a><br/>";
    echo "<form action='ScriptAnadirListaCanciones.php' method='post' class='formulario'>";

    $listas = "SELECT * FROM lista_reproduccion WHERE idusuario='$id'";
    $resultado2 = $mysqli->query($listas);

    echo "<input type='submit' style='width:100%; background-color:green; color:white;' value='Añadir a una lista de reproducción'>";
    echo "<select name='idlista_reproduccion' style='width:100%;'>";
    while ($fila2 = $resultado2->fetch_object()) {
        echo "<option style='background-color: white; color: black;' value='" . $fila2->idlista_reproduccion . "'>" . $fila2->nombre . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='idcanciones' value='" . $idcanciones . "' />";
    echo "</form>";
  }
 if ($_SESSION['type'] == 'administrador'){
	echo "<form action='ScriptAnadirRecopilacionCanciones.php' method='post' class=formulario>";
 	$recopilaciones = "SELECT * FROM recopilaciones WHERE idadmin='$id'";
 	$resultado2 = $mysqli->query($recopilaciones);
 	echo "<input type='submit' style='width:100%; background-color:green;color:white;' value='Añadir a una recopilación'>";
 	echo "<select name='idrecopilaciones' style='width:100%;'>";
 	while ($fila2 = $resultado2->fetch_object()) {
 	 echo "<option style='background-color: white; color: black;'  value='" . $fila2->idrecopilaciones . "'>" . $fila2->nombre . "</option>";
 	}
 	echo "</select>";
 	echo "<input type='hidden' name='idcanciones' style='width:300%; background-color:red;color:white;' value='" . $idcanciones . "' />";
 	echo "</form>";
}



   echo "</div>";



   $recopilaciones = "SELECT * FROM recopilaciones as rec  WHERE EXISTS (SELECT * FROM contenido_recopilaciones_canciones as rcan
     WHERE rcan.idcanciones = '$idcanciones'
     and rcan.idrecopilaciones = rec.idrecopilaciones)";

   $resultado4 = $mysqli->query($recopilaciones);
   if ($resultado4->num_rows>0){
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


   $recopilaciones1 = "SELECT * FROM lista_reproduccion as rec  WHERE EXISTS (SELECT * FROM contenido_lista_canciones as rcan
     WHERE rcan.idcanciones = '$idcanciones'
     and rcan.idlista_reproduccion = rec.idlista_reproduccion)";

   $resultado5 = $mysqli->query($recopilaciones1);
   if ($resultado5->num_rows>0){
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


		 $gustas = "SELECT * FROM usuarios as usu INNER JOIN me_gusta_canciones as mg WHERE mg.idusuarios = usu.idusuarios and mg.idcanciones='$idcanciones'";

	   $resultado6 = $mysqli->query($gustas);
	   if ($resultado6->num_rows>=0){
	 		echo "<hr>";
	 		echo "<div>";
	 		echo "<p style='font-size:30px; '><b>Usuarios a los que le gusta</b></p>";
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
