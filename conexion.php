<?php
$mysqli = new mysqli('localhost', 'root', '', 'tienda_de_maquillaje');
$mysqli->set_charset("utf8");
if ($mysqli->connect_error) {
    die('Error en la conexion: ' . $mysqli->connect_error);
}
echo "Conexión exitosa";  // Línea de prueba
?>