<?php
add_action('after_switch_theme', 'createCompletedLessonsTable');

function createCompletedLessonsTable() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'completed_lessons';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        userId int NOT NULL,
        lessonSlug varchar(255) NOT NULL,
        courseSlug varchar(255) NOT NULL,
        createdAt datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (userId, courseSlug, lessonSlug)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
?>