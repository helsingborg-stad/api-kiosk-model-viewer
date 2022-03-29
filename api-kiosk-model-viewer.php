<?php

/**
 * Plugin Name:       API Kiosk Model Viewer
 * Plugin URI:        https://github.com/helsingborg-stad/api-kiosk-model-viewer
 * Description:       Backend for managing kiosk model viewer app
 * Version:           1.0.0
 * Author:            Nikolas Ramstedt @ Helsingborg Stad
 * Author URI:        https://github.com/helsingborg-stad
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
        'model-file-formats' => 'group_620b028642eca' //Update with acf id here, settings view
    ));
    $acfExportManager->import();
});

add_action('admin_notices', function () {
    $dependencies = [
        'acf' => [
            'name' => 'Advanced Custom Fields PRO',
            'enabled' => class_exists('ACF'),
            'download' => 'https://www.advancedcustomfields.com/'
        ],
        'wp-graphql' => [
            'name' => 'WP GraphQL',
            'enabled' => class_exists('WPGraphQL'),
            'download' => 'https://wordpress.org/plugins/wp-graphql/'
        ],
        'wp-graphql-acf' => [
            'name' => 'WPGraphQL for Advanced Custom Fields',
            'enabled' => function_exists('\WPGraphQL\ACF\init'),
            'download' => 'https://github.com/wp-graphql/wp-graphql-acf'
        ]
    ];

    $missingDependecies = array_filter($dependencies, function ($d) {
        return !$d['enabled'];
    });

    if (count($missingDependecies) > 0) {
        $class = 'notice notice-error';
        $message = __('API Kiosk Model Viewer: Please install & activate required plugins:', API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN);
        $listItems = implode('', array_map(function ($item) {
            return sprintf('<li><a href="%2$s" target="_blank">%1$s</a></li>', esc_html($item['name']), esc_html($item['download']));
        }, $missingDependecies));

        printf('<div class="%1$s"><h4>%2$s</h4><ul>%3$s</ul></div>', esc_attr($class), esc_html($message), $listItems);
    }
});

// Start application
new ApiKioskModelViewer\App();
