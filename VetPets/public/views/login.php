<?php
// login.php
require_once "../../config/config.php";
session_start();

$mensaje = "";
?>
<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetPlatform - Iniciar Sesión</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11d493",
                        "primary-soft": "#A8D5BA",
                        "secondary-blue": "#5B92E5",
                        "background-light": "#F8F9FA",
                        "background-dark": "#10221c",
                        "text-dark": "#333333",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center items-center p-4 sm:p-6 lg:p-8">
                <div
                    class="layout-content-container flex flex-col lg:flex-row w-full max-w-6xl bg-white dark:bg-background-dark shadow-xl rounded-xl overflow-hidden">
                    <div class="w-full max-w-lg mx-auto p-4 sm:p-6 lg:p-8">
                        <div class="max-w-md mx-auto w-full">

                            <!-- Mensajes de error -->
                            <?php if (!empty($mensaje)): ?>
                                <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm font-medium">
                                    <?php echo $mensaje; ?>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-col gap-2 mb-8">
                                <p class="text-2xl sm:text-3xl lg:text-4xl font-black">Bienvenido de vuelta</p>

                                <p class="text-gray-500 dark:text-gray-400 text-base font-normal">Inicia sesión en tu cuenta</p>
                            </div>

                            <div class="flex flex-col gap-6">
                                <label class="flex flex-col gap-2">
                                    <p class="text-text-dark dark:text-white text-base font-medium">Correo</p>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                        <input
                                            class="form-input flex w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-14 pl-11 pr-4 text-base"
                                            name="email" id="email" placeholder="tucorreo@ejemplo.com" type="text" required />
                                    </div>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <p class="text-text-dark dark:text-white text-base font-medium">Contraseña</p>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                                        <input
                                            class="form-input flex w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-14 pl-11 pr-4 text-base"
                                            name="password" id="password" placeholder="Ingresa tu contraseña"
                                            type="password" required />
                                    </div>
                                </label>

                                <div class="flex items-center justify-between">
                                    <a class="text-sm font-medium text-secondary-blue hover:underline"
                                        href="#">¿Olvidaste tu contraseña?</a>
                                </div>

                                <button id="loginBtn"
                                    class="flex w-full items-center justify-center rounded-lg h-14 px-5 bg-primary-soft hover:bg-opacity-90 text-text-dark text-base font-bold tracking-[0.015em] transition-colors">
                                    <span class="truncate">Iniciar Sesión</span>
                                </button>

                                <p class="text-center text-sm text-gray-600 mt-4">
                                    ¿No tienes cuenta?
                                    <button id="openRegisterModal" class="text-secondary-blue hover:underline font-semibold">
                                        Regístrate aquí
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="hidden lg:flex w-1/2 bg-primary-soft/30 items-center justify-center p-8">
                        <div class="w-full h-full bg-center bg-no-repeat bg-contain"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCjZdn5NZzHra5ypMPOGZqqALemBji99A9GYfPRfX_euXLPrle4jgTUr9wyxnNtViBsQTXhS7cIsrjkACNVyoCXhB6cMYlvhy0_Zs9gbWYHn8ocFO72ej8Kgu5cEiA4BcIJHWzqZd_p8EyFGdob5vQ3qExXTnn8L-sJrpxR1MG4_sHYtZ_R4DwuLZtXXz58V-z7sFZG0jfyeJEC9n_6SV7qM_o1vASkfBANr4UEUntAP9oXXwYM7T-pqwizOEcQzt2Cal8R8vXnrwZa");'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Registro -->
    <div id="registerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 w-full max-w-md relative">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">&times;</button>
            <h2 class="text-2xl font-bold mb-6 text-center">Registrar nueva cuenta</h2>
            
            <div class="flex flex-col gap-4">
                <input id="regUsuario" type="text" placeholder="Usuario"
                    class="w-full border rounded-lg p-3 bg-gray-50 dark:bg-gray-700" required>
                <input id="regCorreo" type="email" placeholder="Correo institucional"
                    class="w-full border rounded-lg p-3 bg-gray-50 dark:bg-gray-700" required>
                <input id="regContrasena" type="password" placeholder="Contraseña"
                    class="w-full border rounded-lg p-3 bg-gray-50 dark:bg-gray-700" required>
                <input id="regSede" type="number" placeholder="ID de sede"
                    class="w-full border rounded-lg p-3 bg-gray-50 dark:bg-gray-700" required>
                
                <button id="registerBtn"
                    class="w-full bg-primary-soft hover:bg-primary text-text-dark font-semibold rounded-lg py-3 mt-2 transition-colors">
                    Registrar
                </button>
            </div>
        </div>
    </div>

    <script>
        // --- LOGIN ---
        document.getElementById("loginBtn").addEventListener("click", async function (e) {
            e.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if (!email || !password) {
                Swal.fire({ icon: "warning", title: "Campos incompletos", text: "Por favor, completa todos los campos." });
                return;
            }

            try {
                const response = await fetch("../../config/auth.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: "success",
                        title: "¡Bienvenido!",
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => window.location.href = "dashboard.php");
                } else {
                    Swal.fire({ icon: "error", title: "Error", text: result.message });
                }
            } catch (error) {
                Swal.fire({ icon: "error", title: "Error de conexión", text: "No se pudo contactar con el servidor" });
            }
        });

        // --- MODAL REGISTRO ---
        const modal = document.getElementById("registerModal");
        document.getElementById("openRegisterModal").onclick = () => modal.classList.remove("hidden");
        document.getElementById("closeModal").onclick = () => modal.classList.add("hidden");

        // --- REGISTRO DE USUARIO ---
        document.getElementById("registerBtn").addEventListener("click", async function () {
            const usuario = document.getElementById("regUsuario").value;
            const correo = document.getElementById("regCorreo").value;
            const contrasena = document.getElementById("regContrasena").value;
            const id_sede = document.getElementById("regSede").value;

            if (!usuario || !correo || !contrasena || !id_sede) {
                Swal.fire({ icon: "warning", title: "Campos incompletos", text: "Por favor, completa todos los campos." });
                return;
            }

            try {
                const response = await fetch("../../config/register.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ usuario, correo, contrasena, id_sede })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Usuario registrado",
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    modal.classList.add("hidden");
                } else {
                    Swal.fire({ icon: "error", title: "Error", text: result.message });
                }
            } catch (error) {
                Swal.fire({ icon: "error", title: "Error de conexión", text: "No se pudo contactar con el servidor" });
            }
        });
    </script>

</body>
</html>
