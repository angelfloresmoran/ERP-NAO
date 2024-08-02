<?php
session_start();
$varSesion = $_SESSION['userName'];
if($varSesion == null || $varSesion == ''){
    $_SESSION['logeo']='no has logeado';
    header('Location:index.php');
    die();
}
?>

<?php

include ("crud/conex.php");
$roles = mysqli_query($conex,"SELECT id, rol FROM roles");
$modalidad = mysqli_query($conex, "SELECT id_mod, modalidad FROM modalidad");
$dep = mysqli_query($conex, "SELECT id_Dep, nombre FROM departamentos");
$seguro = mysqli_query($conex, "SELECT id, asegurado  FROM seguro");
$modulo = mysqli_query($conex, "SELECT id, modulo  FROM modulos");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Registro</title>
</head>
<body>

<!----PRINCIPAL------>
<div class="main">

<!----CONTENEDOR DEL FORMULARIO----->
    <div class="container">

        <!-----Lado izquierdo (IMAGEN)-->
        <div class="izquierda">
            <div class="izquierda-img">
                <img class="left-img" src="img/logo-formulario.jpeg" alt="" width="100%" height="100%">
            </div>
            
        </div>

        <!------Lado derecho (FORMULARIO)------>
        <div class="derecha">
            <div class="formulario">

                <form action="crud/editarUsuario.php" method="post">
                <form class="w3-container w3-card-4 w3-light-grey">
                <!--------------------Alertas Formulario--------------------------->     
                <?php
                    if(isset($_SESSION['exito'])){ ?>
                    <script>
                        swal({
                        title: "Registro Exitoso",
                        icon: "success",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['exito']); } ?> 

                <?php if(isset($_SESSION['rep'])){ ?>
                    <script>
                        swal({
                        title: "El nombre de usuario ya existe!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                    
                <?php unset($_SESSION['rep']); } ?> 

                <?php if(isset($_SESSION['falta'])){ ?>
                    <script>
                        swal({
                        title: "Rellena todos los campos correctamente!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['falta']); } ?> 
              <!---------------------------FIN ALERTAS------------------------------------------------>              
                <div class="sub-container">
                <?php
                if (isset($_GET['id'])) {
                    $id_usuario = $_GET['id'];
                    $consulta = mysqli_query($conex, "SELECT u.nombre, u.userName AS id_usr, u.aPaterno, u.aMaterno, u.telefono, u.correo, u.salario, u.fechaNacimiento, u.fechaInicio, u.fechaFin, u.modalidad, u.seguro, s.asegurado, u.departamento, m.modalidad AS moda, u.rol, r.rol AS roles, d.nombre AS nombreDep FROM usuarios u 
                    INNER JOIN seguro s ON u.seguro = s.id
                    INNER JOIN modalidad m ON u.modalidad = m.id_mod
                    INNER JOIN roles r ON u.rol = r.id
                    INNER JOIN departamentos d ON u.departamento = d.id_Dep
                    WHERE u.userName = '$id_usuario'");

     
                    echo mysqli_error($conex);
                    $user = mysqli_fetch_assoc($consulta);
                   // die("Error en la consulta: " . mysqli_error($conex));  
                }
                ?>
                    <!------COLUMNA IZQUIERDA------>
                    <div class="izquierda-form">
                        <h2>REGISTRAR USUARIO</h2>
                        <p>
                        <input type="hidden" name="id" value="<?php echo $user['id_usr']; ?>">
                        <label>Nombre de Usuario</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="usuario" type="text" placeholder="UserName123" value = "<?php echo $user['id_usr']  ?>">
                        <label>Nombre</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nombre" type="text" value = "<?php echo $user['nombre']  ?>">
                        <label>Apellido Paterno</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="aPaterno" type="text" value = "<?php echo $user['aPaterno']  ?>">
                        <label>Apellido Materno</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="aMaterno" type="text" value = "<?php echo $user['aMaterno']  ?>">
                        <label>Teléfono</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="tel" type="number" value = "<?php echo $user['telefono']  ?>">
                        <label>Correo electrónico</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="correo" type="email" value = "<?php echo $user['correo']  ?>">
                       
                                                        
                        <div class="register-btn">
                            <a href="gestionempleados.php" class="button-57"><img src="img/Back-PNG-Pic.png" width="40px" alt=""><span>INICIO</span></a>

                            <button type="submit" class="button" style="vertical-align:middle"><span>Registrar</span></button>
                        </div>

                        
                    </div>

                         <!------COLUMNA DERECHA------->
                    <div class="derecha-form">
                        <label>Salario</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="salario" type="number" value = "<?php echo $user['salario']  ?>">
                        <label>Fecha de Nacimiento</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="fechaN" type="date" value = "<?php echo $user['fechaNacimiento']  ?>">
                        <label>Inicio de contrato</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="fechaI" type="date" value = "<?php echo $user['fechaInicio']  ?>">
                        <label>Fin de contrato</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="fechaF" type="date" value = "<?php echo $user['fechaFin']  ?>">

                        <label>Modalidad</label>
                        
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="mod">
                            <option value = "<?php echo $user['modalidad']  ?>" selected="selected"><?php echo $user['moda'] ?></option>
                            <?php while ($mod = mysqli_fetch_array($modalidad)) { ?>
                                
                                <option value="<?php echo $mod['id_mod']?>"><?php echo $mod['modalidad']?></option>
                            
                                <?php } ?>
                            </select>
                        </label>

                        <label>Rol</label>
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="rol">
                            <option value = "<?php echo $user['rol']  ?>"selected="selected"><?php echo $user['roles']  ?></option>
                            <?php while ($datos = mysqli_fetch_array($roles)) { ?>
                            <option value="<?php echo $datos['id']?>"><?php echo $datos['rol']?></option>
                            <?php } ?>
                            </select>
                        </label>

                        <label>Seguro</label>
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="seguro">
                            <option value = "<?php echo $user['seguro']  ?>"selected="selected"><?php echo $user['asegurado']  ?></option>
                            <?php while ($seg = mysqli_fetch_array($seguro)) { ?>
                            <option value="<?php echo $seg['id']?>"><?php echo $seg['asegurado']?></option>
                            <?php } ?>
                            </select>
                        </label>

                        <label>Departamentos:</label>
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="departamento">
                            <option value = "<?php echo $user['departamento'] ?>" selected="selected"><?php echo $user['nombreDep']?></option>
                            <?php while ($depa = mysqli_fetch_array($dep)) { ?>
                            <option value="<?php echo $depa['id_Dep']?>"><?php echo $depa['nombre']?></option>
                            <?php } ?>
                            </select>
                        </label>
                                
                        <label>Modulos:</label><br>
                        <?php
                        $modulos_asignados_query = mysqli_query($conex, "SELECT * FROM usuario_modulo  WHERE userName = '$id_usuario'");

                        $modulos_asignados = []; // Inicializa el array de módulos asignados
                        while ($mod_asignado = mysqli_fetch_assoc($modulos_asignados_query)) {
                            $modulos_asignados[] = $mod_asignado['id_modulo']; // Agrega los IDs de los módulos asignados al array
                   }

                        while ($mod = mysqli_fetch_assoc($modulo)) {
                            $isChecked = in_array($mod['id'], $modulos_asignados) ? 'checked' : '';
                            echo '<input type="checkbox" name="modulos[]" value="' . $mod['id'] . '" ' . $isChecked . '> ' . $mod['modulo'] . '<br>';
                        }
                        ?>
                            
                </div>
                </form>      
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>