<?php
include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $proy = $_POST['proy'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivo']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("location:../formReporte.php"); 
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO reporte_proyecto (nombre, fecha, proyecto, archivo) 
            VALUES ( '$nombre', '$fecha', '$proy', '$nombre_archivo')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("location:../formReporte.php");  
            } else {
                session_start();
                $_SESSION['error'] = 'error';
                header("location:../formReporte.php");  
            }
        } 
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formReporte.php");  
}