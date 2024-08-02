<?php
include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivoF'])) {
    extract($_POST);
    $nombre = $_POST['nombreFac'];
    $descrip=$_POST['descFac'];
    $fecha=$_POST['fechaFac'];
    $depart = $_POST['depa'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivoF"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivoF']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("location:../formFacturacion.php"); 
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivoF"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO facturacion (nombre, descripcion, archivo, fecha, departamento) 
            VALUES ( '$nombre', '$descrip', '$nombre_archivo','$fecha','$depart')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("location:../formFacturacion.php");  
            } else {
                session_start();
                $_SESSION['error'] = 'error';
                header("location:../formFacturacion.php");  
            }
        } 
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formFacturacion.php");
}