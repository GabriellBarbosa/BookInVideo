<?php

add_action('init', 'register_cpt_chapter');

function register_cpt_chapter() {
    register_post_type('capitulo', array(
        'label' => 'Capítulo',
        'description' => 'Capítulo',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'capitulo', 'with_front' => true),
        'query_var' => true,
        'supports' => array('custom-fields', 'author', 'title', 'related_course'),
        'publicly_queryable' => true,
        'hierarchical' => true,
    ));
}

?>