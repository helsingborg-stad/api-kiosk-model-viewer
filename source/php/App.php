<?php

namespace ApiKioskModelViewer;

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        add_action('init', array($this, 'registerPostType'), 9);
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

    public function registerPostType()
    {
        $args = array(
            'menu_icon'          => 'dashicons-portfolio',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'supports'           => array('title', 'author', 'revisions', 'editor', 'thumbnail', 'themes'),
            'show_in_rest'       => true,
        );

        $restArgs = array(
            'exclude_keys' => array('author', 'acf', 'guid', 'link', 'template', 'meta', 'taxonomy', 'menu_order')
        );

        $postType = new \ApiKioskModelViewer\Helper\PostType(
            'model',
            __('3D Model', API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN),
            __('3D Models', API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN),
            $args,
            array(),
            $restArgs
        );
    }
}
