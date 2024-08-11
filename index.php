<?php

require "tienda_conexion.php"; // Incluye el archivo de conexión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ema_usu = $_POST['email'];
    $password = $_POST['password'];

    // Verifica si la conexión fue exitosa
    if ($mysqli->connect_errno) {
        die("Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    }

    $sql = "SELECT * FROM authentication WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $ema_usu);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $password_bd = $row['password'];

            // Usa password_verify para comparar la contraseña ingresada con el hash almacenado
            if (password_verify($password, $password_bd)) {
                $_SESSION['pass_usu'] = $row['password'];
                $_SESSION['ema_usu'] = $row['email'];
                $_SESSION['type_usu'] = $row['type_usu'];

                if ($row['type_usu'] == "usuario" || $row['type_usu'] == "6") {
                    // Redirige al menú
                    header("Location: code/menu.html");
                } else {
                    // Redirige al índice
                    header("Location: index.php");
                }
                exit();
            } else {
                echo "La contraseña no coincide";
            }
        } else {
            echo "No existe usuario";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta SQL: " . $mysqli->error;
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
            justify-content: center;
            height: 100vh;
        }
        .login-form {
            width: 50%;
        }
        .login-image {
            width: 20%;
            margin-right: 10px;
        }
        .login-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="login-image">
            <img src="./img/logo.png" alt="Logo">
        </div>   
        <div class="login-form">
            <h2 class="mb-4">Iniciar Sesión</h2>
            <form method="POST" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    <button type="button" onclick="limpiarFormulario()" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function limpiarFormulario() {
            document.getElementById("login-form").reset();
        }
    </script>
</body>
</html>
