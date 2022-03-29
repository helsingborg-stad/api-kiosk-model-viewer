<?php

namespace ApiKioskModelViewer;

class App
{
    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'), 9);
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
            'show_in_graphql'    => true
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

        $postType->addTaxonomy(
            'school',
            __('School', API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN),
            __('Schools', API_KIOSK_MODEL_VIEWER_TEXT_DOMAIN),
            array(
                'hierarchical' => true,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_in_quick_edit' => false,
                'meta_box_cb' => false,
                'show_in_graphql' => true
            )
        );
    }
}
