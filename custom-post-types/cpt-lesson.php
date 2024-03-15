<?php

add_action('init', 'register_cpt_lesson');

function register_cpt_lesson() {
    register_post_type('aula', array(
        'label' => 'Aula',
        'description' => 'Aula',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'aula', 'with_front' => true),
        'query_var' => true,
        'supports' => array('custom-fields', 'author', 'title'),
        'publicly_queryable' => true,
        'taxonomies' => array( 'codigo-limpo' )
    ));
}

?>