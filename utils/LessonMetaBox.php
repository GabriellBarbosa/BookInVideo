<?php
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

    public function saveFields($postID, $postType, $httpPost) {
        if ($this->postCanBeSaved($postType, $postID)) {
            foreach ($this->fields as $field) {
                update_post_meta(
                    $postID, $field, $this->getFieldValue($field, $httpPost));
            }
        }
    }

    private function getFieldValue($field, $httpPost) {
        $value = "";
        if (isset($httpPost[$field])) {
            $value = $httpPost[$field];
        }
        return trim($value);
    }

    private function postCanBeSaved($postType, $postID) {
        return $postType == "aula" && current_user_can("edit_post", $postID);
    }
}
?>