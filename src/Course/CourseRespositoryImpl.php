<?php
class CourseRepositoryImpl implements CourseRepository {
    private $slug;

    public function __construct($slug) {
        $this->slug = $slug;
    }

    public function getCourse() {
        $customFields = ['name', 'slug'];
        $queryResult = $this->courseQuery();
        $coursePosts = $queryResult->get_posts();
        return $this->getPostWithCustomFields($coursePosts, $customFields);
    }

    private function courseQuery() {
        return new WP_Query(array(
            'post_type' => 'curso',
            'name' => $this->slug,
            'numberposts' => 1,
        ));
    }

    public function getModules() {
        return get_terms($this->slug);
    }

    public function getLessons($moduleSlug) {
        $fields = ['name', 'slug', 'sequence', 'duration', 'free'];
        $queryResult = $this->lessonsQuery($moduleSlug);
        return $this->getLessonsWithCustomFields($queryResult, $fields);
    }

    private function lessonsQuery($moduleSlug) {
        wp_reset_query();
        return new WP_Query(array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => $this->slug,
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
                array_push($result, $this->getCustomFields($post->ID, $fields));
            endwhile;
        }
        return $result;
    }

    public function getSingleLesson($lessonSlug) {
        $customFields = [
            'name', 
            'slug', 
            'sequence', 
            'video_src', 
            'prev', 
            'next', 
            'code', 
            'slide',
            'note',
            'free'
        ];
        $queryResult = $this->lessonQuery($lessonSlug);
        $lessonPosts = $queryResult->get_posts();
        return $this->getPostWithCustomFields($lessonPosts, $customFields);
    }

    private function lessonQuery($lessonSlug) {
        return new WP_Query(array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => $this->slug,
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

    private function getPostWithCustomFields($posts, $fields) {
        $post = array_shift($posts);
        return $post 
            ? $this->getCustomFields($post->ID, $fields)
            : null;
    }

    private function getCustomFields($postID, $fields) {
        $metaData = get_post_meta($postID);
        $result = array();
        foreach ($fields as $field) {
            $result[$field] = $metaData[$field][0];
        }
        return $result;
    }

    public function completeLesson($lessonSlug, $userID) {
        if ($this->lessonIsNotCompleted($lessonSlug, $userID)) {
            $this->addCompletedLesson($lessonSlug, $userID);
        }
    }

    private function addCompletedLesson($lessonSlug, $userID) {
        global $wpdb;
        $wpdb->insert( 
            'wp_completed_lessons', 
            array(
                'userId' => $userID,
                'courseSlug' => $this->slug, 
                'lessonSlug' => $lessonSlug, 
                'createdAt' => current_time( 'mysql' ), 
            ) 
        );
    }

    private function lessonIsNotCompleted($lessonSlug, $userID) {
        global $wpdb;
        $query = $wpdb->prepare(
            "SELECT EXISTS(
                SELECT `*` FROM `wp_completed_lessons` 
                WHERE `userId` = %d AND `courseSlug` = %s AND `lessonSlug` = %s
            );",
            array($userID, $this->slug, $lessonSlug)
        );
        return $wpdb->get_var($query) == 0;
    }

    public function getCompletedLessons($userID) {
        global $wpdb;
        $query = $wpdb->prepare(
            "SELECT `lessonSlug` FROM `wp_completed_lessons` WHERE `userId` = %d AND `courseSlug` = %s;",
            array($userID, $this->slug)
        );
        return $wpdb->get_results($query);
    }
}
?>

