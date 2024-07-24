<?php
/* Template Name: Certificate */

require_once(__DIR__ . '/utils/pdf-viewer/pdf.php');
require_once(__DIR__ . '/utils/Certificate.php');

$certificateID = get_query_var('certificate_id');
$certificate = findCertificate($certificateID);

if ($certificate != null) {
    displayCertificate($certificate);
}

function findCertificate($certificateID) {
    global $wpdb;
    $tableName = $wpdb->prefix . 'conclusion_certificates';
    $query = $wpdb->prepare(
        "SELECT `*` FROM `$tableName` WHERE `id` = %d",
        array($certificateID)
    );
    $results = $wpdb->get_results($query);
    return $results[0];
}

function displayCertificate($certificate) {
    try {
        tryToDisplayCertificate($certificate);
    } catch (Exception $err) {}
}

function tryToDisplayCertificate($certificate) {
    $course = new \AppCertificate\Certificate(
        $certificate->userId,
        $certificate->courseSlug,
        array(
            'startDate' => $certificate->startDate,
            'endDate' => $certificate->endDate,
        )
    );
    
    $pdf = new PDF('L');
    $pdf->AddFont('Inter', '', 'Inter-Bold.php');
    
    $pdf->addPage();

    $imagePath = __DIR__ . '/assets/images/certificate.png';
    $pdf->Image($imagePath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
    
    $pdf->SetTitle($certificate->id);
    
    $pdf->SetFont('Inter', '', 32);
    $pdf->SetXY(75, 71);
    $pdf->MultiCell(100, 12, $course->getCourseName());
    
    $pdf->SetXY(189, 71);
    $pdf->MultiCell(100, 12, $course->totalHours() . ' horas');
    
    $pdf->SetXY(80, 119);
    $pdf->MultiCell(215, 12, $course->getStudentFullName());
    
    $pdf->SetFont('Inter', '', 16);
    $pdf->SetXY(189, 86);
    $pdf->SetTextColor(96, 97, 99);
    $pdf->MultiCell(
        100, 
        12, 
        $course->getStartDate() . " - " . $course->getEndDate()
    );
    
    $pdf->SetFont('Inter', '', 14);
    $pdf->SetXY(189, 139);
    $pdf->MultiCell(100, 12, "bookinvideo.com/certificate/{$certificate->id}");
    
    $pdf->Output();
}
?>