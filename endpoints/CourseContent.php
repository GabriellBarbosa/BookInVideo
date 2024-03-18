<?php
class CourseContent {
    public function get_module_with_lessons() {
        $result = array();
        $modules = $this->get_modules('codigo-limpo');
        foreach ($modules as $module) {
            $course_content = array(
                'module' => $module->name,
                'lessons' => $this->get_module_lessons($module->slug)
            );
            array_push($result, $course_content);
        }
        return $result;
    }

    private function get_modules($course_slug) {
        return get_terms($course_slug);
    }

    private function get_module_lessons($module_slug) {
        $lesson_posts = $this->get_lesson_posts($module_slug);
        return $this->get_filled_lessons($lesson_posts);
    }


    private function get_lesson_posts($module_slug) {
        wp_reset_query();
        $module_lessons_query = array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => 'codigo-limpo',
                    'field' => 'slug',
                    'terms' => $module_slug,
                ),
            ),
        );
        return new WP_Query($module_lessons_query);
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