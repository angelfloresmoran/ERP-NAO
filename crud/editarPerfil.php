<?php

include("conex.php");

if (isset($_POST['id'])) {
    $id_usr = $_POST['id'];
    $correo = $_POST['correo'];
    $tel = $_POST['tel'];
    $contra = $_POST['contra'];
  

    $carpeta_destino = "../img/";
    $nombre_archivo = basename($_FILES["foto"]["name"]);
    
    if (!empty($_FILES['foto']['name'])) {
        $sql = "SELECT * FROM usuarios WHERE userName = $id_usr";
        $resultado_select = mysqli_query($conex, $sql);
        $registro = mysqli_fetch_assoc($resultado_select);
        $nombre_archivo_anterior = $registro['foto'];
        
        $ruta_archivo_anterior = $carpeta_destino . $nombre_archivo_anterior;

        // Eliminar el archivo anterior
        if (file_exists($ruta_archivo_anterior)) {
            unlink($ruta_archivo_anterior);
        }


  



        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


        $sql = "UPDATE usuarios SET correo = '$correo', telefono = '$tel',contrasena = '$contra', foto = '$nombre_archivo' WHERE userName = '$id_usr'";
        $resultado = mysqli_query($conex, $sql);
        if ($resultado) {
            session_start();
            $_SESSION['exito'] = 'correcto';
            header("location:../editarPerfil.php");
        } else {
            // echo "Error en la consulta: " . mysqli_error($conex);
            session_start();
            $_SESSION['error'] = 'error';
            header("location:../editarPerfil.php");
        }
}else{
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../editarPerfil.php");
}



}else{
    
    $sql = "UPDATE usuarios SET correo = '$correo', telefono = '$tel',contrasena = '$contra' WHERE userName = '$id_usr'";
    $resultado = mysqli_query($conex, $sql);
    if ($resultado) {
        session_start();
        $_SESSION['exito'] = 'correcto';
        header("location:../editarPerfil.php");
    } else {
        //echo "Error en la consulta: " . mysqli_error($conex);
        session_start();
        $_SESSION['error'] = 'error';
        header("location:../editarPerfil.php");
    }
}
}else {
    // echo 'error';
    // echo "Error en la consulta: " . mysqli_error($conex);
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../editarPerfil.php");
}
?>


