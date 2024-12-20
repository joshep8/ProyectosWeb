<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:/Index/login.php");
    exit;
}

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

// Actualizar información
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $correo = $_POST['correo'] ?? '';

    // Validar aquí los datos

    $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, correo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombres, $apellidos, $correo, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
    header("Location:/Index/mi_perfil.php?success=1");
    exit;
}

// Obtener información del usuario
$sql = "SELECT nombres, apellidos, correo FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Mi perfil</title>
    <style>
       body {
    font-family: Arial, sans-serif; /* Usa una fuente más estándar para todo el body */
    margin: 0;
    padding-top: 100px; /* Ajusta según la altura de tu navbar */
    background: #f4f4f4; /* Color de fondo suave */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Altura mínima del viewport */
}
.form-container {
    background: white;
    padding: 30px;  /* Aumentar el padding para más espacio interior */
    border-radius: 10px;  /* Bordes más redondeados para suavizar la apariencia */
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);  /* Sombra más prominente para mayor profundidad */
    width: 40%;  /* Ancho relativo para adaptarse mejor a diferentes tamaños de pantalla */
    max-width: 500px;  /* Máximo ancho para evitar que sea demasiado grande en pantallas grandes */
    min-width: 300px;  /* Mínimo ancho para asegurar legibilidad en dispositivos más pequeños */
}

form {
    display: flex;
    flex-direction: column;
    font-size: 16px;  /* Tamaño de fuente mayor para mejorar la legibilidad */
}

input[type="text"],
input[type="email"] {
    padding: 12px;  /* Aumentar el padding para hacer los campos más grandes */
    margin-bottom: 15px;  /* Aumentar el margen para más espacio entre campos */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;  /* Aumentar el tamaño de la fuente en los inputs */
}

input[type="submit"] {
    padding: 12px;
    background-color: #4CAF50;  /* Mantener el color verde para el botón */
    color: white;
    cursor: pointer;
    border: none;
    font-size: 18px;  /* Hacer el texto del botón más grande */
    border-radius: 5px;  /* Bordes redondeados para el botón */
}

input[type="submit"]:hover {
    background-color: #45a049;  /* Oscurece el botón al pasar el mouse */
}
    </style>
</head>
<body>
<nav class="navbar">
        <div class="navbar-top">
            <img src="Imagenes/logoofic.jpg" alt="Logo de Mi Deporte" class="logo">
            <div class="search-bar">
                <input type="text" placeholder="Buscar producto, deporte y más...">
                <i class="fas fa-search" style="color: #003366;"></i>
            </div>
            <div class="navbar-icons">
                <div class="user-container">
                    <a href="#" class="user-icon"><i class="fas fa-user"></i></a>
                    <div class="dropdown-content">
                        <?php if (isset($_SESSION['user_name'])): ?>
                        <section>
                            <h3>Bienvenid@, <?= htmlspecialchars($_SESSION['user_name']); ?></h3>
                            <a href="/Index/mi_perfil.php">Mi perfil</a>
                            <a href="/Index/mis_pedidos.php">Mis pedidos</a>
                            <a href="/Index/mis_pagos.php">Medios de pago</a>
                            <a href="/Index/mis_direcciones.php">Mis direcciones</a>
                            <a href="/Index/logout.php">Cerrar sesión</a>
                        </section>
                        <?php else: ?>
                        <section id="InicarSesion">
                            <h3> Bienvenido</h3>
                            <p>Inicia sesión y podrás consultar el estado de tus pedidos, tu libreta de direcciones y todo lo que necesites. </p>
                            <a href="#accessModal">Iniciar sésion</a>
                        </section>
                        <section id="CrearCuenta">
                            <h3> ¿Quieres una experiencia de compra más rápida?</h3>
                            <p>Descuentos exclusivos</p>
                            <a href="#loginModal">Crear Cuenta</a>
                        </section>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="#" class="cart-icon"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </div>
        <div class="navbar-bottom">
            <ul class="navbar-menu">
                <li><a href="/Index/index.php">INICIO</a></li>
                <li class="dropdown">
                    <a href="#">TIENDA</a>
                    <div class="dropdown-content">
                        <a href="/Futbol/futbol.html">Fútbol</a>
                        <a href="/Voley/Volleyball.html">Vóley</a>
                        <a href="/Tenis/tenis.html">Tennis</a>
                        <a href="/Basquet/basquetart2.php">Basquet</a>
                    </div>
                </li>
                <li><a href="">QUIÉNES SOMOS</a></li>
                <li><a href="/QuienesSomos/QuienesSomos.html">CONTACTO</a></li>
                <li><a href="/AyudaManual/Ayuda.html">¿NECESITAS AYUDA?</a></li>
            </ul>
        </div>
    </nav>
    <div class="form-container">
        <h1>Mi perfil</h1>
        <?php if ($usuario): ?>
            <form action="mi_perfil.php" method="post">
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($usuario['nombres']) ?>">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>">
                <label for="correo">Correo electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($usuario['correo']) ?>">
                <input type="submit" value="Actualizar">
            </form>
        <?php else: ?>
            <p>No se encontró información del usuario.</p>
        <?php endif; ?>
    </div>
</body>
</html>