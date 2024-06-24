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
	$login = $_POST['login'];
	$password = $_POST['password'];
	$usuario = "SELECT * FROM usuarios WHERE  login='$login' AND password='$password'";
	$resultado = $mysqli->query($usuario);
	if ($resultado->num_rows>0){

		  $fila = $resultado->fetch_object();
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['password'] = $password;
			$_SESSION['id'] = $fila->idusuarios;
			$_SESSION['type'] = 'usuario';
      $_SESSION['loggedin'] = true;
			header("Location:Inicio_Usuario.php");
	}
	else {
		$administrador = "SELECT * FROM administrador WHERE 
		administrador.login='$login' AND 
		administrador.password='$password'";
		$resultado = $mysqli->query($administrador);
		if ($resultado->num_rows>0){
			  $fila = $resultado->fetch_object();
				session_start();
				$_SESSION['login'] = $login;
				$_SESSION['password'] = $password;
				$_SESSION['id'] = $fila->$idadmin;
				$_SESSION['type'] = 'administrador';
	      $_SESSION['loggedin'] = true;
				header("Location:Inicio_Administrador.php");
		}
		else {
			$artista = "SELECT * FROM artistas WHERE login='$login' AND password='$password'";
			$resultado = $mysqli->query($artista);
			if ($resultado->num_rows>0){
					$fila = $resultado->fetch_object();
					session_start();
					$_SESSION['login'] = $login;
					$_SESSION['password'] = $password;
					$_SESSION['id'] = $fila->idartistas;
					$_SESSION['type'] = 'artista';
					$_SESSION['loggedin'] = true;
					header("Location:Inicio_Artista.php");
		}
		else {
			$podcast = "SELECT * FROM podcast WHERE login='$login' AND password='$password'";
			$resultado = $mysqli->query($podcast);
			if ($resultado->num_rows>0){
					$fila = $resultado->fetch_object();
					session_start();
					$_SESSION['login'] = $login;
					$_SESSION['password'] = $password;
					$_SESSION['id'] = $fila->idpodcast;
					$_SESSION['type'] = 'podcast';
					$_SESSION['loggedin'] = true;
					header("Location:Inicio_PodCast.php");
		} else {
			echo "<h1>Usuario no encontrado: Revise sus credenciales.</h1>";
		}
	}
}
}


$mysqli->close();
?>
</body>
</html>
