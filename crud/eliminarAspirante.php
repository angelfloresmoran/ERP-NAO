<?php
include('conex.php');

if(isset($_GET['id'])) {
    $aspirante_id = $_GET['id'];

    // Obtén los nombres de los archivos relacionados antes de eliminar el registro
    $consulta_archivos = mysqli_query($conex, "SELECT cv, ine, comDomicilio, certificado, carRecomendacion, curp, nss FROM aspirante WHERE id = $aspirante_id");
    $row_archivos = mysqli_fetch_assoc($consulta_archivos);

    // Elimina el registro de la base de datos
    $sql_eliminar = "DELETE FROM aspirante WHERE id = $aspirante_id";
    $resultado_eliminar = mysqli_query($conex, $sql_eliminar);

    if ($resultado_eliminar) {
        // Elimina los archivos relacionados de la carpeta "files"
        foreach ($row_archivos as $archivo) {
            if (!empty($archivo)) {
                $ruta_archivo = "files/" . $archivo;
                if (file_exists($ruta_archivo)) {
                    unlink($ruta_archivo);
                }
            }
        }

        session_start();
        $_SESSION['exito'] = 'correcto';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        session_start();
        $_SESSION['error'] = 'error';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
} else {
    echo "No se proporcionó un ID de aspirante para eliminar.";
}
?>
