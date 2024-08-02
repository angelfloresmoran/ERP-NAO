<?php
$id=$_GET['id'];
include ("conex.php");

$consul="DELETE FROM requisiciones WHERE id='".$id."'";
$resul=mysqli_query($conex,$consul);
if ($resul) {
    session_start();
    $_SESSION['act'] = 'correcto';
    header("location:../requisiciones.php");  
} else {
    session_start();
    $_SESSION['erract'] = 'error';
    header("location:../requisiciones.php");  
}
?>