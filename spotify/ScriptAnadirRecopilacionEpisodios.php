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
        $idepisodio = $_POST['idepisodio'];

        // Mostrar los valores para depuración
        echo "ID recopilacion: $idrecopilacion<br>";
        echo "ID episodio: $idepisodio<br>";

        // Verificar si las variables no están vacías
        if (!empty($idrecopilacion) && !empty($idepisodio)) {
            $cadenaSQL = "INSERT INTO contenido_recopilaciones_caciones (idrecopilaciones, idepisodio) VALUES ('$idrecopilacion', '$idepisodio')";
            echo "SQL Query: $cadenaSQL<br>";
            if ($mysqli->query($cadenaSQL)) {
                echo "Episodio añadido exitosamente.<br>";
                header("Location: Pagina_Episodio.php?idepisodio=" . $idepisodio);
                exit();
            } else {
                echo "Error al añadir episodio: " . $mysqli->error . "<br>";
            }
        } else {
            echo "Error: ID de recopilación o de episodio está vacío.<br>";
        }
    }

    $mysqli->close();
    ?>
</body>
</html>
