<?php
header("Content-Type: application/json");
require_once __DIR__ . "/config.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['usuario'], $input['correo'], $input['contrasena'], $input['id_sede'])) {
    echo json_encode(["success" => false, "message" => "Faltan datos para registrar al usuario."]);
    exit;
}

$usuario = trim($input['usuario']);
$correo = trim($input['correo']);
$contrasena = trim($input['contrasena']);
$id_sede = (int)$input['id_sede'];
$rol = "usuario"; // valor fijo por defecto

try {
    // Verificar duplicados
    $check = $pdo_con->prepare("SELECT * FROM usuario WHERE correo = :correo OR usuario = :usuario LIMIT 1");
    $check->execute([":correo" => $correo, ":usuario" => $usuario]);

    if ($check->fetch()) {
        echo json_encode(["success" => false, "message" => "El usuario o correo ya existen."]);
        exit;
    }

    // Insertar nuevo usuario
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $pdo_con->prepare("INSERT INTO usuario (usuario, correo, contrasena, rol, id_sede)
                               VALUES (:usuario, :correo, :contrasena, :rol, :id_sede)");
    $stmt->execute([
        ":usuario" => $usuario,
        ":correo" => $correo,
        ":contrasena" => $hash,
        ":rol" => $rol,
        ":id_sede" => $id_sede
    ]);

    echo json_encode(["success" => true, "message" => "Usuario registrado exitosamente."]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error en la base de datos: " . $e->getMessage()]);
}
