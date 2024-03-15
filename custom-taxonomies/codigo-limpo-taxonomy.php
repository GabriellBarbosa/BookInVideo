<?php
add_action( 'init', 'add_custom_taxonomies', 0 );

function add_custom_taxonomies() {
    register_taxonomy('codigo-limpo', 'post', array(
        'labels' => array(
            'name' => _x( 'codigo-limpo', 'taxonomy general name' ),
            'singular_name' => _x( 'codigo-limpo', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Item' ),
            'all_items' => __( 'All Items' ),
            'edit_item' => __( 'Edit Item' ),
            'update_item' => __( 'Update Item' ),
            'add_new_item' => __( 'Add New Item' ),
            'new_item_name' => __( 'New Item' ),
            'menu_name' => __( 'codigo-limpo' ),
        ),
        'rewrite' => array(
            'slug' => 'codigo-limpo',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
}
?>