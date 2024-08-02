<?php
$id=$_GET['id'];
include ("conex.php");

$sql = "SELECT archivo FROM facturacion WHERE id = $id";
$resultado = mysqli_query($conex, $sql);
$fila = mysqli_fetch_assoc($resultado);

$archivo_a_eliminar = $fila['archivo'];

// Elimina el archivo físico si existe
if (file_exists($archivo_a_eliminar)) {
    unlink($archivo_a_eliminar);
}


$consul="DELETE FROM facturacion WHERE id='".$id."'";
$resul=mysqli_query($conex,$consul);
if ($resul) {
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../facturas.php");  
} else {
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../facturas.php");  
}
?>