<?php
// ✅ Verificación de sesión al cargar el dashboard
session_start();
if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es" class="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VetPets Dashboard</title>
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
        'opsz' 24;
    }

    /* 🐶 GIF fijo visible pero sin bloquear clics */
    .gif-footer-fixed {
      width: 290px;
      height: auto;
      position: fixed;
      left: 30px;
      bottom: 20px;
      pointer-events: none;
      z-index: 50;
    }
  </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100">

  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col w-64 bg-white dark:bg-gray-800 shadow-md relative z-10">
      <div class="flex items-center justify-center h-20 border-b dark:border-gray-700">
        <div class="flex items-center gap-4 text-primary">
          <span class="material-symbols-outlined text-4xl">pets</span>
          <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-light dark:text-text-dark">
            VetPets
          </h2>
        </div>
      </div>

      <nav class="flex-1 px-4 py-6 flex flex-col">
        <a href="#" data-page="templates/gestion_duenos.php"
          class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">group</span>
          Dueños
        </a>

        <a href="#" data-page="templates/gestion_mascotas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">favorite</span>
          Mascotas
        </a>

        <a href="#" data-page="templates/gestion_citas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">calendar_month</span>
          Citas
        </a>

        <a href="#" data-page="templates/gestion_sucursales.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">location_on</span>
          Sucursales
        </a>

        <!-- 🔹 Botón de Cerrar sesión -->
        <a href="#" id="logout-btn"
          class="flex items-center gap-3 px-4 py-3 mt-6 rounded-lg text-red-600 font-semibold hover:bg-red-100 dark:hover:bg-red-900 transition">
          <span class="material-symbols-outlined">logout</span>
          Cerrar sesión
        </a>

      </nav>
    </aside>

    <!-- Main content -->
    <main id="main-content" class="flex-1 min-w-0 p-6 md:p-10">
      <!-- Aquí se cargará dinámicamente el contenido -->
    </main>
  </div>

  <!-- 🐶 GIF decorativo -->
  <footer>
    <img src="../../resources/dog.gif" alt="Perrito feliz" class="gif-footer-fixed">
  </footer>
<!DOCTYPE html>
<html lang="es" class="light">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VetPets Dashboard</title>
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
        'opsz' 24;
    }

    /* 🐶 GIF fijo y sin bloquear clics */
    .gif-footer-fixed {
      width: 290px;
      height: auto;
      position: fixed;
      left: 30px;
      bottom: 20px;
      pointer-events: none;
      z-index: 50;
    }
  </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-100">
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col w-64 bg-white dark:bg-gray-800 shadow-md relative z-10">
      <div class="flex items-center justify-center h-20 border-b dark:border-gray-700">
        <div class="flex items-center gap-4 text-primary">
          <span class="material-symbols-outlined text-4xl">pets</span>
          <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-light dark:text-text-dark">
            VetPets
          </h2>
        </div>
      </div>

      <nav class="flex-1 px-4 py-6 flex flex-col">
        <a href="#" data-page="templates/gestion_duenos.php"
          class="menu-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">group</span>
          Dueños
        </a>

        <a href="#" data-page="templates/gestion_mascotas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">favorite</span>
          Mascotas
        </a>

        <a href="#" data-page="templates/gestion_citas.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">calendar_month</span>
          Citas
        </a>

        <a href="#" data-page="templates/gestion_sucursales.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">location_on</span>
          Sucursales
        </a>

        <!-- 🔹 Botón de Cerrar sesión (debajo de sucursales) -->
        <a href="#" id="logout-btn"
          class="flex items-center gap-3 px-4 py-3 mt-6 rounded-lg text-red-600 font-semibold hover:bg-red-100 dark:hover:bg-red-900 transition">
          <span class="material-symbols-outlined">logout</span>
          Cerrar sesión
        </a>

      </nav>
    </aside>

    <!-- Main -->
    <main id="main-content" class="flex-1 min-w-0 p-6 md:p-10">
      <!-- Aquí se cargará dinámicamente el contenido -->
    </main>
  </div>

  <!-- Script principal -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const mainContent = document.getElementById("main-content");

      // Función para cargar contenido de las páginas
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

      // Cargar contenido cuando se hace clic en el menú
      document.addEventListener("click", function (e) {
        const link = e.target.closest("a[data-page]");
        if (link) {
          e.preventDefault();
          const page = link.getAttribute("data-page");
          loadPage(page);
        }
      });

      // ✅ Cerrar sesión correctamente
      const logoutBtn = document.getElementById("logout-btn");
      logoutBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        try {
          const res = await fetch("templates/logout_temp.php", { method: "POST" });
          const data = await res.json();
          if (data.status === "success") {
            window.location.href = "login.php"; // 🔹 redirige al login (misma carpeta)
          } else {
            alert("Error al cerrar sesión");
          }
        } catch (err) {
          console.error("Error al cerrar sesión:", err);
        }
      });

      // Cargar por defecto la primera sección
      loadPage("templates/gestion_duenos.php");
    });
  </script>

  <!-- 🐾 GIF -->
  <footer>
    <img src="../../resources/dog.gif" alt="Perrito feliz" class="gif-footer-fixed">
  </footer>

</body>

</html>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const mainContent = document.getElementById("main-content");

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

      document.addEventListener("click", function (e) {
        const link = e.target.closest("a[data-page]");
        if (link) {
          e.preventDefault();
          const page = link.getAttribute("data-page");
          loadPage(page);
        }
      });

      // ✅ Botón cerrar sesión
      const logoutBtn = document.getElementById("logout-btn");
      logoutBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        try {
          await fetch("../../../config/auth.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ logout: true })
          });

          // Redirigir al login después de cerrar sesión
          window.location.href = "../login.php";
        } catch (error) {
          console.error("Error al cerrar sesión:", error);
        }
      });

      // Cargar sección por defecto
      loadPage("templates/gestion_duenos.php");
    });
  </script>
</body>
</html>
