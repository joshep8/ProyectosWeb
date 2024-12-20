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

// Obtener pedidos del usuario
$sql = "SELECT id_pedido, fecha, total FROM pedidos WHERE id_usuario = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$pedidos = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Mis pedidos</title>
    <style>
        body {
            padding-top: 250px;
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
    <h1 class="mis-pedidos-titulo">Mis pedidos</h1>
    <?php if ($pedidos): ?>
        <ul class="mis-pedidos-lista">
            <?php foreach ($pedidos as $pedido): ?>
                <li>
                    Pedido #<?= $pedido['id_pedido'] ?> - Fecha: <?= $pedido['fecha'] ?> - Total: <?= $pedido['total'] ?>€
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="mis-pedidos-mensaje">No tienes pedidos realizados.</p>
    <?php endif; ?>
</body>
</html>