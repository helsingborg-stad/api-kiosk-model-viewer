<?php

namespace ApiKioskModelViewer;

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style(
            'api-kiosk-model-viewer-css',
            API_KIOSK_MODEL_VIEWER_URL . '/dist/' .
            \ApiKioskModelViewer\Helper\CacheBust::name('css/api-kiosk-model-viewer.css')
        );
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script(
            'api-kiosk-model-viewer-js',
            API_KIOSK_MODEL_VIEWER_URL . '/dist/' .
            \ApiKioskModelViewer\Helper\CacheBust::name('js/api-kiosk-model-viewer.js')
        );
    }
}
