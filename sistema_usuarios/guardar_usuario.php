<?php
require_once __DIR__ . '/config/sesion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registro.php');
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if ($nombre === '' || $correo === '' || $password === '' || $confirmar === '') {
    $_SESSION['error'] = 'Completa todos los campos.';
    header('Location: registro.php');
    exit;
}
if (mb_strlen($nombre, 'UTF-8') > 100 || mb_strlen($correo, 'UTF-8') > 150 || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Revisa el nombre y el formato del correo electrónico.';
    header('Location: registro.php');
    exit;
}
if (strlen($password) < 8 || $password !== $confirmar) {
    $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres y coincidir con su confirmación.';
    header('Location: registro.php');
    exit;
}

try {
    require __DIR__ . '/config/conexion.php';
    $consulta = $conexion->prepare('SELECT id FROM usuarios WHERE correo = ? LIMIT 1');
    $consulta->execute([$correo]);
    if ($consulta->fetch()) {
        $_SESSION['error'] = 'Ese correo ya está registrado.';
        header('Location: registro.php');
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insertar = $conexion->prepare(
        'INSERT INTO usuarios (nombre, correo, password, foto) VALUES (:nombre, :correo, :password, NULL)'
    );
    $insertar->execute([
        ':nombre' => $nombre,
        ':correo' => $correo,
        ':password' => $hash,
    ]);

    $_SESSION['exito'] = 'Cuenta creada correctamente. Inicia sesión.';
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    // El índice UNIQUE también resuelve intentos duplicados simultáneos.
    $_SESSION['error'] = $e->getCode() === '23000'
        ? 'Ese correo ya está registrado.'
        : 'No fue posible completar el registro. Verifica que MySQL esté iniciado.';
    header('Location: registro.php');
    exit;
}
