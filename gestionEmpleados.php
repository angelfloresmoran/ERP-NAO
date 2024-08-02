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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stilonav.css">
    <link rel="stylesheet" href="./css/tables.css">
   

    
</head>
<body>
   


    <nav>
        <div></div>

        <div class="tittle">
            <h4>GESTIÓN DE EMPLEADOS</h4>
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

    <?php
                    if(isset($_SESSION['exito'])){ ?>
                    <script>
                        swal({
                        title: "Correcto",
                        icon: "success",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['exito']); } ?> 

                <?php if(isset($_SESSION['error'])){ ?>
                    <script>
                        swal({
                        title: "Error",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                    
                <?php unset($_SESSION['error']); } ?> 
               
  <main>
    <div class="main-content"> 
    <h1>Gestión de Empleados</h1> <br>
    <a href="formUsuario.php" class="a-forms"><img src="./assets/bx-user-plus.svg">Agregar empleado</a>
            <div class="tabla">

        <div class="tabla-contenido">
            <table id="tablax" class="table table-striped table-bordered" style="width:100%">
            <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Salario</th>
                <th>Departamento</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Modalidad</th>
                <th>Seguro</th>
                <th>Acciones</th>
            </tr>
           
            <?php

              
                $consulta = mysqli_query($conex, "SELECT u.nombre, u.userName AS id_usr, u.aPaterno, u.aMaterno, u.telefono, u.correo, u.salario, u.fechaNacimiento, u.fechaInicio, u.fechaFin, u.modalidad, u.seguro, s.asegurado, m.modalidad AS moda, u.departamento, d.nombre AS depa FROM usuarios u 
                    INNER JOIN seguro s ON u.seguro = s.id
                    INNER JOIN modalidad m ON u.modalidad = m.id_mod
                    INNER JOIN departamentos d ON u.departamento = d.id_Dep;");
                while ($fila = mysqli_fetch_assoc($consulta)):


            ?>
            <tr>
                <td><?php echo $fila['nombre'] ?></td>
                <td><?php echo $fila['aPaterno'] ?></td>
                <td><?php echo $fila['telefono'] ?></td>
                <td><?php echo $fila['correo'] ?></td>
                <td><?php echo $fila['salario'] ?></td>
                <td><?php echo $fila['depa'] ?></td>
                <td><?php echo $fila['fechaInicio'] ?></td>
                <td><?php echo $fila['fechaFin'] ?></td>
                <td>
                    <!-- Estatus select para estatus -->
                    <form class="select_estatus" method="POST" action="crud/editarProyectos.php">
                    <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usr']; ?>" title="Selecciona un estatus">
                    <select name="estatus" id="activo">
                    <option value="<?php echo $fila['modalidad']; ?>" selected="selected"><?php echo $fila['moda']; ?></option>
                    <?php
                    $moda = mysqli_query($conex, "SELECT * FROM modalidad");
                    while ($act = mysqli_fetch_assoc($moda)) {
                    $selected = ($fila['modalidad'] == $act['id_mod']) ? 'selected' : '';
                    echo '<option value="' . $act['id_mod'] . '" ' . $selected . '>' . $act['modalidad'] . '</option>';
                    }
                    ?>
                    </select>
                        
                        <button class="button_paloma" type="submit"><img class="paloma" src="img/paloma.png" alt=""></button>
                    </form>
                </td>
                <td><?php echo $fila['asegurado'] ?></td>
                <td>
                <a href="editarUsuario.php?id=<?php echo $fila['id_usr']; ?>" class="btn btn-warning"><img src="./assets/bx-edit.svg"></a>
                <a href="javascript:void(0);" onclick="confirmarEliminacion('<?php echo urlencode($fila['id_usr']); ?>')"><img src="./assets/bx-trash.svg"></a>

                </td>

            <?php endwhile ;?>
            </tr>
        </table>
    </div>
    </div>
    </div>
  </main>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./script-sidebar/menu.js"></script>
    <script src="./script-sidebar/script.js"></script>
    <script src="./script-sidebar/main.js"></script>
    <script>
    function confirmarEliminacion(id) {
        id = decodeURIComponent(id);
        Swal.fire({
            title: '¿Deseas Eliminar?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirige a la página que realiza la eliminación
                window.location.href = "crud/eliminarUsuario.php?id=" + id;
            }
        });
    }
</script>

</body>
</html>