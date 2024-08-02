<?php

session_start();
$varSesion = $_SESSION['userName'];
if($varSesion == null || $varSesion == ''){
    $_SESSION['logeo']='no has logeado';
    header('Location:index.php');
    die();
}

include ("crud/conex.php");
$tipo = mysqli_query($conex, "SELECT id, nombre FROM tiposervicio");
$dep = mysqli_query($conex, "SELECT id_Dep, nombre FROM departamentos");
$consulta = mysqli_query($conex, "SELECT s.id, s.servicio, s.departamento, s.monto, s.tipo, s.fechaContratado, s.fechaTermino, s.observaciones, s.comprobante, t.nombre, d.nombre AS depa FROM serviciocontratado s
INNER JOIN tiposervicio t ON s.tipo = t.id
INNER JOIN departamentos d ON s.departamento = d.id_Dep;" );
 $servicio = mysqli_fetch_assoc($consulta);
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
    
    <title>Agregar Servicio</title>
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

                <form action="crud/editarServicio.php" method="post" enctype="multipart/form-data">
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
                        title: "El archivo es demasiado grande o no es compatible",
                        text:"Asegurate de subir un archivo con un peso menor a 20 MB",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['grande']); } ?> 
              <!---------------------------FIN ALERTAS------------------------------------------------>    
                

                    <!------ INPUTS FORMULARIO------>
                   
                        <h2>Agregar Servicio</h2>
                        <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>">
                        <label>Nombre</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nombre" type="text" value=<?php echo $servicio['servicio']; ?>>
                        <label>Monto</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="monto" type="number" value=<?php echo $servicio['monto']; ?>>
                        
                        <label>Tipo</label>
                            <label class="select" for="slct">
                            <select id="slct" required="required" name="tipo">
                            <option value="<?php echo $servicio['tipo']; ?>" selected="selected"" selected="selected"><?php echo $servicio['nombre']; ?></option>
                            <?php while ($ser = mysqli_fetch_array($tipo)) { ?>
                                
                                <option value="<?php echo $ser['id']?>"><?php echo $ser['nombre']?></option>
                            
                            <?php } ?>
                            </select>
                        </label>
                        
                        <label>Departamentos:</label>
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="departamento">
                            <option value="<?php echo $servicio['departamento']; ?>" selected="selected"" selected="selected"><?php echo $servicio['depa']; ?></option>
                            <?php while ($depa = mysqli_fetch_array($dep)) { ?>
                            <option value="<?php echo $depa['id_Dep']?>"><?php echo $depa['nombre']?></option>
                            <?php } ?>
                            </select>
                        </label>

                        <label>Fecha Contrato</label>
                        <input value="<?php echo $servicio['fechaContratado']; ?>" required class="w3-input w3-border w3-round-xxlarge" name="fechaC" type="date">
                        <label>Fecha Termino</label>
                        <input value="<?php echo $servicio['fechaTermino']; ?>" required class="w3-input w3-border w3-round-xxlarge" name="fechaT" type="date">
                        
                        <label>Archivo actual:</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="archivoAct" type="text" value="<?php echo $servicio['comprobante']; ?>">
                        <a href="crud/files/<?php echo $servicio['comprobante']; ?>" target="_blank">Ver archivo</a> <br>
        

                        </label>
                        <label>Archivo Nuevo:</label>
                        <input class="w3-input w3-border w3-round-xxlarge" name="archivoNuevo" id="archivo" type="file">
                        
                        
                        <label>Observaciones</label>
                        <input value="<?php echo $servicio['observaciones']; ?>" required class="w3-input w3-border w3-round-xxlarge" name="observaciones" type="text">
                                   
                                    
                        

                        
                                                        
                        <div class="register-btn">
                            <a href="servicios.php" class="button-57"><img src="img/Back-PNG-Pic.png" width="40px" alt=""><span>Atras</span></a>

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