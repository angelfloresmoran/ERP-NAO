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

$tipo = mysqli_query($conex, "SELECT * FROM tipoaspirante");
$depa = mysqli_query($conex, "SELECT * FROM departamentos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aspirante</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stilonav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
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
                                <a href="proyectosDesarrollo.php" class="nav__link nav__link--inside">proyectos</a>
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
                                <a href="proyectosRedes.php" class="nav__link nav__link--inside">proyectos</a>
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
                                <a href="proyectosDiseno.php" class="nav__link nav__link--inside">proyectos</a>
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
    <?php

        if (isset($_GET['id'])) {
            $id_aspirante = $_GET['id'];
            $consulta = mysqli_query($conex, "SELECT a.id, a.nombre AS aspirante, a.telefono, a.cv, a.ine, a.comDomicilio, a.certificado, a.carRecomendacion, a.curp, a.nss, a.tipo AS id_tipo, a.departamento, d.nombre, t.tipo FROM aspirante a 
                INNER JOIN tipoaspirante t ON a.tipo = t.id
                INNER JOIN departamentos d ON a.departamento = d.id_Dep
                WHERE a.id = $id_aspirante;");
           
            $aspitante = mysqli_fetch_assoc($consulta);
        // die("Error en la consulta: " . mysqli_error($conex));  
        }
    ?>
      <form action="crud/editarAspirante.php" method="post" enctype="multipart/form-data">

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
                        
                <?php unset($_SESSION['falta']); } ?> 
              <!---------------------------FIN ALERTAS------------------------------------------------>     
        <h1> Editar Aspirante</h1>
        
        <fieldset>
          
          <legend><span class="number">1</span> Información Personal</legend>
          <input type="hidden" name="id" value="<?php echo $aspitante['id']; ?>">
          <label>Nombre completo:</label>
          <input required type="text" name="nombre-Aspirante" value="<?php echo $aspitante['aspirante'] ?>" >

          <label>Número de teléfono:</label>
          <input required type="number" name="telefono-Aspirante" value="<?php echo $aspitante['telefono'] ?>">

            <label>Tipo</label>
                <label class="select" for="slct">
                    <select id="slct" required="required" name="tipo-Aspirante">
                        <option value="<?php echo $aspitante['id_tipo']?>" selected="selected"><?php echo $aspitante['tipo'] ?></option>
                            <?php while ($as = mysqli_fetch_array($tipo)) { ?>                        
                                <option value="<?php echo $as['id']?>"><?php echo $as['tipo']?></option>    
                            <?php } ?>
                    </select>
                </label>
                        
            <label>Departamento:</label>
                <label class="select" for="slct">
                    <select id="slct" required="required" name="dep-Aspirante">
                    <option value="<?php echo $aspitante['departamento'] ?>" selected="selected"><?php echo $aspitante['nombre'] ?></option>
                        <?php while ($dep = mysqli_fetch_array($depa)) { ?>    
                            <option value="<?php echo $dep['id_Dep']?>"><?php echo $dep['nombre']?></option>
                        <?php } ?>
                    </select>
                </label>
       
          <BR><label>CV Anterior:</label>
          <input required class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['cv'], PATHINFO_FILENAME); ?>">
          <a href="crud/files/<?php echo $aspitante['cv']; ?>" target="_blank">Ver archivo</a> <br></BR>
          <BR><label>CV Nuevo:</label>
          <input type="file" name="cv-Aspirante"></BR>

          <BR><label>INE Anterior:</label>
          <input required  class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['ine'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['ine']; ?>" target="_blank">Ver archivo</a> <br></BR>
          
          <BR><label>INE Nuevo:</label>
          <input type="file" name="ine-Aspirante"></BR>

          <BR><label>Comprobante de domicilio Anterior:</label>
          <input required class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['comDomicilio'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['comDomicilio']; ?>" target="_blank">Ver archivo</a></BR>
          <BR><label>Comprobante de domicilio Nuevo:</label>
          <input type="file" name="comprobante-domicilio-Aspirante"></BR>

          <BR><label>Certificado Anterior:</label>
          <input required class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['certificado'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['certificado']; ?>" target="_blank">Ver archivo</a></BR>
          <BR><label>Certificado Nuevo:</label>
          <input type="file" name="certificado-Aspirante"></BR>

          <BR><label>Carta de recomendación Anterior:</label>
          <input required  class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['carRecomendacion'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['carRecomendacion']; ?>" target="_blank">Ver archivo</a></BR>
          <BR><label>Carta de recomendación Nuevo:</label>
          <input type="file" name="carta-recomendacion-Aspirante"></BR>

          <BR><label>CURP Anterior:</label>
          <input required  class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['curp'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['curp']; ?>" target="_blank">Ver archivo</a></BR>
          <BR><label>CURP Nuevo:</label>
          <input type="file" name="curp-Aspirante"></BR>

          <BR><label>NSS Anterior:</label>
          <input required required class="w3-input required w3-border w3-round-xxlarge" name="ineAct" type="text" value="<?php echo pathinfo($aspitante['nss'], PATHINFO_FILENAME);; ?>"><a href="crud/files/<?php echo $aspitante['nss']; ?>" target="_blank">Ver archivo</a></BR>
          <BR><label>NSS Nuevo:</label>
          <input type="file" name="nss-Aspirante"></BR>
        

        </fieldset>

        <a href="reclutamiento.php"><img src="./assets/bx-arrow-back.svg"></a>
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