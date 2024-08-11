<?php
$mysqli = new mysqli("localhost", "root", "", "tienda_de_maquillaje");

// Verificar la conexión
if ($mysqli->connect_errno) {
    die("Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
?>
