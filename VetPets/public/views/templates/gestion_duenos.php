<?php
// Ejemplo de conexión (ajusta a tu config real)
include '../../../config/config.php';

// Traer todos los dueños
$stmt = $pdo_con->prepare("SELECT id_dueno, nombre, apellido, correo, telefono, direccion, id_sede FROM dueno ORDER BY id_dueno DESC");
$stmt->execute();
$duenos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">


<header class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestión de Dueños</h1>
    <a href="#" data-page="templates/registro_dueno.php"
        class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90 transition">
        Registrar Nuevo Dueño
    </a>
</header>

<!-- Buscador -->
<form method="GET" action="" class="mb-4">
    <input type="text" name="buscar" placeholder="Buscar dueño por nombre o correo"
        class="w-full px-4 py-2 rounded-lg border dark:border-gray-700 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
</form>

<!-- Tabla -->
<div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Correo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Teléfono</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php if (count($duenos) > 0): ?>
                    <?php foreach ($duenos as $dueno): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 whitespace-normal break-words"><?= htmlspecialchars($dueno['nombre']) ?></td>
                            <td class="px-6 py-4 whitespace-normal break-words"><?= htmlspecialchars($dueno['correo']) ?></td>
                            <td class="px-6 py-4 whitespace-normal break-words"><?= htmlspecialchars($dueno['telefono']) ?></td>
                            <td class="px-6 py-4 whitespace-normal break-words text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="#"
                                        onclick="openEditDuenoModal(<?= $dueno['id_dueno'] ?>, '<?= htmlspecialchars($dueno['nombre']) ?>', '<?= htmlspecialchars($dueno['apellido']) ?>', '<?= htmlspecialchars($dueno['correo']) ?>', '<?= htmlspecialchars($dueno['telefono']) ?>', '<?= htmlspecialchars($dueno['direccion']) ?>', <?= $dueno['id_sede'] ?>)"
                                        class="text-blue-500 hover:text-blue-400 btn-editar-dueno">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>

                                    <a href="#" class="text-red-500 hover:text-red-400 btn-eliminar-dueno"
                                        onclick="deleteDueno(<?= $dueno['id_dueno'] ?>, '<?= htmlspecialchars($dueno['nombre']) ?>')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Aún no hay dueños registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Editar Dueño -->
<div id="modal-edit-dueno" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Editar Dueño</h2>
        <div id="form-edit-dueno" class="space-y-4">
            <input type="hidden" id="edit_id_dueno" name="id_dueno">

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="edit_nombre" name="nombre" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" id="edit_apellido" name="apellido"
                    class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" id="edit_correo" name="correo"
                    class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" id="edit_telefono" name="telefono"
                    class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" id="edit_direccion" name="direccion"
                    class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Sede</label>
                <select id="edit_id_sede" name="id_sede" class="mt-1 block w-full border rounded-md px-3 py-2">
                    <?php
                    $query = $pdo_con->query("SELECT id_sede, nombre_sede FROM sede ORDER BY nombre_sede ASC");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id_sede']}'>{$row['nombre_sede']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="button" onclick="closeEditDuenoModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
                <button type="button" onclick="helperEditDueno()"
                    class="px-4 py-2 bg-primary text-white rounded hover:bg-primary/90">Guardar</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>