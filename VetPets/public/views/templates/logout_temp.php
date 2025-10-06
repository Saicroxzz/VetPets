<?php
// Mostrar errores mientras pruebas (puedes quitar esto en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vaciar variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Eliminar cookie de sesión por seguridad
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Devolver respuesta JSON
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'Sesión cerrada correctamente'
]);
exit;
?>
