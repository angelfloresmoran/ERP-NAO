<?php
include ('conex.php');
session_start();
$varSesion = $_SESSION['userName'];
if($varSesion == null || $varSesion == ''){
    $_SESSION['logeo']='no has logeado';
    header('Location:index.php');
    die();
}

//Mostrar Módulos
$modulo = mysqli_query($conex, "SELECT m.* FROM modulos m INNER JOIN usuario_modulo um ON m.id = um.id_modulo INNER JOIN usuarios u ON u.userName = um.userName WHERE u.userName = '$_SESSION[userName]';");

$modUsr = array();

while ($fila = mysqli_fetch_assoc($modulo)) {
    $modUsr[] = $fila['id'];
}
?>

<?php
include ("conex.php");
$depat = mysqli_query($conex,"SELECT id_Dep, nombre FROM departamentos");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stilonav.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/estiloForm.css">


    
    <title>Editar Factura</title>
</head>
<body>
<?php
    if(isset($_POST['envi'])){
        $id=$_POST['id'];
        $nombre=$_POST['nombreFac'];
        $descripcion=$_POST['descFac'];
        $fecha=$_POST['fechaFac'];
        $depa=$_POST['depa'];
        $sql="UPDATE facturacion SET nombre='".$nombre."', descripcion='".$descripcion."',fecha='".$fecha."', departamento='".$depa."'
        WHERE id='".$id."'";
        $arch=(isset($_FILES["archivoF"]['name'])?$_FILES["archivoF"]['name']:"");
        $fecha= new DateTime();
        $nombre_archi=($arch!='')?$fecha->getTimestamp()."_".$_FILES["archivoF"]['name']:"";
        $tmp_archi=$_FILES["archivoF"]['tmp_name'];

        $limite_tamano = 20 * 1024 * 1024; // 20 MB en bytes

    // Verificamos el tamaño del archivo
    if ($_FILES['archivoF']['size'] > $limite_tamano) {
        session_start();
        $_SESSION['error'] = 'error';
        header("location:../facturas.php"); 
        exit;
    }

        if($tmp_archi!=''){
            move_uploaded_file($tmp_archi,"files/".$nombre_archi);
            $sql="UPDATE facturacion SET archivo='".$nombre_archi."' WHERE id='".$id."'";
        }
     
        $resultado=mysqli_query($conex,$sql);
        if($resultado){
            session_start();
            $_SESSION['exito'] = 'correcto';
            header("location:../facturas.php");  

        }else{
            session_start();
    $_SESSION['error'] = 'error';
    header("location:../facturas.php"); 
        }
        mysqli_close($conex);

    }else{ 
    $id=$_GET['id'];
    $sql="SELECT * FROM facturacion WHERE id='".$id."'";
    $resulta=mysqli_query($conex,$sql);

    $fila=mysqli_fetch_assoc($resulta);
    $nombre=$fila["nombre"];
    $descripcion=$fila["descripcion"];
    $fecha=$fila["fecha"];
    $deparm=$fila["departamento"];
    $archi=$fila["archivo"];
    mysqli_close($conex);
    ?>

<nav>
        <div></div>

        <div class="tittle">
            <h4>EDITAR</h4>
        </div>
        
        <div></div>

    </nav>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
             <img id="cloud" name="cloud-outline" src="../assets/bx-menu.svg" alt="" width="35%">
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
                        <img src="../assets/dashboard" name="mail-unread-outline" class="list__img">
                        <a href="../dashboard.php" class="nav__link">Inicio</a>
                    </div>
                </li>
    
                <?php if (in_array(1, $modUsr)) { ?>
                    <!-----------Módulo 1- DESARROLLO----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bx-terminal.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Desarrollo</a>
                            <img src="../assets/arrow" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../proyectosDesarrollo.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../servicios.php" class="nav__link nav__link--inside">Servicios</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(2, $modUsr)) { ?>
                    <!-----------Módulo 2- REDES----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bxs-network-chart.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Redes</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../proyectosRedes.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../reportes.php" class="nav__link nav__link--inside">Reportes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(5, $modUsr)) { ?>
                    <!-----------Módulo 5- Diseño----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bx-palette.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Diseño</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../proyectosDiseno.php" class="nav__link nav__link--inside">Proyectos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../reportes.php" class="nav__link nav__link--inside">reportes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(3, $modUsr)) { ?>
                    <!-----------Módulo 3- R.R.H.H.----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bx-group.svg" class="list__img" name="document-text-outline">
                            <a class="nav__link">R.R.H.H</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../gestionEmpleados.php" class="nav__link nav__link--inside">Gestión de Empleados</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../reclutamiento.php" class="nav__link nav__link--inside">Reclutamiento</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../practicasServicio.php" class="nav__link nav__link--inside">Practicas P. y Servicio S.</a>
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
                            <img src="../assets/bx-clipboard.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Administración</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../inventario.php" class="nav__link nav__link--inside">Inventario</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../clientes.php" class="nav__link nav__link--inside">Clientes</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (in_array(6, $modUsr)) { ?>
                    <!-----------Módulo 6- Contabilidad----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bx-money.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Contabilidad</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
                            <ul class="list__show">
                                <li class="list__inside">
                                    <a href="../facturas.php" class="nav__link nav__link--inside">Facturas</a>
                                </li>
            
                                <li class="list__inside">
                                    <a href="../pagos.php" class="nav__link nav__link--inside">Pagos</a>
                                </li>

                                <li class="list__inside">
                                    <a href="../cotizaciones.php" class="nav__link nav__link--inside">Cotizaciones</a>
                                </li>

                                <li class="list__inside">
                                    <a href="../cajaChica.php" class="nav__link nav__link--inside">Caja Chica</a>
                                </li>

                                <li class="list__inside">
                                    <a href="../requisiciones.php" class="nav__link nav__link--inside">Requisiciones</a>
                                </li>
                            </ul>
                        </li>
                <?php } ?>

                <?php if (in_array(7, $modUsr)) { ?>
                    <!-----------Módulo 7- Licitaciones----------->
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../assets/bxs-bank.svg" name="star-outline" class="list__img">
                            <a class="nav__link">Licitaciones</a>
                            <img src="../assets/arrow.svg" class="list__arrow">
                        </div>
        
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../licitaciones.php" class="nav__link nav__link--inside">Licitaciones y concursos</a>
                            </li>
        
                            <li class="list__inside">
                                <a href="../historico.php" class="nav__link nav__link--inside">Histórico</a>
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
                <img src="../img/usuario.png" alt="">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre"><?php echo $_SESSION['name']; ?></span>
                        <span class="email"><?php echo $_SESSION['correo']; ?></span>
                    </div>
                    <a href="../editarPerfil.php"><img src="../assets/bx-cog.svg"></a>
                    
                </div>
            </div>
        </div>

    </div>

<!----PRINCIPAL------>

<main>
        <div class="main-content"> 
        
        

                <form action="editarFact.php" method="post" enctype="multipart/form-data">
                
                    <!------ INPUTS FORMULARIO------>
                   
                        <h2>Editar Factura</h2>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label>Nombre</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nombreFac" value="<?php echo $nombre; ?>" type="text">
                        <label>Descripcion</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="descFac" value="<?php echo $descripcion; ?>" type="text">
                        <label>Fecha</label>
                        <input class="w3-input w3-border w3-round-xxlarge" name="fechaFac" value="<?php echo $fecha; ?>" type="date" required>
                        <label>Archivo</label>
                        Documento: <a href="<?php echo "files/$archi"; ?>"><?php echo $archi; ?></a> 
                        <p><input type="file" name="archivoF"></p>
                        <label>Departamento</label>
                                    <label class="select" for="slct">
                                    <select id="slct" required="required" name="depa">
                                    <?php while ($depa = mysqli_fetch_array($depat)) { 
                                        if($depa['id_Dep']==$deparm['departamento']){
                                        ?>
                                        <option selected value="<?php echo $depa['id_Dep']?>"><?php echo $depa['nombre']?></option>
                                    <?php
                                
                                }else{  ?>
                                <option value="<?php echo $depa['id_Dep']?>"><?php echo $depa['nombre']?></option>
                                <?php
                                }}
                                ?>
                                    </select>
                                    </label>        
                                                        
                        <div class="register-btn">
                            <a href="../clientes.php" class="button-57"><img src="img/Back-PNG-Pic.png" width="40px" alt=""><img src="../assets/bx-arrow-back.svg"></a>

                            <button type="submit" class="button" name="envi" style="vertical-align:middle"><span>Actualizar</span></button>
                        </div>

                        


                         
                    </div>
                
                </form>      
                <?php }?>

                </div>
</main>


                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../script-sidebar/menu.js"></script>
    <script src="../script-sidebar/script.js"></script>
    <script src="../script-sidebar/main.js"></script>
</body>
</html>