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
                                    <a href="editar_dueno.php?id=<?= $dueno['id_dueno'] ?>" class="text-blue-500 hover:text-blue-400">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="eliminar_dueno.php?id=<?= $dueno['id_dueno'] ?>"
                                        onclick="return confirm('¿Seguro que deseas eliminar este dueño?')"
                                        class="text-red-500 hover:text-red-400">
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

</body>

</html>