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
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- CONTENIDO (fragmento, sin <html> ni <head>) -->

<div class="min-w-0 w-full">

  <!-- Header -->

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestión de Citas</h1>
    <a href="#" data-page="registro_cita.php"
       class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90 transition">
      Registrar Nueva Cita
    </a>
  </div>

  <div class="flex flex-col lg:flex-row gap-8">

```
<!-- Calendario (columna izquierda) -->
<div class="w-full lg:w-1/3">
  <div class="flex flex-col gap-2 bg-background-light dark:bg-background-dark p-4 rounded-xl border border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between">
      <!-- Navegación mes anterior/next: usan fetch inline para recargar el fragmento con month/year -->
      <a href="#" class="px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
         onclick="(function(){ fetch('gestion_citas.php?<?= keepParams(['month'=>$prev->format('n'),'year'=>$prev->format('Y')]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()">
        <span class="material-symbols-outlined">chevron_left</span>
      </a>

      <div class="font-bold"><?= htmlspecialchars($firstOfMonth->format('F Y'), ENT_QUOTES, 'UTF-8') ?></div>

      <a href="#" class="px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
         onclick="(function(){ fetch('gestion_citas.php?<?= keepParams(['month'=>$next->format('n'),'year'=>$next->format('Y')]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()">
        <span class="material-symbols-outlined">chevron_right</span>
      </a>
    </div>

    <!-- Encabezados semana (L M M J V S D) -->
    <div class="grid grid-cols-7 text-center text-xs font-semibold text-gray-600 mt-3">
      <div>L</div><div>M</div><div>M</div><div>J</div><div>V</div><div>S</div><div>D</div>
    </div>

    <!-- Días -->
    <div class="grid grid-cols-7 gap-1 mt-2">
      <?php
      // Rellenar huecos antes del primer día si firstWeekday > 1 (Lun=1)
      $pad = ($firstWeekday === 7) ? 0 : $firstWeekday - 1; // adaptamos para L..D
      for ($i = 0; $i < $pad; $i++): ?>
        <div class="h-10"></div>
      <?php endfor; ?>

      <?php for ($d = 1; $d <= $daysInMonth; $d++):
          $ymd = sprintf('%04d-%02d-%02d', $year, $month, $d);
          // construir href manteniendo otros params
          $href = 'gestion_citas.php?' . keepParams(['date'=>$ymd, 'month'=>$month, 'year'=>$year]);
      ?>
        <button
          class="h-10 w-full rounded-full flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm"
          onclick="(function(){ fetch('<?= htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()">
          <?= $d ?>
        </button>
      <?php endfor; ?>
    </div>
  </div>
</div>

<!-- Lista / controles (columna derecha) -->
<div class="w-full lg:w-2/3 flex flex-col gap-4">

  <!-- Controles: búsqueda y filtros (usamos botones/anchors con fetch inline para preservar SPA) -->
  <div class="flex flex-wrap items-center gap-3">
    <div class="relative flex-1">
      <input id="citas-search" value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?>"
             class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50"
             placeholder="Buscar por mascota, dueño o veterinario..." type="text" />
      <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
    </div>

    <!-- Botón buscar: construye query usando valor del input -->
    <button onclick="(function(){
        var q = encodeURIComponent(document.getElementById('citas-search').value || '');
        var status = '<?= rawurlencode($status) ?>';
        var base = 'gestion_citas.php?<?= keepParams() ?>';
        // eliminamos q previo si existe
        var sep = base.indexOf('?') === -1 ? '?' : '&';
        var url = 'gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year]) ?>' + (q ? '&q='+q : '');
        if (status) url += '&status=' + encodeURIComponent(status);
        fetch(url).then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;});
    })()" class="h-12 px-4 rounded-lg bg-secondary text-white font-semibold">Buscar</button>

    <!-- Filtros por estado: usamos anchors con fetch inline -->
    <div class="ml-auto flex items-center gap-2">
      <a href="#" onclick="(function(){ fetch('gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year,'status'=>'']) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()"
         class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition <?= $status==='' ? 'font-bold' : '' ?>">Todos</a>
      <?php foreach ($allowedStatuses as $st): ?>
        <a href="#" onclick="(function(){ fetch('gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year,'status'=>rawurlencode($st)]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()"
           class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition <?= $status===$st ? 'font-bold' : '' ?>"><?= htmlspecialchars($st) ?></a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Tabla de citas -->
  <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
    <table class="w-full table-fixed min-w-[640px] text-left">
      <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
          <th class="px-4 py-3 text-sm font-medium">Mascota</th>
          <th class="px-4 py-3 text-sm font-medium">Dueño</th>
          <th class="px-4 py-3 text-sm font-medium">Fecha</th>
          <th class="px-4 py-3 text-sm font-medium">Hora</th>
          <th class="px-4 py-3 text-sm font-medium">Veterinario</th>
          <th class="px-4 py-3 text-sm font-medium">Estado</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php if (count($citas) > 0): ?>
          <?php foreach ($citas as $c): ?>
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
              <td class="px-4 py-3 text-sm truncate max-w-[160px]"><?= htmlspecialchars($c['mascota']) ?></td>
              <td class="px-4 py-3 text-sm truncate max-w-[160px]"><?= htmlspecialchars($c['dueno']) ?></td>
              <td class="px-4 py-3 text-sm"><?= htmlspecialchars($c['fecha']) ?></td>
              <td class="px-4 py-3 text-sm"><?= htmlspecialchars($c['hora']) ?></td>
              <td class="px-4 py-3 text-sm"><?= htmlspecialchars($c['id_usuario']) ?></td>
              <td class="px-4 py-3 text-sm">
                <?php
                  $badge = 'bg-gray-100 text-gray-800';
                  if ($c['estado'] === 'Confirmada') $badge = 'bg-green-100 text-green-800';
                  if ($c['estado'] === 'Pendiente')  $badge = 'bg-yellow-100 text-yellow-800';
                  if ($c['estado'] === 'Atendida')   $badge = 'bg-blue-100 text-blue-800';
                ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badge ?>">
                  <?= htmlspecialchars($c['estado']) ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
              No hay citas para los filtros seleccionados.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>

  </div>
</div>
