<?php
include '../../../config/config.php';
?>
<div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 sm:px-6 lg:px-8">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestión de Dueños</h1>
        <a href="registrar_mascota.php"
            class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90 transition">
            Registrar Nueva Mascota
        </a>
    </header>
    <main class="flex-grow mt-8">
        <div class="px-4 py-3">
            <label class="flex flex-col min-w-40 h-12 w-full">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                    <div
                        class="text-gray-500 dark:text-gray-400 flex border-none bg-white dark:bg-background-dark items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark focus:border-primary h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                        placeholder="Buscar por nombre de mascota o filtrar por especie" value="" />
                </div>
            </label>
        </div>
        <div class="px-4 py-3 @container">
            <div
                class="flex overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/20">
                <table class="flex-1">
                    <thead class="bg-secondary/10 dark:bg-secondary/20">
                        <tr>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-20 text-secondary dark:text-secondary/80">
                                Foto</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-[20%] text-secondary dark:text-secondary/80">
                                Nombre</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-[20%] text-secondary dark:text-secondary/80">
                                Especie</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-[20%] text-secondary dark:text-secondary/80">
                                Raza</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-[10%] text-secondary dark:text-secondary/80">
                                Edad</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-[20%] text-secondary dark:text-secondary/80">
                                Dueño</th>
                            <th
                                class="px-4 py-3 text-left text-sm font-medium leading-normal w-32 text-secondary dark:text-secondary/80">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php
                        $stmt = $pdo_con->prepare("
    SELECT m.id_mascota, m.nombre, m.especie, m.raza, m.edad, m.sexo, m.id_dueno, m.id_sede, d.nombre AS dueno
    FROM mascota m
    JOIN dueno d ON m.id_dueno = d.id_dueno
    ORDER BY m.id_mascota DESC
");
                        $stmt->execute();
                        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($mascotas):
                            foreach ($mascotas as $mascota): ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="h-[72px] px-4 py-2 w-20">
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10"
                                            style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/2/23/Dog_retrieving_stick.jpg');">
                                        </div>
                                    </td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($mascota['nombre']) ?></td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                        <?= htmlspecialchars($mascota['especie']) ?>
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                        <?= htmlspecialchars($mascota['raza']) ?>
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                        <?= htmlspecialchars($mascota['edad']) ?> años
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                        <?= htmlspecialchars($mascota['dueno']) ?>
                                    </td>
                                    <td class="px-4 py-2 w-32">
                                        <div class="flex items-center gap-2">
                                            <a href="editar_mascota.php?id=<?= $mascota['id_mascota'] ?>"
                                                class="text-secondary hover:text-secondary/80">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                            <a href="eliminar_mascota.php?id=<?= $mascota['id_mascota'] ?>"
                                                class="text-red-500 hover:text-red-400">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">No hay mascotas
                                    registradas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="flex items-center justify-center p-4">
            <a class="flex size-10 items-center justify-center text-text-light dark:text-text-dark hover:text-primary"
                href="#">
                <span class="material-symbols-outlined">chevron_left</span>
            </a>
            <a class="text-sm font-bold leading-normal tracking-[0.015em] flex size-10 items-center justify-center rounded-full bg-primary/20 text-primary"
                href="#">1</a>
            <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center rounded-full hover:bg-primary/10 text-text-light dark:text-text-dark"
                href="#">2</a>
            <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center rounded-full hover:bg-primary/10 text-text-light dark:text-text-dark"
                href="#">3</a>
            <span
                class="text-sm font-normal leading-normal flex size-10 items-center justify-center rounded-full text-text-light dark:text-text-dark">...</span>
            <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center rounded-full hover:bg-primary/10 text-text-light dark:text-text-dark"
                href="#">10</a>
            <a class="flex size-10 items-center justify-center text-text-light dark:text-text-dark hover:text-primary"
                href="#">
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
    </main>
</div>