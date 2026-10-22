<?php
require_once __DIR__ . '/config/sesion.php';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6b7b5e">
    <title>Crear cuenta | Nexo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta tarjeta-registro" aria-labelledby="titulo-pagina">
            <header class="encabezado">
                <div class="marca" aria-hidden="true">N</div>
                <p class="sobrelinea">TU ESPACIO DIGITAL</p>
                <h1 id="titulo-pagina">Empieza algo nuevo</h1>
                <p class="subtitulo">Crea tu cuenta en Nexo</p>
            </header>
            <form id="formRegistro" class="formulario" action="guardar_usuario.php" method="post">
                <div class="titulo-formulario">
                    <span class="etiqueta-seccion">UN PASO MÁS CERCA</span>
                    <h2>Crear cuenta</h2>
                    <p>Completa tus datos para registrarte.</p>
                </div>
                <?php if ($error !== ''): ?>
                    <p class="mensaje error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <div class="grupo">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" maxlength="100" placeholder="Escribe tu nombre" autocomplete="name" required>
                </div>
                <div class="grupo">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" maxlength="150" placeholder="nombre@ejemplo.com" autocomplete="email" required>
                </div>
                <div class="grupo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" minlength="8" autocomplete="new-password" required>
                </div>
                <div class="grupo">
                    <label for="confirmar">Confirmar contraseña</label>
                    <input type="password" id="confirmar" name="confirmar" placeholder="Repite tu contraseña" minlength="8" autocomplete="new-password" required>
                </div>
                <p id="mensajeRegistro" class="mensaje" aria-live="polite"></p>
                <button type="submit" class="boton">Crear cuenta <span aria-hidden="true">→</span></button>
                <p class="texto-enlace">¿Ya tienes una cuenta? <a href="index.php">Iniciar sesión</a></p>
            </form>
            <footer class="pie-tarjeta">Nexo <span>·</span> Aplicación de usuarios</footer>
        </section>
    </main>
    <script src="js/validaciones.js" defer></script>
</body>
</html>
