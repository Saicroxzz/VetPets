<?php
require '../../config/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// Obtener datos del JSON
$data = json_decode(file_get_contents("php://input"), true);

$cedula    = trim($data['cedula'] ?? '');
$nombre    = trim($data['nombre'] ?? '');
$apellido  = trim($data['apellido'] ?? '');
$correo    = trim($data['correo'] ?? '');
$telefono  = trim($data['telefono'] ?? '');
$direccion = trim($data['direccion'] ?? '');
$id_sede   = intval($data['id_sede'] ?? 1); // Valor por defecto 1

try {
    $stmt = $pdo_con->prepare("INSERT INTO dueno (id_dueno, nombre, apellido, correo, telefono, direccion, id_sede) 
                               VALUES (:cedula, :nombre, :apellido, :correo, :telefono, :direccion, :id_sede)");
    $stmt->execute([
        ':cedula'    => $cedula,
        ':nombre'    => $nombre,
        ':apellido'  => $apellido,
        ':correo'    => $correo,
        ':telefono'  => $telefono,
        ':direccion' => $direccion,
        ':id_sede'   => $id_sede
    ]);

    echo json_encode(["success" => true, "message" => "Dueño registrado correctamente"]);

} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // código de error de duplicado
        echo json_encode(["success" => false, "message" => "Este correo ya está registrado"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar: " . $e->getMessage()]);
    }
}
