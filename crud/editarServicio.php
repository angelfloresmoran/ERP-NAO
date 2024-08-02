<?php
include("conex.php");

if (isset($_POST['id'])) {
    $id_servicio = $_POST['id'];
    $nombre = $_POST['nombre'];
    $monto = $_POST['monto'];
    $tipo = $_POST['tipo'];
    $dep = $_POST['departamento'];
    $fechaC = $_POST['fechaC'];
    $fechaT = $_POST['fechaT'];
    $obs = $_POST['observaciones'];
    

    // Verificamos si se seleccionó un nuevo archivo
    if (!empty($_FILES['archivoNuevo']['name'])) {
        $sql = "SELECT * FROM serviciocontratado WHERE id = $id_servicio";
        $resultado_select = mysqli_query($conex, $sql);
        $registro = mysqli_fetch_assoc($resultado_select);
        $nombre_archivo_anterior = $registro['comprobante'];
        $carpeta_destino = "files/";
        $nombre_archivo = basename($_FILES['archivoNuevo']['name']);
        $ruta_archivo_anterior = $carpeta_destino . $nombre_archivo_anterior;

        // Eliminar el archivo anterior
        if (file_exists($ruta_archivo_anterior)) {
            unlink($ruta_archivo_anterior);
        }

        if (move_uploaded_file($_FILES['archivoNuevo']['tmp_name'], $carpeta_destino . $nombre_archivo)) {
            // Actualizar la ruta del archivo en la base de datos
            $sql = "UPDATE serviciocontratado SET servicio = '$nombre', monto = '$monto', tipo = '$tipo', fechaContratado = '$fechaC', fechaTermino = '$fechaT', observaciones = '$obs', departamento = $dep, comprobante = '$nombre_archivo' WHERE id = $id_servicio";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                $redireccion = "../editarServicio.php?id=" . $id_servicio;
                header("Location: $redireccion");
            }else {
                // echo "Error en la consulta: " . mysqli_error($conex);
            }
        } else {
            // echo "Error en la consulta: " . mysqli_error($conex);
            session_start();
            $_SESSION['error'] = 'error';
            $redireccion = "../editarServicio.php?id=" . $id_servicio;
            header("Location: $redireccion");
        }
    } else {
        // No se seleccionó un nuevo archivo, solo actualizar los otros campos
        $sql = "UPDATE serviciocontratado SET servicio = '$nombre', monto = '$monto', tipo = '$tipo', fechaContratado = '$fechaC', fechaTermino = '$fechaT', observaciones = '$obs', departamento = $dep WHERE id = $id_servicio";
        $resultado = mysqli_query($conex, $sql);
        if ($resultado) {
            session_start();
            $_SESSION['exito'] = 'correcto';
            $redireccion = "../editarServicio.php?id=" . $id_servicio;
            header("Location: $redireccion");
        } else {
            // echo "Error en la consulta: " . mysqli_error($conex);
            session_start();
            $_SESSION['error'] = 'error';
            $redireccion = "../editarServicio.php?id=" . $id_servicio;
            header("Location: $redireccion");
        }
    }
}else {
    // echo "Error en la consulta: " . mysqli_error($conex);
    session_start();
    $_SESSION['error'] = 'error';
    $redireccion = "../editarServicio.php?id=" . $id_servicio;
    header("Location: $redireccion");
}
?>
