<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFIn = $_POST['fechaFin'];
    $team = $_POST['team'];
    $estatus = $_POST['estatus'];
    $cliente = $_POST['cliente'];
    $desc = $_POST['desc'];
    $area = $_POST['area'];
    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivo']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO proyectos (nombre, fechaInicio, fechaFin, estatusProy, team, areaDesarrollo, cliente, descripcion, archivo) VALUES ( '$nombre', '$fechaInicio', '$fechaFin', '$estatus', '$team', '$area', '$cliente', '$desc', '$nombre_archivo')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                session_start();
                $_SESSION['error'] = 'error';
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        } 
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("Location: " . $_SERVER['HTTP_REFERER']);
}