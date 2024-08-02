<?php
include('conex.php');
$id_articulo = $_POST['id_articulo'];
$cantidad = $_POST['cantidadResta'];

$consulta = mysqli_query($conex,"SELECT cantidad FROM articulo WHERE id = $id_articulo");
$fila = mysqli_fetch_assoc($consulta);

$nueva_cantidad =  $fila['cantidad'] - $cantidad;


$suma = mysqli_query($conex, "UPDATE articulo SET cantidad = '$nueva_cantidad'");

if($suma){
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../inventario.php");
}else{
//    echo mysqli_error($conex);
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../inventario.php");
}

?>