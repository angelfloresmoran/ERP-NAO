<?php
    include ("conex.php");

// Variables de los datos a registrar
    $user = trim($_POST["usuario"]);
    $name = trim($_POST["nombre"]);
    $aPaterno = trim($_POST["aPaterno"]);
    $aMaterno = trim($_POST["aMaterno"]);
    $telefono = trim($_POST["tel"]);
    $correo = trim($_POST["correo"]);
    $pass = trim($_POST["contra"]);
    $salario = floatval($_POST["salario"]);
    $fechaN = trim($_POST["fechaN"]);
    $fechaI = trim($_POST["fechaI"]);
    $fechaF = trim($_POST["fechaF"]);
    $mod = trim($_POST["mod"]);
    $rol = trim($_POST["rol"]);
    $modulosSeleccionados = $_POST["modulos"] ?? [];
    $seguro = trim($_POST["seguro"]);
    $dep = trim($_POST["departamento"]);
    $foto = null;
    
//Validacion de campos para no aceptar nulos ni campos vacios   
if($user == null or $name == null or $aPaterno == null or $aMaterno == null or $telefono == null or $correo == null or $pass == null or $salario == null or $fechaN == null or $fechaI == null or $fechaF == null|| $user == " " or $name == " " or $aPaterno == " " or $aMaterno == " " or $telefono == " " or $correo == " " or $pass == " " or $salario == " " or $fechaN == " " or $fechaI == " " or $fechaF == " "){
  
    session_start();
    $_SESSION['falta'] = 'faltan';
    header("location:../formUsuario.php");
}else{

//Consulta para evitar registrar un usuario repetido 
$sql2 = "SELECT COUNT(*) as contar FROM usuarios where userName = '$user'";
$consulta = mysqli_query($conex,$sql2);
$array = mysqli_fetch_assoc($consulta);
if($array['contar']>0){
    session_start();
    $_SESSION['rep'] = 'repetido';
    header("location:../formUsuario.php");
}else{

//Inserta datos a la bd una vez se haya validado todo
$sql = "INSERT INTO usuarios VALUES('$user','$name','$aPaterno','$aMaterno','$telefono','$correo','$salario','$fechaN','$fechaI', '$fechaF','$mod','$rol','$pass', $seguro,'$dep', '$foto')";
$rta = mysqli_query($conex,$sql);

if ($rta) {
  $idEmpleado = $user;

  foreach ($modulosSeleccionados as $modulo_id) {
    mysqli_query($conex, "INSERT INTO usuario_modulo (userName, id_modulo) VALUES ('$idEmpleado', '$modulo_id')");
}
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../formUsuario.php");

}else {
    die("Error en la consulta: " . mysqli_error($conex));     
}
}
}

?>