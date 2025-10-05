<!DOCTYPE html>
<html lang="es" class="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VetCare Clinic - Dashboard</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#4CAF50",
            secondary: "#2196F3",
            "background-light": "#F5F5F5",
            "background-dark": "#1a1a1a",
          },
          fontFamily: {
            display: ["Manrope", "sans-serif"],
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
<body class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100">
<div class="flex min-h-screen">

  <!-- Sidebar -->
  <aside class="hidden md:flex flex-col w-64 bg-white dark:bg-gray-800 shadow-md">
    <div class="flex items-center justify-center h-20 border-b dark:border-gray-700">
      <div class="flex items-center gap-3">
        <div class="bg-primary p-2 rounded-full text-white">
          <span class="material-symbols-outlined">pets</span>
        </div>
        <h1 class="text-xl font-bold">VetCare</h1>
      </div>
    </div>
    <nav class="flex-1 px-4 py-6">
      <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" href="#">
        <span class="material-symbols-outlined text-secondary">group</span>
        Dueños
      </a>
      <a class="flex items-center gap-3 px-4 py-3 mt-2 bg-primary text-white rounded-lg shadow" href="#">
        <span class="material-symbols-outlined">favorite</span>
        Mascotas
      </a>
      <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition" href="#">
        <span class="material-symbols-outlined text-secondary">calendar_month</span>
        Citas
      </a>
      <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition" href="#">
        <span class="material-symbols-outlined text-secondary">location_on</span>
        Sucursales
      </a>
      <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition" href="#">
        <span class="material-symbols-outlined text-secondary">settings</span>
        Configuración
      </a>
    </nav>
  </aside>

  <!-- Main -->
  <main class="flex-1 p-6 md:p-10">
    <!-- Topbar -->
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-3xl font-bold">Resumen General</h2>
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Buscar..." class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:outline-none">
        <button class="bg-secondary text-white px-3 py-2 rounded-lg">Modo oscuro</button>
        <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600"></div>
      </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <p class="text-lg text-gray-500">Mascotas Registradas</p>
        <p class="text-4xl font-bold mt-2">1,250</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <p class="text-lg text-gray-500">Citas Próximas</p>
        <p class="text-4xl font-bold mt-2">15</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <p class="text-lg text-gray-500">Sucursales Activas</p>
        <p class="text-4xl font-bold mt-2">3</p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <p class="text-lg text-gray-500">Nuevos Clientes</p>
        <p class="text-4xl font-bold mt-2">42</p>
      </div>
    </div>

    <!-- Example tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Ultimas citas -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h3 class="text-xl font-semibold mb-4">Próximas citas</h3>
        <ul class="divide-y dark:divide-gray-700">
          <li class="py-3 flex justify-between"><span>Max (Canino)</span><span>05/10 10:30 AM</span></li>
          <li class="py-3 flex justify-between"><span>Luna (Felino)</span><span>05/10 11:00 AM</span></li>
          <li class="py-3 flex justify-between"><span>Toby (Canino)</span><span>05/10 12:15 PM</span></li>
        </ul>
      </div>

      <!-- Mascotas recientes -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h3 class="text-xl font-semibold mb-4">Nuevas mascotas</h3>
        <ul class="divide-y dark:divide-gray-700">
          <li class="py-3 flex justify-between"><span>Rocky</span><span>Canino</span></li>
          <li class="py-3 flex justify-between"><span>Michu</span><span>Felino</span></li>
          <li class="py-3 flex justify-between"><span>Polly</span><span>Ave</span></li>
        </ul>
      </div>
    </div>

  </main>
</div>
</body>
</html>