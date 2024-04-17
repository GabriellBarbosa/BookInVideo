<?php
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

function displayLessonMetaBox($lessonPost) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $lessonMetaBox = new LessonMetaBox();
    $lessonMetaBox->displayFields($lessonPost);
}

add_action("save_post", "saveLessonMetaBoxFields", 10, 3);

function saveLessonMetaBoxFields($postID, $post, $update) {
    $lessonMetaBox = new LessonMetaBox();
    $lessonMetaBox->saveFields($postID, $post->post_type);
}

class LessonMetaBox {
    private $fields = array(
        'name',
        'sequence',
        'slug',
        'video_src',
        'duration',
        'prev',
        'next',
        'code',
        'slide',
    );

    public function displayFields($lessonPost) { ?>
        <div>
            <?php foreach ($this->fields as $field) { ?>
                <label 
                    style="display: block;"
                    for="<?= $field; ?>"
                ><?= $field ?></label>
                <input 
                    style="padding: 10px; margin: 10px 0 20px 0; width: 370px;"
                    type="text"
                    name="<?= $field; ?>"
                    value="<?= get_post_meta($lessonPost->ID, $field, true); ?>"
                >
                <br>
            <?php } ?>
        </div>
    <?php }

    public function saveFields($postID, $postType) {
        if ($this->postCanBeSaved($postType, $postID)) {
            foreach ($this->fields as $field) {
                update_post_meta($postID, $field, $this->getFieldValue($field));
            }
        }
    }

    private function getFieldValue($field) {
        $value = "";
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
        }
        return trim($value);
    }

    private function postCanBeSaved($postType, $postID) {
        return (
            $postType == "aula" &&
            current_user_can("edit_post", $postID) && 
            $this->nonceIsValid() && 
            $this->autosaveIsDisabled()
        );
    }

    private function nonceIsValid() {
        return (
            isset($_POST["meta-box-nonce"]) && 
            wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__))
        );
    }

    private function autosaveIsDisabled() {
        return !(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE);
    }
}
?>