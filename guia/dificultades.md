![Friendly](images/logo.png) **Friendly**
==================

### Dificultades encontradas y soluciones aplicadas.

-------------------------------------------


> La aplicación tienes dos salas de chat, una individual con amigos y otra de grupo con los usuarios conectados. En un principio el chat iba a guardar todos los mensajes en una tabla llamada mensajes, pero esto me suponía un problema dado que los mensajes que son enviados al chat público no tienen receptor, y tenía que discriminar los que tenían receptor o no, así que la decisión tomada para solucionar el problema fue separar los mensajes en dos tablas, una para públicos y otra para privados.

> Otra dificultad encontrada fue a la hora de buscar una extensión que me hiciera el chat. En la búsqueda use varias extensiones de extensiones pero la verdad que ninguna me terminó de convencer. Unas eran imposibles de configurar, otras no funcionaban bien y la mayoría tenía pocas descargas y no eran muy usadas por otros usuarios. así que mi decisión fue la de hacer las salas de chat por mí mismo.

> Una dificultad encontrada a sido a la hora de guardar los usuarios conectados para el chat. En un principio al hacer login guardaba el usuarios entre los conectados y al hacer logout lo eliminaba de entre los conectados. el problema era a la hora de que el usuario cierre el navegador o se vaya la luz, porque al no pasar por el logout no se eliminaba de los conectados. La solución mas razonable que he encontrado ha sido que cada cliente a la hora de hacer una petición http guarde o actualize una cookie y la actualice en la base de datos. Luego he hecho un crontab que se ejecuta cada minuto y busca los usuarios que entre el tiempo actual y la última petición http(cookie) ha pasado más de 10 minutos y los elimina de la base de datos.
