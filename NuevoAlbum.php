<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="micss.css">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>

	<form action="ScriptNuevoAlbum.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
		<table>
			<tr>
				<td>Título:</td>
				<td><input type="text" size="120" name="titulo"/></td>
			</tr>
      <tr>
				<td>Año de Publicación:</td>
				<td><input name="anopublicacion" type="text" size="120"/></td>
			</tr>
			<tr>
				<td>Enlace Imagen:</td>
				<td><input type="text" name="imagendeportada" size="120" /></td>
			</tr>
			<tr>
				<td>
					<?php
					$idartista = isset($_GET['idartistas']) ? $_GET['idartistas'] : '';
					echo '<input type="hidden" name="idartistas" value="' . htmlspecialchars($idartista, ENT_QUOTES, 'UTF-8') . '" />';
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
