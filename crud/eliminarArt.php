<?php
$id=$_GET['id'];
include ("conex.php");

$consul="DELETE FROM articulo WHERE id='".$id."'";
$resul=mysqli_query($conex,$consul);
if ($resul) {
    session_start();
    $_SESSION['elim'] = 'correcto';
    header("location:../inventario.php");  
} else {
    session_start();
    $_SESSION['err'] = 'error';
    header("location:../invetario.php");  
}
?>