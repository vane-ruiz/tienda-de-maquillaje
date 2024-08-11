<?php
require('db_connect.php'); // Asegúrate de que esta ruta es correcta
date_default_timezone_set("America/Bogota");

// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos obligatorios estén presentes y no están vacíos
    $required_fields = ['password', 'email'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            die("<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>Por favor, complete todos los campos obligatorios.</p></center>");
        }
    }

    $ema_usu = stripslashes($_POST['email']);
    $ema_usu = mysqli_real_escape_string($mysqli, $ema_usu);
    $pass_usu = stripslashes($_POST['password']);
    $pass_usu = mysqli_real_escape_string($mysqli, $pass_usu);
    
    // Verificar si el usuario ya existe en la base de datos
    $check_query = "SELECT * FROM authentication WHERE email = '$ema_usu'";
    $check_result = mysqli_query($mysqli, $check_query);

    if (!$check_result) {
        die("Error en la consulta: " . mysqli_error($mysqli));
    }

    if (mysqli_num_rows($check_result) > 0) {
        // Si el usuario ya existe, mostrar un mensaje
        echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>El usuario ya está registrado. Por favor, elija otro correo electrónico.</p></center>";
    } else {
        // Si el usuario no existe, proceder con el registro
        $query = "INSERT INTO authentication (email, password, type_usu) VALUES ('$ema_usu', '" . sha1($pass_usu) . "', 6)";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo "<center><p style='border-radius: 20px;box-shadow: 10px 10px 5px #c68615; font-size: 23px; font-weight: bold;'>REGISTRO CREADO SATISFACTORIAMENTE</p></center>
                  <div class='form' align='center'><h3>Regresar para iniciar la sesión... <br/><br/><center><a href='index.php'>Regresar</a></center></h3></div>";
        } else {
            echo "Error al insertar datos en la base de datos: " . mysqli_error($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
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
        <form id="crearUsuarioForm" method="POST">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Registro</button>
            <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Cancelar</button>
        </form>
    </div>
</body>
</html>
