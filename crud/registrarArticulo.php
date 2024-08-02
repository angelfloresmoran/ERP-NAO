<?php
    include ("conex.php");

// Variables de los datos a registrar
    $equipo = trim($_POST["equi"]);
    $marca = trim($_POST["marca"]);
    $modelo = trim($_POST["modelo"]);
    $stat = trim($_POST["sta"]);
    $depa=trim($_POST["depa"]);
    $observacion=trim($_POST["obs"]);
//Validacion de campos para no aceptar nulos ni campos vacios   
if($equipo == null or $marca == null or $modelo == null or $stat == null or $depa == null or $observacion == null || $equipo == " " or $marca == " " or $modelo == " " or $stat == " " or $depa == " " or $observacion == " "){
  
    session_start();
    $_SESSION['falta'] = 'faltan';
    header("location:../formArticulo.php");
}
else {

//Inserta datos a la bd una vez se haya validado todo
$sql = "INSERT INTO articulo (equipo,marca,modelo,estatus,departamento,observaciones) VALUES('$equipo','$marca','$modelo','$stat','$depa','$observacion')";

$rt = mysqli_query($conex,$sql);

//Generamos mensaje de error o de correcto si la consulta fue correcta 
if (!$rt) {
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formArticulo.php"); 
}else {
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../formArticulo.php");    
}
}

?>