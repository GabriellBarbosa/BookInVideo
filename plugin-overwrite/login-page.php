<?php
add_filter('login_errors', 'changeLoginErrorMessage', 10, 1);   
function changeLoginErrorMessage( $error ) {
    if ($error) {
        $error = '<span>E-mail e/ou senha inválidos</span>';
    }
    return $error;
}
?>