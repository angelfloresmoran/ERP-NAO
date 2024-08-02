<?php
include ('crud/conex.php');

session_start();
$varSesion = $_SESSION['userName'];
if($varSesion == null || $varSesion == ''){
    $_SESSION['logeo']='no has logeado';
    header('Location:index.php');
    die();
}

$modulo = mysqli_query($conex, "SELECT m.* FROM modulos m INNER JOIN usuario_modulo um ON m.id = um.id_modulo INNER JOIN usuarios u ON u.userName = um.userName WHERE u.userName = '$_SESSION[userName]';");

$modUsr = array();

while ($fila = mysqli_fetch_assoc($modulo)) {
    $modUsr[] = $fila['id'];
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
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stilonav.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/estiloForm.css">

</head>
<body>
   


    <nav>
        <div></div>

        <div class="tittle">
            <h4>INICIO</h4>
        </div>
        
        <div></div>

    </nav>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
             <img id="cloud" name="cloud-outline" src="./assets/bx-menu.svg" width="30%"> 
            </div>
        </div>

       <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>


        <div class="navegacion">

            <ul>

                <li class="list__item">
                    <div class="list__button">
                        <img src="assets/dashboard" name="mail-unread-outline" class="list__img">
                        <a href="dashboard.php" class="nav__link">Inicio</a>
                    </div>
                </li>
    
                <?php if (in_array(1, $modUsr)) { ?>
                    <!-----------Módulo 1- DESARROLLO----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bx-terminal.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Desarrollo</a>
                            <img src="assets/arrow" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="proyectosDesarrollo.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="servicios.php" class="nav__link nav__link--inside">Servicios</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(2, $modUsr)) { ?>
                    <!-----------Módulo 2- REDES----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bxs-network-chart.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Redes</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="proyectosRedes.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="reportes.php" class="nav__link nav__link--inside">Reportes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(5, $modUsr)) { ?>
                    <!-----------Módulo 5- Diseño----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bx-palette.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Diseño</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="proyectosDiseno.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="reportes.php" class="nav__link nav__link--inside">reportes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(3, $modUsr)) { ?>
                    <!-----------Módulo 3- R.R.H.H.----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bx-group.svg" class="list__img" name="document-text-outline">
                            <a class="nav__link">R.R.H.H</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="gestionEmpleados.php" class="nav__link nav__link--inside">Gestión de Empleados</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="reclutamiento.php" class="nav__link nav__link--inside">Reclutamiento</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="practicasServicio.php" class="nav__link nav__link--inside">Practicas P. y Servicio S.</a>
                            </li>
                            
                            <li class="list__inside">
                                <a href="teams.php" class="nav__link nav__link--inside">Equipos de Trabajo</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
    
                <?php if (in_array(4, $modUsr)) { ?>
                    <!-----------Módulo 4- Administración----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bx-clipboard.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Administración</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="inventario.php" class="nav__link nav__link--inside">Inventario</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="clientes.php" class="nav__link nav__link--inside">Clientes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(6, $modUsr)) { ?>
                    <!-----------Módulo 6- Contabilidad----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bx-money.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Contabilidad</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
                            <ul class="list__show">
                                <li class="list__inside">
                                    <a href="facturas.php" class="nav__link nav__link--inside">Facturas</a>
                                </li>
            
                                <li class="list__inside">
                                    <a href="pagos.php" class="nav__link nav__link--inside">Pagos</a>
                                </li>

                                <li class="list__inside">
                                    <a href="cotizaciones.php" class="nav__link nav__link--inside">Cotizaciones</a>
                                </li>

                                <li class="list__inside">
                                    <a href="cajaChica.php" class="nav__link nav__link--inside">Caja Chica</a>
                                </li>

                                <li class="list__inside">
                                    <a href="requisiciones.php" class="nav__link nav__link--inside">Requisiciones</a>
                                </li>
                            </ul>
                        </li>
                <?php } ?>

                <?php if (in_array(7, $modUsr)) { ?>
                    <!-----------Módulo 7- Licitaciones----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="assets/bxs-bank.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Licitaciones</a>
                            <img src="assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="licitaciones.php" class="nav__link nav__link--inside">Licitaciones y concursos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="historico.php" class="nav__link nav__link--inside">Histórico</a>
                            </li>
                        </ul>
        
                    </li>
                <?php } ?> 
    
            </ul>
        </div>

        <div>
            <div class="linea"></div>

            <div class="modo-oscuro">
                <div class="info">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span>Drak Mode</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo">
                            
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="usuario">
            
            <?php
          include('crud/conex.php');
          $sql = mysqli_query($conex, "SELECT * FROM usuarios");
          $fila = mysqli_fetch_assoc($sql);
          
          $imagen = '';
          if(!file_exists('img/' . $imagen)){
              $imagen = "usuario.png";
          }else{
              $imagen = $fila['foto'];
          }
          ?>
  
                  <img src="img/<?php echo $imagen ?>" alt="">
                  <div class="info-usuario">
                      <div class="nombre-email">
                          <span class="nombre"><?php echo $_SESSION['name']; ?></span>
                          <span class="email"><?php echo $_SESSION['correo']; ?></span>
                      </div>
                      <a href="editarPerfil.php"><img src="./assets/bx-cog.svg"></a>
                      
                  </div>
              </div>
        </div>

    </div>


  <main>
    <div class="main-content"> 

    <div class="row">
    <div class="col-md-12">
      <form action="crud/editarUsuario.php" method="post">

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


        <h1>Editar Usuario</h1>
        
        <fieldset>
          
          <legend><span class="number">1</span> Información Básica</legend>
        
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
                        <label>Salario</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="salario" type="text" value = "<?php echo $user['salario']  ?>">
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
                       
        

        </fieldset>
       
        <a href="gestionEmpleados.php"><img src="./assets/bx-arrow-back.svg"></a>
        <button type="submit">Actualizar</button>
        
       </form>
        </div>
      </div>                

    </div>
  </main>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./script-sidebar/menu.js"></script>
    <script src="./script-sidebar/script.js"></script>
    <script src="./script-sidebar/main.js"></script>
</body>
</html>