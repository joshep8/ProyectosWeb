//Asiganamos el evento lisner con los id cliente from, updeit buton y seerch

document.getElementById('client-form').addEventListener('submit', addOrUpdateClient);
document.getElementById('update-btn').addEventListener('click', updateClient);
document.getElementById('search').addEventListener('input', searchClient);

// Inicializa un array vacío para almacenar los clientes.
let clients = [];

// Definimos una variable para indicar que no se esta editando los clientes 
let editingClientIndex = -1;

// Agregamos una funcion para actalizar y agregar un cliente 
function addOrUpdateClient(event) {
    // Evita que el formulario se envíe y recargue la página.
    event.preventDefault();

    // Obtenemos los valores de los campos del formulario
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    // Utilizamos la condicional if - else. Si no se esta editando un cliente(editingClientIndex es -1), agregamos un cliente al array
    if (editingClientIndex === -1) {
        clients.push({ name, email, phone });
    } else {
        // Si se está editando un cliente, actualiza los datos del cliente en el array.
        clients[editingClientIndex] = { name, email, phone };
        editingClientIndex = -1;
        // Cambia la visibilidad de los botones de agregar y actualizar.
        document.getElementById('add-btn').style.display = 'inline-block';
        document.getElementById('update-btn').style.display = 'none';
    }

    // Devuelve la lista de clientes actualizada.
    renderClientList();
    // Resetea el formulario.
    document.getElementById('client-form').reset();
}

// Agrega una funcion para devolver la lista de clientes en la tabla.
function renderClientList() {
    // Obtiene el elemento de la tabla donde se mostrarán los clientes.
    const clientsTable = document.getElementById('clients');
    // Limpia la tabla.
    clientsTable.innerHTML = '';

    // Recorre el array de clientes y crea una fila para cada cliente.
    clients.forEach((client, index) => {
        const clientRow = document.createElement('tr');

        // Agrega los datos del cliente y botones de acción a la fila.
        clientRow.innerHTML = `
            <td>${client.name}</td>
            <td>${client.email}</td>
            <td>${client.phone}</td>
            <td class="actions">
                <button onclick="editClient(${index})">Editar</button>
                <button onclick="deleteClient(${index})">Eliminar</button>
                <button onclick="redirectToWhatsApp('${client.phone}')">Chatear por WhatsApp</button>
            </td>
        `;

        // Agrega la fila a la tabla.
        clientsTable.appendChild(clientRow);
    });
}

// Agrega una funcion para cargar los datos de un cliente en el formulario para su edición.
function editClient(index) {
    const client = clients[index];

    // Llena los campos del formulario con los datos del cliente seleccionado.
    document.getElementById('name').value = client.name;
    document.getElementById('email').value = client.email;
    document.getElementById('phone').value = client.phone;
    editingClientIndex = index;

    // Cambia la visibilidad de los botones de agregar y actualizar.
    document.getElementById('add-btn').style.display = 'none';
    document.getElementById('update-btn').style.display = 'inline-block';
}

// Agrega una función para actualizar los datos de un cliente.
function updateClient() {
    // Obtiene los valores de los campos del formulario.
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    // Actualiza los datos del cliente en el array.
    clients[editingClientIndex] = { name, email, phone };
    editingClientIndex = -1;

    // Cambia la visibilidad de los botones de agregar y actualizar.
    document.getElementById('add-btn').style.display = 'inline-block';
    document.getElementById('update-btn').style.display = 'none';

    // Devuelve la lista de clientes actualizada.
    renderClientList();
    // Resetea el formulario.
    document.getElementById('client-form').reset();
}

// Agrega una función para eliminar un cliente del array.
function deleteClient(index) {
    // Elimina el cliente del array.
    clients.splice(index, 1);
    // Devuelve la lista de clientes actualizada.
    renderClientList();
}

// Agrega una función para buscar clientes en la lista.
function searchClient(event) {
    const searchTerm = event.target.value.toLowerCase();
    // Filtra los clientes que coinciden con el término de búsqueda.
    const filteredClients = clients.filter(client => 
        client.name.toLowerCase().includes(searchTerm)
    );

    // Obtiene el elemento de la tabla donde se mostrarán los clientes filtrados.
    const clientsTable = document.getElementById('clients');
    // Limpia la tabla.
    clientsTable.innerHTML = '';

    // Recorre el array de clientes filtrados y crea una fila para cada cliente.
    filteredClients.forEach((client, index) => {
        const clientRow = document.createElement('tr');

        // Agrega los datos del cliente y botones de acción a la fila.
        clientRow.innerHTML = `
            <td>${client.name}</td>
            <td>${client.email}</td>
            <td>${client.phone}</td>
            <td class="actions">
                <button onclick="editClient(${index})">Editar</button>
                <button onclick="deleteClient(${index})">Eliminar</button>
                <button onclick="redirectToWhatsApp('${client.phone}')">Chatear por WhatsApp</button>
            </td>
        `;

        // Agrega la fila a la tabla.
        clientsTable.appendChild(clientRow);
    });
}

// Agrega una función para redirigir a WhatsApp con un mensaje predefinido.
function redirectToWhatsApp(phoneNumber) {
    const message = 'Hola, somos Sports Center, una tienda especializada en la venta de productos deportivos ubicada en Lima, Perú. ¡Consúltenos para conocer nuestras increíbles ofertas! Esta semana, estamos ofreciendo descuentos especiales en una amplia variedad de productos. Desde equipamiento para fútbol y baloncesto hasta ropa y accesorios para correr y entrenar, tenemos todo lo que necesita a precios inigualables. ¡No se pierda nuestras promociones exclusivas y venga a visitarnos para equiparse con lo mejor en artículos deportivos!';

    // Construye el enlace de WhatsApp con el número de teléfono y el mensaje.
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    // Redirige al usuario a la URL de WhatsApp.
    window.location.href = whatsappURL;
}


// Obtiene los elementos de nombre, email y teléfono.
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone');

// Agrega event listeners para detectar el cambio de enfoque en los campos de entrada.
nameInput.addEventListener('blur', changeTextColor);
emailInput.addEventListener('blur', changeTextColor);
phoneInput.addEventListener('blur', changeTextColor);

// Agrega una Función para cambiar el color del texto a azul cuando el usuario cambia el enfoque del campo.
function changeTextColor() {
    // Cambia el color del texto a azul solo si el campo no está vacío.
    if (this.value.trim() !== '') {
        this.style.color = 'blue';
    } else {
        this.style.color = 'black';
    }
}
