<?php
$id=$_GET['id'];
include ("conex.php");

$consul="DELETE FROM cliente WHERE id='".$id."'";
$resul=mysqli_query($conex,$consul);
if ($resul) {
    session_start();
    $_SESSION['elim'] = 'correcto';
    header("location:../clientes.php");  
} else {
    session_start();
    $_SESSION['err'] = 'error';
    header("location:../clientes.php");  
}
?>