<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link rel="stylesheet" href="micss.css">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
</head>
<body>
    <?php
    include_once('Conexion.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idrecopilacion = $_POST['idrecopilaciones'];
        $idcancion = $_POST['idcanciones'];

        // Mostrar los valores para depuración
        echo "ID Lista: $idrecopilacion<br>";
        echo "ID Canción: $idcancion<br>";

        // Verificar si las variables no están vacías
        if (!empty($idrecopilacion) && !empty($idcancion)) {
            $cadenaSQL = "INSERT INTO contenido_recopilaciones_caciones (idrecopilaciones, idcanciones) VALUES ('$idrecopilacion', '$idcancion')";
            echo "SQL Query: $cadenaSQL<br>";
            if ($mysqli->query($cadenaSQL)) {
                echo "Canción añadida exitosamente.<br>";
                header("Location: Pagina_Cancion.php?idcanciones=" . $idcancion);
                exit();
            } else {
                echo "Error al añadir la canción: " . $mysqli->error . "<br>";
            }
        } else {
            echo "Error: ID de lista o de canción está vacío.<br>";
        }
    }

    $mysqli->close();
    ?>
</body>
</html>
