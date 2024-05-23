<?php
add_filter('login_errors', 'bookinvideo_changeLoginErrorMessage', 10, 1);   
function bookinvideo_changeLoginErrorMessage( $error ) {
    if ($error) {
        $error = '<span>E-mail e/ou senha inválidos</span>';
    }
    return $error;
}
?>