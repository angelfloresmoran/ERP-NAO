<?php
include('conex.php');

if(isset($_POST['id'])) {
    $aspirante_id = $_POST['id'];
    $nombre = $_POST['nombre-Aspirante'];
    $tel = $_POST['telefono-Aspirante'];
    $tipo = $_POST['tipo-Aspirante'];
    $dep = $_POST['dep-Aspirante'];


    // Actualiza los campos de texto
    $sql = "UPDATE aspirante SET nombre = '$nombre', telefono = '$tel', tipo = '$tipo', departamento = '$dep' WHERE id = $aspirante_id";
    $resultado = mysqli_query($conex, $sql);

    if ($resultado) {
        // Array con los nombres de los campos de archivo y sus respectivas variables
        $archivos_para_actualizar = array(
            'cv' => $_FILES['cv-Aspirante'],
            'ine' => $_FILES['ine-Aspirante'],
            'comDomicilio' => $_FILES['comprobante-domicilio-Aspirante'],
            'certificado' => $_FILES['certificado-Aspirante'],
            'carRecomendacion' => $_FILES['carta-recomendacion-Aspirante'],
            'curp' => $_FILES['curp-Aspirante'],
            'nss' => $_FILES['nss-Aspirante'],
            
            // Agrega el resto de los campos de archivo aquí
        );

        foreach ($archivos_para_actualizar as $campo => $archivo) {
            if ($archivo['error'] === UPLOAD_ERR_OK) {
                // Obtén el nombre del archivo actual en la base de datos
                $consulta_archivo = mysqli_query($conex, "SELECT $campo FROM aspirante WHERE id = $aspirante_id");
                $row_archivo = mysqli_fetch_assoc($consulta_archivo);
                $nombre_archivo_actual = $row_archivo[$campo];

                // Guarda el nuevo archivo y reemplaza el anterior
                $archivo_guardado = guardarArchivo($archivo, $carpeta_destino, $nombre_archivo_actual);

                $sql_archivo = "UPDATE aspirante SET $campo = '$archivo_guardado' WHERE id = $aspirante_id";
                $resultado_archivo = mysqli_query($conex, $sql_archivo);

                if (!$resultado_archivo) {
                    echo "Error al actualizar el archivo $campo: " . mysqli_error($conex);
                }
            }
        }

        session_start();
        $_SESSION['exito'] = 'correcto';
        $redireccion = "../editarAspirante.php?id=" . $aspirante_id;
        header("Location: $redireccion");
    } else {
        session_start();
        $_SESSION['error'] = 'error';
        $redireccion = "../editarAspirante.php?id=" . $aspirante_id;
        header("Location: $redireccion");
    }
} else {
    echo "No se proporcionó un ID de aspirante para actualizar.";
}

function guardarArchivo($archivo, $carpeta_destino, $archivo_anterior = null) {
    if ($archivo_anterior) {
        // Elimina el archivo anterior si existe
        $ruta_archivo_anterior = $carpeta_destino . $archivo_anterior;
        if (file_exists($ruta_archivo_anterior)) {
            unlink($ruta_archivo_anterior);
        }
    }

    $nombre_archivo = $archivo['name'];
    $ruta_archivo = $carpeta_destino . $nombre_archivo;
    if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
        echo "El archivo $nombre_archivo se ha cargado correctamente y se ha guardado en el servidor.<br>";
        return $nombre_archivo;
    } else {
        session_start();
        $_SESSION['error'] = 'error';
        $redireccion = "../editarAspirante.php?id=" . $aspirante_id;
        header("Location: $redireccion");
    }
}
?>
