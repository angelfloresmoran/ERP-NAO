<?php
include ('conex.php');
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $desc = $_POST['desc'];
    $archivo = $_POST['archivo'];
    $fecha = $_POST['fecha'];
   
    

    
   

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);

    $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivo']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['grande'] = 'error';
        header("location:../formRequisicion.php"); 
        exit;
    }

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos

            $sql = "INSERT INTO requisiciones (nombre, descripcion, archivo, fecha) VALUES ( '$nombre', '$desc', '$nombre_archivo', '$fecha')";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                header("location:../formRequisicion.php");  
            } else {
                // die("Error en la consulta: " . mysqli_error($conex));  
                session_start();
                $_SESSION['error'] = 'error';
                header("location:../formRequisicion.php"); 
            }
        } 
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formRequisicion.php"); 
}