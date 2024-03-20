<?php
class CourseRepository {
    public function getCourse($slug, $fields) {
        $queryResult = $this->courseQuery($slug);
        $coursePosts = $queryResult->get_posts();
        $singleCoursePost = array_shift($coursePosts);
        $fields = $this->getPostCustomFields($singleCoursePost->ID, $fields);
        return $fields;
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

