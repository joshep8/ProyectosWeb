<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasquetBall</title>
    <link rel="stylesheet" href="Estilobs1.css" type="text/css">
    <style>
        #BasquetBall {
            display: inline-block;
            flex-wrap: wrap;
        }
        .columna {
            display: inline-block;   
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="Imagenes/logoofic.jpg" alt="Logo Tenis">
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Buscar">
        <button type="submit">Buscar</button>
    </div>
    <div class="user">
        <a href="#"><img src="Imagenes/iconvent.jpg" alt="Icono de Usuario"></a>
    </div>
    <div class="cart">
        <a href="Carrito.php"><img src="Imagenes/Carrio.icon.jpg" alt="Icono de Carrito"></a>
    </div>
</header>

<nav id="Horizontal">
    <div class="enlaces">
        <a href="/Index/index.php">INICIO</a>
    </div>

    <div class="dropdown">
        <a href="/Index/index.php">TIENDA</a>
        <div class="dropdown-content">
            <a href="/Futbol/futbol.html">Fútbol</a>
            <a href="/Voley/Volleyball.html">Vóley</a>
            <a href="/Tenis/tenis.html">Tennis</a>
            <a href="basquetart2.html">Básquet</a>
        </div>
    </div>

    <div class="enlaces">
        <a href="/QuienesSomos/QuienesSomos.html">QUIENES SOMOS</a>
    </div>
    <div class="enlaces">
        <a href="/Contacto/Contacto.html">CONTACTO</a>
    </div>
</nav>

<br><br><br><br><br><br><br><br><br>

<section>
    <div class="item" id="Titulo">
        <p>BasquetBall</p>
    </div>
</section>

<div class="container">
    <section id="lateral">
        <p>CATEGORIA</p>
        <hr>
        <div class="categoria">
            <a href="Balon.html">Pelotas</a>
            <a href="Camisetas.html">Camisetas</a>
            <a href="Zapatillas.html">Zapatillas</a>
        </div>
        <br>
        <hr>
        <p>MARCA</p>
        <hr>
        <div class="marca">
            <input type="checkbox">Adidas<br><br><br>
            <input type="checkbox">Jordan<br><br><br>
            <input type="checkbox">Nike<br><br><br>
            <input type="checkbox">Wilson<br><br><br>
        </div>
    </section>

    <section id="BasquetBall">
        <div class="fila">
            <div class="columna">
                <img id="Producto1" src="https://images.footballfanatics.com/los-angeles-lakers/los-angeles-lakers-nike-icon-swingman-jersey-gold-lebron-james-youth_ss5_p-201084152+u-jnutuz4rmnvkna8w9jpj+v-4qcoyuea5iq79pkgraun.jpg?_hv=2&w=340">
                <h2 class="marca">NIKE</h2>
                <h3 class="titulo">Camiseta Nike Icon Swingman de Los Angeles Lakers - Dorado - LeBron James - Juvenil – 3 unidades</h3>
                <h3 class="precio">
                    <span style="text-decoration: line-through;">S/95.00</span> S/59.90
                </h3>
                <br>
                <form action="Carrito.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id_producto" value="1">
                    <input type="number" name="cantidad" value="1">
                    <button type="submit" name="añadir_carrito">AÑADIR AL CARRO</button>
                </form>
            </div>

            <div class="columna">
                <img id="Producto2" src="https://images.footballfanatics.com/oklahoma-city-thunder/oklahoma-city-thunder-nike-association-swingman-jersey-custom-youth_ss5_p-13373718+u-wz7miolebdvtzm068lgk+v-mtqunc8bdercahjc0fpp.jpg?_hv=2&w=340" alt="Camiseta">
                <h2 class="marca">NIKE</h2>
                <h3 class="titulo">Oklahoma City Thunder Nike Association Swingman Jersey - Personalizado - Jóvenes</h3>
                <h3 class="precio">
                    <span style="text-decoration: line-through;">S/99.90</span>S/89.90
                </h3>
                <br>
                <form action="Carrito.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id_producto" value="2">
                    <input type="number" name="cantidad" value="1">
                    <button type="submit" name="añadir_carrito">AÑADIR AL CARRO</button>
                </form>
            </div>

           

        </div>
    </section>
</div>

</body>
</html>
