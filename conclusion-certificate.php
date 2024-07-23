<?php
/* Template Name: Certificate */
require_once __DIR__ . '/fpdf/fpdf.php';

$imagePath = __DIR__ . '/assets/images/certificate.png';
$pdf = new FPDF('L');

$pdf->SetTitle('87ec6b');
$pdf->addPage();
$pdf->Image($imagePath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->Output();
?>