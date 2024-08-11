<?php
require 'db_connect.php';

// Consulta SQL para obtener los productos
$sql = "SELECT product_id, product_name, description, price, stock, brand, state, inventory, image FROM products";
$result = $mysqli->query($sql);

if ($result === false) {
    // Si la consulta falla, mostrar el error
    die("Error en la consulta SQL: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .price-column {
            text-align: right; /* Alinear el precio a la derecha */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Productos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Marca</th>
                    <th>Estado</th>
                    <th>Inventario</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Formatear el precio
                        $formatted_price = number_format($row['price'], 2, ',', '.');
                        echo "<tr>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td class='price-column'>$ " . $formatted_price . "</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>" . $row['brand'] . "</td>";
                        echo "<td>" . ($row['state'] ? 'Disponible' : 'No Disponible') . "</td>";
                        echo "<td>" . $row['inventory'] . "</td>";
                        echo "<td><img src='img/" . $row['image'] . "' alt='Imagen' width='100'></td>";
                        echo "</tr>";

                         // Asegúrate de que la ruta sea correcta
                            echo "<td><img src='../img/" . $row['image'] . "' alt='Imagen' width='100'></td>";
                            echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No hay productos disponibles</td></tr>";
                }
                ?>
            </tbody>
            
        </table>
    </div>
    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
