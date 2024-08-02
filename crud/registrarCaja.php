<?php
include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivoC'])) {
    extract($_POST);
    $nombre = $_POST['nombreC'];
    $descripcion=$_POST['descripC'];
    $fecha = $_POST['fechaC'];
    $depa = $_POST['depa'];

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivoC"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivoC']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("location:../formCajachica.php"); 
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivoC"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO cajachica (nombre, descripcion, archivo, fecha, departamento) 
            VALUES ( '$nombre', '$descripcion','$nombre_archivo', '$fecha', '$depa')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("location:../formCajachica.php");  
            } else {
                session_start();
                $_SESSION['error'] = 'error';
                header("location:../formCajachica.php");  
            }
        } 
}