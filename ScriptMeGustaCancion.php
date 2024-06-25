<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
    $triggermgcanciones = "CREATE TRIGGER MeGustaCancion ON me_gusta_cancion FOR
    BEGIN
    DELETE FROM MeGusta
    WHERE artistas IN (SELECT idartistas FROM inserted WHERE TipoAccion = 'Me Gusta');
    
    INSERT INTO MeGusta (idartistas, fecha)
    SELECT 
        idartistas, 
        GETDATE()
    FROM 
        inserted
    WHERE 
        TipoAccion = 'Me Gusta';
    
    UPDATE artistas
    SET NumeroMeGusta = (SELECT COUNT(*) FROM MeGusta WHERE idartistas = inserted.idartistas)
    FROM inserted
    WHERE artistas.idartistas = inserted.idartistas AND inserted.TipoAccion = 'Me Gusta';
END";
?>
</body>
</html>
