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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="./css/register.css">
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

                    <form action="crud/editarProyectos.php" method="post" enctype="multipart/form-data">
                        <form class="w3-container w3-card-4 w3-light-grey">
                           
                
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


                            <div class="sub-container">

                                <!------COLUMNA IZQUIERDA------>
                                
                                <div class="izquierda-form">
                                    <h2>Editar Proyecto</h2>
                                    <p>
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
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="archivoAct" type="text" value="<?php echo $proyecto['archivo']; ?>">
                                    <a href="crud/files/<?php echo $proyecto['archivo']; ?>" target="_blank">Ver archivo</a> <br>
                                   
                                    
                                    <label>Archivo Nuevo:</label>
                                    <input class="w3-input w3-border w3-round-xxlarge" name="archivoNuevo" id="archivo" type="file">
                                    
                                    
                                    <div class="register-btn">
                                    <a class="button-57" href="#" onclick="history.go(-1);">
                                    <img src="./img/Back-PNG-Pic.png" width="40px" alt="">
                                    <span>Regresar</span>
                                    </a>
                                        
                                    
                                    
                                        <button type="submit" class="button" style="vertical-align:middle"><span>Guardar</span></button>

                                    </div>
                                    
                                </div>

                                <!------COLUMNA DERECHA------->
                                <div class="derecha-form">
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
                                      
                                </div>
                                </div>
                          </form>
                          
                        
                </form>
                </div>
            </div>


        </div>
    </div>
    
    
</body>
</html>

