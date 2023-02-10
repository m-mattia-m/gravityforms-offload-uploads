<?php
/*
 * Plugin Name: Gravity Forms Offload File Uploads
 * Plugin URI: https://vtldesign.com
 * Description: Offloads file uploads in Gravity Forms to Amazon S3 or FTP storage
 * Version: 1.0.0
 * Requires at least: 4.0
 * Requires PHP: 7.0
 * Author: Vital
 * Author URI: https://vtldesign.com
 * Text Domain: vital
 */
if (!defined('ABSPATH')) {
    exit;
}

define('GF_SIMPLE_ADDON_VERSION', '2.1');

add_action('gform_loaded', ['GF_Offload_File_Uploads_Addon', 'load'], 5);

class GF_Offload_File_Uploads_Addon {

    public static function load() {

        if (!method_exists('GFForms', 'include_addon_framework')) {
            return;
        }

        if (!class_exists('S3')) {
            require_once('includes/S3.php');
        }

        require_once('class-gravityforms-offload-file-uploads.php');

        GFAddOn::register('GF_Offload_File_Uploads');
    }
}

function gf_simple_addon() {
    return GF_Offload_S3_Uploads::get_instance();
}
