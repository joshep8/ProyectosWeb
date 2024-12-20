<?php
// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";  // Asegúrate de que este es el usuario correcto.
$password = "";  // Asegúrate de que esta es la contraseña correcta.
$database = "bd_tienda";  // Asegúrate de que este es el nombre correcto de la base de datos.
$port = 33065;
// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>