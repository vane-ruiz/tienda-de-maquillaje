<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['ema_usu']);  // Verificar si el email está en la sesión
}

if (!isLoggedIn()) {
    header('Location: index.php'); // Redirige a la página de login en la raíz del proyecto
    exit();
}
?>