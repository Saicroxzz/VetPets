<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Veterinary Platform - Pet Management</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4CAF50",
                        "secondary": "#2196F3",
                        "background-light": "#F4F7F6",
                        "background-dark": "#10221c",
                        "text-light": "#333333",
                        "text-dark": "#F4F7F6"
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col max-w-6xl flex-1 px-4 sm:px-6 lg:px-8">
                    <header
                        class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-4 py-3">
                        <div class="flex items-center gap-4 text-text-light dark:text-text-dark">
                            <div class="size-8 text-primary">
                                <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6_330)">
                                        <path clip-rule="evenodd"
                                            d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z"
                                            fill="currentColor" fill-rule="evenodd"></path>
                                    </g>
                                    <defs>
                                        <clippath id="clip0_6_330">
                                            <rect fill="white" height="48" width="48"></rect>
                                        </clippath>
                                    </defs>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold leading-tight tracking-[-0.015em]">Veterinary Platform</h2>
                        </div>
                        <div class="flex flex-1 justify-end gap-8 items-center">
                            <div class="hidden md:flex items-center gap-9">
                                <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                                    href="#">Dashboard</a>
                                <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                                    href="#">Citas</a>
                                <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary"
                                    href="#">Clientes</a>
                            </div>
                            <button
                                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                                <span class="truncate">Registrar Nueva Mascota</span>
                            </button>
                        </div>
                    </header>
                    <main class="flex-grow mt-8">
                        <div class="flex flex-wrap justify-between items-center gap-4 px-4 py-3">
                            <h1 class="text-4xl font-black leading-tight tracking-[-0.033em]">Gestión de Mascotas</h1>
                        </div>
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
                                        $stmt = $conn->prepare("
    SELECT m.id, m.nombre, m.especie, m.raza, m.edad, d.nombre AS dueno, m.foto
    FROM mascotas m
    JOIN duenos d ON m.id_dueno = d.id
    ORDER BY m.id DESC
");
                                        $stmt->execute();
                                        $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        if ($mascotas):
                                            foreach ($mascotas as $mascota): ?>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                                    <td class="h-[72px] px-4 py-2 w-20">
                                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10"
                                                            style="background-image: url('<?= htmlspecialchars($mascota['foto']) ?>');">
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2"><?= htmlspecialchars($mascota['nombre']) ?></td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                        <?= htmlspecialchars($mascota['especie']) ?></td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                        <?= htmlspecialchars($mascota['raza']) ?></td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                        <?= htmlspecialchars($mascota['edad']) ?> años</td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                        <?= htmlspecialchars($mascota['dueno']) ?></td>
                                                    <td class="px-4 py-2 w-32">
                                                        <div class="flex items-center gap-2">
                                                            <a href="editar_mascota.php?id=<?= $mascota['id'] ?>"
                                                                class="text-secondary hover:text-secondary/80">
                                                                <span class="material-symbols-outlined">edit</span>
                                                            </a>
                                                            <a href="eliminar_mascota.php?id=<?= $mascota['id'] ?>"
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
            </div>
        </div>
    </div>
</body>

</html>