# Nexo — Sistema de usuarios

Proyecto de las prácticas 1, 2 y 3: interfaces responsivas, registro seguro con PHP/MySQL, autenticación mediante `password_verify()` y un panel protegido por sesión.

## Requisitos

- PHP 7.4 o posterior con extensiones PDO y PDO MySQL.
- MySQL o MariaDB en ejecución.
- Apache local (por ejemplo, AppServ o XAMPP).

## Preparar la base de datos

1. Inicia Apache y MySQL.
2. Abre phpMyAdmin e importa `config/crear_bd.sql` (o ejecuta su contenido en la pestaña SQL).
3. Por defecto, `config/conexion.php` usa `127.0.0.1`, usuario `root`, contraseña vacía y base `sistema_usuarios`, como en la configuración local descrita en la práctica.
4. Si tu MySQL tiene otras credenciales, configura las variables de entorno `DB_HOST`, `DB_USER`, `DB_PASSWORD` y `DB_NAME` antes de iniciar PHP.
5. Abre `http://localhost/practica1/config/probar_conexion.php` si la carpeta sigue llamándose `practica1`. Si la instalas como `sistema_usuarios`, usa esa ruta.

## Flujo

- `registro.php` valida los campos en el navegador.
- `guardar_usuario.php` vuelve a validar en PHP, rechaza correos repetidos y guarda la contraseña con `password_hash()` usando una consulta preparada.
- `index.php` envía las credenciales por POST a `validar_login.php`, que verifica el hash y regenera el identificador de sesión al autenticar.
- `panel.php` exige una sesión iniciada y escapa el nombre y el correo antes de mostrarlos.
- `cerrar_sesion.php` invalida la sesión y vuelve al inicio.

La fotografía queda en `NULL`, según lo indicado en la práctica. Los formularios no guardan contraseñas en texto plano.

## Reflexión breve sobre las sesiones

Una sesión permite conservar en el servidor la identidad del usuario entre peticiones HTTP. El navegador solo recibe un identificador de sesión en una cookie; PHP lo utiliza para recuperar los datos guardados en el servidor. Por eso el panel verifica `usuario_id` antes de mostrar contenido privado y cerrar sesión elimina esos datos e invalida la cookie. La sesión complementa la verificación de contraseña, pero nunca debe reemplazarla.

## Archivos principales

- `config/crear_bd.sql`: esquema de base de datos y tabla `usuarios`.
- `config/conexion.php`: conexión PDO configurable por variables de entorno.
- `js/validaciones.js`: validación de acceso y registro en el navegador.
- `guardar_usuario.php`: alta de cuentas.
- `validar_login.php`: comprobación de credenciales.
- `panel.php`: zona privada.
- `cerrar_sesion.php`: cierre de sesión.
