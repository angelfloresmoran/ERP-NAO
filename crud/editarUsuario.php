<?php
include ('conex.php');

if (isset($_POST['id'])) {
    $id_user = $_POST['id'];
    $user = trim($_POST["usuario"]);
    $name = trim($_POST["nombre"]);
    $aPaterno = trim($_POST["aPaterno"]);
    $aMaterno = trim($_POST["aMaterno"]);
    $telefono = trim($_POST["tel"]);
    $correo = trim($_POST["correo"]);
    $salario = trim($_POST["salario"]);
    $fechaN = trim($_POST["fechaN"]);
    $fechaI = trim($_POST["fechaI"]);
    $fechaF = trim($_POST["fechaF"]);
    $mod = trim($_POST["mod"]);
    $rol = trim($_POST["rol"]);
    $modulosSeleccionados = $_POST["modulos"] ?? [];
    $seguro = trim($_POST["seguro"]);
    $dep = trim($_POST["departamento"]);

    $sql = "UPDATE usuarios SET userName = '$user', nombre = '$name', aPaterno = '$aPaterno', aMaterno = '$aMaterno', telefono = '$telefono', correo = '$correo', salario = '$salario', fechaNacimiento = '$fechaN', fechaInicio = '$fechaI', fechaFin = '$fechaF', modalidad = '$mod', rol = '$rol', seguro = '$seguro', departamento = '$dep' WHERE userName = '$id_user'";

    $resultado = mysqli_query($conex, $sql);
    echo mysqli_error($conex);
    if($resultado){
       
        $idEmpleado = $id_user;
        mysqli_query($conex, "DELETE FROM usuario_modulo WHERE userName = '$id_user'");

        foreach ($modulosSeleccionados as $modulo_id) {
            mysqli_query($conex, "INSERT INTO usuario_modulo (userName, id_modulo) VALUES ('$idEmpleado', '$modulo_id')");
        }
        
    session_start();
    $_SESSION['exito'] = 'correcto';
    $redireccion = "../editarUsuario.php?id=" . $id_user;
    header("Location: $redireccion");
    }
    else{
        $_SESSION['error'] = 'error';
        $redireccion = "../editarUsuario.php?id=" . $id_user;
        header("Location: $redireccion");
    }

}

?>