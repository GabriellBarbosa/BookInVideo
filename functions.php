<?php

require_once(get_template_directory() . '/custom-post-types/cpt-course.php');
require_once(get_template_directory() . '/custom-post-types/cpt-chapter.php');
require_once(get_template_directory() . '/custom-post-types/cpt-lesson.php');

add_action( 'add_meta_boxes', 'add_related_course_box' );
add_action( 'save_post', 'save_related_course_box' );

//create the metabox
function add_related_course_box() {
   add_meta_box( 
        'related_course',
        'Related Course',
        'related_course_box',
        'capitulo',
        'normal'
    );
}

//build the box
function related_course_box($post) {
    wp_nonce_field( basename( __FILE__ ), 'wpse_143600_nonce' );
    $stored_meta = get_post_meta( $post->ID );
    $courseArgs = array(
        'post_type' => 'curso',
        'post_status' => 'publish',
        'numberposts' => -1
    );
    $courses = get_posts($courseArgs);

    if ($courses) : ?>
        <p>
            <label for="related-course" class="wpse_143600-row-title">Courses</label>
            <select name="related-course" id="related-course">
                <option value="NULL">Please choose a course</option>
                <?php foreach($courses as $c): ?>
                <option value="<?php echo $c->ID; ?>" <?php if ( isset ( $stored_meta['related-course'] ) ) selected( $stored_meta['related-course'][0], $c->ID ); ?>><?php echo $c->post_title; ?></option>
                <?php endforeach; ?>
            </select>
        </p>    
<?php else: ?>
        <p>There are no courses - please save this post, and write some courses. You'll then be able to choose a course for this location.</p>
<?php endif; 
}

//save the box
function save_related_course_box( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'wpse_143600_nonce' ] ) && wp_verify_nonce( $_POST[ 'wpse_143600_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves if needed
    if ( isset( $_POST[ 'related-course' ] ) ) {
        update_post_meta( $post_id, 'related-course', $_POST[ 'related-course' ] );
    }
}

add_action('init', 'bookinvideo_fix_react_routing');

function bookinvideo_fix_react_routing() {
    add_rewrite_rule('^(curso|slide)/(.+)?', 'index.php?pagename=curso', 'top');
}

add_action('wp_enqueue_scripts', 'bookinvideo_register_css');

function bookinvideo_register_css() {
    wp_register_style('bookinvideo-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
    wp_enqueue_style('bookinvideo-style');
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_js');

function bookinvideo_enqueue_react_js() {
    wp_enqueue_script('course-js', get_template_directory_uri() . '/course/index.js', [], '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_css');

function bookinvideo_enqueue_react_css() {
    wp_register_style('course-css', get_template_directory_uri() . '/course/index.css');
    wp_enqueue_style('course-css');
}
?>