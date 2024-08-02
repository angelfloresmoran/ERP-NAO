
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
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stilonav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="./css/editarPerfil/msg.css">
    <link rel="stylesheet" href="./css/editarPerfil/styleEditarPerfil.css">
</head>
<body>


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
            <?php
            include("crud/conex.php");
            $consulta = mysqli_query($conex, "SELECT * FROM usuarios");
            $fila = mysqli_fetch_assoc($consulta);
    

          $imagen = $fila['foto'];
          
          if(!file_exists($imagen)){
            $imagen = "img/usuario.png";
          }
           ?>
          
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
  <style>

header{
  background-color: #224abe;
}
.flex-column {
  padding: 0px;
}
.tab-content {
  padding: 20px;
}
.tab-content h1{
  margin-bottom:  10px;
  color: #333;
  text-align: center;
  font-size: 24px;
}
.tab-content b{
  width: 100px;
  display: inline-block;
}
</style>
</head>
<body>


<!-- Msg -->

<?php
    include("crud/conex.php");
    $consulta = mysqli_query($conex, "SELECT * FROM usuarios");
    $fila = mysqli_fetch_assoc($consulta);
   
    
?>
<!--------------------Alertas Formulario--------------------------->     
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
 <!---------------------------FIN ALERTAS------------------------------------------------>   
<form class="form-usuario container" action="crud/editarPerfil.php" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col-8 main card ">
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <h1>Editar Información </h1>
          <label><b>Descripción </b></label><br>
          <p>Rellene los campos correctamente para actualizar su Información, posteriormente de click sobre el botón de guardar cambios, para que estos se vean reflejados.</p>
          <input type="hidden" name="id" value="<?php echo $fila['userName']; ?>">
          <label><b>Nombre </b> <?php echo $fila['nombre']; ?></label><br>
          <label><b>Apellidos </b> <?php echo $fila['aPaterno']; ?> </b> <?php echo $fila['aMaterno']; ?> </label><br>
          <label><b>Correo electronico</b></label> <input name="correo" type="email" value = "<?php echo $fila['correo']; ?> "><br>
          <label><b>Teléfono </b></label> <input type="number" name="tel" value="<?php echo $fila['telefono']; ?>"><br>
          <label><b>Contraseña </b></label> <input name="contra" type="password" value="<?php echo $fila['contrasena']; ?>"><br>  


           
          <div class="btn-guardar">
            <button class="button" type="submit">Guardar Cambios</button>
          </div>
          
        </div>

        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          
        <h1>Cambiar foto de perfil </h1>
            <div class="box-cards-center">
              <input type="file" name="foto">
              </div>
            <div class="btn-guardar">
             <button class="button">Guardar Cambios</button>
            </div>
          </div>
        
        
      </div>
  </div>
  
    
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

  <div class="col-4">
    <div class="card cards-usuario">
      <img class="user-creador" src="img/<?php echo $imagen ?>">
      <h1 class="user-name"><?php echo $fila['nombre'] ?> </h1>
    </div>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Editar foto de perfil</a>

        <div class="btn-logout">
            <a class="button-logout" href="crud/logout.php">cerrar sesión</a>
        </div>
    </div>

  </div>
</div>

</form>
  </main>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./script-sidebar/menu.js"></script>
    <script src="./script-sidebar/script.js"></script>
    <script src="./script-sidebar/main.js"></script>
</body>
</html>