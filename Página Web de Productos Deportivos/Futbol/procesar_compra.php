<?php
// conexión a la base de datos
$conexion = new mysqli('localhost:33065', 'root', '', 'bd_tienda');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Función para sanitizar datos
function sanitizar($data, $conexion) {
    return $conexion->real_escape_string(trim($data));
}

// recibe valores del formulario y los sanitiza
$nombre = sanitizar($_POST['nombre'], $conexion);
$apellidos = sanitizar($_POST['apellidos'], $conexion);
$direccion_calle = sanitizar($_POST['direccion-calle'], $conexion);
$region_provincia = sanitizar($_POST['region-provincia'], $conexion);
$telefono = sanitizar($_POST['telefono'], $conexion);
$email = sanitizar($_POST['email'], $conexion);
$tipo_comprobante = sanitizar($_POST['tipo-comprobante'], $conexion);
$ruc_dni = sanitizar($_POST['ruc-dni'], $conexion);
$razon_social = sanitizar($_POST['razon-social'], $conexion);
$total = sanitizar($_POST['total'], $conexion);

// Valida que los campos requeridos no estén vacíos
if (empty($nombre) || empty($apellidos) || empty($direccion_calle) || empty($region_provincia) || empty($telefono) || empty($email) || empty($tipo_comprobante) || empty($ruc_dni) || empty($razon_social) || empty($total)) {
    $mensaje = "Todos los campos son obligatorios.";
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=0");
    exit();
}

// Valida formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mensaje = "El formato del correo electrónico no es válido.";
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=0");
    exit();
}

// Valida que el teléfono inicie con 9 y tenga 9 dígitos
if (!preg_match('/^9\d{8}$/', $telefono)) {
    $mensaje = "El número de teléfono debe iniciar con 9 y tener 9 dígitos.";
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=0");
    exit();
}

// Valida que el DNI tenga 8 dígitos y empiece con 1, 4, 6 o 7
if (!preg_match('/^[1467]\d{7}$/', $ruc_dni)) {
    $mensaje = "El DNI debe tener 8 dígitos y comenzar con 1, 4, 6 o 7.";
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=0");
    exit();
}

// Inserta datos en la base de datos
$sql = "INSERT INTO compras (nombre, apellidos, direccion_calle, region_provincia, telefono, email, tipo_comprobante, ruc_dni, razon_social, total) VALUES ('$nombre', '$apellidos', '$direccion_calle', '$region_provincia', '$telefono', '$email', '$tipo_comprobante', '$ruc_dni', '$razon_social', '$total')";

if ($conexion->query($sql) === TRUE) {
    $mensaje = "Gracias por tu compra, $nombre. 🎉 Tu pedido ha sido procesado con éxito. Pronto recibirás un correo con todos los detalles y el seguimiento.";
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=1");
} else {
    $mensaje = "Error al procesar la compra: " . $conexion->error;
    header("Location: realizarcompra.php?mensaje=" . urlencode($mensaje) . "&exito=0");
}

$conexion->close();
?>