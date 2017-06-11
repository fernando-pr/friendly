![Friendly](images/logo.png) **Friendly**
==================

### Dificultades encontradas y soluciones aplicadas.

-------------------------------------------


> La aplicación tienes dos salas de chat, una individual con amigos y otra de grupo con los usuarios conectados. En un principio el chat iba a guardar todos los mensajes en una tabla llamada mensajes, pero esto me suponía un problema dado que los mensajes que son enviados al chat público no tienen receptor, y tenía que discriminar los que tenían receptor o no, así que la decisión tomada para solucionar el problema fue separar los mensajes en dos tablas, una para públicos y otra para privados.

> Otra dificultad encontrada fue a la hora de buscar una extensión que me hiciera el chat. En la búsqueda use varias extensiones de extensiones pero la verdad que ninguna me terminó de convencer. Unas eran imposibles de configurar, otras no funcionaban bien y la mayoría tenía pocas descargas y no eran muy usadas por otros usuarios. así que mi decisión fue la de hacer las salas de chat por mí mismo.

> Problemas con bootstrap. Unos de los problemas de usar bootstrap es que al poner tus propios css no los sobreescribe y sigue usando los css de bootstrap. Así que cambias por ejemplo el color de alguna propiedad y no hace nada. Otro problema añadido es que el navegador actualiza el css de algunos elementos desde lo que está guardado en el navegador, así que no cambia el diseño aunque lo cambies en el css. La solución aplicada a los dos problemas fue, primero usar la navegación privada para que cada vez se hiciera una petición se pidan también los recursos css y la segunda solución usar important! en las sentencias css y usar selectores mas directos para que tuvieran prioridad.
