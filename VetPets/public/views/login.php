<?php
// login.php
require_once "../../config/config.php";
session_start();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    if (!empty($usuario) && !empty($password)) {
        try {
            $sql = "SELECT id_usuario, usuario, contraseña, rol 
                    FROM Usuario 
                    WHERE usuario = :usuario OR correo = :usuario
                    LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["usuario" => $usuario]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user["contraseña"])) {
                $_SESSION["usuario_id"] = $user["id_usuario"];
                $_SESSION["usuario"] = $user["usuario"];
                $_SESSION["rol"] = $user["rol"];

                header("Location: dashboard.php");
                exit();
            } else {
                $mensaje = "❌ Usuario o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en el login: " . $e->getMessage();
        }
    } else {
        $mensaje = "⚠️ Debes llenar todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetPlatform - Iniciar Sesión</title>
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
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }
    </style>
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

                                <p class="text-gray-500 dark:text-gray-400 text-base font-normal">Inicia sesión en tu
                                    cuenta</p>
                            </div>

                            <form class="flex flex-col gap-6" method="POST" action="">
                                <label class="flex flex-col gap-2">
                                    <p class="text-text-dark dark:text-white text-base font-medium">Usuario o Correo</p>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                                        <input
                                            class="form-input flex w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-14 pl-11 pr-4 text-base"
                                            name="usuario" placeholder="tucorreo@ejemplo.com" type="text" required />
                                    </div>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <p class="text-text-dark dark:text-white text-base font-medium">Contraseña</p>
                                    <div class="relative">
                                        <span
                                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                                        <input
                                            class="form-input flex w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 h-14 pl-11 pr-4 text-base"
                                            name="password" placeholder="Ingresa tu contraseña" type="password"
                                            required />
                                    </div>
                                </label>

                                <div class="flex items-center justify-between">
                                    <a class="text-sm font-medium text-secondary-blue hover:underline"
                                        href="#">¿Olvidaste tu contraseña?</a>
                                </div>

                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-lg h-14 px-5 bg-primary-soft hover:bg-opacity-90 text-text-dark text-base font-bold tracking-[0.015em] transition-colors">
                                    <span class="truncate">Iniciar Sesión</span>
                                </button>

                                <div class="text-center mt-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        ¿No tienes una cuenta? <a
                                            class="font-medium text-secondary-blue hover:underline"
                                            href="config/register.php">Regístrate</a>
                                    </p>
                                </div>
                            </form>
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
</body>

</html>