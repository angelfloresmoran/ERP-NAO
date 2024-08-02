<?php
include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $estatus = $_POST['estatus'];
    $desc = $_POST['desc'];
    $tipo = $_POST['tipo'];
    

    
   

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivo']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("location:../formLicitacion.php"); 
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO licitaciones (nombre, estatus, descripcion, fecha, archivo, tipo) VALUES ( '$nombre', '$estatus', '$desc', '$fecha', '$nombre_archivo', '$tipo')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("location:../formLicitacion.php");  
            } else {
                die("Error en la consulta: " . mysqli_error($conex));  
            }
        } 
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formLicitacion.php");
}