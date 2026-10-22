<?php
require_once __DIR__ . '/config/sesion.php';
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
$nombre = htmlspecialchars($_SESSION['usuario_nombre'] ?? '', ENT_QUOTES, 'UTF-8');
$correo = htmlspecialchars($_SESSION['usuario_correo'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6b7b5e">
    <title>Panel de usuario | Nexo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta" aria-labelledby="titulo-pagina">
            <header class="encabezado">
                <div class="marca" aria-hidden="true">N</div>
                <p class="sobrelinea">ESPACIO PERSONAL</p>
                <h1 id="titulo-pagina">Panel de usuario</h1>
                <p class="subtitulo">Has iniciado sesión en Nexo</p>
            </header>
            <div class="contenido-panel">
                <span class="etiqueta-seccion">SESIÓN ACTIVA</span>
                <h2>¡Hola, <?= $nombre ?>!</h2>
                <p>Tu cuenta está lista.</p>
                <div class="dato-panel"><span>Correo electrónico</span><strong><?= $correo ?></strong></div>
                <a class="boton boton-salir" href="cerrar_sesion.php">Cerrar sesión</a>
            </div>
            <footer class="pie-tarjeta">Nexo <span>·</span> Aplicación de usuarios</footer>
        </section>
    </main>
</body>
</html>
