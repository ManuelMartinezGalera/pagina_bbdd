<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="micss.css">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>

	<form action="ScriptNuevoEpisodio.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
		<table>
			<tr>
				<td>Título:</td>
				<td><input type="text" size="120" name="titulo"/></td>
			</tr>
      <tr>
				<td>Enlace a Spotify:</td>
				<td><textarea name="enlace" rows="5" cols="120"></textarea></td>
			</tr>
			<tr>
				<td>Minutos:</td>
				<td><input type="text" name="minutos" size="120" /></td>
			</tr>
            <tr>
				<td>Imagen de Portada:</td>
				<td><input type="text" name="imagendeportada" size="120" /></td>
			</tr>
			<tr>
				<td>Fecha de Publicacion:</td>
				<td><input type="text" name="fecha_publicacion" size="120" /></td>
			</tr>
            <tr>
				<td>Descripcion: </td>
				<td><input type="text" name="descripcion_episodio" size="120" /></td>
			</tr>
			<tr>
				<td>
					<?php
					$idpodcast = isset($_GET['idpodcast']) ? $_GET['idpodcast'] : '';
					echo '<input type="hidden" name="idpodcast" value="' . htmlspecialchars($idpodcast, ENT_QUOTES, 'UTF-8') . '" />';
					?>
				</td>
			</tr>
			<tr>
				<td>
				<input type="submit" style='width:300%; background-color:green;color:white;' value="Publicar" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>