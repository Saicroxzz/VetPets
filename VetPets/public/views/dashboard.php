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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      height: auto;
      position: fixed;
      left: 0px;
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

        <!-- <a href="#" data-page="templates/gestion_sucursales.php"
          class="menu-link flex items-center gap-3 px-4 py-3 mt-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <span class="material-symbols-outlined text-secondary">location_on</span>
          Sucursales
        </a> -->

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

    const mainContent = document.getElementById("main-content");

    loadPage("templates/gestion_duenos.php");

    // Cargar contenido cuando se hace clic en el menú
    function loadPage(page) {
      fetch(page)
        .then(res => res.text())
        .then(data => {
          mainContent.innerHTML = data;

          //initializers javascript for includes regist
          if (page === "templates/registro_dueno.php") {
            initRegistrarDueno();
          }

          if (page === "templates/registro_mascota.php") {
            initRegistrarMascota();
          }

          if (page === "templates/registro_cita.php") {
            initRegistrarCita();
          }

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


    function initRegistrarDueno() {
      const form = document.getElementById("form-dueno");
      if (!form) return;

      form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const nombre = document.getElementById("nombre").value.trim();
        const apellido = document.getElementById("apellido").value.trim();
        const cedula = document.getElementById("cedula").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const telefono = document.getElementById("telefono").value.trim();
        const direccion = document.getElementById("direccion").value.trim();

        // Validaciones básicas
        if (!cedula || !nombre || !apellido || !correo || !telefono || !direccion) {
          Swal.fire("Error", "Todos los campos son obligatorios", "error");
          return;
        }

        if (cedula.length < 10) {
          Swal.fire("Error", "La cédula debe tener al menos 10 caracteres", "error");
          return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
          Swal.fire("Error", "El correo electrónico no es válido", "error");
          return;
        }

        const phoneRegex = /^\+?[0-9\s-]{7,15}$/;
        if (!phoneRegex.test(telefono)) {
          Swal.fire("Error", "El número de teléfono no es válido", "error");
          return;
        }
        var id_sede = 1;

        try {
          const response = await fetch("../duenos/add.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ cedula, nombre, apellido, correo, telefono, direccion, id_sede })
          });

          const result = await response.json();

          if (result.success) {
            Swal.fire("Éxito", result.message, "success").then(() => {
              loadPage("templates/gestion_duenos.php");
            });
          } else {
            Swal.fire("Error", result.message || "Hubo un problema", "error");
          }
        } catch (error) {
          Swal.fire("Error", "No se pudo conectar con el servidor", "error");
          console.error("Error al enviar el formulario:", error);
        }
      });
    }


    function initRegistrarMascota() {
      const form = document.getElementById("form-mascota");
      if (!form) return;

      form.addEventListener("submit", async function (e) {
        e.preventDefault();

        // Obtener valores
        const nombre = document.getElementById("nombre").value.trim();
        const especie = document.getElementById("especie").value.trim();
        const raza = document.getElementById("raza").value.trim();
        const edad = document.getElementById("edad").value.trim();
        const sexo = document.getElementById("sexo").value.trim();
        const id_dueno = document.getElementById("id_dueno").value.trim();
        const id_sede = document.getElementById("id_sede").value.trim();

        // Validaciones
        if (!nombre || !especie || !raza || !edad || !sexo || !id_dueno || !id_sede) {
          Swal.fire("Error", "Todos los campos son obligatorios", "error");
          return;
        }

        if (parseInt(edad) < 0 || isNaN(parseInt(edad))) {
          Swal.fire("Error", "La edad debe ser un número válido mayor o igual a 0", "error");
          return;
        }

        try {
          const response = await fetch("../mascotas/add.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ nombre, especie, raza, edad, sexo, id_dueno, id_sede })
          });

          const result = await response.json();

          if (result.success) {
            Swal.fire("Éxito", result.message, "success").then(() => {
              loadPage("templates/gestion_mascotas.php");
            });
          } else {
            Swal.fire("Error", result.message || "Hubo un problema", "error");
          }
        } catch (error) {
          Swal.fire("Error", "No se pudo conectar con el servidor", "error");
          console.error("Error al enviar el formulario:", error);
        }
      });
    }

    function initRegistrarCita() {
      const form = document.getElementById("form-cita");
      if (!form) return;

      form.addEventListener("submit", async function (e) {
        e.preventDefault();

        // Obtener valores
        const fecha_cita = document.getElementById("fecha_cita_nc").value.trim();
        const hora_cita = document.getElementById("hora_cita_nc").value.trim();
        const motivo = document.getElementById("motivo_nc").value.trim();
        const estado = document.getElementById("estado_nc").value.trim();
        const id_mascota = document.getElementById("id_mascota_nc").value.trim();
        const id_dueno = document.getElementById("id_dueno_nc").value.trim();
        const id_usuario = document.getElementById("id_usuario_nc").value.trim();
        const id_sede = document.getElementById("id_sede_nc").value.trim();

        // Validaciones
        if (!fecha_cita || !hora_cita || !motivo || !estado || !id_mascota || !id_dueno || !id_usuario || !id_sede) {
          Swal.fire("Error", "Todos los campos son obligatorios", "error");
          return;
        }

        // Validar que fecha+hora formen una fecha válida
        const dateTimeStr = `${fecha_cita}T${hora_cita}`;
        if (isNaN(Date.parse(dateTimeStr))) {
          Swal.fire("Error", "La fecha o la hora no son válidas", "error");
          return;
        }

        try {
          const response = await fetch("../citas/add.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              fecha_cita,
              hora_cita,
              motivo,
              estado,
              id_mascota,
              id_dueno,
              id_usuario,
              id_sede
            })
          });

          const result = await response.json();

          if (result.success) {
            Swal.fire("Éxito", result.message, "success").then(() => {
              loadPage("templates/gestion_citas.php");
            });
          } else {
            Swal.fire("Error", result.message || "Hubo un problema", "error");
          }
        } catch (error) {
          Swal.fire("Error", "No se pudo conectar con el servidor", "error");
          console.error("Error al enviar el formulario:", error);
        }
      });
    }
  </script>
  <script>

    function openEditDuenoModal(id, nombre, apellido, correo, telefono, direccion, id_sede) {
      document.getElementById("modal-edit-dueno").classList.remove("hidden");
      document.getElementById("modal-edit-dueno").classList.add("flex");

      document.getElementById("edit_id_dueno").value = id;
      document.getElementById("edit_nombre").value = nombre;
      document.getElementById("edit_apellido").value = apellido;
      document.getElementById("edit_correo").value = correo;
      document.getElementById("edit_telefono").value = telefono;
      document.getElementById("edit_direccion").value = direccion;
      document.getElementById("edit_id_sede").value = id_sede;
    }

    function closeEditDuenoModal() {
      document.getElementById("modal-edit-dueno").classList.add("hidden");
      document.getElementById("modal-edit-dueno").classList.remove("flex");
    }

    async function helperEditDueno() {
      const formCita = document.getElementById("form-edit-dueno");

      formCita.addEventListener("submit", async (e) => {
        e.preventDefault();
      });

      const id_dueno = document.getElementById("edit_id_dueno").value;
      const nombre = document.getElementById("edit_nombre").value.trim();
      const apellido = document.getElementById("edit_apellido").value.trim();
      const correo = document.getElementById("edit_correo").value.trim();
      const telefono = document.getElementById("edit_telefono").value.trim();
      const direccion = document.getElementById("edit_direccion").value.trim();
      const id_sede = document.getElementById("edit_id_sede").value;

      if (!nombre || !apellido || !correo || !telefono || !direccion || !id_sede) {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
        return;
      }

      try {
        const response = await fetch("../duenos/update.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id_dueno, nombre, apellido, correo, telefono, direccion, id_sede })
        });

        const result = await response.json();

        if (result.success) {
          Swal.fire("Éxito", result.message, "success").then(() => {
            closeEditDuenoModal();
            loadPage("templates/gestion_duenos.php"); // recarga el dashboard
          });
        } else {
          Swal.fire("Error", result.message || "No se pudo actualizar", "error");
        }
      } catch (error) {
        Swal.fire("Error", "No se pudo conectar con el servidor", "error");
        console.error(error);
      }

    }


    async function deleteDueno(id, nombre) {
      const result = await Swal.fire({
        title: "¿Eliminar dueño?",
        text: `Se eliminará el dueño "${nombre}"`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "rgba(206, 124, 124, 1)",
        cancelButtonColor: "#606c78ff",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      });

      if (result.isConfirmed) {
        try {
          const response = await fetch(`../duenos/delete.php?id=${id}`, { method: "GET" });
          const data = await response.json();

          if (data.success) {
            Swal.fire("Eliminado", data.message, "success").then(() => {
              loadPage("templates/gestion_duenos.php");
            });
          } else {
            Swal.fire("Error", data.message || "No se pudo eliminar", "error");
          }
        } catch (err) {
          console.error(err);
          Swal.fire("Error", "No se pudo conectar con el servidor", "error");
        }
      }
    }

    
  </script>
  <footer>
    <img src="../resources/dog.gif" alt="Perrito feliz" class="w-64 gif-footer-fixed">
  </footer>

</body>

</html>