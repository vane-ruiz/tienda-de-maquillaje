<?php
    require('../conexion.php');
    date_default_timezone_set("America/Bogota");

    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        $usu_usu = stripslashes($_REQUEST['username']); // removes backslashes
        $usu_usu = mysqli_real_escape_string($mysqli,$usu_usu); //escapes special characters in a string
        $pass_usu = stripslashes($_REQUEST['password']);
        $pass_usu = mysqli_real_escape_string($mysqli,$pass_usu);
        $nom_usu = stripslashes($_REQUEST['nom_usu']);
        $tipo_usu = 9;
        
        // Check if the username already exists in the database
        $check_query = "SELECT * FROM autentication WHERE username = '$usu_usu'";
        $check_result = mysqli_query($mysqli, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // If the username already exists, show a message
            echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>El usuario ya está registrado. Por favor, elija otro nombre de usuario.</p></center>";
        } else {
            // If the username doesn't exist, proceed with the registration
            $query = "INSERT INTO `usuarios` (usu_usu, pass_usu, tipo_usu, nom_usu) VALUES ('$usu_usu', '".sha1($pass_usu)."', '$tipo_usu', '$nom_usu')";
            $result = mysqli_query($mysqli, $query);
        
            // Check if data is inserted successfully
            if ($result) {
                echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>REGISTRO CREADO SATISFACTORIAMENTE</p></center>
                    <div class='form' align='center'><h3>Regresar para iniciar la sesión... <br/><br/><center><a href='index.php'>Regresar</a></center></h3></div>";
            } else {
                echo "Error al insertar datos en la base de datos: " . mysqli_error($mysqli);
            }
        }
    } 
?>

!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <!-- Incluimos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluimos los estilos personalizados -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Crear Nuevo Usuario</h2>
        <form id="crearUsuarioForm">
            <div class="form-group">
                <label for="type_document">Tipo de Identificación:</label>
                <select id="type_document" name="type_document" class="form-control" required>
                    <option value="">Seleccionar</option>
                    <option value="CC">CC</option>
                    <option value="TI">TI</option>
                    <option value="CE">CE</option>
                    <option value="NIT">NIT</option>
                    <option value="RC">RC</option>
                    <option value="PA">PA</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="document">cedula:</label>
                    <input type="text" id="document" name="document" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="username">Nombre:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="last_name">Apellidos:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="address">direccion:</label>
                    <input type="tel" id="address" name="address" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Registro</button>
            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Cancelar</button>
        </form>
    </div>

   <script> 
        
   </script>
    
</body>

</html>
