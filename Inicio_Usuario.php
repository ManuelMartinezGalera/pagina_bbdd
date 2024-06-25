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
   <a class="menu" href="Perfil_Usuario.php">Perfil</a>
   <a class="menu" href="Listas.php">Mi Biblioteca</a>
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
