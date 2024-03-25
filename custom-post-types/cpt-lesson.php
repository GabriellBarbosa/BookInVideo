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
        'supports' => array('author', 'title'),
        'publicly_queryable' => true,
        'taxonomies' => array( 'codigo-limpo' )
    ));
}

add_action("add_meta_boxes", "add_lesson_custom_meta_box");

function add_lesson_custom_meta_box() {
    add_meta_box("lesson-name", "lesson fields", "custom_meta_box_markup", "aula", "normal", "high", null);
}

function custom_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    ?>
        <div>
            <label for="name">name</label>
            <input name="name" type="text" value="<?= get_post_meta($object->ID, "name", true); ?>">
            <br>

            <label for="sequence">sequence</label>
            <input name="sequence" type="text" value="<?= get_post_meta($object->ID, "sequence", true); ?>">
            <br>

            <label for="slug">slug</label>
            <input name="slug" type="text" value="<?= get_post_meta($object->ID, "slug", true); ?>">
            <br>

            <label for="video_src">video_src</label>
            <input name="video_src" type="text" value="<?= get_post_meta($object->ID, "video_src", true); ?>">
            <br>

            <label for="duration">duration</label>
            <input name="duration" type="text" value="<?= get_post_meta($object->ID, "duration", true); ?>">
            <br>

            <label for="prev">prev</label>
            <input name="prev" type="text" value="<?= get_post_meta($object->ID, "prev", true); ?>">
            <br>
            
            <label for="next">next</label>
            <input name="next" type="text" value="<?= get_post_meta($object->ID, "next", true); ?>">
            <br>

            <label for="has_code">has_code</label>
            <?php
                $has_code_box = get_post_meta($object->ID, "has_code", true);
                if ($has_code_box == "true") {
                    ?>
                        <input name="has_code" type="checkbox" value="true" checked>
                    <?php
                }
                else {
                    ?>  
                        <input name="has_code" type="checkbox" value="true">
                    <?php
                }
            ?>

            <label for="has_slide">has_slide</label>
            <?php
                $has_slide_box = get_post_meta($object->ID, "has_slide", true);
                if ($has_slide_box == "true") {
                    ?>
                        <input name="has_slide" type="checkbox" value="true" checked>
                    <?php
                }
                else {
                    ?>  
                        <input name="has_slide" type="checkbox" value="true">
                    <?php
                }
            ?>
        </div>
    <?php  
}

add_action("save_post", "save_custom_meta_box", 10, 3);

function save_custom_meta_box($post_id, $post, $update) {
    if (canEdit($post->post_type, $post_id)) {
        $fields = array(
            'name',
            'sequence',
            'slug',
            'video_src',
            'duration',
            'prev',
            'next',
            'has_code',
            'has_slide'
        );

        foreach ($fields as $field) {
            $value = "";
            if (isset($_POST[$field])) {
                $value = $_POST[$field];
            }
            update_post_meta($post_id, $field, trim($value));
        }
    }
}

function canEdit($postType, $post_id) {
    return (
        assertEquals("aula", $postType) &&
        nonceIsValid() && 
        current_user_can("edit_post", $post_id) && 
        autosaveIsDisabled()
    );
}

function nonceIsValid() {
    return (
        isset($_POST["meta-box-nonce"]) && 
        wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__))
    );
}

function autosaveIsDisabled() {
    return !(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE);
}

function assertEquals($expected, $actual) {
    return $expected == $actual;
}
?>