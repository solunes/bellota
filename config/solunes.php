<?php

return [
    // GLOBAL
    'vendor_path' => env('SOLUNES_PATH', 'vendor/solunes/master'),
    'blocked_activities' => [],
    'error_report' => true,
    'master_admin_id' => 1,
    'master_dashboard' => true,

    // PLUGINS
    'store' => true,

    // FORM
    'relation_fast_create_array' => [], // array de field names: 'name'
    'item_get_after_vars' => [], // array de nodos: 'node'
    'item_child_after_vars' => [],
    'item_post_after_item' => [],
    'item_post_after_subitems' => [],
    'item_post_redirect_success' => [],
    'item_post_redirect_fail' => [],
    'item_add_css' => [], // array debe contener el array de includes: 'example'=>['file']
    'item_remove_scripts' => [],
    'item_add_script' => ['online-sale'=>['online-sale'], 'international-sale'=>['international-sale']],

    // CUSTOM FUNC
    'get_page_array' => false,
    'before_migrate' => false,
    'after_migrate' => false,
    'before_seed' => false,
    'after_seed' => true,
    'after_login' => false,
    'admin_menu_extras' => false,
    'admin_menu_extra_array' => [], // Incluir los IDs de link de los menús para ejecutar
    'get_sitemap_array' => false,
    'get_indicator_result' => false,
    'update_indicator_values' => false,
    'check_permission' => true,
    'custom_indicator' => false,
    'custom_field' => false,
    'get_options_relation' => true,
    'check_custom_filter' => false,
    'custom_filter' => false,
    'custom_filter_field' => false,
    'custom_pdf_header' => false,
];