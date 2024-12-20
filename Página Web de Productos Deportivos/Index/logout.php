<?php
session_start(); // Iniciar el manejo de sesión
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión por completo
header("Location:/Index/index.php"); // Redirigir al usuario a la página de inicio
exit;
?>