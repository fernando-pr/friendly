![Friendly](images/logo.png) **Friendly**
==================

### Definición detallada
------------------------



| **R01**              | **Crear usuario administrador** |
| ----------           | ---------- |
| Descripción larga    | Usuario que se crea junto con la aplicación y que nunca puede faltar, ya que se encarga de la gestión de la aplicación. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [1](https://github.com/fernando3287/friendly/issues/1) |

| **R02**              | ** Privilegios para administrador.** |
| ----------           | ---------- |
| Descripción larga    | Usuario con todos los privilegios que se encarga de la administración de toda la aplicación y con permisos totales. Puede modificar, crear, consultar o borrar tanto mensajes, usuarios. Los usuarios normales de la aplicación tienen permisos limitados de edición a ellos mismos, pero el administrador puede editar a todos. |
| Prioridad            |    Importante        |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [2](https://github.com/fernando3287/friendly/issues/2) |

| **R03**              | **Registrar un usuario** |
| ----------           | ---------- |
| Descripción larga    |     La aplicación debe permitir a un usuario invitado poder registrarse quedando guardado en la base de datos y adquirir los privilegios de un usuario registrado. La opción de registrarse solo sera accesible cuando un usuario no está ya registrado, en el caso de haber iniciado sesión no podrá registrarse.       |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [3](https://github.com/fernando3287/friendly/issues/3) |

| **R04**              | **Validar un usuario mediante email** |
| ----------           | ---------- |
| Descripción larga    |     La aplicación debe enviar un correo de confirmación con un enlace al correo  electrónico del usuario que se acaba de registrar. El usuario al entrar en el enlace desde el correo que se le envió, está confirmando el registro en el sistema y la activación de su cuenta de usuario. Esto le permite usar la aplicación una vez inicie sesión con los privilegios de estar registrado       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Difícil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [4](https://github.com/fernando3287/friendly/issues/4) |

| **R05**              | **Privilegios para usuarios invitados.** |
| ----------           | ---------- |
| Descripción larga    |     Los usuarios que entren a la aplicación no tendrán privilegios para hacer casi nada aparte de iniciar sesión, si ya está registrado, o de registrarse si no lo está. Los invitados están limitados ya que la mayoría de las funcionalidades de la aplicación requiere que se conozca quien la está usando.       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [5](https://github.com/fernando3287/friendly/issues/5) |

| **R06**              | ** Privilegios para usuarios registrados** |
| ----------           | ---------- |
| Descripción larga    |     El sistema permite a los usuarios registrados entrar a la mayoría de funcionalidades de la aplicación ( menos a las acciones que solo puede hacer el administrador).
Los usuarios registrados pueden buscar a otros usuarios, agregar amigos, mandar mensajes a amigos, conversar con otros usuarios registrados. También pueden personalizar su perfil, su foto, como sus datos personales y contraseña, etc.
       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [6](https://github.com/fernando3287/friendly/issues/6) |

| **R07**              | **Consultar datos usuarios** |
| ----------           | ---------- |
| Descripción larga    |     Ante esta situación los datos de usuarios que puedes consultar dependen de los privilegios que tengas.
Si eres usuario invitado directamente no puedes consultar nada.
Si eres usuario registrado puedes ver tus datos y los de tus amigos.
Si eres usuario administrador puedes consultar los datos de cualquier usuario.
Tanto usuario registrado o administrador deben haber iniciado sesión en el sistema.       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [7](https://github.com/fernando3287/friendly/issues/7) |

| **R08**              | **Modificar datos usuario.** |
| ----------           | ---------- |
| Descripción larga    |      La aplicación distingue tres situaciones para la modificación de usuarios. La primera situación es que no estés registrado en el sistema por lo que no puedes modificar los datos del propio usuario porque no existen ni los datos de los demás usuarios. La segunda situación es que seas un usuario registrado, entonces tienes la posibilidad de modificar los datos propios. La tercera situación es que seas administrador por lo que puedes modificar los datos de cualquier usuario.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [8](https://github.com/fernando3287/friendly/issues/8) |

| **R09**              | **Borrar datos de un usuario.** |
| ----------           | ---------- |
| Descripción larga    |      Un usuario registrado o un usuario administrador no puede borrar los datos de los usuarios ni de ellos mismos. No puede haber usuarios sin nombre o sin contraseña. Podrían cambiar los datos pero no borrarlos      |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [9](https://github.com/fernando3287/friendly/issues/9) |

| **R10**              | **Borrar usuarios** |
| ----------           | ---------- |
| Descripción larga    |      Los usuarios registrados solo pueden ser borrados del sistema por el usuario administrador o por ellos mismos siempre que tengan iniciada sesión en la aplicación      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [10](https://github.com/fernando3287/friendly/issues/10) |

| **R11**              | **Crear usuarios** |
| ----------           | ---------- |
| Descripción larga    |     Un usuario solo se puede crear cuando un el sistema está siendo usado por un usuario invitado que rellene correctamente un formulario de registro y entre a través del enlace que se le envía al correo(activación).       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [11](https://github.com/fernando3287/friendly/issues/11) |

| **R12**              | **Ver usuarios** |
| ----------           | ---------- |
| Descripción larga    |      El listado de usuarios registrados en la aplicación solo los puede consultar el administrador de la aplicación.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [12](https://github.com/fernando3287/friendly/issues/12) |

| **R13**              | **Login de usuario** |
| ----------           | ---------- |
| Descripción larga    |      El sistema permite a los usuarios iniciar sesión en la aplicación como usuario o administrador siempre y cuando exista una cuenta activada guardada en la base de datos, sino deberá registrarse y activar la cuenta antes de iniciar sesión.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Difícil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [13](https://github.com/fernando3287/friendly/issues/13) |

| **R14**              | **Logout de usuario.** |
| ----------           | ---------- |
| Descripción larga    |     La aplicación permite a usuarios que tengan iniciada la sesión en el sistema cerrar la sesión y pasar a ser usuario invitado. Si quiere volver a tener los privilegios de usuario deberá volver a iniciar sesión.       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [14](https://github.com/fernando3287/friendly/issues/14) |

| **R15**              | **Cambio de contraseña de usuario** |
| ----------           | ---------- |
| Descripción larga    |     Los usuarios registrados y que tengan iniciada sesión pueden cambiar la contraseña de su cuenta siempre y cuando se acuerden de la contraseña actual porque necesitan la contraseña actual y la nueva para cambiar la clave.       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [15](https://github.com/fernando3287/friendly/issues/15) |

| **R16**              | **Cambio de datos personales de usuario.** |
| ----------           | ---------- |
| Descripción larga    |      Los usuarios registrados y que tengan iniciada sesión en el sistema tienen la posibilidad de cambiar los datos personales de su usuario.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [16](https://github.com/fernando3287/friendly/issues/16) |

| **R17**              | **Crear perfil usuario.** |
| ----------           | ---------- |
| Descripción larga    |      El sistema creará el perfil de un usuario a partir de los datos personales de un usuario.       |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [17](https://github.com/fernando3287/friendly/issues/17) |

| **R18**              | **Modificar perfil usuario.** |
| ----------           | ---------- |
| Descripción larga    |      El perfil de un usuario se modifica de forma dinámica cuando el usuario modifique sus datos personales.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [18](https://github.com/fernando3287/friendly/issues/18) |

| **R19**              | ** Borrar perfil usuario.** |
| ----------           | ---------- |
| Descripción larga    |     El perfil del usuario solo se mostrará si el usuario existe. Por lo tanto, al borrar el usuario (por el administrador o el propio usuario) se borrará el perfil.       |
| Prioridad            |     Importante       |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [19](https://github.com/fernando3287/friendly/issues/19) |

| **R20**              | **Ver perfil usuario.** |
| ----------           | ---------- |
| Descripción larga    |      El perfil del usuario solo se podrá ver por usuarios que pertenezcan a la lista de amigos del usuario consultado, y es una información que se coge de los datos personales del  usuario.      |
| Prioridad            |      Importante      |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº issue             | [20](https://github.com/fernando3287/friendly/issues/20) |

| **R21**              | **Añadir otros usuarios a tu lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |     El sistema permite enviar peticiones de amistad a otros usuarios que no estén en tu lista de amigos y si esa petición de amistad es aceptada pasaría a formar parte de la lista de amigos del usuario       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [21](https://github.com/fernando3287/friendly/issues/21) |

| **R22**              | ** Ver usuarios de la lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |      La aplicación permite a los usuarios registrados y que tengan iniciada sesión consultar su lista de amigos actual.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [22](https://github.com/fernando3287/friendly/issues/22) |

| **R23**              | **modificar lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |      Un usuario registrado y que tenga iniciada sesión puede añadir y borrar nuevos amigos a su lista.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [23](https://github.com/fernando3287/friendly/issues/23) |

| **R24**              | **Borrar otros usuarios de tu lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |      El sistema a los usuarios que tengas iniciada sesión la posibilidad de dejar de ser amigos de otro usuario por lo que se borrará ese usuario de la lista de amigos.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [24](https://github.com/fernando3287/friendly/issues/24) |

| **R25**              | **Opción de buscar otros usuarios por localidad.** |
| ----------           | ---------- |
| Descripción larga    |       La aplicación permite a los usuarios buscar a otros usuarios que sean de la misma localidad.     |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [25](https://github.com/fernando3287/friendly/issues/25) |

| **R26**              | **Opción de buscar otros usuarios con filtros** |
| ----------           | ---------- |
| Descripción larga    |       El sistema de búsqueda de la aplicación proporciona un formulario donde según los campos que se rellenen se aplicarán esos datos a la búsqueda.     |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [26](https://github.com/fernando3287/friendly/issues/26) |

| **R27**              | **Enviar invitación amistad de parte de otro usuario.** |
| ----------           | ---------- |
| Descripción larga    |      El usuario registrado y que tenga iniciada sesión se le permitirá enviar invitación de amistad a usuarios que no pertenezcan a la lista de amigos. Si la solicitud es aceptada a ambos le aparecerá el otro en su lista de amigos.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [27](https://github.com/fernando3287/friendly/issues/27) |

| **R28**              | **Recibir invitación de amistad.** |
| ----------           | ---------- |
| Descripción larga    |      Cuando un usuario envía petición de amistad a otro usuario. Al otro usuario le llega una petición de amistad que si es aceptada a ambos le aparecerá el otro en la lista de amigos. Si es rechazada la petición no se añadirán a la lista de amigos.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [28](https://github.com/fernando3287/friendly/issues/28) |

| **R29**              | ** Ver invitación de amistad.** |
| ----------           | ---------- |
| Descripción larga    |     A los usuarios que inicien sesión les aparecerá un apartado en el menú donde puedan ver las solicitudes de amistad que tenga pendientes para aceptar o rechazar.       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº issue             | [29](https://github.com/fernando3287/friendly/issues/29) |

| **R30**              | **Permite enviar mensajes de chat con usuarios de la lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |     El sistema permitirá a un usuario registrado la posibilidad de enviar mensajes de chat con otro usuario que este registrado y pertenezca a su lista de amigos.       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [30](https://github.com/fernando3287/friendly/issues/30) |

| **R31**              | **Permite recibir mensajes de chat con usuarios de tu lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |      La aplicación permitirá a un usuario registrado la posibilidad de recibir mensajes de chat de otro usuario que este registrado y pertenezca a su lista de amigos.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [31](https://github.com/fernando3287/friendly/issues/31) |

| **R32**              | **Permite ver mensajes  enviados y recibidos de chat con usuarios de tu lista de amigos.** |
| ----------           | ---------- |
| Descripción larga    |     La aplicación guarda los mensajes enviados y recibidos durante la conversación permitiendo ver la lista de mensajes mientras dure la conversación.       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [32](https://github.com/fernando3287/friendly/issues/32) |

| **R33**              | **Foro general para usuarios registrados** |
| ----------           | ---------- |
| Descripción larga    |     A los usuarios registrados y que tengan iniciada sesión les aparecerá en el menú un apartado donde todos los usuarios logueados podrán escribir y leer lo que escriben los demás.       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [33](https://github.com/fernando3287/friendly/issues/33) |

| **R34**              | **Permite ver mensajes del foro general.** |
| ----------           | ---------- |
| Descripción larga    |      Los mensajes pueden ser vistos por todos los usuarios que hayan iniciado sesión.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [34](https://github.com/fernando3287/friendly/issues/34) |

| **R35**              | **Permite enviar mensajes del foro general.** |
| ----------           | ---------- |
| Descripción larga    |      Todos los usuarios que hayan iniciado sesión se les permitirá escribir mensajes en el foro general.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [35](https://github.com/fernando3287/friendly/issues/35) |

| **R36**              | **Permite modificar mensajes de foro general.** |
| ----------           | ---------- |
| Descripción larga    |     El usuario administrador es el único con privilegios para modificar mensajes del foro general.       |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [36](https://github.com/fernando3287/friendly/issues/36) |

| **R37**              | **Permite borrar mensajes del foro general.** |
| ----------           | ---------- |
| Descripción larga    |      El usuario administrador es el único con privilegios para borrar mensajes del foro general.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [37](https://github.com/fernando3287/friendly/issues/37) |

| **R38**              | **Permite ver usuarios que están conectados en el foro general.** |
| ----------           | ---------- |
| Descripción larga    |      El sistema permite a un usuarios que tenga iniciada sesión  ver la lista de usuarios que están en linea en ese momento dentro del apartado del foro.      |
| Prioridad            | Importante |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [38](https://github.com/fernando3287/friendly/issues/38) |

| **R39**              | **Permite guardar mi ubicación con geolocalización.** |
| ----------           | ---------- |
| Descripción larga    |     El sistema cuando alguien inicie sesión guardara la geolocalización del usuario en el momento de iniciar sesión.       |
| Prioridad            | Opcional |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [39](https://github.com/fernando3287/friendly/issues/39) |

| **R40**              | **permite  buscar a otros usuarios  según su geolocalización.** |
| ----------           | ---------- |
| Descripción larga    |       La aplicación dará la posibilidad de buscar a los usuarios que estén cerca teniendo en cuenta la geolocalización del usuario y la de los demás usuarios.     |
| Prioridad            | Opcional |
| Tipo                 | Funcional  |
| Complejidad          | Difícil |
| Entrega planificada  | v3 |
| Entrega realizada    | v3 |
| Nº issue             | [40](https://github.com/fernando3287/friendly/issues/40) |
