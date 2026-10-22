<?php
require_once __DIR__ . '/config/sesion.php';
$errorLogin = $_SESSION['error_login'] ?? '';
$exito = $_SESSION['exito'] ?? '';
unset($_SESSION['error_login'], $_SESSION['exito']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6b7b5e">
    <title>Inicio de sesión | Nexo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta" aria-labelledby="titulo-pagina">
            <header class="encabezado">
                <div class="marca" aria-hidden="true">N</div>
                <p class="sobrelinea">TU ESPACIO DIGITAL</p>
                <h1 id="titulo-pagina">Qué bueno verte</h1>
                <p class="subtitulo">Ingresa a tu cuenta de Nexo</p>
            </header>
            <form id="formLogin" class="formulario" action="validar_login.php" method="post">
                <div class="titulo-formulario">
                    <span class="etiqueta-seccion">ACCESO PERSONAL</span>
                    <h2>Iniciar sesión</h2>
                    <p>Escribe tus datos para continuar.</p>
                </div>
                <?php if ($exito !== ''): ?>
                    <p class="mensaje exito" role="status"><?= htmlspecialchars($exito, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <?php if ($errorLogin !== ''): ?>
                    <p class="mensaje error" role="alert"><?= htmlspecialchars($errorLogin, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <div class="grupo">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="nombre@ejemplo.com" autocomplete="email" required>
                </div>
                <div class="grupo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" autocomplete="current-password" required>
                </div>
                <p id="mensajeLogin" class="mensaje" aria-live="polite"></p>
                <button type="submit" class="boton">Ingresar <span aria-hidden="true">→</span></button>
                <p class="texto-enlace">¿Aún no tienes una cuenta? <a href="registro.php">Regístrate</a></p>
            </form>
            <footer class="pie-tarjeta">Nexo <span>·</span> Aplicación de usuarios</footer>
        </section>
    </main>
    <script src="js/validaciones.js" defer></script>
</body>
</html>
