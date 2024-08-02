<?php
    include ("conex.php");

// Variables de los datos a registrar
    $cliente = trim($_POST["cliente"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["tel"]);
    $representante = trim($_POST["representante"]);
    
//Validacion de campos para no aceptar nulos ni campos vacios   
if($cliente == null or $email == null or $telefono == null or $representante == null || $cliente == " " or $email == " " or $telefono == " " or $representante == " "){
  
    session_start();
    $_SESSION['falta'] = 'faltan';
    header("location:../formCliente.php");
}else{

//Consulta para evitar registrar un usuario repetido 
$sql2 = "SELECT COUNT(*) as contar FROM cliente where nombreEmpresa = '$cliente'";
$consulta = mysqli_query($conex,$sql2);
$array = mysqli_fetch_assoc($consulta);
if($array['contar']>0){
    session_start();
    $_SESSION['rep'] = 'repetido';
    header("location:../formCliente.php");
}else{

//Inserta datos a la bd una vez se haya validado todo
$sql = "INSERT INTO cliente (nombreEmpresa,correo,telefono,nombreRep) VALUES('$cliente','$email','$telefono','$representante')";

$rta = mysqli_query($conex,$sql);

//Generamos mensaje de error o de correcto si la consulta fue correcta 
if (!$rta) {
    session_start();
    $_SESSION['error'] = 'error';
    header("location:../formCliente.php"); 
}else {
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../formCliente.php");    
}
}
}

?>