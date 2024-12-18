<?php
require_once get_stylesheet_directory() . '/custom-meta-boxes/LessonMetaBox.php';

add_action('init', 'registerLessonCustomPostType');

function registerLessonCustomPostType() {
    register_post_type('aula', array(
        'label' => 'Aula',
        'description' => 'Aula',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'aula', 'with_front' => true),
        'query_var' => true,
        'supports' => array('author', 'title'),
        'publicly_queryable' => true,
        'taxonomies' => array( 'codigo-limpo' )
    ));
}

add_action("add_meta_boxes", "addLessonMetaBox");

function addLessonMetaBox() {
    add_meta_box("lesson-metabox", "lesson fields", "displayLessonMetaBox", "aula", "normal", "high", null);
}

function displayLessonMetaBox($post) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $lessonMetaBox = new LessonMetaBox();
    $lessonMetaBox->displayFields($post->ID);
}

add_action("save_post", "saveLessonMetaBoxFields", 10, 3);

function saveLessonMetaBoxFields($postID, $post, $update) {
    $lessonMetaBox = new LessonMetaBox();
    $lessonMetaBox->saveFields($postID, $post->post_type, $_POST);
}
?>