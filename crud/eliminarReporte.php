<?php
include ('conex.php');

$id_reporte = $_GET['id'];

$sql_eliminar = "DELETE FROM reporte_proyecto WHERE id = $id_reporte";
$ejecutar = mysqli_query($conex,$sql_eliminar);


if($ejecutar){
    session_start();
    $_SESSION['exito'] = 'exito';
    header("location:../reportes.php");
}else{
    //die("Error en la consulta: " . mysqli_error($conex));  
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../servicios.php");
}


?>