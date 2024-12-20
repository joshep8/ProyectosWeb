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

// Obtener métodos de pago del usuario
$sql = "SELECT id_pago, tipo_pago, detalles FROM metodos_pago WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$pagos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis medios de pago</title>
</head>
<body>
    <h1>Mis medios de pago</h1>
    <?php if ($pagos): ?>
        <ul>
            <?php foreach ($pagos as $pago): ?>
                <li>
                    Tipo: <?= $pago['tipo_pago'] ?> - Detalles: <?= $pago['detalles'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes métodos de pago guardados.</p>
    <?php endif; ?>
</body>
</html>
