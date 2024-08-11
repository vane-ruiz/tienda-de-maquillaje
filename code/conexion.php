<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "tienda_de_maquillaje";

// Crear la conexión
$mysqli = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

?>
