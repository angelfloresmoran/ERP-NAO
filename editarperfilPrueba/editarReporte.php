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
$proyectos = mysqli_query($conex,"SELECT id, nombre FROM proyectos");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/formReportes.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <title>Generar Reporte</title>
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

                <form action="crud/editarReporte.php" method="post" enctype="multipart/form-data">
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
                
            <?php
                if (isset($_GET['id'])) {
                    $id_reporte = $_GET['id'];
                    $consulta = mysqli_query($conex, "SELECT r.id, r.nombre, r.fecha, r.proyecto, r.archivo, p.nombre AS proy FROM reporte_proyecto r
                    INNER JOIN proyectos p ON r.proyecto = p.id
                    WHERE r.id = $id_reporte");
                    $reporte = mysqli_fetch_assoc($consulta);
                      
                }
            ?>
                    <!------ INPUTS FORMULARIO------>
                   
                        <h2>Generar Reporte</h2>
                        <input type="hidden" name="id" value="<?php echo $reporte['id']; ?>">
                        <label>Nombre del Reporte</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nombre" type="text" value="<?php echo $reporte['nombre']; ?>" placeholder="Nombre del Reporte">
                        <label>Fecha</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" type="date" name="fecha" value="<?php echo $reporte['fecha']; ?>">
                        <label>Nombre del proyecto</label>
                                    
                                    <label class="select" for="slct">
                                    <select id="slct" required="required" name="proy">
                                    <option value="<?php echo $reporte['proyecto'];?>"selected="selected"><?php echo $reporte['proy']; ?></option>
                                    <?php while ($proy = mysqli_fetch_array($proyectos)) { ?>
                                    <option value="<?php echo $proy['id']?>"><?php echo $proy['nombre']?></option>
                                    <?php } ?>
                                    </select>
                                    </label>

                                    <label>Archivo actual:</label>
                                    <input required class="w3-input w3-border w3-round-xxlarge" name="archivoAct" type="text" value="<?php echo $reporte['archivo']; ?>">
                                    <a href="crud/files/<?php echo $reporte['archivo']; ?>" target="_blank">Ver archivo</a> <br>
                                    
                                    <label>Archivo Nuevo:</label>
                                    <input class="w3-input w3-border w3-round-xxlarge" name="archivoNuevo" id="archivoNuevo" type="file">
                                    

                        
                                                        
                        <div class="register-btn">
                            <a href="reportes.php" class="button-57"><img src="img/Back-PNG-Pic.png" width="40px" alt=""><span>Atras</span></a>

                            <button type="submit" class="button" style="vertical-align:middle"><span>Guardar</span></button>
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