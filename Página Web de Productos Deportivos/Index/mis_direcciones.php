<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:/Index/login.php");
    exit;
}

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

// Obtener direcciones del usuario
$sql = "SELECT id_direccion, direccion, ciudad, estado, codigo_postal FROM direcciones WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$direcciones = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis direcciones</title>
</head>
<body>
    <h1>Mis direcciones</h1>
    <?php if ($direcciones): ?>
        <ul>
            <?php foreach ($direcciones as $direccion): ?>
                <li>
                    <?= $direccion['direccion'] ?>, <?= $direccion['ciudad'] ?>, <?= $direccion['estado'] ?> - Código Postal: <?= $direccion['codigo_postal'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes direcciones guardadas.</p>
    <?php endif; ?>
</body>
</html>