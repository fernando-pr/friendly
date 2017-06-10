![Friendly](images/logo.png) **Friendly**
==================

### Instalación en local
------------------------

#### Debes tener:
> - ** PHP 7.0 o superior **
> - ** PostgreSQL 9.5 o superior **
> - ** Tener Composer **
> - ** Servidor apache2 **

#### Instalación:

> - Crear un directorio virtual en el servidor `friendly.local` y cambiar el documentRoot a `friendly /web`.
> - Una vez configurado apache2 instala `composer`.
> - Lo siguiente es instalar la base de datos con los siguientes comandos de consola para crear la base de daton , el usuario e inyectar el archivo sql del proyecto:
>       ~ ᐅ sudo -u postgres createdb friendly
>       ~ ᐅ sudo -u postgres createuser -P friendly
>       ~/web/friendly ᐅ psql -U friendly friendly < db/friendly.sql
>
> - Ahora usaremos `composer` y el `repositorio de friendly` que está en ** github ** :
>       ~/web ᐅ git clone https://github.com/fernando3287/friendly.git
>       ~/web ᐅ cd friendly
>       ~/web/friendly ᐅ composer install
>       ~/web/friendly ᐅ composer run-script post-create-project-cmd
>       ~/web/friendly ᐅ chmod 777 controllers models views uploads
>
> - Cambiar la dirección de correo en `/config/params.php`
>        'smtpUsername' => 'nueva dirección de correo',
>
> - Crear una variable de entorno en la configuracion de apache2 llamada `SMTP_PASS` con la contraseña de la dirección de correo.
>       SetEnv SMTP_PASS "clave correo"
