<?php

require 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Consulta SQL para obtener los productos
$sql = "SELECT product_id, product_name, description, price, stock, brand, state, inventory, image FROM products";
$result = $mysqli->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Maquillaje</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Maquillaje</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="menu.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tiendamaquillaje.php">productos</a>
                </li>
                <!-- Menú desplegable para el perfil -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Perfil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="crearcuenta.php">Crear Usuario</a>
                        <a class="dropdown-item" href="crear.php">Crear Cuenta</a>
                    </div>
                </li>
                <!-- Menú desplegable para articulos -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Articulos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="agregarproducto.php">Crear Productos</a>
                        <a class="dropdown-item" href="stock.php">Stock de Productos</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="cart-icon" data-toggle="modal" data-target="#cart-modal">
                        <i class="fa fa-shopping-cart"></i> <span id="cart-count">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sección de Productos -->
    <section id="productos" class="container mt-5">
        <h2 class="text-center">Nuestros Productos</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_name = htmlspecialchars($row['product_name']);
                    $description = htmlspecialchars($row['description']);
                    $price = number_format($row['price'], 2);
                    $stock = $row['stock'];
                    $brand = htmlspecialchars($row['brand']);
                    $state = htmlspecialchars($row['state']);
                    $inventory = $row['inventory'];
                    $image = htmlspecialchars($row['image']);

                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="../img/' . $image . '" class="card-img-top" alt="' . $product_name . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $product_name . '</h5>
                                <p class="card-text">' . $description . '</p>
                                <p class="card-text"><strong>Precio:</strong> $' . $price . '</p>
                                <p class="card-text"><strong>Stock:</strong> ' . $stock . '</p>
                                <a href="#" class="btn btn-primary add-to-cart" data-id="' . $product_id . '" data-name="' . $product_name . '" data-price="' . $price . '">Comprar</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">No hay productos disponibles.</p>';
            }
            ?>
        </div>
    </section>

    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="cart-items" class="list-group">
                        <!-- Productos del carrito serán añadidos aquí -->
                    </ul>
                    <div class="mt-3 text-right">
                        <strong>Total: $<span id="cart-total">0</span></strong>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="checkout-button">Pagar</button>
                </div>
            </div>
        </div>
    </div>
    !-- Información de Contacto -->
    <section id="contacto" class="container mt-5">
        <h2 class="text-center">Contacto</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="fas fa-phone fa-2x"></i>
                <h4>Teléfono</h4>
                <p>3225145641</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-map-marker-alt fa-2x"></i>
                <h4>Dirección</h4>
                <p>kra 5 # 5-70 barrio la maria,bugalagrande</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-envelope fa-2x"></i>
                <h4>Correo Electrónico</h4>
                <p>exclusivasbynaryes@gmail.com</p>
            </div>
        </div>
    </section>

    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <p>&copy; 2024 Tienda de Maquillaje. Todos los derechos reservados.</p>
            <a href="#contacto" class="btn btn-secondary">Contacto</a>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartIcon = document.getElementById('cart-icon');
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');

            function updateCart() {
                cartCount.textContent = cart.length;
                cartItems.innerHTML = '';
                let total = 0;
                cart.forEach((item, index) => {
                    total += item.price * item.quantity;
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    listItem.innerHTML = `
                        ${item.name} - $${item.price} x 
                        <input type="number" class="item-quantity" data-index="${index}" value="${item.quantity}" min="1" style="width: 50px;">
                        <button class="btn btn-danger btn-sm remove-item" data-index="${index}">Eliminar</button>
                    `;
                    cartItems.appendChild(listItem);
                });
                cartTotal.textContent = total.toFixed(2);
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const price = parseFloat(button.getAttribute('data-price'));
                    const existingItemIndex = cart.findIndex(item => item.id === id);
                    if (existingItemIndex !== -1) {
                        cart[existingItemIndex].quantity += 1;
                    } else {
                        const item = { id, name, price, quantity: 1 };
                        cart.push(item);
                    }
                    updateCart();
                });
            });

            cartItems.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-item')) {
                    const index = e.target.getAttribute('data-index');
                    cart.splice(index, 1);
                    updateCart();
                }
            });

            cartItems.addEventListener('input', (e) => {
                if (e.target.classList.contains('item-quantity')) {
                    const index = e.target.getAttribute('data-index');
                    const quantity = parseInt(e.target.value, 10);
                    if (quantity > 0) {
                        cart[index].quantity = quantity;
                        updateCart();
                    }
                }
            });

            updateCart();
        });
    </script>
</body>
</html>
