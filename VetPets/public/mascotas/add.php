<?php
require '../../config/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// Obtener datos del JSON
$data = json_decode(file_get_contents("php://input"), true);

$nombre   = trim($data['nombre'] ?? '');
$especie  = trim($data['especie'] ?? '');
$raza     = trim($data['raza'] ?? '');
$edad     = intval($data['edad'] ?? 0);
$sexo     = trim($data['sexo'] ?? '');
$id_dueno = intval($data['id_dueno'] ?? 0);
$id_sede  = intval($data['id_sede'] ?? 1); // Valor por defecto 1

// Validaciones rápidas
if (!$nombre || !$especie || !$raza || $edad < 0 || !$sexo || !$id_dueno || !$id_sede) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
    exit;
}

try {
    $stmt = $pdo_con->prepare("INSERT INTO mascota (nombre, especie, raza, edad, sexo, id_dueno, id_sede) 
                               VALUES (:nombre, :especie, :raza, :edad, :sexo, :id_dueno, :id_sede)");
    $stmt->execute([
        ':nombre'   => $nombre,
        ':especie'  => $especie,
        ':raza'     => $raza,
        ':edad'     => $edad,
        ':sexo'     => $sexo,
        ':id_dueno' => $id_dueno,
        ':id_sede'  => $id_sede
    ]);

    echo json_encode(["success" => true, "message" => "Mascota registrada correctamente"]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al registrar: " . $e->getMessage()]);
}
