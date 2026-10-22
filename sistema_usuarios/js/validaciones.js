document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', (evento) => {
            const correo = document.getElementById('correo').value.trim();
            const password = document.getElementById('password').value;
            const mensaje = document.getElementById('mensajeLogin');
            if (correo === '' || password === '') {
                evento.preventDefault();
                mensaje.textContent = 'Completa todos los campos.';
                mensaje.className = 'mensaje error';
            }
            // Los datos completos se envían por POST a validar_login.php.
        });
    }

    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {
        formRegistro.addEventListener('submit', (evento) => {
            evento.preventDefault();
            const nombre = document.getElementById('nombre').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const password = document.getElementById('password').value;
            const confirmar = document.getElementById('confirmar').value;
            const mensaje = document.getElementById('mensajeRegistro');

            if (!nombre || !correo || !password || !confirmar) {
                mensaje.textContent = 'Completa todos los campos.';
                mensaje.className = 'mensaje error';
                return;
            }
            if (password.length < 8) {
                mensaje.textContent = 'La contraseña debe tener al menos 8 caracteres.';
                mensaje.className = 'mensaje error';
                return;
            }
            if (password !== confirmar) {
                mensaje.textContent = 'Las contraseñas no coinciden.';
                mensaje.className = 'mensaje error';
                return;
            }
            mensaje.textContent = 'Datos validados. Creando tu cuenta…';
            mensaje.className = 'mensaje exito';
            formRegistro.submit();
        });
    }
});
