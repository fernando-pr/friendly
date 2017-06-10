![Friendly](images/logo.png) **Friendly**
==================

### Instalación en local
------------------------

#### Debes tener:
> - ** cuenta en heroku **
> - ** crear nueva aplicacion en heroku **
> - ** crear variable de entorno en heroku para la contraseña de correo: **


#### Instalación desde consola:

>       heroku login
>       heroku apps:create nombreAplicacion --region eu
>       heroku addons:create heroku-postgresql
>       heroku pg:psql < db/friendly.sql
>       heroku pg:psql
>       create extension pgcrypto;
>       heroku config:set YII_ENV=prod   
>       heroku config:set SMTP_PASS=clave correo>       
>       git push -u heroku master
>       create extension pgcrypto;
