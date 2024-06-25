<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="micss.css">
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>

	<form action="ScriptNuevaCancion.php" method="post" class="formulario" style='margin:20pt; background-color:black;color:white;'>
		<table>
			<tr>
				<td>Título:</td>
				<td><input type="text" size="120" name="titulo"/></td>
			</tr>
      <tr>
				<td>Enlace a Spotify:</td>
				<td><textarea name="enlaceaspotify" rows="5" cols="120"></textarea></td>
			</tr>
			<tr>
				<td>Minutos:</td>
				<td><input type="text" name="minutos" size="120" /></td>
			</tr>
			<tr>
				<td>Segundos:</td>
				<td><input type="text" name="segundos" size="120" /></td>
			</tr>
			<tr>
				<td>
					<?php
					$idalbumes = isset($_GET['idalbumes']) ? $_GET['idalbumes'] : '';
					echo '<input type="hidden" name="idalbumes" value="' . htmlspecialchars($idalbumes, ENT_QUOTES, 'UTF-8') . '" />';
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
