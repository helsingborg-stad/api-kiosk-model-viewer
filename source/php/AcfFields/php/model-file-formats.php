<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_620b028642eca',
    'title' => __('Model File Formats', 'api-kiosk-model-viewer'),
    'fields' => array(
        0 => array(
            'key' => 'field_620b0291b1425',
            'label' => __('GLTF (.glb)', 'api-kiosk-model-viewer'),
            'name' => 'gltf',
            'type' => 'file',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'return_format' => 'array',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'glb',
        ),
        1 => array(
            'key' => 'field_620b02c3b1426',
            'label' => __('USDZ (.usdz)', 'api-kiosk-model-viewer'),
            'name' => 'usdz',
            'type' => 'file',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'show_in_graphql' => 1,
            'return_format' => 'array',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'usdz',
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
    'menu_order' => -1000,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
        0 => 'the_content',
        1 => 'discussion',
        2 => 'comments',
        3 => 'format',
        4 => 'page_attributes',
        5 => 'categories',
        6 => 'tags',
        7 => 'send-trackbacks',
    ),
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'modelFileFormats',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
));
}