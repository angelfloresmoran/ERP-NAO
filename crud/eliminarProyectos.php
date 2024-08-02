<?php
include ('conex.php');
    $id_proyecto = $_GET['id']; // Obtén el ID del registro a eliminar desde la URL

    // Obtén la información del archivo de la base de datos
    $sql = "SELECT archivo FROM proyectos WHERE id = $id_proyecto";
    $resultado = mysqli_query($conex, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    
    $archivo_a_eliminar = $fila['archivo'];
    
    // Elimina el archivo físico si existe
    if (file_exists($archivo_a_eliminar)) {
        unlink($archivo_a_eliminar);
    }
    
    // Elimina el registro de la base de datos
    $sql_eliminar = "DELETE FROM proyectos WHERE id = $id_proyecto";
    $resultado_eliminar = mysqli_query($conex, $sql_eliminar);
    
    if ($resultado_eliminar) {
        session_start();
        $_SESSION['exito'] = 'correcto';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        session_start();
        $_SESSION['error'] = 'error';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }


?>