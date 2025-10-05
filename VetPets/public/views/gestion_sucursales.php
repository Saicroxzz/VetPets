<!DOCTYPE html>

<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestión de Sucursales - Veterinaria</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4CAF50",
                        "secondary": "#2196F3",
                        "background-light": "#F5F5F5",
                        "background-dark": "#1a1a1a",
                        "text-dark": "#333333",
                        "text-light": "#f0f0f0",
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

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="flex min-h-screen">

        <main class="flex-1 p-6">
            <header class="flex justify-between items-center mb-6">
                <div class="flex min-w-72 flex-col gap-2">
                    <h1 class="text-2xl font-bold">
                        Gestión de Sucursales</h1>
                    <p class="text-base font-normal leading-normal text-gray-500 dark:text-gray-400">Aquí
                        puedes gestionar todas las sucursales de la clínica veterinaria.</p>
                </div>
                <a href="registrar_dueno.php"
                    class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90 transition">
                    Agregar Sucursal
                </a>
            </header>
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-4 py-3">
                <div class="relative w-full md:w-auto md:flex-1 max-w-md">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input
                        class="w-full h-10 pl-10 pr-4 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-secondary focus:outline-none"
                        placeholder="Buscar por nombre o veterinario..." type="text" />
                </div>
                <div
                    class="flex h-10 w-full md:w-auto items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 p-1">
                    <label
                        class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-lg px-3 has-[:checked]:bg-white has-[:checked]:dark:bg-gray-800 has-[:checked]:shadow-sm has-[:checked]:text-secondary text-gray-600 dark:text-gray-400 text-sm font-medium leading-normal gap-2">
                        <span class="material-symbols-outlined text-base">grid_view</span>
                        <span class="truncate">Tarjetas</span>
                        <input checked="" class="invisible w-0" name="view-toggle" type="radio" value="Card View" />
                    </label>
                    <label
                        class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-lg px-3 has-[:checked]:bg-white has-[:checked]:dark:bg-gray-800 has-[:checked]:shadow-sm has-[:checked]:text-secondary text-gray-600 dark:text-gray-400 text-sm font-medium leading-normal gap-2">
                        <span class="material-symbols-outlined text-base">table_rows</span>
                        <span class="truncate">Tabla</span>
                        <input class="invisible w-0" name="view-toggle" type="radio" value="Table View" />
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                <div
                    class="p-0 @container bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="relative">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-xl"
                            data-alt="Image of the Central Branch"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCHgQAygfRGp3u8R6hdXntlmdmXhI8p6aq4YsAHFv1FfoiL4uRA5KbJY0X7kXTjLQJaOH2SIyzuzJkVh9hySYXQ3WUnYyGy4zFp8YS-M1gmrCjryZ8uf-MU7ug_jz3W1WlycQvpGICnKSHYP7nzUhRc2i_MrACf1k5rTTiP2KoUqWKpgDirv9k5DL2oIUmiF5dmQ4l2Q40d2nJMq_PMWRSkNVYse8IIQjBHdtBq0YuHmPonFpgypesL2G76HcZl5f-HHVEC8qmdoCYu");'>
                        </div>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-secondary hover:bg-secondary hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">edit</span></button>
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-red-500 hover:bg-red-500 hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">delete</span></button>
                        </div>
                    </div>
                    <div class="flex flex-col grow p-4 gap-3">
                        <p
                            class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-dark dark:text-text-light">
                            Sucursal Centro</p>
                        <div class="flex flex-col gap-1 text-gray-500 dark:text-gray-400 text-sm">
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">location_on</span>123
                                Main Street, Downtown</p>
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">call</span>Contacto:
                                555-1234</p>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700 my-2" />
                        <p class="text-sm font-semibold text-text-dark dark:text-text-light">Veterinarios
                            Disponibles:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dr.
                                Smith</span>
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dr.
                                Jones</span>
                        </div>
                    </div>
                </div>
                <div
                    class="p-0 @container bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="relative">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-xl"
                            data-alt="Image of the North Veterinary Clinic"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDc5OYTWIEPycadfjz6bAmTInzzqc2hO9G8UXaVcsjujSpuujgwJTJitY0pN1FDihe6Vy7TdY12-j1Yz-9jFcrJz63bV7Z8Qvbfp2HbqghDuro1mQYGmb98GNrGJWUL-4nYdYgZlUxGOxvj46fpFxVUuPxC6vqfDeMKXT4GNIflZT7GVHJIGBo9NZnzGq4CsNgAivZzuChlyYQNAkVS7xEbgOhg5StFvrgyYc8wFUSiDBXitvqtb3Lu6Jaygeky3BbMLik6_h2Uzu55");'>
                        </div>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-secondary hover:bg-secondary hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">edit</span></button>
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-red-500 hover:bg-red-500 hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">delete</span></button>
                        </div>
                    </div>
                    <div class="flex flex-col grow p-4 gap-3">
                        <p
                            class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-dark dark:text-text-light">
                            Clínica Veterinaria del Norte</p>
                        <div class="flex flex-col gap-1 text-gray-500 dark:text-gray-400 text-sm">
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">location_on</span>456
                                Oak Avenue, North District</p>
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">call</span>Contacto:
                                555-5678</p>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700 my-2" />
                        <p class="text-sm font-semibold text-text-dark dark:text-text-light">Veterinarios
                            Disponibles:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dr.
                                Williams</span>
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dr.
                                Brown</span>
                        </div>
                    </div>
                </div>
                <div
                    class="p-0 @container bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="relative">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-t-xl"
                            data-alt="Image of the South Pet Hospital"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiOuTV1yHrkIZwFC_B03qwik99pIiAS9X8nzjQMkJfQRIWZz-dWeyXnY_PUACUOAlBO8WJ8XHbFK1jUPXvxuPLUuU1keJ5uUF6zGWL96XbhidnNluZaX4mHm-y6EDgxd7DlYNbRGnjwVMM3Kln1aR4FEgUYF3ipru6Y_52jEA8yJBwoPktoKnq8pyX3nOGI5KNO3dOLqmYsjC7ncKJhHdTlaoBY6m5qq_t8hocqiY1VPC2FXfWBG02I_5hi1vd56fGyhEg4ruaR-jD");'>
                        </div>
                        <div class="absolute top-2 right-2 flex gap-2">
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-secondary hover:bg-secondary hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">edit</span></button>
                            <button
                                class="bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm p-2 rounded-full text-red-500 hover:bg-red-500 hover:text-white transition-colors"><span
                                    class="material-symbols-outlined">delete</span></button>
                        </div>
                    </div>
                    <div class="flex flex-col grow p-4 gap-3">
                        <p
                            class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-dark dark:text-text-light">
                            Hospital de Mascotas del Sur</p>
                        <div class="flex flex-col gap-1 text-gray-500 dark:text-gray-400 text-sm">
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">location_on</span>789
                                Pine Street, Southside</p>
                            <p class="flex items-center gap-2"><span
                                    class="material-symbols-outlined text-base text-secondary">call</span>Contacto:
                                555-9012</p>
                        </div>
                        <hr class="border-gray-200 dark:border-gray-700 my-2" />
                        <p class="text-sm font-semibold text-text-dark dark:text-text-light">Veterinarios
                            Disponibles:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dra.
                                Davis</span>
                            <span class="bg-primary/20 text-primary text-xs font-semibold px-2.5 py-1 rounded-full">Dr.
                                Miller</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Empty state example -->
            <!--
            <div class="flex flex-col items-center justify-center text-center p-16 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl mt-8">
                <span class="material-symbols-outlined text-6xl text-gray-400 dark:text-gray-500">store</span>
                <h3 class="text-2xl font-bold mt-4 text-text-dark dark:text-text-light">No hay sucursales todavía</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">¡Comienza agregando tu primera sucursal para administrarla desde aquí!</p>
                <button class="flex mt-6 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                    <span class="truncate">Agregar la primera sucursal</span>
                </button>
            </div>
            -->
        </main>
    </div>
</body>

</html>