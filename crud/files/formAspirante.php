<?php

include ("crud/conex.php");
$roles = mysqli_query($conex,"SELECT id, rol FROM roles");
$modalidad = mysqli_query($conex, "SELECT id_mod, modalidad FROM modalidad");
$dep = mysqli_query($conex, "SELECT id_Dep, nombre FROM departamentos");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Agregar Aspirante</title>
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

                <form action="crud/registrarUsuario.php" method="post">
                <form class="w3-container w3-card-4 w3-light-grey">
                <!--------------------Alertas Formulario--------------------------->     
                <?php session_start();
                    if(isset($_SESSION['exito'])){ ?>
                    <script>
                        swal({
                        title: "Registro Exitoso",
                        icon: "success",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['exito']); } ?> 

                <?php if(isset($_SESSION['rep'])){ ?>
                    <script>
                        swal({
                        title: "El nombre de usuario ya existe!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                    
                <?php unset($_SESSION['rep']); } ?> 

                <?php if(isset($_SESSION['falta'])){ ?>
                    <script>
                        swal({
                        title: "Rellena todos los campos correctamente!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
                <?php unset($_SESSION['falta']); } ?> 
              <!---------------------------FIN ALERTAS------------------------------------------------>              
                <div class="sub-container">

                    <!------COLUMNA IZQUIERDA------>
                    <div class="izquierda-form">
                        <h2>Agregar aspirante</h2>
                        <p>
                        <label>Nombre</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nombre-Aspirante" type="text">
                        <label>Telefono</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="telefono-Aspirante" type="number">
                        <label>CV</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="cv-Aspirante" type="file">
                        <label>INE</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="ine-Aspirante" type="file">
                        <label>Comprobante de Domicilio</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="comprobante-domicilio-Aspirante" type="file">
                        
                        
                        <div class="register-btn">
                            <a href="gestionempleados.php" class="button-57"><img src="img/Back-PNG-Pic.png" width="40px" alt=""><span>INICIO</span></a>

                            <button type="submit" class="button" style="vertical-align:middle"><span>Registrar</span></button>
                        </div>

                        
                    </div>

                         <!------COLUMNA DERECHA------->
                    <div class="derecha-form">
                        <label>Certificado</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="certificado-Aspirante" type="file">
                        <label>Carta de recomedacion</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="carta-recomedacion-Aspirante" type="file">
                        <label>CURP</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="curp-Aspirante" type="file">
                        <label>NSS</label>
                        <input required class="w3-input w3-border w3-round-xxlarge" name="nss-Aspirante" type="file">
                        
                        <label>Tipo</label>
                        
                        <label class="select" for="slct">
                            <select id="slct" required="required" name="tipo-Aspirate">
                            <option value="" disabled="disabled" selected="selected">Selecciona una opcion</option>
                            <?php while ($mod = mysqli_fetch_array($modalidad)) { ?>
                                
                                <option value="<?php echo $mod['id_mod']?>"><?php echo $mod['modalidad']?></option>
                            
                                <?php } ?>
                                          <option value="#">Trabajador</option>
                                          <option value="#">Servicio social</option>
                            </select>
                        </label>

 
                        <!-----SELECCIÓN DE HABILIDADES------->
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








