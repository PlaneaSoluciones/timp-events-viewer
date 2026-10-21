# AGENTS.md

## Qué es esto

Plugin de WordPress que muestra en una página o entrada las sesiones/eventos de un centro de
TIMP (app de gestión para centros deportivos), con navegación por semanas y selector de día.
Integración directa con la API REST de TIMP v1 vía AJAX de WordPress. Repo movido desde
`nfortea/timp-events-viewer` (personal) a `PlaneaSoluciones/timp-events-viewer`, que es quien
implementa y da soporte al plugin para sus clientes.

## Comandos

```bash
# Comprobar sintaxis PHP
php -l timp-events-viewer.php

# Instalar dependencias de desarrollo (lint)
composer install

# Linting
vendor/bin/phpcs
vendor/bin/phpstan analyse --memory-limit=768M

# Autofix de estilo (lo que sea auto-corregible)
vendor/bin/phpcbf
```

No hay build ni servidor local: es un plugin que se instala copiando la carpeta en
`/wp-content/plugins/` de un WordPress real (manual o por ZIP, ver README.md).

## Arquitectura

- `timp-events-viewer.php` — único fichero PHP. Clase `TIMP_Events_Plugin`: menú de ajustes,
  llamadas a la API de TIMP (`get_authorized_centers`, `get_center_activities`,
  `get_activity_admissions`, `get_all_sessions`), endpoint AJAX `ajax_get_events` (con caché de
  5 min vía transients, por centro+semana) y el shortcode `[timp_events]`.
- `js/timp-events.js` — navegación por semanas/días y render de las tarjetas de sesión, vía
  AJAX a `admin-ajax.php` (acción `timp_get_events`).
- `css/timp-events.css` — estilos de las tarjetas y navegación.
- `uninstall.php` — limpia las opciones (`timp_api_key`, `timp_center_uuid`,
  `timp_booking_url`) al desinstalar el plugin desde WordPress.
- `readme.txt` (formato WordPress.org) — Plugin Update Checker lo lee del repo de GitHub para
  rellenar el popup "Ver detalles" cuando hay una actualización disponible (descripción, FAQ,
  changelog). Mantenerlo sincronizado con `CHANGELOG.md` al hacer un release.
- Sin build step. `composer.json` mezcla tooling de desarrollo (phpcs/phpstan, `require-dev`,
  no se instala en el ZIP) con una única dependencia de producción: `yahnis-elsts/plugin-update-checker`
  (`require`), que sí viaja dentro del plugin — ver sección de actualizaciones automáticas abajo.

## Workflows

- `pr-title-lint.yml` — valida Conventional Commits en el título de los PRs
- `secret-scan.yml` — gitleaks en cada push/PR
- `lint-php.yml` — `php -l` + PHPCS (WordPress Coding Standards) + PHPStan (nivel 5) en cada push/PR
- `release-php.yml` — al pushear un tag `v*`: corre `composer install --no-dev` (solo trae el
  Plugin Update Checker, no las herramientas de lint), genera el ZIP del plugin con ese `vendor/`
  reducido dentro, extrae las notas de `CHANGELOG.md` y crea la GitHub Release con el ZIP adjunto
  como *release asset*

No hay deploy automático (NAS/SFTP) configurado.

## Actualizaciones automáticas en WordPress

Desde v1.4.0 el plugin integra [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker)
(`yahnis-elsts/plugin-update-checker` vía Composer, dependencia de producción). En
`timp-events-viewer.php`, antes de la clase, se instancia `PucFactory::buildUpdateChecker()`
apuntando al repo de GitHub y con `enableReleaseAssets()` para que use el ZIP adjunto a la
Release (el que genera `release-php.yml`) en vez de empaquetar el código fuente crudo del tag.

- Solo corre en `is_admin()` — no carga nada en el front-end.
- WordPress detecta la actualización de forma nativa (Plugins > "Hay una nueva versión
  disponible") y se instala con un clic, sin tocar GitHub a mano.
- Requiere que el repo siga siendo público (no usa token de GitHub); si se vuelve privado hay
  que configurar `setAuthentication()` con un token.
- Si `vendor/autoload.php` no existe (ej. clonando el repo en local sin `composer install`), el
  chequeo de actualizaciones simplemente no se activa — no rompe el resto del plugin.

## Releases

Seguir el proceso estándar PHP/WordPress: actualizar `CHANGELOG.md` ([Unreleased] → versión con
fecha), bump de `Version` en la cabecera de `timp-events-viewer.php`, commit propio
`chore: bump version to X.Y.Z`, tag `vX.Y.Z`, push. El workflow de release hace el resto.

## Propuestas pendientes (no implementadas, valorar en el futuro)

- **i18n**: las cadenas visibles para el usuario no están envueltas en `__()`/`esc_html_e()`
  pese a declarar `Text Domain: timp-events` en la cabecera — el plugin no es traducible hoy.
- **Paralelizar llamadas a TIMP** (`curl_multi` o similar) en `get_all_sessions()`: ahora mismo
  se hace una llamada secuencial por actividad; con la caché de 5 min el impacto es bajo, pero
  si el centro tiene muchas actividades seguiría siendo la parte más lenta de una petición en
  cache miss.
- **Pestaña de diagnóstico en el admin**: mostrar la última respuesta cruda de TIMP (activities
  + primeras admissions) ayudaría a diagnosticar casos como el de actividades que no aparecen
  sin tener que mirar `debug.log` a mano.
