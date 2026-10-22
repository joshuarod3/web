<?php
// Configuración para desarrollo local. Define estas variables de entorno en otros entornos.
$servidor = getenv('DB_HOST') ?: '127.0.0.1';
$usuario = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$base_datos = getenv('DB_NAME') ?: 'sistema_usuarios';

try {
    $conexion = new PDO(
        "mysql:host={$servidor};dbname={$base_datos};charset=utf8mb4",
        $usuario,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(503);
    exit('No fue posible conectar con la base de datos. Inicia MySQL y revisa la configuración local.');
}
