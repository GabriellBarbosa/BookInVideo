<?php
add_action('after_switch_theme', 'createCompletedLessonsTable');

function createCompletedLessonsTable() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'completed_lessons';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        userId int NOT NULL,
        lessonSlug int NOT NULL,
        courseSlug int NOT NULL,
        createdAt datetime NOT NULL,
        PRIMARY KEY  (userId, courseSlug, lessonSlug)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
?>