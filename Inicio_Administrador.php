<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>

<link rel="stylesheet" href="micss.css">
</head>
<body>



 <div class="sidebar">
   <img src="spotify.png" alt="Spotify" width="100%" height="100">
   <a class="menu" href="Buscador.php">Buscador</a>
   <a class="menu" href="Recopilaciones.php">Recopilaciones</a>
   <a class="menu" href="NuevoArtista.php">Nuevo Artista</a>
   <a class="menu" href="NuevoPodCast.php">Nuevo PodCast</a>
   <a class="menu" href="NuevaRecopilacionCanciones.php">Nueva Recopilación de Canciones</a>
   <a class="menu" href="NuevaRecopilacionEpisodios.php">Nueva Recopilación de Episodios</a>
   <a class="menu" href="NuevaTematica.php">Nueva Temática</a>
   <a class="menu" href="Consulta1.php">Número de artistas por temática</a>
   <a class="menu" href="Consulta2.php">Número de podcasts por temática</a>
   <a class="menu" href="Consulta3.php">Artistas más seguidos</a>
   <a class="menu" href="Consulta4.php">Podcasts más seguidos</a>
   <a class="menu" href="Consulta5.php">Número medio de me gusta de artistas</a>
   <a class="menu" href="Consulta6.php">Número medio de me gusta de podcasts</a>
   <a class="menu" href="Consulta7.php">Número de apariciones de canciones en listas y recopilatorios</a>
   <a class="menu" href="Consulta8.php">Número de apariciones de episodios en listas y recopilatorios</a>
   <a class="menu" href="Consulta9.php">Canciones que no gustan</a>
   <a class="menu" href="Consulta10.php">Epidodios que no gustan</a>
   <a href="Inicio.html">Logout</a>
 </div>

<div class="content" id="main" >
<div>
   <?php include 'Principal.php'?>
 </div>
</div>
<script>

$(document).on('click', '.menu', function(e) {
  e.preventDefault();
 $.ajax({
   url: $(this).attr('href'),
   success: function(data){
     $("#main").html(data);
   }
 });
});
</script>
<script>
$(document).on('submit', '.formulario', function() {
	 event.preventDefault();
	 $.ajax( {
			 url: $(this).attr('action'),
			 data: $(".formulario").serialize(),
			 method: "post",
			dataType: 'html',
			 success: function(strMessage) {
					 $("#main").html(strMessage);
			 }
	 });
 });


</script>
</body>
</html>
