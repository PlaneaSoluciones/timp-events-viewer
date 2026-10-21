<?php

// Evitar acceso directo: WordPress define WP_UNINSTALL_PLUGIN al desinstalar desde el admin
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

delete_option('timp_api_key');
delete_option('timp_center_uuid');
delete_option('timp_booking_url');
