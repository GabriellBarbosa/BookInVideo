<?php
require_once __DIR__ . '/fpdf/fpdf.php';

class PDF extends FPDF {
    // override Cell to accept UTF-8 texts
    function Cell( $w,  $h = 0,  $text = '',  $b = 0,  $l = 0,  $a = '',  $f = false,  $y = '' ) {
        parent::Cell( $w, $h, iconv( 'UTF-8', 'windows-1252', $text ), $b, $l, $a, $f, $y );
    }
}
?>