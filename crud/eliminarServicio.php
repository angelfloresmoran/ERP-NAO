<?php
include ('conex.php');

$id_serv = $_GET['id'];

$sql_eliminar = "DELETE FROM serviciocontratado WHERE id = $id_serv";
$ejecutar = mysqli_query($conex,$sql_eliminar);


if($ejecutar){
    session_start();
    $_SESSION['exito'] = 'exito';
    header("location:../servicios.php");
}else{
    //die("Error en la consulta: " . mysqli_error($conex));  
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../servicios.php");
}


?>