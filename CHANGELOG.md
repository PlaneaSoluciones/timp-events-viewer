# Changelog

Todas las novedades notables de este proyecto se documentan en este fichero.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/es/1.1.0/),
y este proyecto sigue [Versionado Semántico](https://semver.org/lang/es/).

## [Unreleased]

## [1.4.0] - 2026-10-21

### Añadido

- Actualizaciones automáticas desde el propio WordPress: al publicar una nueva Release en GitHub, el admin ve el aviso habitual de "Hay una nueva versión disponible" y puede actualizar con un clic, sin descargar ni subir el ZIP a mano

## [1.3.5] - 2026-10-21

### Corregido

- Corrige mensajes de "Error de conexión" intermitentes: se añade caché temporal (5 min) de las sesiones para reducir las llamadas a la API de TIMP y se blinda el parseo ante datos incompletos
- Los mensajes de error ahora distinguen entre timeout, fallo de red y respuesta inválida del servidor, en vez de un mensaje genérico
- Corrige una pérdida silenciosa de sesiones cuando una actividad tiene admissions repartidas en varias páginas de la API

## [1.3.4] - 2026-03-04

### Cambiado

- Mueve botón Reservar a la misma línea que duración y aforo para reducir altura de tarjetas

## [1.3.3] - 2026-03-02

### Corregido

- Corrige versión incorrecta a 1.3.2 generada por workflow con regex fallida

## [1.3.2] - 2026-03-02

### Cambiado

- Elimina badge 'Pocas plazas', solo se muestra badge en clases completas

## [1.3.1] - 2026-02-17

### Cambiado

- Mejora de indentación en código HTML del formulario de configuración
- Limpieza de comentarios obsoletos en botones de navegación
- Agregada clase `timp-nav-btn` a botones de navegación para mejor control de estilos
- Corrección de formato de código para mejor legibilidad

## [1.3.0] - 2026-02-17

### Añadido

- Detección automática de centros autorizados
- Selector desplegable para centros
- Función de prueba de conexión en panel de administración
- Botón para obtener centros autorizados
- Mejor manejo de errores con detalles específicos
- Configuración de URL de reservas
- Logs de debugging mejorados

## [1.0.0] - 2026-02-16

### Añadido

- Primera versión del plugin
- Integración con API de TIMP v1
- Navegación por semanas
- Selector de días
- Vista responsive
- Shortcode `[timp_events]`
