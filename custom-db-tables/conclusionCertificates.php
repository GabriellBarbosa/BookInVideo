<?php
add_action('after_switch_theme', 'createTableOfConclusionCertificates');

function createTableOfConclusionCertificates() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'conclusion_certificates';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id int NOT NULL AUTO_INCREMENT,
        userId int NOT NULL,
        courseSlug varchar(255) NOT NULL,
        startDate datetime NOT NULL,
        endDate datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
?>