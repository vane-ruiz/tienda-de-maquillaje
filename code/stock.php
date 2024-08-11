<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Stock de Productos</h1>
        <?php
        // Incluir la conexión a la base de datos
        require_once "./db_connect.php"; // Asegúrate de que la ruta sea correcta

        // Verificar que la conexión esté abierta
        if ($conn === null || $conn->connect_error) {
            die("Error: La conexión no se ha establecido o está cerrada.");
        }

        // Consulta para obtener todos los productos
        $sql = "SELECT product_id, product_name, description, price, stock, brand, state, image FROM products";

        // Ejecutar la consulta
        $result = $conn->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result) {
            if ($result->num_rows > 0) {
                // Iniciar la tabla HTML
                echo "<table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Producto</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Marca</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Mostrar los datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    // Formatear el precio con el signo $
                    $formattedPrice = '$' . number_format($row["price"], 2);

                    // Verificar si 'image' está presente y no está vacío
                    $imagePath = isset($row["image"]) && !empty($row["image"]) ? '../img/' . htmlspecialchars($row["image"]) : '../img/no-image.png';

                    echo "<tr>
                            <td>" . htmlspecialchars($row["product_id"]) . "</td>
                            <td>" . htmlspecialchars($row["product_name"]) . "</td>
                            <td>" . htmlspecialchars($row["description"]) . "</td>
                            <td>" . $formattedPrice . "</td>
                            <td>" . htmlspecialchars($row["stock"]) . "</td>
                            <td>" . htmlspecialchars($row["brand"]) . "</td>
                            <td>" . ($row["state"] == 1 ? 'Activo' : 'Inactivo') . "</td>
                            <td><img src='" . $imagePath . "' alt='Imagen de " . htmlspecialchars($row["product_name"]) . "' style='max-width: 100px; height: auto;'></td>
                          </tr>";
                }

                echo "</tbody>
                      </table>";
            } else {
                echo "No hay productos disponibles.";
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }

        // Cerrar la conexión al final
        if ($conn !== null && $conn->ping()) {
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
