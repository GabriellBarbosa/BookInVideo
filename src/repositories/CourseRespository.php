<?php
class CourseRepository {
    public function getCourse($slug, $fields) {
        $queryResult = $this->courseQuery($slug);
        $coursePosts = $queryResult->get_posts();
        return $this->getSinglePostWithCustomFields($coursePosts, $fields);
    }

    private function courseQuery($slug) {
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
        $queryResult = $this->lessonsQuery($courseSlug, $moduleSlug);
        return $this->getLessonsWithCustomFields($queryResult, $fields);
    }

    private function lessonsQuery($courseSlug, $moduleSlug) {
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

    private function getLessonsWithCustomFields($lessonsQuery, $fields) {
        global $post;
        $result = array();
        if ($lessonsQuery->have_posts()) {
            while ($lessonsQuery->have_posts()) : $lessonsQuery->the_post();
                array_push($result, $this->getPostCustomFields($post->ID, $fields));
            endwhile;
        }
        return $result;
    }

    public function getSingleLesson($courseSlug, $lessonSlug, $fields) {
        $queryResult = $this->lessonQuery($courseSlug, $lessonSlug);
        $lessonPosts = $queryResult->get_posts();
        return $this->getSinglePostWithCustomFields($lessonPosts, $fields);
    }

    private function lessonQuery($courseSlug, $lessonSlug) {
        return new WP_Query(array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => $courseSlug,
                    'operator' => 'EXISTS'
                )
            ),
            'meta_query' => array(
                array(
                    'key' => 'slug',
                    'value' => $lessonSlug,
                ),
            )
        ));
    }

    private function getSinglePostWithCustomFields($post, $fields) {
        $singlePost = array_shift($post);
        return $singlePost 
            ? $this->getPostCustomFields($singlePost->ID, $fields)
            : null;
    }

    private function getPostCustomFields($postID, $fields) {
        $metaData = get_post_meta($postID);
        $result = array();
        foreach ($fields as $field) {
            $result[$field] = $metaData[$field][0];
        }
        return $result;
    }
}
?>

