<?php
include("conex.php");

if (isset($_POST['id'])) {
    $id_proyecto = $_POST['id'];
    $nombre = $_POST['nombre'];
    $desc = $_POST['desc'];
    $team = $_POST['team'];
    $fInicio = $_POST['fechaInicio'];
    $fFin = $_POST['fechaFin'];
    $estatus = $_POST['estatus'];
    $area = $_POST['area'];
    $cliente = $_POST['cliente'];

    // Verificamos si se seleccionó un nuevo archivo
    if (!empty($_FILES['archivoNuevo']['name'])) {
        $sql = "SELECT * FROM proyectos WHERE id = $id_proyecto";
        $resultado_select = mysqli_query($conex, $sql);
        $registro = mysqli_fetch_assoc($resultado_select);
        $nombre_archivo_anterior = $registro['archivo'];
        $carpeta_destino = "files/";
        $nombre_archivo = basename($_FILES['archivoNuevo']['name']);
        $ruta_archivo_anterior = $carpeta_destino . $nombre_archivo_anterior;

        // Eliminar el archivo anterior
        if (file_exists($ruta_archivo_anterior)) {
            unlink($ruta_archivo_anterior);
        }

        if (move_uploaded_file($_FILES['archivoNuevo']['tmp_name'], $carpeta_destino . $nombre_archivo)) {
            // Actualizar la ruta del archivo en la base de datos
            $sql = "UPDATE proyectos SET nombre = '$nombre', fechaInicio = '$fInicio', fechaFin = '$fFin', estatusProy = '$estatus', team = '$team', areaDesarrollo = '$area', cliente = '$cliente', descripcion = '$desc', archivo = '$nombre_archivo' WHERE id = $id_proyecto";
            $resultado = mysqli_query($conex, $sql);
            if ($resultado) {
                session_start();
                $_SESSION['exito'] = 'correcto';
                $redireccion = "../editarProyecto.php?id=" . $id_proyecto;
                header("Location: $redireccion");
            }else {
                echo "Error en la consulta: " . mysqli_error($conex);
            }
        } else {
            session_start();
            $_SESSION['error'] = 'error';
            header("location:../editarProyecto.php");
        }
    } else {
        // No se seleccionó un nuevo archivo, solo actualizar los otros campos
        $sql = "UPDATE proyectos SET nombre = '$nombre', fechaInicio = '$fInicio', fechaFin = '$fFin', estatusProy = '$estatus', team = '$team', areaDesarrollo = '$area', cliente = '$cliente', descripcion = '$desc' WHERE id = $id_proyecto";
        $resultado = mysqli_query($conex, $sql);
        if ($resultado) {
            session_start();
            $_SESSION['exito'] = 'correcto';
            $redireccion = "../editarProyecto.php?id=" . $id_proyecto;
            header("Location: $redireccion");
        } else {
            session_start();
            $_SESSION['error'] = 'error';
            $redireccion = "../editarProyecto.php?id=" . $id_proyecto;
            header("Location: $redireccion");
        }
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los valores del formulario
    $nuevoEstatus = $_POST['estatus'];
    $id_proyecto = $_POST['id_proyecto'];

    // Actualiza el estatus en la base de datos
    $sql = "UPDATE proyectos SET estatusproy = '$nuevoEstatus' WHERE id = $id_proyecto";
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
?>
