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
        <div class="flex items-center gap-4 text-primary">
                    <span class="material-symbols-outlined text-4xl">pets</span>
                    <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-light dark:text-text-dark">
                        VetPets</h2>
                </div>
      </div>
      <nav class="flex-1 px-4 py-6">
        <a href="#" data-page="gestion_duenos.php"
          class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">group</span>
          Dueños
        </a>
        <a href="#" data-page="gestion_mascotas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">favorite</span>
          Mascotas
        </a>
        <a href="#" data-page="gestion_citas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">calendar_month</span>
          Citas
        </a>
        <a href="#" data-page="gestion_sucursales.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">location_on</span>
          Sucursales
        </a>
      </nav>
    </aside>

    <!-- Main -->
    <main id="main-content" class="flex-1 p-6 md:p-10">
      <!-- Aquí se cargará dinámicamente el contenido -->
    </main>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const mainContent = document.getElementById("main-content");
      const links = document.querySelectorAll(".menu-link");

      // Función para cargar contenido
      function loadPage(page) {
        fetch(page)
          .then(res => res.text())
          .then(data => {
            mainContent.innerHTML = data;
          })
          .catch(err => {
            mainContent.innerHTML = "<p class='text-red-500'>Error al cargar la página.</p>";
            console.error(err);
          });
      }

      // Listeners para cada link
      links.forEach(link => {
        link.addEventListener("click", (e) => {
          e.preventDefault();
          const page = link.getAttribute("data-page");
          loadPage(page);
        });
      });

      // Cargar por defecto la primera sección (ej: Dueños)
      loadPage("gestion_duenos.php");
    });
  </script>

</body>

</html>