<?php
class CourseContent {
    public function getModulesWithLessons($courseSlug) {
        $result = array();
        $modules = $this->getModules($courseSlug);
        foreach ($modules as $module) {
            $courseContent = array(
                'name' => $module->name,
                'sequence' => $module->description,
                'lessons' => $this->getModuleLessons($module->slug, $courseSlug)
            );
            array_push($result, $courseContent);
        }
        return $result;
    }

    private function getModules($courseSlug) {
        return get_terms($courseSlug);
    }

    private function getModuleLessons($moduleSlug, $courseSlug) {
        $lessonPosts = $this->getLessonPosts($moduleSlug, $courseSlug);
        return $this->getFilledLessons($lessonPosts);
    }


    private function getLessonPosts($moduleSlug, $courseSlug) {
        wp_reset_query();
        $module_lessons_query = array(
            'post_type' => 'aula',
            'tax_query' => array(
                array(
                    'taxonomy' => $courseSlug,
                    'field' => 'slug',
                    'terms' => $moduleSlug,
                ),
            ),
        );
        return new WP_Query($module_lessons_query);
    }

    private function getFilledLessons($lessonPosts) {
        global $post;
        $result = array();
    
        if ($lessonPosts->have_posts()) {
            while ($lessonPosts->have_posts()) : $lessonPosts->the_post();
                array_push($result, $this->getLessonFields($post->ID));
            endwhile;
        }
    
        return $result;
    }

    private function getLessonFields($postId) {
        $lessonMetaData = get_post_meta($postId);
        return array(
            'name'      => $lessonMetaData['name'][0],
            'slug'      => $lessonMetaData['slug'][0],
            'sequence'  => $lessonMetaData['sequence'][0],
            'video_src' => $lessonMetaData['video_src'][0],
            'duration'  => $lessonMetaData['duration'][0],
        );
    }
}
?>