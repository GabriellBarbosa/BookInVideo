<?php
namespace AppCertificate;

class Certificate {
    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function getByUser() {
        global $wpdb;
        $tableName = $wpdb->prefix . 'conclusion_certificates';
        $query = $wpdb->prepare(
            "SELECT `id`, `courseSlug` FROM `$tableName` WHERE `userId` = %d;",
            array($this->userId)
        );
        $results = $wpdb->get_results($query);
        return array_shift($results);
    }
}
?>