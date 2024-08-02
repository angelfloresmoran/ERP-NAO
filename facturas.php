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
    <title>Facturas</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/stilonav.css">
    <link rel="stylesheet" href="./css/tables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    

    
</head>
<body>
   


    <nav>
        <div></div>

        <div class="tittle">
            <h4>FACTURAS</h4>
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
            <img src="assets/dashboard.svg" name="mail-unread-outline" class="list__img">
            <a href="dashboard.php" class="nav__link">Inicio</a>
        </div>
    </li>

    <?php if (in_array(1, $modUsr)) { ?>
        <!-----------Módulo 1- DESARROLLO----------->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <img src="assets/bx-terminal.svg" name="star-outline" class="list__img">
                <a class="nav__link">Desarrollo</a>
                <img src="assets/arrow.svg" class="list__arrow">
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

  <main>
    <div class="main-content"> 
    <?php
    include ("crud/conex.php");
    $consul="SELECT * FROM facturacion";
    $resul=mysqli_query($conex,$consul);

    ?>
        <h1>Facturas</h1>
        <h4> <a href="formFacturacion.php" class="a-forms"><img src="./assets/bx-add-to-queue.svg">Subir nueva factura</a></h4> <br>
        <div> 
        <label>Filtrar por Fecha:</label>
        <input type="date" id="filtroFecha">               
        <input type="text" id="busqueda" placeholder="Buscar por nombre...">
        </div>
        
        <div class="tabla">
    <div class="tabla-contenido">
        <table id="tablax" class="table table-striped table-bordered" style="width:100%">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Archivo</th>
                <th>Descargar</th>
                <th>Acciones</th>
                
            </tr>
            <?php
                while ($filas=mysqli_fetch_assoc($resul)){
            ?>
            <tr>
                <td><?php echo $filas['nombre'] ?></td>
                <td><?php echo $filas['descripcion'] ?></td>
                <td><?php echo $filas['fecha'] ?></td>
                <td><?php echo $filas['archivo'] ?></td>
                </td>
                <td><a href="crud/dArchivoFact.php?id= <?php echo $filas['id'] ;?>" class="btn btn-primary"><img src="./assets/bx-cloud-download.svg"></a>
                </td>
                <td>
                <a href="crud/editarFact.php?id=<?php echo $filas['id']; ?>" class="btn btn-warning"><img src="./assets/bx-edit.svg"></a>
                <a href="javascript:void(0);" onclick="confirmarEliminacion(<?php echo $filas['id']; ?>)"><img src="./assets/bx-trash.svg"></a>
                </td>
            </tr>   
                <?php
                 }
                ?>
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
    <script src="js/filtrarConta.js"></script>
    <script>
    function confirmarEliminacion(id) {
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
                window.location.href = "crud/eliminarFact.php?id=" + id;
            }
        });
    }
</script>
</body>
</html>