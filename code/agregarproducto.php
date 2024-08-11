<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "tienda_de_maquillaje"; 

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
        $target_file = null;
    }

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO products (product_name, description, price, stock, brand, state, inventory, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssis", $product_name, $description, $price, $stock, $brand, $state, $inventory, $image);

        if ($stmt->execute()) {
            echo "Producto creado exitosamente.";
        } else {
            echo "Error al crear el producto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nuevo Producto</h2>
        <form id="nuevoProductoForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Nombre del Producto:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción del Producto:</label>
                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="brand">Marca:</label>
                <input type="text" id="brand" name="brand" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">Disponible:</label>
                <select id="state" name="state" class="form-control" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inventory">Inventario:</label>
                <input type="number" id="inventory" name="inventory" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Imagen del Producto:</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
