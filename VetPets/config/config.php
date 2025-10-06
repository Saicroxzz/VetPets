<?php
$host = "localhost";
$dbname = "verpets3";
$user = "root";
$pass = "";

try {
    // Configurar DSN
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

    // Crear conexión PDO
    $pdo_con = new PDO($dsn, $user, $pass);

    // Configurar atributos de PDO
    $pdo_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $pdo_con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 

    $pdo_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    die("❌ Error de conexión a la BD: " . $e->getMessage());
}
?>
