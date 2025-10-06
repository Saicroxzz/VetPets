<?php
require '../../config/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// Obtener datos del JSON
$data = json_decode(file_get_contents("php://input"), true);

$fecha_cita = trim($data['fecha_cita'] ?? '');
$hora_cita  = trim($data['hora_cita'] ?? '');
$motivo     = trim($data['motivo'] ?? '');
$estado     = trim($data['estado'] ?? '');
$id_mascota = intval($data['id_mascota'] ?? 0);
$id_dueno   = intval($data['id_dueno'] ?? 0);
$id_usuario = intval($data['id_usuario'] ?? 0);
$id_sede    = intval($data['id_sede'] ?? 0);

// Validaciones rápidas
if (!$fecha_cita || !$hora_cita || !$motivo || !$estado || !$id_mascota || !$id_dueno || !$id_usuario || !$id_sede) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
    exit;
}

// Validar fecha y hora
if (!strtotime($fecha_cita . ' ' . $hora_cita)) {
    echo json_encode(["success" => false, "message" => "Fecha u hora inválida"]);
    exit;
}

try {
    $stmt = $pdo_con->prepare("INSERT INTO cita (fecha_cita, hora_cita, motivo, estado, id_mascota, id_dueno, id_usuario, id_sede) 
                               VALUES (:fecha_cita, :hora_cita, :motivo, :estado, :id_mascota, :id_dueno, :id_usuario, :id_sede)");
    $stmt->execute([
        ':fecha_cita' => $fecha_cita,
        ':hora_cita'  => $hora_cita,
        ':motivo'     => $motivo,
        ':estado'     => $estado,
        ':id_mascota' => $id_mascota,
        ':id_dueno'   => $id_dueno,
        ':id_usuario' => $id_usuario,
        ':id_sede'    => $id_sede
    ]);

    echo json_encode(["success" => true, "message" => "Cita registrada correctamente"]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al registrar: " . $e->getMessage()]);
}
?>