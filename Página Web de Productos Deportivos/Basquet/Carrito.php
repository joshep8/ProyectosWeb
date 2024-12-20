<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_tienda";
$port = 33065;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Función para añadir un producto al carrito
function addToCart($id_producto, $cantidad) {
    global $conexion;

    // Obtener el producto desde la base de datos
    $query = "SELECT * FROM Productos WHERE id = :id";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':id', $id_producto);
    $statement->execute();
    $producto = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Producto no encontrado.");
    }

    // Añadir el producto al carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Verificar si el producto ya está en el carrito
    $found = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $id_producto) {
            $item['cantidad'] += $cantidad;
            $found = true;
            break;
        }
    }

    // Si no está en el carrito, añadirlo
    if (!$found) {
        $item = array(
            'id' => $id_producto,
            'nombre' => $producto['nombre'],
            'marca' => $producto['marca'],
            'precio' => $producto['precio'],
            'imagen' => $producto['imagen'],
            'cantidad' => $cantidad
        );
        $_SESSION['carrito'][] = $item;
    }

    // Redirigir de vuelta a la página de productos
    header('Location: basquetart2.html');
    exit;
}

// Verificar si se ha enviado el formulario para añadir al carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    addToCart($id_producto, $cantidad);
}

// Función para mostrar el contenido del carrito
function displayCart() {
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            echo '<div>';
            echo '<img src="' . $item['imagen'] . '" alt="Producto">';
            echo '<h2>' . $item['nombre'] . '</h2>';
            echo '<p>Marca: ' . $item['marca'] . '</p>';
            echo '<p>Precio: S/' . number_format($item['precio'], 2) . '</p>';
            echo '<p>Cantidad: ' . $item['cantidad'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>El carrito está vacío.</p>';
    }
}
?>