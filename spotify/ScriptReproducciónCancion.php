<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
    $script ="CREATE TRIGGER Reproducciones_Artistas
    AFTER UPDATE ON canciones
    FOR EACH ROW
    BEGIN
        IF NEW.numerodereproduciones > OLD.numerodereproduciones THEN
            UPDATE artistas 
            SET numerodereproducciones = numerodereproducciones + 1
            WHERE idartistas = (SELECT idartistas FROM albumes WHERE idalbumes = NEW.idalbumes);
        END IF;
    END"
    $mysqli->query($script);
    $mysqli->close();
?>
</body>
</html>
