<?php
    include ("conex.php");

// Variables de los datos a registrar
    $id_art = $_POST['id_articulo'];
    $equipo = trim($_POST["equi"]);
    $marca = trim($_POST["marca"]);
    $modelo = trim($_POST["modelo"]);
    $medida = trim($_POST["medida"]);
    $cantidad = floatval($_POST["cantidad"]);
    $tipo = trim($_POST["tipo"]);
    $stat = trim($_POST["sta"]);
    $depa=trim($_POST["depa"]);
    $observacion=trim($_POST["obs"]);
//Validacion de campos para no aceptar nulos ni campos vacios   

//Inserta datos a la bd una vez se haya validado todo
$sql = "UPDATE articulo SET equipo = '$equipo', tipo_articulo = '$tipo', marca = '$marca', modelo = '$modelo', estatus = '$stat', cantidad = '$cantidad', unidad_medida = '$medida', departamento = '$depa', observaciones = '$observacion' WHERE id = '$id_art'";

$rt = mysqli_query($conex,$sql);

//Generamos mensaje de error o de correcto si la consulta fue correcta 
if (!$rt) {
    echo mysqli_error($conex);
    // session_start();
    // $_SESSION['error'] = 'error';
    // header("location:../editarArticulo.php"); 
}else {
    
    session_start();
    $_SESSION['exito'] = 'correcto';
    header("location:../editarArticulo.php");    
}


?>