<?php
    include ('conex.php');
    
    $usuario = addslashes($_POST["user"]);
    $contrasena = addslashes($_POST["pass"]);

    $consultaSql = "SELECT * FROM usuarios WHERE userName = '$usuario' and contrasena = '$contrasena'";
    $ejecuta =mysqli_query($conex,$consultaSql);
    if (mysqli_num_rows($ejecuta)>0) {
    session_start();
    while ($filas = mysqli_fetch_assoc($ejecuta)) {
        $_SESSION['userName'] = $filas["userName"];
        $_SESSION['name'] = $filas['nombre']; 
        $_SESSION['apellido'] = $filas['aPaterno'];
        $_SESSION['depa'] = $filas['departamento'];
        $_SESSION['correo']=$filas['correo'];
        header('location:../dashboard.php');
    }
    }else{
        session_start();
        $_SESSION['incorrecto']='incorrecto';
        header("location:../index.php");
}

?>