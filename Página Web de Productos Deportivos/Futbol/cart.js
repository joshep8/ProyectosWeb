let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.addEventListener('DOMContentLoaded', function() {
    // Asegúrate de que la visualización del carrito se actualiza al cargar la página
    updateCartView();
    // Evento para añadir productos al carrito desde botones específicos
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productImage = this.closest('.product, .columna').querySelector('img').src;  // Ajusta la selección según tu HTML
            const productName = this.getAttribute('data-product');
            const productPrice = this.getAttribute('data-price');
            addToCart(productName, productPrice, productImage);
            showCart();  // Función para mostrar el carrito
        });
    });
});

function addToCart(productName, productPrice, productImage) {
    const existingIndex = cart.findIndex(item => item.name === productName);
    if (existingIndex !== -1) {
        cart[existingIndex].quantity += 1;
    } else {
        const product = {
            name: productName,
            price: parseFloat(productPrice),
            image: productImage,
            quantity: 1
        };
        cart.push(product);
    }
    updateCartView();
}

function updateCartView() {
    const cartItems = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotalInput = document.getElementById('total');  
    if (!cartItems) return;  // Asegúrate de que el elemento existe
    cartItems.innerHTML = '';
    let total = 0;
    let totalCount = 0;
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        totalCount += item.quantity; 
        cartItems.innerHTML += `
            <li>
                <img src="${item.image}" alt="${item.name}" style="width:100px; height:auto;">
                <div class="product-details">
                    <span class="product-name">${item.name}</span>
                    <span class="product-price">S/${item.price.toFixed(2)}</span>
                    <span class="product-quantity">Cantidad: ${item.quantity}</span>
                </div>
                <div class="quantity-controls">
                    <button onclick="changeQuantity(${index}, -1)" class="quantity-btn">-</button>
                    <span class="quantity-display">${item.quantity}</span>
                    <button onclick="changeQuantity(${index}, 1)" class="quantity-btn">+</button>
                </div>
                <button onclick="removeFromCart(${index})" class="delete-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </li>
        `;
    });
    document.getElementById('cart-total').textContent = `S/${total.toFixed(2)}`;
    cartCount.textContent = totalCount;
    cartTotalInput.value = total;
    localStorage.setItem('cart', JSON.stringify(cart));
}

function showCart() {
    const cartSummary = document.getElementById('cart-summary');
    if (cartSummary) {
        cartSummary.style.display = 'block';  // Cambia esto según tu CSS para mostrar el carrito
    }
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartView();
}

function changeQuantity(index, change) {
    if (cart[index].quantity + change > 0) {
        cart[index].quantity += change;
    } else {
        removeFromCart(index);
    }
    updateCartView();
}

function closeCart() {
    const cartSummary = document.getElementById('cart-summary');
    if (cartSummary) {
        cartSummary.style.display = 'none';
    }
}
