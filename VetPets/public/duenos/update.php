<?php
require '../../config/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

$id_dueno  = intval($data['id_dueno'] ?? 0);
$nombre    = trim($data['nombre'] ?? '');
$apellido  = trim($data['apellido'] ?? '');
$correo    = trim($data['correo'] ?? '');
$telefono  = trim($data['telefono'] ?? '');
$direccion = trim($data['direccion'] ?? '');
$id_sede   = intval($data['id_sede'] ?? 0);

if (!$id_dueno || !$nombre || !$apellido || !$correo || !$telefono || !$direccion || !$id_sede) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
    exit;
}

try {
    $stmt = $pdo_con->prepare("UPDATE dueno 
        SET nombre=:nombre, apellido=:apellido, correo=:correo, telefono=:telefono, direccion=:direccion, id_sede=:id_sede
        WHERE id_dueno=:id_dueno");
    $stmt->execute([
        ':id_dueno'  => $id_dueno,
        ':nombre'    => $nombre,
        ':apellido'  => $apellido,
        ':correo'    => $correo,
        ':telefono'  => $telefono,
        ':direccion' => $direccion,
        ':id_sede'   => $id_sede
    ]);

    echo json_encode(["success" => true, "message" => "Dueño actualizado correctamente"]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al actualizar: " . $e->getMessage()]);
}
?>