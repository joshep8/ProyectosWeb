var modals = document.querySelectorAll('.modal');

// Obtener todos los botones de cierre
var closeButtons = document.querySelectorAll('.close');

// Función para mostrar un modal específico
function showModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'block';
}

// Función para cerrar todos los modales
function closeModal() {
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });
}