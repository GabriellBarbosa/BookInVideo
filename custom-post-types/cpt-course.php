<?php

add_action('init', 'register_cpt_course');

function register_cpt_course() {
    register_post_type('curso', array(
        'label' => 'Curso',
        'description' => 'Curso',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'curso', 'with_front' => true),
        'query_var' => true,
        'supports' => array('custom-fields', 'author', 'title', 'related_course'),
        'publicly_queryable' => true,
        'taxonomies' => array( 'codigo-limpo' )
    ));
}

?>