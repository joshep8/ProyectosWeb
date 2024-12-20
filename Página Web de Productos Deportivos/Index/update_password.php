<?php
include 'db.php';  // Asegúrate de que este archivo contiene la información de conexión a la base de datos

$message = ""; // Inicializa la variable del mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) && isset($_POST['new_password'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Verifica el token y su expiración en la base de datos
    $sql = "SELECT * FROM usuarios WHERE reset_token = ? AND token_expiration > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];

        // Hash de la nueva contraseña
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualiza la contraseña y elimina el token de la base de datos
        $sql = "UPDATE usuarios SET contrasena = ?, reset_token = NULL, token_expiration = NULL WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newPasswordHash, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Su contraseña ha sido actualizada con éxito.";
        } else {
            $message = "Error al actualizar la contraseña.";
        }
    } else {
        $message = "Token inválido o expirado.";
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "Solicitud inválida.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Actualización de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .message {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            text-align: center;
            font-size: 34px; /* Tamaño de fuente aumentado para mejorar la legibilidad */
            color: #333; /* Color del texto oscuro para contraste */
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
    <div class="message">
        <?php echo htmlspecialchars($message); ?>
    </div>
</body>
</html>