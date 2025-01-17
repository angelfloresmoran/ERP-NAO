<?php
include "conex.php";

// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

// Buscar el archivo en la base de datos
$sql = "SELECT * FROM cotizacion WHERE id = '$id'";
$resultado = mysqli_query($conex, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $filas = mysqli_fetch_assoc($resultado);
    $archivo = $filas['archivo'];
    $ruta_archivo = "files/" . $archivo;

    // Verificar que el archivo exista en el servidor
    if (file_exists($ruta_archivo)) {
        // Enviar el archivo al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        readfile($ruta_archivo);
    } else {
        echo "El archivo no existe en el servidor.";
    }
} else {
    echo "El archivo no se encontró en la base de datos.";
}

?>