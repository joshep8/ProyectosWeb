<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS del chatbot -->
    <link rel="stylesheet" href="styleChat.css">
    <!-- Link de las fuentes para los iconos Google -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- Script del chatbot -->
    <script src="scriptChat.js" defer></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Mi Deporte</title>
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
                            <a href="logout.php">Cerrar sesión</a>
                        </section>
                        <?php else: ?>
                        <section id="InicarSesion">
                            <h3> Bienvenido</h3>
                            <p>Inicia sesión y podrás consultar el estado de tus pedidos, tu libreta de direcciones y
                                todo lo que necesites. </p>
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


    <div class="hero">

        <iframe
            src="https://www.youtube.com/embed/JLvxPaeIVRI?autoplay=1&loop=1&playlist=JLvxPaeIVRI&controls=0&showinfo=0&modestbranding=1&rel=0&mute=1"
            title="YouTube video" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>

    <!-- Aqui inicia el chat -->
    <button class="chatbot-toggler">
        <span class="material-symbols-outlined">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
        <header>
            <h2>Asistente</h2>
            <span class="close-btn material-symbols-outlined">close</span>
        </header>
        <ul class="chatbox">
            <li class="chat incoming">
                <span class="material-symbols-outlined">person</span>
                <p>Hola 👋 <br>Como puedo ayudarte?</p>
            </li>
        </ul>
        <div class="chat-input">
            <textarea placeholder="Ingrese un consulta..." required></textarea>
            <span id="send-btn" class="material-symbols-outlined">send</span>
        </div>
    </div>                      
    <!-- Aqui termina el chat -->

    <h2 class="section-title">Sport Center Tienda de artículos deportivos para todo tipo de disciplinas 🏋️‍♀️⛹️</h2>
    <div class="categories">
        <div class="category">
            <a href="/Voley/Volleyball.html" Target="_blank">
                <img src="involey.png.png" alt="categoria voley">
                <p>8 PRODUCTOS</p>
            </a>
        </div>
        <div class="category">
            <a href="/Futbol/futbol.html" Target="_blank">
                <img src="infutbol.png.png" alt="categoria futbol">
                <p>8 PRODUCTOS</p>
            </a>
        </div>
        <div class="category">
            <a href="/Tenis/tenis.html" Target="_blank">
                <img src="intennis.png.png" alt="categoria tennis">
                <p>14 PRODUCTOS</p>
            </a>
        </div>
        <div class="category">
            <a href="/Basquet/basquetart2.html" Target="_blank">
                <img src="inbasquet.png.png" alt="categoria basquet">
                <p>8 PRODUCTOS</p>
            </a>
        </div>
    </div>
    <!--Slider-->
    <h2 class="section-title">Productos Destacados 🤩</h2>
    <div class="featured-card">
        <div class="card blue">
            <div class="product">
                <span class="number">01</span>
                <span class="sneakers">SNEAKERS</span>
                <span class="price">S/180.00</span>
                <img src="images/nike-blue.png">
            </div>
            <div class="title">
                <h2>Nike Blue</h2>
            </div>
        </div>

        <div class="card purple">
            <div class="product">
                <span class="number">02</span>
                <span class="sneakers">SNEAKERS</span>
                <span class="price">S/200.00</span>
                <img src="images/nike-purple.png">
            </div>
            <div class="title">
                <h2>Nike Purple</h2>
            </div>
        </div>

        <div class="card red">
            <div class="product">
                <span class="number">03</span>
                <span class="sneakers">SNEAKERS</span>
                <span class="price">S/220.00</span>
                <img src="images/Adidas-Zero-Pro.png">
            </div>
            <div class="title">
                <h2>Adidas Zero Pro</h2>
            </div>
        </div>

        <div class="card green">
            <div class="product">
                <span class="number">04</span>
                <span class="sneakers">SNEAKERS</span>
                <span class="price">S/215.00</span>
                <img src="images/Nike-Gore.png">
            </div>
            <div class="title">
                <h2>Nike Gore</h2>
            </div>
        </div>

        <div class="card greenyellow">
            <div class="product">
                <span class="number">05</span>
                <span class="sneakers">SNEAKERS</span>
                <span class="price">S/185.00</span>
                <img src="images/Adidas-Supernova.png">
            </div>
            <div class="title">
                <h2>Adidas Supernova</h2>
            </div>
        </div>
    </div>
    <script src="vanilla-tilt.js"></script>
    <script type="text/javascript">
    VanillaTilt.init(document.querySelectorAll(".card"), {
        max: 25,
        speed: 5000,
        glare: true,
        'max-glare': 0.5,
    });
    </script>
    <div class="image-container">
        <img src="imganun.jpg" alt="imagen de futbol" class="full-width-image">
    </div>
    <div class="testimonial-container">
        <h2>Testimonios de Algunos Clientes</h2>
        <div class="testimonial">
            <div class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star gray">&#9733;</span>
            </div>
            <p>Muy buena coordinación, buen producto, y sobre todo puntuales con la hora acordada para entregar el
                pedido, 100% recomendado.</p>
            <div class="author">GICA8238807 / Mercado Libre</div>
        </div>
        <div class="testimonial">
            <div class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <p>Totalmente recomendable para todo tipo de artículos deportivos, muy precisos con los detalles y con cada
                artículo en venta, son tal cual las fotos, buen precio y sobre todo el envío a todo Lima. Excelente
                servicio en todas las etapas de la compra y también en la post venta, 10 Puntos!!</p>
            <div class="author">Roberto Loja Cárdenas / Facebook</div>
        </div>
        <div class="testimonial">
            <div class="rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star gray">&#9733;</span>
                <span class="star gray">&#9733;</span>
            </div>
            <p>Recibí el pedido tal cual lo había solicitado, el tiempo de entrega fue muy breve. Una muy buena
                experiencia la compra con mideporte.pe</p>
            <div class="author">Alejandro Ruiz / Instagram</div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
            </div>
            <div class="footer-row">

                <div class="footer-links">
                    <h4>SportCenter</h4>
                    <ul>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Nuestros sevicios</a></li>
                        <li><a href="#">Politica de privacidad</a></li>
                        <li><a href="#">Afiliate</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Ayuda</h4>
                    <ul>
                        <li><a href="#">Preguntas</a></li>
                        <li><a href="#">Compras</a></li>
                        <li><a href="#">Envios</a></li>
                        <li><a href="#">Estatus de orden</a></li>
                        <li><a href="#">Pago</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Tienda</h4>
                    <ul>
                        <li><a href="#">Ropa</a></li>
                        <li><a href="#">Zapatillas</a></li>
                        <li><a href="#">Telefonos</a></li>
                        <li><a href="#">Accesorios</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Siguenos</h4>
                    <div class="social-link">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>

                </div>
            </div>

        </div>

    </footer>
    <div class="copyright">
        <p>&copy; 2024 Tienda de Equipos Deportivos. Todos los derechos reservados.</p>
        <img src="imgpayment.png" alt="Pagos">
    </div>
    <form action="registrar.php" method="post">
        <div id="loginModal" class="modal">
            <div class="modal-content">
                <span class="close"><a href="#_">&times;</a></span>
                <section class="form-register">
                    <h4>Registro</h4>
                    <input class="controls" type="text" name="nombres" id="nombres" placeholder="Ingrese su Nombre">
                    <input class="controls" type="text" name="apellidos" id="apellidos"
                        placeholder="Ingrese su Apellido">
                    <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su Correo">
                    <input class="controls" type="password" name="contrasena" id="contrasena"
                        placeholder="Ingrese su Contraseña">
                    <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
                    <br>
                    <input class="botons" type="submit" value="Registrar">
                    <p><a href="#">¿Ya tengo Cuenta?</a></p>
                </section>
            </div>
        </div>
    </form>
    <form action="/Index/login.php" method="post">
        <!-- Cambiado el action y agregado etiqueta form -->
        <div id="accessModal" class="modal">
            <!-- Cambiado el ID -->
            <div class="modal-content">
                <span class="close"><a href="#_">&times;</a></span>
                <section class="form-register">
                    <h4>ACCEDER</h4>
                    <input class="controls" type="text" name="username" id="username"
                        placeholder="Nombre de usuario o correo electrónico" required>
                    <input class="controls" type="password" name="password" id="password" placeholder="Contraseña"
                        required>
                    <label class="checkbox-container">
                        Recuérdame
                        <input type="checkbox" checked="checked" name="remember">
                        <span class="checkmark"></span>
                    </label>
                    <input class="botons" type="submit" value="ACCESO">
                    <p><a href="/Index/forgot_password.php">¿Olvidaste la contraseña?</a></p>
                </section>
            </div>
        </div>
    </form>
</body>

</html>