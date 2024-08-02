<?php
$id=$_GET['id'];
include ("conex.php");

$consul="DELETE FROM cajachica WHERE id='".$id."'";
$resul=mysqli_query($conex,$consul);
if ($resul) {
    session_start();
    $_SESSION['act'] = 'correcto';
    header("location:../cajaChica.php");  
} else {
    session_start();
    $_SESSION['erract'] = 'error';
    header("location:../cajaChica.php");  
}
?>