<?php 

add_action('init', 'register_course_cpt');

function register_course_cpt() {
    register_post_type('course', array(
        'label' => 'Curso',
        'description' => 'Curso',
        'public' => true,
        'capability_type' => 'post',
        'rewrite' => array(
            'slug' => 'curso',
            'with_front' => true
        ),
        'query_var' => true,
        'supports' => array('custom-fields', 'author', 'title'),
        'publicly_queryable' => true
    ));
}

?>