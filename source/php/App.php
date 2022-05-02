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
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => array('title', 'author', 'revisions', 'thumbnail'),
            'show_in_graphql'    => true,
            'graphql_single_name' => 'model',
            'graphql_plural_name' => 'models'

        );

        $restArgs = array(
            'exclude_keys' => array()
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
                'public' => true,
                'publicly_queryable' => false,
                'hierarchical' => true,
                'show_ui' => true,
                'show_in_rest' => false,
                'show_in_quick_edit' => true,
                'meta_box_cb' => false,
                'show_in_graphql' => true,
                'graphql_single_name' => 'school',
                'graphql_plural_name' => 'schools'
            )
        );
    }
}
