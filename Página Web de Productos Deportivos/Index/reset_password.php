<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente más moderna */
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 50px; /* Más espacio alrededor de los elementos del formulario */
            border-radius: 12px; /* Bordes ligeramente más redondeados */
            box-shadow: 0 0 20px rgba(0,0,0,0.2); /* Sombra más oscura para un efecto más profundo */
            width: 450px; /* Ancho más grande del formulario */
        }
        label {
            font-size: 20px; /* Tamaño de fuente aumentado para las etiquetas */
            color: #333;
            font-weight: bold; /* Mantenemos el texto en negrita */
            display: block; /* Aseguramos que cada etiqueta esté en su propia línea */
            margin-bottom: 12px; /* Más espacio debajo de cada etiqueta */
        }
        input[type=password], input[type=submit] {
            width: 100%;
            padding: 18px; /* Padding más grande para hacer los inputs más altos */
            margin-top: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box; /* Incluye el padding en el cálculo del ancho */
            font-size: 18px; /* Tamaño de fuente más grande para los inputs */
        }
        input[type=submit] {
            background-color: #23ac35;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold; /* Botón en negrita para hacerlo destacar */
        }
        input[type=submit]:hover {
            background-color: #115c1d;
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
    
    <form action="update_password.php" method="post">
        <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
        <label for="new_password">Nueva Contraseña:</label>
        <input type="password" name="new_password" id="new_password" required>
        <input type="submit" value="Restablecer Contraseña">
    </form>
    
</body>
</html>