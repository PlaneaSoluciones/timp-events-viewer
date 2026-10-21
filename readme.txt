=== TIMP Events Viewer ===
Contributors: planeasoluciones
Tags: timp, eventos, reservas, pilates, calendario
Requires at least: 5.0
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 1.4.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Muestra las sesiones/eventos de un centro de TIMP en tu web, con navegación por semanas y selector de día.

== Description ==

TIMP Events Viewer integra la API REST de TIMP (app de gestión para centros deportivos) con WordPress. Inserta el shortcode `[timp_events]` en cualquier página o entrada y muestra las sesiones del centro con:

* Navegación por semanas (anterior / siguiente)
* Selector de día (L-S) con indicador de días sin sesiones
* Instructor, sala, duración y plazas disponibles por sesión
* Badges de "Completa" / "Cancelada"
* Botón de reserva configurable, enlazando a la web de reservas de TIMP
* Descripciones de actividad expandibles

Desarrollado y mantenido por [Planea Soluciones](https://planeasoluciones.com).

== Installation ==

1. Sube la carpeta `timp-events-viewer` a `/wp-content/plugins/`, o instala el ZIP desde **Plugins > Añadir nuevo > Subir plugin**.
2. Activa el plugin.
3. Ve a **Ajustes > TIMP Events** e introduce tu API Access Key (desde [developers.timp.pro](https://developers.timp.pro)).
4. Selecciona el centro autorizado de la lista desplegable (se detecta automáticamente).
5. Inserta el shortcode `[timp_events]` en cualquier página o entrada.

Detalles completos de configuración y de la API de TIMP en el [README del repositorio](https://github.com/PlaneaSoluciones/timp-events-viewer).

== Frequently Asked Questions ==

= No aparecen sesiones =

Verifica que el centro haya autorizado tu aplicación en el panel de TIMP y que la API Access Key sea correcta. Usa el botón "Probar Conexión" en Ajustes > TIMP Events para diagnosticarlo.

= ¿Se actualiza solo? =

Sí, desde la versión 1.4.0 el plugin comprueba las Releases de GitHub y muestra el aviso de actualización habitual de WordPress.

== Changelog ==

= 1.4.1 =
* Corrige el autor del plugin mostrado en WordPress (ahora "Planea Soluciones")
* Añade este readme.txt para que WordPress muestre descripción e historial de cambios en "Ver detalles"

= 1.4.0 =
* Actualizaciones automáticas desde el propio WordPress al publicar una nueva Release en GitHub

= 1.3.5 =
* Corrige mensajes de "Error de conexión" intermitentes añadiendo caché temporal (5 min) y blindando el parseo ante datos incompletos de la API
* Mensajes de error más específicos (timeout / fallo de red / respuesta inválida)
* Corrige una pérdida silenciosa de sesiones por paginación no gestionada

= 1.3.4 =
* Mueve el botón Reservar a la misma línea que duración y aforo

= 1.3.3 =
* Corrige versión incorrecta a 1.3.2 generada por workflow con regex fallida

= 1.3.2 =
* Elimina el badge "Pocas plazas"; solo se muestra badge en clases completas

= 1.3.1 =
* Mejoras de indentación y formato de código

= 1.3.0 =
* Detección automática de centros autorizados y selector desplegable
* Función de prueba de conexión en el panel de administración
* Configuración de URL de reservas

= 1.0.0 =
* Primera versión del plugin
