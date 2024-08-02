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

include ("crud/conex.php");
$tipo = mysqli_query($conex, "SELECT id, nombre FROM tiposervicio");
$dep = mysqli_query($conex, "SELECT id_Dep, nombre FROM departamentos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicio</title>
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
        <form action="crud/registrarServicio.php" method="post" enctype="multipart/form-data">

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

                <?php if(isset($_SESSION['error'])){ ?>
                    <script>
                        swal({
                        title: "Error al subir el archivo!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                    
                <?php unset($_SESSION['error']); } ?> 

                <?php if(isset($_SESSION['grande'])){ ?>
                    <script>
                        swal({
                        title: "El archivo es demasiado grande!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['grande']); } ?> 
              <!---------------------------FIN ALERTAS------------------------------------------------>

            <h1> Nuevo Servicio </h1>
            
            <fieldset>
            
            <legend><span class="number">1</span> Información Básica</legend>
            
                <label>Nombre</label>
                <input required class="w3-input w3-border w3-round-xxlarge" name="nombre" type="text">
                        
                <label>Monto</label>
                <input required class="w3-input w3-border w3-round-xxlarge" name="monto" type="number">
                        
                <label>Tipo</label>
                                    
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="tipo">
                            <option value="" disabled="disabled" selected="selected">Selecciona una opcion</option>
                            <?php while ($ser = mysqli_fetch_array($tipo)) { ?>
                                
                                <option value="<?php echo $ser['id']?>"><?php echo $ser['nombre']?></option>
                            
                            <?php } ?>
                            </select>
                        </label>
                
                <label>Departamentos:</label>
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="departamento">
                            <option value="" disabled="disabled" selected="selected">Selecciona una opcion</option>
                            <?php while ($depa = mysqli_fetch_array($dep)) { ?>
                            <option value="<?php echo $depa['id_Dep']?>"><?php echo $depa['nombre']?></option>
                            <?php } ?>
                            </select>
                        </label>

                <label>Fecha Contrato</label>
                <input required class="w3-input w3-border w3-round-xxlarge" name="fechaC" type="date">
                        
                <label>Fecha Termino</label>
                <input required class="w3-input w3-border w3-round-xxlarge" name="fechaT" type="date">

                <label>Observaciones</label>
                <textarea required class="w3-input w3-border w3-round-xxlarge" name="observaciones" cols="30" rows="5"></textarea>
                        
                <label>Archivo</label>
                <input required type="file" name="archivo" id="archivo">
            

            </fieldset>
        
            <button type="submit">Guardar</button>
        
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