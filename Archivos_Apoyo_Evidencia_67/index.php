<?php
   
  require "conexion.php";
 
  session_start();

  if($_POST)
  {

    $usu_usu = $_POST['usu_usu'];
    $pass_usu = $_POST['pass_usu'];

    $sql = "SELECT * FROM usuarios WHERE usu_usu='$usu_usu'";
    //echo $sql;
    $resultado = $mysqli->query($sql);
    $num = $resultado->num_rows;

      if($num>0)
      {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['pass_usu'];

        $pass_c = sha1($pass_usu);

        if($password_bd == $pass_c)
        {
          $_SESSION['id_usu'] = $row['id_usu'];
          $_SESSION['nom_usu'] = $row['nom_usu'];
          $_SESSION['tipo_usu'] = $row['tipo_usu'];

          if($row['tipo_usu']==9)
          {
            // header("Location: code/usuarios/adduser.php");
            header("Location: access.php");
          }
          elseif($row['tipo_usu']==2)
          {
            header("Location: access.php");
          }
          elseif($row['tipo_usu']==3)
          {
            header("Location: access.php");
          }
          elseif($row['tipo_usu']==4)
          {
            header("Location: access.php");
          }
          elseif($row['tipo_usu']==5)
          {
            header("Location: access.php");
          }
          elseif($row['tipo_usu']==6)
          {
            header("Location: access.php");
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
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>SENA</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="js/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/fondo.jpg">
	<div class="container">
		<div class="img">
			<img src="img/logoSena.png">
		</div>
		<div class="login-content">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<img src="img/avatar.svg">
				<h2 class="title">Bienvenid@</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="usu_usu" type="text" />
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="pass_usu" class="input" name="pass_usu" type="text" />
            	   </div>
            	</div>
              <a href="register.php">Crear cuenta</a>
            	<input type="submit" class="btn" value="Accede">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
