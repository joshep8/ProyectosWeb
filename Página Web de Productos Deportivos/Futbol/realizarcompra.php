<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Facturación</title>
    <link rel="stylesheet" type="text/css" href="realizarcompra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body  class="bg-gray-100 min-h-screen">
    <div class="main-content flex items-center justify-start">
    <header>
        <div class="logo">
            <img src="Imagenes/logoofic.jpg">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar">
            <button type="submit">Buscar</button>
        </div>
        <div class="user">
            <a href="#"><img src="Imagenes/iconvent.jpg"></a>
        </div>
        <div class="cart">
            <a href="#"><img src="Imagenes/Carrio.icon.jpg"><span id="cart-count" class="cart-count">0</span></a>
        </div>
    </header>

    <nav id="Horizontal">
        <div class="enlaces">
            <a href="/Index/index.php">INICIO</a>  
        </div>
        <div class="dropdown">
            <a href="" >TIENDA</a>  
            <div class="dropdown-content">
                <a href="/Futbol/futbol.html">Fútbol</a>
                <a href="/Voley/Volleyball.html">Vóley</a>
                <a href="/Tenis/tenis.html">Tennis</a>
                <a href="Basquet/basquetart2.html">Básquet</a>
            </div>
        </div>
        <div class="enlaces">
            <a href="/QuienesSomos/QuienesSomos.html" >QUIENES SOMOS</a>
        </div>
        <div class="enlaces">
            <a href="/Contacto/Contacto.html">CONTACTO</a>
        </div>
    </nav>
    <?php
        if (isset($_GET['mensaje'])) {
            $tipo = $_GET['exito'] == 1 ? "alert-success" : "alert-danger";
            echo "<div class='message-container'><div class='{$tipo}'>" . htmlspecialchars($_GET['mensaje']) . "</div></div>";
        } else {
            // Cuando no hay mensaje, muestra todo el contenido normal de la página
            ?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl mx-auto mt-24">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">DETALLES DE FACTURACIÓN</h2>
        <form action="procesar_compra.php" method="post"  onsubmit="updateCartView()">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
                <div>
                    <label for="apellidos" class="block text-gray-700 font-semibold mb-2">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
            </div>
            <div class="mt-4">
                <label for="direccion-calle" class="block text-gray-700 font-semibold mb-2">Dirección de la calle *</label>
                <input type="text" id="direccion-calle" name="direccion-calle" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Número de la casa y nombre de la calle">
            </div>
            <div class="mt-4">
                <label for="region-provincia" class="block text-gray-700 font-semibold mb-2">Región / Provincia *</label>
                <select id="region-provincia" name="region-provincia" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Lima Metropolitana</option>
                </select>
            </div>
            <div class="mt-4">
                 <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono *</label>
                 <input type="tel" id="telefono" name="telefono" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="" maxlength="9" pattern="\d{9}">
            </div>
            <div class="mt-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Dirección de correo electrónico *</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
            </div>
            <div class="mt-4">
                <label for="tipo-comprobante" class="block text-gray-700 font-semibold mb-2">Facturación: Tipo de Comprobante *</label>
                <select id="tipo-comprobante" name="tipo-comprobante" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Factura</option>
                </select>
            </div>
            <div class="mt-4">
            <label for="ruc-dni" class="block text-gray-700 font-semibold mb-2">Facturación: RUC/DNI *</label>
            <input type="text" id="ruc-dni" name="ruc-dni" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="" maxlength="8">
            </div>
            <div class="mt-4">
                <label for="razon-social" class="block text-gray-700 font-semibold mb-2">Facturación: Nombre/Razon Social *</label>
                <input type="text" id="razon-social" name="razon-social" class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
            </div>

            <div class="payment-container">
                <div class="header">
                    <h2>Pago con tarjeta de Débito y Crédito</h2>
                    <div class="icons">
                        <i class="fab fa-cc-visa visa"></i>
                        <i class="fab fa-cc-mastercard mastercard"></i>
                        <i class="fab fa-cc-amex amex"></i>
                        <i class="fab fa-cc-diners-club diners"></i>
                    </div>
                </div>
                <div class="form-group">
                        <label for="card-number">Número de tarjeta</label>
                        <div class="relative">
                            <input type="text" id="card-number" placeholder="Número de tarjeta">
                            <i class="fas fa-credit-card icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry-date">MM/AA</label>
                        <div class="relative">
                            <input type="text" id="expiry-date" placeholder="MM/AA">
                            <i class="fas fa-calendar-alt icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <div class="relative">
                            <input type="text" id="cvv" placeholder="CVV">
                            <i class="fas fa-question-circle icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="installments">Sin cuotas</label>
                        <select id="installments">
                            <option>Sin cuotas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deferred-payment">Pago sin diferido</label>
                        <select id="deferred-payment">
                            <option>Pago sin diferido</option>
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <button type="submit" class="order-button">Realizar Pedido</button>
                    </div>
                    <div class="text-center text-gray-600 text-sm">
                        He leído y estoy de acuerdo con los términos y condiciones de la web
                    </div>
                    <input type="hidden" id="total" name="total" value="">
                </form>
            </div>


    <main class="main-container">
        <div class="cart-container">
            <h1>Tus Productos</h1>
            <ul id="cart-items">
                <!-- Elementos del carrito aquí -->
            </ul>
            <div class="order-summary">
                <h2>Total:<span id="cart-total">0</span></h2> 
            </div>
        </div>
    </main>
</div>
<div class="main-content">
    <div class="card">
        <p class="text-details"><strong>Beneficio de cuotas sin intereses es exclusivo con tarjetas tarjetas de crédito BCP (Visa), BBVA (Visa y Mastercard) y Diners Club</strong> <a href="#" class="link-style">Ver Más</a></p>
        
        <div class="section">
            <h2 class="section-title">Compra con Seguridad</h2>
            <p class="text-details">Tus compras estás seguras con nosotros.</p>
            <ul class="list-style">
                <li class="list-item">
                    <i class="fas fa-check-circle icon-style"></i>
                    <span class="text-details">Somos distribuidores oficiales de las marcas que ofrecemos.</span>
                </li>
                <li class="list-item">
                    <i class="fas fa-check-circle icon-style"></i>
                    <span class="text-details">Pago con tarjeta de crédito asegurada con Mercado Pago</span>
                </li>
            </ul>
        </div>
        
        <hr class="divider">
        
        <div class="flex-center">
            <i class="fas fa-truck icon-style cart-icon"></i>
            <h2 class="section-title">Envío Seguro</h2>
        </div>
        <p class="text-details">Recibe tus pedidos en la comodidad de tu hogar en un máximo de 7 días hábiles.</p>
        <?php
        }
        ?>
    </div>
    <script src="cart.js"></script>
</body>
</html>