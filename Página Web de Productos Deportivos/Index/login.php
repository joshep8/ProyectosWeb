<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_tienda";
$port = 33065;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['username'] ?? '';
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: /Index/login_page.php?error=" . urlencode("Formato de correo electrónico inválido"));
        exit();
    }

    $contrasena = $_POST['password'] ?? '';

    // Preparar consulta
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($contrasena, $row['contrasena'])) {
            // Regenerar el ID de sesión al iniciar sesión para prevenir ataques de fijación de sesión
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row['id'];  // Asegúrate de que 'id_usuario' es el nombre correcto de la columna en tu base de datos
            $_SESSION['user_name'] = $row['nombres'];  // Iniciar sesión con el nombre del usuario
            header("Location: /Index/index.php");  // Redirigir a la página principal
            exit();
        } else {
            header("Location: /Index/login_page.php?error=" . urlencode("La contraseña no es correcta"));
            exit();
        }
    } else {
        header("Location: /Index/login_page.php?error=" . urlencode("No se encontró usuario con ese correo"));
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>