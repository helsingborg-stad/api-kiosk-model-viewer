<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_626fd05403c57',
    'title' => __('Taxonomies', 'api-kiosk-model-viewer'),
    'fields' => array(
        0 => array(
            'key' => 'field_626fd05d3a54b',
            'label' => __('Schools', 'api-kiosk-model-viewer'),
            'name' => 'schools',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 0,
            'taxonomy' => 'school',
            'field_type' => 'select',
            'allow_null' => 1,
            'add_term' => 1,
            'save_terms' => 1,
            'load_terms' => 0,
            'return_format' => 'object',
            'multiple' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'model',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 0,
    'graphql_field_name' => 'taxonomies',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
));
}