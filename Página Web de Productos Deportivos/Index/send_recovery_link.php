<?php
session_start();
include 'db.php';  // Asegúrate de conectar a tu base de datos

$message = ""; // Inicializa la variable del mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar si el correo existe
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Genera un token seguro
        $token = bin2hex(random_bytes(50)); 
        // Establece la expiración para 24 horas después
        $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Guardar el token y la expiración en la base de datos
        $sql = "UPDATE usuarios SET reset_token = ?, token_expiration = ? WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $token, $expiration, $email);
        $stmt->execute();

        // Enviar correo electrónico con el token
        $to = $email;
        $subject = "Recuperación de contraseña";
        $message = "Estimado usuario,\n\nHas solicitado restablecer tu contraseña. Por favor, haz clic en el siguiente enlace para establecer una nueva contraseña.\n\nEste enlace es válido solo por 24 horas por razones de seguridad.\n Haga clic en este enlace para restablecer su contraseña:\nhttp://localhost/Index/reset_password.php?token=$token\nSi no has solicitado un cambio de contraseña, por favor ignora este correo o contacta con nuestro equipo de soporte para más ayuda.\n\nAtentamente,\nEl equipo de soporte";
        $headers = "From: no-reply@yourdomain.com";
        mail($to, $subject, $message, $headers);

        $message = "Enlace de recuperación enviado a su correo electrónico.";
    } else {
        $message = "Correo electrónico no encontrado.";
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
    <title>Recuperación de Contraseña</title>
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
            font-size: 24px;
            color: #333;
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