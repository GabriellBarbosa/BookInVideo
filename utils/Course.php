<?php
namespace AppCourse;

class Course {
    private $courseSlug;

    public function __construct($courseSlug) {
        $this->courseSlug = $courseSlug;
    }

    public function getName() {
        $query = $this->queryCourse();
        $posts = $query->get_posts();
        $firstPost = array_shift($posts);
        if ($firstPost != null) {
            $metaData = get_post_meta($firstPost->ID);
            return $metaData['name'][0];
        }
        throw new Exception('Course not found');
    }

    private function queryCourse() {
        return new \WP_Query(array(
            'post_type' => 'curso',
            'name' => $this->courseSlug,
            'numberposts' => 1,
        ));
    }

    public function totalHours() {
        $lessonsMinutes = $this->lessonsDurationInMinutes();
        $lessonsInSeconds = $this->lessonsDurationInSeconds($lessonsMinutes);
        $totalSeconds = $this->sumSeconds($lessonsInSeconds);
        return ceil($totalSeconds / 3600); 
    }
    
    private function lessonsDurationInMinutes() {
        $query = $this->queryAllLessons();
        global $post;
    
        $result = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
                $metaData = get_post_meta($post->ID);
                array_push($result, $metaData['duration'][0]);
            endwhile;
        }
        return $result;
    }
    
    private function queryAllLessons() {
        return new \WP_Query(array(
            'post_type' => 'aula',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => $this->courseSlug,
                    'operator' => 'EXISTS',
                )
            )
        ));
    }
    
    private function lessonsDurationInSeconds($durations) {
        $result = array();
        foreach($durations as $minutes) {
            array_push($result, $this->minutesToSeconds($minutes));
        }
        return $result;
    }
    
    private function minutesToSeconds($minutes) {
        $parts = explode(':', $minutes);
        $minutes = $parts[0];
        $seconds = $parts[1];
        return ($minutes * 60) + $seconds;
    }
    
    private function sumSeconds($secondsArray) {
        $result = 0;
        foreach($secondsArray as $seconds) {
            $result += $seconds;
        }
        return $result;
    }
}
?>