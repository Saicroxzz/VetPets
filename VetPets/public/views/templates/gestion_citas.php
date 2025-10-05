<?php
include '../../citas/getCitas.php';
$citas = $list_citas; 
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


<!-- Calendario (columna izquierda) -->
<div class="w-full lg:w-1/3">
  <div class="flex flex-col gap-2 bg-background-light dark:bg-background-dark p-4 rounded-xl border border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between">
      <!-- Navegación mes anterior/next: usan fetch inline para recargar el fragmento con month/year -->
      <a href="#" class="px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
         onclick="(function(){ fetch('templates/gestion_citas.php?<?= keepParams(['month'=>$prev->format('n'),'year'=>$prev->format('Y')]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()">
        <span class="material-symbols-outlined">chevron_left</span>
      </a>

      <div class="font-bold"><?= htmlspecialchars($firstOfMonth->format('F Y'), ENT_QUOTES, 'UTF-8') ?></div>

      <a href="#" class="px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700"
         onclick="(function(){ fetch('templates/gestion_citas.php?<?= keepParams(['month'=>$next->format('n'),'year'=>$next->format('Y')]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()">
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
          $href = 'templates/gestion_citas.php?' . keepParams(['date'=>$ymd, 'month'=>$month, 'year'=>$year]);
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
        var base = 'templates/gestion_citas.php?<?= keepParams() ?>';
        // eliminamos q previo si existe
        var sep = base.indexOf('?') === -1 ? '?' : '&';
        var url = 'templates/gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year]) ?>' + (q ? '&q='+q : '');
        if (status) url += '&status=' + encodeURIComponent(status);
        fetch(url).then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;});
    })()" class="h-12 px-4 rounded-lg bg-secondary text-white font-semibold">Buscar</button>

    <!-- Filtros por estado: usamos anchors con fetch inline -->
    <div class="ml-auto flex items-center gap-2">
      <a href="#" onclick="(function(){ fetch('templates/gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year,'status'=>'']) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()"
         class="px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition <?= $status==='' ? 'font-bold' : '' ?>">Todos</a>
      <?php foreach ($allowedStatuses as $st): ?>
        <a href="#" onclick="(function(){ fetch('templates/gestion_citas.php?<?= keepParams(['month'=>$month,'year'=>$year,'status'=>rawurlencode($st)]) ?>').then(r=>r.text()).then(h=>{document.getElementById('main-content').innerHTML=h;}); return false; })()"
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
