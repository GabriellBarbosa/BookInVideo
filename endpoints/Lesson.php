<?php
class Lesson {
    public function getAll() {
        $chapters = $this->get_chapters('codigo-limpo');
        $result = array();
        foreach ($chapters as $chapter) {
            wp_reset_query();
            $lesson_posts = $this->get_lesson_posts($chapter->slug);
            $course_content = array(
                'chapter' => $chapter->name,
                'lessons' => $this->get_filled_lessons($lesson_posts)
            );
            array_push($result, $course_content);
        }
        return $result;
    }

    private function get_chapters($course_slug) {
        return get_terms($course_slug);
    }

    private function get_lesson_posts($slug) {
        $chapter_lessons_query = array(
            'post_type' => 'Aula',
            'tax_query' => array(
                array(
                    'taxonomy' => 'codigo-limpo',
                    'field' => 'slug',
                    'terms' => $slug,
                ),
            ),
        );
        return new WP_Query($chapter_lessons_query);
    }

    private function get_filled_lessons($lesson_posts) {
        global $post;
        $result = array();
    
        if ($lesson_posts->have_posts()) {
            while ($lesson_posts->have_posts()) : $lesson_posts->the_post();
                array_push($result, $this->get_lesson_fields($post->ID));
            endwhile;
        }
    
        return $result;
    }

    private function get_lesson_fields($post_id) {
        $lesson_meta_data = get_post_meta($post_id);
        return array(
            'name'      => $lesson_meta_data['name'][0],
            'slug'      => $lesson_meta_data['slug'][0],
            'sequence'  => $lesson_meta_data['sequence'][0],
            'video_src' => $lesson_meta_data['video_src'][0],
            'duration'  => $lesson_meta_data['duration'][0],
        );
    }
}
?>