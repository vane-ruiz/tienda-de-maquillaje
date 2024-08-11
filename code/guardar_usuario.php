<?php
// Conectar a la base de datos (reemplaza con tus credenciales)
$servername = "127.0.0.1";
$username = "root";
$password = ""; 
$dbname = "tienda_de_maquillaje";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$type_document = $_POST['type_document'];
$document = $_POST['document'];
$username = $_POST['username'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Inicializar $user_type si no se recibe del formulario
$user_type = isset($_POST['user_type']) ? $_POST['user_type'] : "cliente";

// Aplicar hash a la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Verificar si el email ya existe en `authentication`
$sql_check_email = "SELECT * FROM authentication WHERE email='$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    // El email ya existe, detener la ejecución del script
    die("El email ya existe. No se puede crear un nuevo usuario con este correo electrónico.");
} else {
    // Insertar en `authentication` si el email no existe
    $sql_auth = "INSERT INTO authentication (email, password, username, first_name, last_name, is_active, is_superuser, is_staff, type_usu, date_joined) 
                 VALUES ('$email', '$hashed_password', '$username', '$first_name', '$last_name', 1, 0, 0, 'usuario', NOW())";

    if ($conn->query($sql_auth) === TRUE) {
        // Si la inserción en `authentication` es exitosa, insertar en `users`
        $sql_user = "INSERT INTO users (user_type, document, username, first_name, last_name, email, password, address, phone, type_document)
                     VALUES ('$user_type', '$document', '$email', '$first_name', '$last_name', '$email', '$hashed_password', '$address', '$phone', '$type_document')";

        if ($conn->query($sql_user) === TRUE) {
            echo "Usuario creado exitosamente";
        } else {
            echo "Error al insertar en la tabla users: " . $sql_user . "<br>" . $conn->error;
        }
    } else {
        echo "Error al insertar en la tabla authentication: " . $sql_auth . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

