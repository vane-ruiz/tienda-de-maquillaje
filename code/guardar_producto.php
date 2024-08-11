<?php

// Verifica que la ruta del archivo sea correcta y que la conexión se realice adecuadamente.
require '../db_connect.php';

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $brand = $_POST['brand'];
    $state = $_POST['state'];
    $inventory = $_POST['inventory'];
    $image = $_FILES['image']['name'];

    // Define la ruta de destino para la imagen
    $upload_dir = '../img/';
    $target_file = $upload_dir . basename($image);

    // Mueve la imagen a la carpeta de destino
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "Imagen cargada exitosamente.";
    } else {
        echo "Error al cargar la imagen.";
        $target_file = null; // Asegura que $target_file esté definido
    }

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO products (product_name, description, price, stock, brand, state, inventory, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Enlaza los parámetros a la declaración preparada
        $stmt->bind_param("ssssssis", $product_name, $description, $price, $stock, $brand, $state, $inventory, $image);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Producto creado exitosamente.";
        } else {
            echo "Error al crear el producto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }

    $mysqli->close();
}
