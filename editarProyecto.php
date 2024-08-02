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
include("crud/conex.php");

if (isset($_GET['id'])) {
    $id_proyecto = $_GET['id'];
    $consulta = mysqli_query($conex, "SELECT p.id, t.id AS id_team, e.id AS id_est, c.id AS id_cl, id_Dep, p.nombre AS nombre_proy, p.fechaInicio, p.fechaFin, p.descripcion, p.archivo, p.estatusProy, p.team, p.areaDesarrollo, p.cliente, e.estatus, t.nombre AS nombre_team, a.area, c.nombreEmpresa, d.nombre FROM proyectos p 
    INNER JOIN estatusproyecto e ON p.estatusProy = e.id 
    INNER JOIN team t ON p.team = t.id 
    INNER JOIN areadesarrollo a ON p.areaDesarrollo = a.id 
    INNER JOIN cliente c ON p.cliente = c.id 
    INNER JOIN departamentos d ON a.departamento = d.id_Dep
    WHERE p.id = $id_proyecto");
    $proyecto = mysqli_fetch_assoc($consulta);
   // die("Error en la consulta: " . mysqli_error($conex));  
}
?>


<?php

include ("crud/conex.php");
$team = mysqli_query($conex,"SELECT id, nombre FROM team");
$area = mysqli_query($conex, "SELECT id, area FROM areadesarrollo");
$cliente = mysqli_query($conex, "SELECT id, nombreEmpresa FROM cliente");
$estatus = mysqli_query($conex, "SELECT id, estatus FROM estatusproyecto");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
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
      <form action="crud/editarProyectos.php" method="post" enctype="multipart/form-data">

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
                        title: "El archivo es demasiado grande o no es compatible",
                        text:"Asegurate de subir un archivo con un peso menor a 20 MB",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                    
                <?php unset($_SESSION['error']); } ?> 
               

        <!---------------------------FIN ALERTAS------------------------------------------------>


        <h1> Editar Proyecto</h1>
        
        <fieldset>
          
          <legend><span class="number">1</span> Información Básica</legend>
        
          <input type="hidden" name="id" value="<?php echo $proyecto['id']; ?>">
                                    <label>Nombre</label>
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="nombre" type="text" value="<?php echo $proyecto['nombre_proy']; ?>">
                                    
                                    <label>Descripción</label>
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="desc" type="text" value="<?php echo $proyecto['descripcion']; ?>">
                                    
                                    <label>Team</label>
                                    <label required class="select" for="slct" >
                                    <select id="slct" required="required" name="team">
                                    <option value="<?php echo $proyecto['team']; ?>" selected="selected"><?php echo $proyecto['nombre_team']; ?></option>
                                    <?php while ($t = mysqli_fetch_array($team)) { ?>
                                        
                                        <option value="<?php echo $t['id']?>"><?php echo $t['nombre']?></option>
                                    
                                    <?php } ?>
                                    </select>

                                    <label>Archivo actual:</label>
                                    <a href="crud/files/<?php echo $proyecto['archivo']; ?>" target="_blank">Ver archivo</a><br>
                                    <br><input required class="w3-input w3-border w3-round-xxlarge" name="archivoAct" type="text" value="<?php echo $proyecto['archivo']; ?>">
                                    
                                   
                                    
                                    <br><label>Archivo Nuevo:</label>
                                    <input class="w3-input w3-border w3-round-xxlarge" name="archivoNuevo" id="archivo" type="file">

                                    <label>Fecha inicio</label>
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="fechaInicio" type="date" value="<?php echo $proyecto['fechaInicio']?>">
                                    <label>Fecha fin</label>
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="fechaFin" type="date" value="<?php echo $proyecto['fechaFin']?>">

                                    <label>Estatus</label>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="estatus">
                                       
                                        <option value="<?php echo $proyecto['estatusProy']; ?>" selected="selected"><?php echo $proyecto['estatus']; ?></option>
                                        
                                        <?php while ($es = mysqli_fetch_array($estatus)) { ?>
                                        <option value="<?php echo $es['id']?>"><?php echo $es['estatus']?></option>
                                        <?php } ?>
                                        </select>
                                    </label>

                                    <label>Tipo</label>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="area">
                                            <option value="<?php echo $proyecto['areaDesarrollo']; ?>" selected="selected"><?php echo $proyecto['area']; ?></option>
                                            <?php while ($a = mysqli_fetch_array($area)) { ?>
                                            <option value="<?php echo $a['id']?>"><?php echo $a['area']?></option>
                                            <?php } ?>
                                            </select>
                                        </label>

                                      <label>Cliente</label>
                                        <label class="select" for="slct">
                                        <select id="slct" required="required" name="cliente">
                                        <option value="<?php echo $proyecto['cliente']; ?>" selected="selected"><?php echo $proyecto['nombreEmpresa']; ?></option>
                                            <?php while ($cl = mysqli_fetch_array($cliente)) { ?>
                                            <option value="<?php echo $cl['id']?>"><?php echo $cl['nombreEmpresa']?></option>
                                            <?php } ?>
                                            </select>
                                        </label>
        

        </fieldset>
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