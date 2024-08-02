<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/mainstyle.css">
    <title>Login</title>
</head>
<body>


  
  <div class="contenedor"><!--=Wrapper-->
 
    <div class="image">
     </div>

    <form action="crud/loginCrud.php" method="post" class="formulario"><!--=form-action-->

    <?php session_start();
                    if(isset($_SESSION['incorrecto'])){ ?>
                    <script>
                        swal({
                        title: "Usuario Y/O Contraseña Incorrectos!!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
    <?php unset($_SESSION['incorrecto']); } ?> 

    <?php
                    if(isset($_SESSION['logeo'])){ ?>
                    <script>
                        swal({
                        title: "No Has Iniciado Sesion!!",
                        icon: "warning",
                        button: "Volver",
                        });
                    </script>
                        
    <?php unset($_SESSION['logeo']); } ?> 

      <h1>Inicio de sesion</h1>

    <div class="inputs"><!--input-box-->
      <input required type="text" class="box" name="user"  placeholder="Ingresa nombre de usuario"><!--Puede ser tambien CLASS=BOX == input-box-->
      <i class='bx bxs-user'></i>
     </div>

     <div class="inputs">
      <input required type="password" class="box" placeholder="Contraseña" name="pass">
      <i class='bx bxs-key'></i>
    </div>
          
    <div>
    <input type="submit" value="Ingresar" class="boton">
    </div>

  </form>
</div>
  
</body>
</html>