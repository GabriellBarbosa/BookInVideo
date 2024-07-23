<?php
/* Template Name: Certificate */

require_once __DIR__ . '/fpdf/fpdf.php';
$imagePath = __DIR__ . '/assets/images/certificate.png';

$user = wp_get_current_user();
$certificateId = get_query_var('certificate_id');
$certificate = getCertificate($certificateId);

$courseName = getCourseName($certificate->courseSlug);
$totalHours = totalHours($certificate->courseSlug);
$startDate = date_create($certificate->startDate);
$endDate = date_create($certificate->endDate);
$first_name = get_user_meta($user->ID, 'first_name', true);
$last_name = get_user_meta($user->ID, 'last_name', true);

echo '<pre>';
print_r($totalHours);
echo '</pre>';

if (
    $user->ID > 0 && 
    $certificateId != null &&
    $courseName != null 
) {
    // $pdf = new FPDF('L');
    // $pdf->SetTitle('87ec6b');
    // $pdf->addPage();
    // $pdf->Image($imagePath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
    // $pdf->Output();
}

function getCertificate($certificateId) {
    global $wpdb;
    $tableName = $wpdb->prefix . 'conclusion_certificates';
    $query = $wpdb->prepare(
        "SELECT `*` FROM `$tableName` WHERE `id` = %d",
        array($certificateId)
    );
    $results = $wpdb->get_results($query);
    return $results[0];
}

function getCourseName($slug) {
    $query = new WP_Query(array(
        'post_type' => 'curso',
        'name' => $slug,
        'numberposts' => 1,
    ));
    $posts = $query->get_posts();
    $firstPost = array_shift($posts);
    if ($firstPost != null) {
        $metaData = get_post_meta($firstPost->ID);
        return $metaData['name'][0];
    }
    return null;
}

function totalHours($courseSlug) {
    $lessonsMinutes = lessonsDurationInMinutes($courseSlug);
    $lessonsInSeconds = lessonsDurationInSeconds($lessonsMinutes);
    $totalSeconds = sumSeconds($lessonsInSeconds);
    $oneHourInSeconds = 3600;
    return ceil($totalSeconds / $oneHourInSeconds); 
}

function lessonsDurationInMinutes($courseSlug) {
    $query = queryAllLessonsFromCourse($courseSlug);
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

function queryAllLessonsFromCourse($courseSlug) {
    return new WP_Query(array(
        'post_type' => 'aula',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $courseSlug,
                'operator' => 'EXISTS',
            )
        )
    ));
}

function lessonsDurationInSeconds($durations) {
    $result = array();
    foreach($durations as $minutes) {
        array_push($result, minutesToSeconds($minutes));
    }
    return $result;
}

function minutesToSeconds($minutes) {
    $parts = explode(':', $minutes);
    $minutes = $parts[0];
    $seconds = $parts[1];
    return ($minutes * 60) + $seconds;
}

function sumSeconds($secondsArray) {
    $result = 0;
    foreach($secondsArray as $seconds) {
        $result += $seconds;
    }
    return $result;
}
?>