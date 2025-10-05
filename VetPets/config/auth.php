<?php
header("Content-Type: application/json");
session_start();

// Incluir conexión (ajusta la ruta según tu estructura /config/db.php)
require_once __DIR__ . "/../config/config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['email'], $input['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Faltan datos de acceso"
    ]);
    exit;
}

$email = trim($input['email']);
$password = trim($input['password']);

try {
    // Buscar usuario por correo
    $stmt = $pdo_con->prepare("SELECT id_usuario, usuario, correo, password_hash, rol FROM usuario WHERE correo = :email LIMIT 1");
    $stmt->execute([":email" => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password_hash'])) {
        // Guardar en sesión
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['rol'] = $usuario['rol'] ?? "usuario";

        echo json_encode([
            "success" => true,
            "message" => "Login correcto",
            "user" => [
                "id" => $usuario['id'],
                "nombre" => $usuario['nombre'],
                "email" => $usuario['email'],
                "rol" => $usuario['rol'] ?? "usuario"
            ]
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Correo o contraseña inválidos"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error en la base de datos: " . $e->getMessage()
    ]);
}
