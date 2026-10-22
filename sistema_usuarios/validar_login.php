<?php
require_once __DIR__ . '/config/sesion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';
if ($correo === '' || $password === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_login'] = 'Introduce un correo y una contraseña válidos.';
    header('Location: index.php');
    exit;
}

try {
    require __DIR__ . '/config/conexion.php';
    $consulta = $conexion->prepare(
        'SELECT id, nombre, correo, password FROM usuarios WHERE correo = ? LIMIT 1'
    );
    $consulta->execute([$correo]);
    $usuario = $consulta->fetch();

    if ($usuario && password_verify($password, $usuario['password'])) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = (int) $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_correo'] = $usuario['correo'];
        header('Location: panel.php');
        exit;
    }

    $_SESSION['error_login'] = 'Correo o contraseña incorrectos.';
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['error_login'] = 'No fue posible iniciar sesión. Verifica que MySQL esté iniciado.';
    header('Location: index.php');
    exit;
}
