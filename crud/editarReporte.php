<?php
include("conex.php");

if (isset($_POST['id'])) {
    $id_reporte = $_POST['id'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $proy = $_POST['proy'];
    

    // Verificamos si se seleccionó un nuevo archivo
    if (!empty($_FILES['archivoNuevo']['name'])) {
        $sql = "SELECT * FROM reporte_proyecto WHERE id = $id_reporte";
        $resultado_select = mysqli_query($conex, $sql);

        $registro = mysqli_fetch_assoc($resultado_select);
        $nombre_archivo_anterior = $registro['archivo'];
        $carpeta_destino = "files/";
        $nombre_archivo = basename($_FILES['archivoNuevo']['name']);
        $ruta_archivo_anterior = $carpeta_destino . $nombre_archivo_anterior;

        // Eliminar el archivo anterior
        if (file_exists($ruta_archivo_anterior)) {
            unlink($ruta_archivo_anterior);
        }

        if (move_uploaded_file($_FILES['archivoNuevo']['tmp_name'], $carpeta_destino . $nombre_archivo)) {
            // Actualizar la ruta del archivo en la base de datos
            $sql = "UPDATE reporte_proyecto SET nombre = '$nombre', fecha = '$fecha', proyecto = '$proy', archivo = '$nombre_archivo' WHERE id = $id_reporte";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                $redireccion = "../editarReporte.php?id=" . $id_reporte;
                header("Location: $redireccion");
            }else {
                session_start();
                $_SESSION['error'] = 'error';
                $redireccion = "../editarReporte.php?id=" . $id_reporte;
                header("Location: $redireccion");
            }
        } else {
            // echo "Error en la consulta: " . mysqli_error($conex);
            session_start();
            $_SESSION['error'] = 'error';
            $redireccion = "../editarReporte.php?id=" . $id_reporte;
            header("Location: $redireccion");
        }
    } else {
        // No se seleccionó un nuevo archivo, solo actualizar los otros campos
        $sql = "UPDATE reporte_proyecto SET nombre = '$nombre', fecha = '$fecha', proyecto = '$proy' WHERE id = $id_reporte";
        $resultado = mysqli_query($conex, $sql);
        if ($resultado) {
            session_start();
            $_SESSION['exito'] = 'correcto';
            $redireccion = "../editarReporte.php?id=" . $id_reporte;
            header("Location: $redireccion");
        } else {
            // echo "Error en la consulta: " . mysqli_error($conex);
            session_start();
            $_SESSION['error'] = 'error';
            $redireccion = "../editarReporte.php?id=" . $id_reporte;
            header("Location: $redireccion");
        }
    }
}else {
    // echo "Error en la consulta: " . mysqli_error($conex);
    session_start();
    $_SESSION['error'] = 'error';
    $redireccion = "../editarReporte.php?id=" . $id_reporte;
    header("Location: $redireccion");
}
?>
