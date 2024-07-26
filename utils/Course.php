<?php
namespace AppCourse;

class Course {
    private $courseSlug;

    public function __construct($courseSlug) {
        $this->courseSlug = $courseSlug;
    }

    public function getName() {
        $post = $this->queryCourse();
        if ($post != null) {
            $metaData = get_post_meta($post->ID);
            return $metaData['name'][0];
        }
        throw new Exception('Course not found');
    }

    private function queryCourse() {
        $query = new \WP_Query(array(
            'post_type' => 'curso',
            'name' => $this->courseSlug,
            'numberposts' => 1,
        ));
        $posts = $query->get_posts();
        return array_shift($posts);
    }

    public function totalLessons() {
        $query = $this->queryAllLessons();
        return $query->found_posts;
    }

    public function totalHours() {
        $lessonsMinutes = $this->lessonsDurationInMinutes();
        $lessonsInSeconds = $this->lessonsDurationInSeconds($lessonsMinutes);
        $totalSeconds = $this->sumSeconds($lessonsInSeconds);
        return ceil($totalSeconds / 3600); 
    }
    
    private function lessonsDurationInMinutes() {
        $result = array();
        $query = $this->queryAllLessons();
        foreach($query->get_posts() as $post) {
            $metaData = get_post_meta($post->ID);
            array_push($result, $metaData['duration'][0]);
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