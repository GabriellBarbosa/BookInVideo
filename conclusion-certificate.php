<?php
/* Template Name: Certificate */

require_once __DIR__ . '/fpdf/fpdf.php';
$imagePath = __DIR__ . '/assets/images/certificate.png';

class PDF extends FPDF {
    function Cell( $w, $h = 0, $t = '', $b = 0, $l = 0, $a = '', $f = false, $y = '' ) {
        parent::Cell( $w, $h, iconv( 'UTF-8', 'windows-1252', $t ), $b, $l, $a, $f, $y );
    }
}

$user = wp_get_current_user(); // So pode ver se tiver logado?
$certificateId = get_query_var('certificate_id');
$certificate = getCertificate($certificateId);

$courseName = getCourseName($certificate->courseSlug);
$totalHours = totalHours($certificate->courseSlug);
$startDate = date_create($certificate->startDate);
$endDate = date_create($certificate->endDate);
$first_name = get_user_meta($user->ID, 'first_name', true); // nome do usuario logado?
$last_name = get_user_meta($user->ID, 'last_name', true); // nome do usuario logado?

$pdf = new PDF('L');
$pdf->AddFont('Inter', '', 'Inter-Bold.php');

$pdf->addPage();
$pdf->Image($imagePath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

$pdf->SetTitle($certificateId);

$pdf->SetFont('Inter', '', 32);
$pdf->SetXY(75, 71);
$pdf->MultiCell(100, 12, 'Código limpo', 0);

$pdf->SetXY(189, 71);
$pdf->MultiCell(100, 12, '12 horas', 0);

$pdf->SetXY(80, 119);
$pdf->MultiCell(215, 12, 'Gabriel Barbosa', 0);

$pdf->SetFont('Inter', '', 16);
$pdf->SetXY(189, 86);
$pdf->SetTextColor(96, 97, 99);
$pdf->MultiCell(100, 12, '13/09/2022 - 13/09/2022', 0);

$pdf->SetFont('Inter', '', 14);
$pdf->SetXY(189, 139);
$pdf->MultiCell(100, 12, 'bookinvideo.com/certificate/87ec6b', 0);

$pdf->Output();

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