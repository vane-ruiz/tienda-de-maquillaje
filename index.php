<?php
   
  require "conexion.php";
 
  session_start();

  if($_POST)
  {

    $usu_usu = $_POST['username'];
    $pass_usu = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$usu_usu'";
    //echo $sql;
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;

      if($num>0)
      {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['password'];

        $pass_c = sha1($pass_usu);

        if($password_bd == $pass_c)
        {
          $_SESSION['id_usu'] = $row['id_usu'];
          $_SESSION['nom_usu'] = $row['nom_usu'];
          $_SESSION['tipo_usu'] = $row['tipo_usu'];

          if($row['tipo_usu']==9)
          {
            // header("Location: code/usuarios/adduser.php");
            header("Location: tiendamaquillaje.html");
          }
          elseif($row['tipo_usu']==2)
          {
            header("Location: tiendamaquillaje.html");
          }
          elseif($row['tipo_usu']==3)
          {
            header("Location: tiendamaquillaje.html");
          }
          elseif($row['tipo_usu']==4)
          {
            header("Location: tiendamaquillaje.html");
          }
          elseif($row['tipo_usu']==5)
          {
            header("Location: tiendamaquillaje.html");
          }
          elseif($row['tipo_usu']==6)
          {
            header("Location: tiendamaquillaje.html");
          }
          else
          {
            
            header("Location: index.php");
          }
        }else
        {
          echo "La contraseña no coincide";
        }
      }else
      {
        echo "NO existe usuario";
      }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         .login-container {
            display: flex;
            align-items: center;
        }
        .login-form {
            width: 50%;
        }
        .login-image {
            width: 20%;
            margin-right: 10px; /* Espacio entre la imagen y el formulario */
        }
        .login-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
        <div class="container mt-5 ">
            <div class="image">
                <img src="/img/logo.png" >
            
    <div class="container mt-5 login-container">
        <div class="login-form">
          <h2 class="mb-4">Iniciar Sesión</h2>
          <form method="POST" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="button" onclick="verificarInicioSesion()" class="btn btn-primary">Iniciar Sesión</button>
                    <button type="button" onclick="limpiarFormulario()" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function limpiarFormulario() {
            document.getElementById("login-form").reset();
        }

        function verificarInicioSesion() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username !== "" && password !== "") {
                // Redireccionar al usuario a la página Formulario.html
                window.location.href = "code/menu.html";
            } else {
                alert("Por favor ingrese un nombre de usuario y contraseña.");
            }
        }
    </script>

    </script>
</body>
</html>
