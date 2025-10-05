<?php
// Ajusta la ruta a tu config si hace falta
include '../../../config/config.php';

// --- Parámetros de filtrado ---
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$status = isset($_GET['status']) ? trim($_GET['status']) : '';
$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$month = isset($_GET['month']) ? intval($_GET['month']) : null;
$year  = isset($_GET['year'])  ? intval($_GET['year'])  : null;

// Si hay una fecha concreta, usa su mes/año para el calendario; si no tomar mes/año actual
if ($date && ($d = DateTime::createFromFormat('Y-m-d', $date))) {
    $month = intval($d->format('n'));
    $year  = intval($d->format('Y'));
} else {
    $now = new DateTime('now');
    $month = $month ?: intval($now->format('n'));
    $year  = $year  ?: intval($now->format('Y'));
}

// normalize status allowed (ajusta si tienes otros estados)
$allowedStatuses = ['Pendiente','Confirmada','Atendida'];
if ($status !== '' && !in_array($status, $allowedStatuses, true)) {
    $status = '';
}

// --- Generar calendario simple (mes actual o el indicado) ---
$firstOfMonth = new DateTime("$year-$month-01");
$daysInMonth = intval($firstOfMonth->format('t'));
$firstWeekday = intval($firstOfMonth->format('N')); // 1 (Lun) - 7 (Dom)

// Para nav mes anterior/siguiente:
$prev = (clone $firstOfMonth)->modify('-1 month');
$next = (clone $firstOfMonth)->modify('+1 month');

// Helper para construir query params persistentes
function keepParams(array $extra = []) {
    $params = [];
    if (!empty($_GET['q']))    $params['q'] = $_GET['q'];
    if (!empty($_GET['status'])) $params['status'] = $_GET['status'];
    if (!empty($_GET['month']))  $params['month'] = $_GET['month'];
    if (!empty($_GET['year']))   $params['year'] = $_GET['year'];
    $params = array_merge($params, $extra);
    return http_build_query($params);
}

// --- Consulta PDO para traer citas filtradas ---
// Nota: ajusta nombres de tablas/columnas según tu esquema real.
// Asumimos tablas: citas (c.id, c.fecha DATETIME, c.hora TIME/STRING, c.veterinario, c.estado, c.id_mascota),
// mascota m (m.id, m.nombre, m.id_dueno) y dueno d (d.id_dueno, d.nombre, d.apellido, d.correo)
$sql = "SELECT 
            c.id_cita,
            c.motivo,
            DATE(c.fecha_cita) AS fecha,
            TIME_FORMAT(c.hora_cita, '%H:%i') AS hora,
            COALESCE(m.nombre, '—') AS mascota,
            CONCAT(COALESCE(d.nombre,''), ' ', COALESCE(d.apellido,'')) AS dueno,
            c.id_usuario,
            c.estado
        FROM cita c
        LEFT JOIN mascota m ON c.id_mascota = m.id_mascota
        LEFT JOIN dueno d ON m.id_dueno = d.id_dueno";

$conds = [];
$params = [];

// Filtrado por fecha exacta o por mes/año
if ($date) {
    $conds[] = "DATE(c.fecha_cita) = :date";
    $params[':date'] = $date;
} else {
    $conds[] = "MONTH(c.fecha_cita) = :month AND YEAR(c.fecha_cita) = :year";
    $params[':month'] = $month;
    $params[':year']  = $year;
}

// Estado
if ($status) {
    $conds[] = "c.estado = :status";
    $params[':status'] = $status;
}

// Búsqueda libre (mascota / dueño / veterinario)
if ($q !== '') {
    $conds[] = "(m.nombre LIKE :q OR d.nombre LIKE :q OR d.correo LIKE :q OR c.id_usuario LIKE :q)";
    $params[':q'] = '%' . $q . '%';
}

if (count($conds) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $conds);
}

$sql .= ' ORDER BY c.fecha_cita ASC, c.hora_cita ASC LIMIT 500'; // limita por seguridad

$stmt = $pdo_con->prepare($sql);
$stmt->execute($params);
$list_citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>