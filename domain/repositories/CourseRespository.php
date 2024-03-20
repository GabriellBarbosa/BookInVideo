<?php
class CourseRepository {
    public function findBySlug($slug, $fields) {
        $courseQueryResult = $this->getCourseQuery($slug);
        $coursePosts = $courseQueryResult->get_posts();
        $singleCoursePost = array_shift($coursePosts);
        $fields = $this->getPostFields($singleCoursePost->ID, $fields);
        return $fields;
    }

    private function getCourseQuery($slug) {
        return new WP_Query(array(
            'post_type' => 'curso',
            'name' => $slug,
            'numberposts' => 1,
        ));
    }

    public function getModules($courseSlug) {
        return get_terms($courseSlug);
    }

    public function getLessons($courseSlug, $moduleSlug, $fields) {
        $lessonPosts = $this->getLessonsQuery($courseSlug, $moduleSlug);
        return $this->getLessonsFields($lessonPosts, $fields);
    }

    private function getLessonsQuery($courseSlug, $moduleSlug) {
        wp_reset_query();
        return new WP_Query(array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => $courseSlug,
                    'field' => 'slug',
                    'terms' => $moduleSlug
                ),
            ),
        ));
    }

    private function getLessonsFields($lessonPosts, $fields) {
        global $post;
        $result = array();
        if ($lessonPosts->have_posts()) {
            while ($lessonPosts->have_posts()) : $lessonPosts->the_post();
                array_push($result, $this->getPostFields($post->ID, $fields));
            endwhile;
        }
        return $result;
    }

    private function getPostFields($postID, $fields) {
        $metaData = get_post_meta($postID);
        $result = array();
        foreach ($fields as $field) {
            $result[$field] = $metaData[$field][0];
        }
        return $result;
    }
}
?>

