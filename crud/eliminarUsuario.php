<?php
include ('conex.php');

$id_user = $_GET['id'];

$sql_modulos = "DELETE FROM usuario_modulo WHERE userName = '$id_user'";
$sql = "DELETE FROM usuarios WHERE userName = '$id_user'";
$resultado_modulo = mysqli_query($conex,$sql_modulos);
$resultado = mysqli_query($conex,$sql);

if($resultado_modulo){
    $resultado = mysqli_query($conex,$sql);
    session_start();
    $_SESSION['exito']= 'corecto';
    header("location:../gestionEmpleados.php");
}else{
    session_start();
    $_SESSION['error']= 'corecto';
    header("location:../gestionEmpleados.php");
}

?>