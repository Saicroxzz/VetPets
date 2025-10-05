<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestión de Citas - Veterinaria</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4CAF50",
                        "secondary": "#2196F3",
                        "background-light": "#FFFFFF",
                        "background-dark": "#10221c",
                        "text-light": "#333333",
                        "text-dark": "#f6f8f7"
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <header
                class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-700 px-10 py-3">
                <div class="flex items-center gap-4 text-primary">
                    <span class="material-symbols-outlined text-4xl">pets</span>
                    <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-light dark:text-text-dark">
                        Veterinaria</h2>
                </div>
                <div class="flex flex-1 justify-center gap-8">
                    <div class="flex items-center gap-9">
                        <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal"
                            href="#">Pacientes</a>
                        <a class="text-text-light dark:text-text-dark text-sm font-medium leading-normal"
                            href="#">Inventario</a>
                        <a class="text-secondary text-sm font-bold leading-normal" href="#">Citas</a>
                    </div>
                </div>
                <button
                    class="flex items-center justify-center rounded-full h-10 w-10 bg-gray-100 dark:bg-gray-800 text-text-light dark:text-text-dark">
                    <span class="material-symbols-outlined">person</span>
                </button>
            </header>
            <main class="px-4 md:px-10 lg:px-20 py-5">
                <div class="layout-content-container flex flex-col max-w-full flex-1">
                    <div class="flex flex-wrap justify-between gap-4 items-center mb-6">
                        <p
                            class="text-4xl font-black leading-tight tracking-[-0.033em] min-w-72 text-text-light dark:text-text-dark">
                            Gestión de Citas</p>
                        <button
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white gap-2 text-base font-bold leading-normal tracking-[0.015em]">
                            <span class="material-symbols-outlined">add</span>
                            <span class="truncate">Crear Nueva Cita</span>
                        </button>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-8">
                        <div class="w-full lg:w-1/3">
                            <div
                                class="flex flex-col gap-0.5 bg-background-light dark:bg-background-dark p-4 rounded-xl border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between p-1">
                                    <button class="text-text-light dark:text-text-dark">
                                        <span
                                            class="material-symbols-outlined flex size-10 items-center justify-center">chevron_left</span>
                                    </button>
                                    <p
                                        class="text-base font-bold leading-tight text-center text-text-light dark:text-text-dark">
                                        Octubre 2023</p>
                                    <button class="text-text-light dark:text-text-dark">
                                        <span
                                            class="material-symbols-outlined flex size-10 items-center justify-center">chevron_right</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-7">
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        D</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        L</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        M</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        M</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        J</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        V</p>
                                    <p
                                        class="text-[13px] font-bold leading-normal tracking-[0.015em] flex h-12 w-full items-center justify-center pb-0.5 text-text-light dark:text-text-dark">
                                        S</p>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 col-start-1 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">24</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">25</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">26</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">27</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">28</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">29</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">30</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">1</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">2</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">3</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal relative">
                                        <div class="flex size-full items-center justify-center rounded-full">4</div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-secondary">
                                        </div>
                                    </button>
                                    <button class="h-12 w-full text-white text-sm font-medium leading-normal">
                                        <div
                                            class="flex size-full items-center justify-center rounded-full bg-secondary">
                                            5</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal relative">
                                        <div class="flex size-full items-center justify-center rounded-full">6</div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-primary">
                                        </div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">7</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">8</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">9</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">10</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal relative">
                                        <div class="flex size-full items-center justify-center rounded-full">11</div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-yellow-400">
                                        </div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">12</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">13</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">14</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">15</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">16</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">17</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">18</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">19</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">20</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">21</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">22</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">23</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">24</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">25</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal relative">
                                        <div class="flex size-full items-center justify-center rounded-full">26</div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-primary">
                                        </div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-yellow-400 -ml-2">
                                        </div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal relative">
                                        <div class="flex size-full items-center justify-center rounded-full">27</div>
                                        <div
                                            class="absolute bottom-2 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-secondary">
                                        </div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">28</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">29</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">30</div>
                                    </button>
                                    <button
                                        class="h-12 w-full text-text-light dark:text-text-dark text-sm font-medium leading-normal">
                                        <div class="flex size-full items-center justify-center rounded-full">31</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-2/3">
                            <div class="flex flex-col gap-4">
                                <div class="flex flex-wrap items-center gap-4">
                                    <div class="relative flex-1">
                                        <input
                                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50"
                                            placeholder="Buscar por mascota o dueño..." type="text" />
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                                    </div>
                                    <div class="relative">
                                        <select
                                            class="appearance-none w-full h-12 pl-4 pr-10 rounded-lg border border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:outline-none focus:ring-2 focus:ring-primary/50">
                                            <option>Filtrar por estado</option>
                                            <option>Pendiente</option>
                                            <option>Confirmada</option>
                                            <option>Atendida</option>
                                        </select>
                                        <span
                                            class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                                    </div>
                                </div>
                                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                                    <table class="w-full text-left">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Mascota</th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Dueño</th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Fecha</th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Hora</th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Veterinario</th>
                                                <th
                                                    class="px-4 py-3 text-sm font-medium text-text-light dark:text-text-dark">
                                                    Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Buddy
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">John
                                                    Smith</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                    2023-10-26</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">10:00 AM
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Dr. Smith
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Confirmada</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Lucy</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Jane Doe
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                    2023-10-26</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">11:00 AM
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Dr. Jones
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pendiente</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Max</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Peter Pan
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                    2023-10-27</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">02:00 PM
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Dr. Smith
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Atendida</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Daisy
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Mary Jane
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                    2023-10-27</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">03:00 PM
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">Dr. Jones
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Confirmada</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>