<?php
// login.php
require_once __DIR__ . "/config/config.php";
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
                // Guardar datos en la sesión
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - VetPets</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

    <form method="POST">
        <label for="usuario">Usuario o Correo:</label>
        <input type="text" name="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tienes cuenta? <a href="config/register.php">Regístrate aquí</a></p>
</body>
</html>
