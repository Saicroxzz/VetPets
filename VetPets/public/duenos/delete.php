<?php
require '../../config/config.php';
header('Content-Type: application/json');

$id = intval($_GET['id'] ?? 0);

if (!$id) {
    echo json_encode(["success" => false, "message" => "ID inválido"]);
    exit;
}

try {
    $stmt = $pdo_con->prepare("DELETE FROM dueno WHERE id_dueno = :id");
    $stmt->execute([":id" => $id]);

    echo json_encode(["success" => true, "message" => "Dueño eliminado correctamente"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al eliminar: " . $e->getMessage()]);
}
