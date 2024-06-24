<!DOCtype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="micss.css">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
	<?php
	include_once ('Conexion.php');
    $triggermgcanciones = "CREATE TRIGGER MeGustaCancion ON MeGustaCancion FOR
    BEGIN
    DELETE FROM MeGusta
    WHERE artistas IN (SELECT idartistas FROM inserted WHERE TipoAccion = 'Me Gusta');
    
    INSERT INTO MeGusta (ArtistaID, FechaMeGusta)
    SELECT 
        ArtistaID, 
        GETDATE()
    FROM 
        inserted
    WHERE 
        TipoAccion = 'Me Gusta';
    
    UPDATE Artistas
    SET NumeroMeGusta = (SELECT COUNT(*) FROM MeGusta WHERE ArtistaID = inserted.ArtistaID)
    FROM inserted
    WHERE Artistas.ArtistaID = inserted.ArtistaID AND inserted.TipoAccion = 'Me Gusta';
END";
?>
</body>
</html>
