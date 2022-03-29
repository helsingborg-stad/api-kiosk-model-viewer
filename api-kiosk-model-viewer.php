<?php

/**
 * Plugin Name:       API Kiosk Model Viewer
 * Plugin URI:        https://github.com/nramstedt/api-kiosk-model-viewer
 * Description:       Backend for managing kiosk model viewer app
 * Version:           1.0.0
 * Author:            Nikolas Ramstedt @ Helsingborg Stad
 * Author URI:        https://github.com/nramstedt
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       api-kiosk-model-viewer
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('API_KIOSK_MODEL_VIEWER_PATH', plugin_dir_path(__FILE__));
define('API_KIOSK_MODEL_VIEWER_URL', plugins_url('', __FILE__));
define('API_KIOSK_MODEL_VIEWER_TEMPLATE_PATH', API_KIOSK_MODEL_VIEWER_PATH . 'templates/');
define('API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN', 'api-kiosk-model-viewer');

load_plugin_textdomain(API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN, false, API_KIOSK_MODEL_VIEWER_PATH . '/languages');

require_once API_KIOSK_MODEL_VIEWER_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once API_KIOSK_MODEL_VIEWER_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ApiKioskModelViewer\Vendor\Psr4ClassLoader();
$loader->addPrefix('ApiKioskModelViewer', API_KIOSK_MODEL_VIEWER_PATH);
$loader->addPrefix('ApiKioskModelViewer', API_KIOSK_MODEL_VIEWER_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('api-kiosk-model-viewer');
    $acfExportManager->setExportFolder(API_KIOSK_MODEL_VIEWER_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'api-kiosk-model-viewer-settings' => 'group_61ea7a87e8aaa' //Update with acf id here, settings view
    ));
    $acfExportManager->import();
});

// Start application
new ApiKioskModelViewer\App();
