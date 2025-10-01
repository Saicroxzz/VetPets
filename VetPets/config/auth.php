<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: ../login.php");
    exit();
}

// Obtener datos del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];
$usuario_nombre = $_SESSION['usuario'] ?? "";
$usuario_rol = $_SESSION['rol'] ?? "usuario";

// Función para verificar permisos de rol
function verificarRol($rolesPermitidos = []) {
    global $usuario_rol;

    if (!in_array($usuario_rol, $rolesPermitidos)) {
        // Redirigir si el rol no tiene permiso
        header("Location: ../dashboard.php?error=permiso_denegado");
        exit();
    }
}
?>
