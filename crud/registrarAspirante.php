<?php
// Verificar si se han enviado archivos desde los campos de entrada
if (isset($_FILES['cv-Aspirante']) && isset($_FILES['ine-Aspirante']) && isset($_FILES['comprobante-domicilio-Aspirante']) && isset($_FILES['certificado-Aspirante']) && isset($_FILES['carta-recomendacion-Aspirante']) && isset($_FILES['curp-Aspirante']) && isset($_FILES['nss-Aspirante'])) {
    $nombre = $_POST['nombre-Aspirante'];
    $tel = $_POST['telefono-Aspirante'];
    $tipo = $_POST['tipo-Aspirante'];
    $dep = $_POST['dep-Aspirante'];

    $carpeta_destino = "files/";

    function guardarArchivo($archivo, $carpeta_destino) {
        $nombre_archivo =  $archivo['name'];
        $ruta_archivo = $carpeta_destino . $nombre_archivo; 
        if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
            echo "El archivo $nombre_archivo se ha cargado correctamente y se ha guardado en el servidor.<br>";
            return $nombre_archivo; // Devuelve solo el nombre del archivo
        } else {
            echo "Error al cargar el archivo $nombre_archivo.<br>";
            return null;
        }
    }

    // Procesar y guardar cada archivo
    $cv_aspirante_guardado = guardarArchivo($_FILES['cv-Aspirante'], $carpeta_destino);
    $ine_aspirante_guardado = guardarArchivo($_FILES['ine-Aspirante'], $carpeta_destino);
    $comprobante_domicilio_guardado = guardarArchivo($_FILES['comprobante-domicilio-Aspirante'], $carpeta_destino);
    $certificado_guardado = guardarArchivo($_FILES['certificado-Aspirante'], $carpeta_destino);
    $carta_guardado = guardarArchivo($_FILES['carta-recomendacion-Aspirante'], $carpeta_destino);
    $curp_guardado = guardarArchivo($_FILES['curp-Aspirante'], $carpeta_destino);
    $nss_guardado = guardarArchivo($_FILES['nss-Aspirante'], $carpeta_destino);

    include ('conex.php');


    $sql = "INSERT INTO aspirante (nombre, telefono, cv, ine, comDomicilio, certificado, carRecomendacion, curp, nss, tipo, departamento) VALUES ('$nombre', '$tel', '$cv_aspirante_guardado','$ine_aspirante_guardado', '$comprobante_domicilio_guardado', '$certificado_guardado', '$carta_guardado', '$curp_guardado', '$nss_guardado', '$tipo', '$dep')";
    $resultado = mysqli_query($conex, $sql);
    if ($resultado) {
        session_start();
        $_SESSION['exito'] = 'correcto';
        header("location:../formAspirante.php");
    } else {
        // die("Error en la consulta: " . mysqli_error($conex));
        session_start();
        $_SESSION['error'] = 'error';
        header("location:../formAspirante.php");
    }
} else {
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formAspirante.php");
}
?>