<?php
session_start();
$servername = "localhost";
$username = "root";  // Asegúrate de que este es el usuario correcto.
$password = "";  // Asegúrate de que esta es la contraseña correcta.
$database = "bd_tienda";  // Asegúrate de que este es el nombre correcto de la base de datos.
$port = 33065;
// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recoger los datos del formulario
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena']; // Asegúrate de que el 'name' en tu formulario HTML sea 'contrasena', no 'correo'
// Hashear la contraseña antes de almacenarla en la base de datos
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
// Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (nombres, apellidos, correo, contrasena) VALUES (?, ?, ?, ?)";

// Preparar la declaración para mayor seguridad
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombres, $apellidos, $correo, $contrasena_hash);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Si el registro es exitoso, también inicia la sesión del usuario
    $_SESSION['user_name'] = $nombres; // Iniciar sesión con el nombre del usuario registrado
    header("Location:/Index/index.php"); // Redirigir a la página principal como usuario logueado
    exit;
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>