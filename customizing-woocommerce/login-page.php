<?php
add_filter( 'gettext', 'bookinvideo_change_text_email', 10, 3 );
function bookinvideo_change_text_email( $translated_text, $text, $domain ) {
    if ( ! is_user_logged_in() && is_account_page() ) {
        $original_text = 'Username or email address';
        if ( $text === $original_text )
            $translated_text = esc_html__('Email', $domain );
    }
    return $translated_text;
}

add_filter( 'gettext', 'bookinvideo_change_text_login_button', 10, 3 );
function bookinvideo_change_text_login_button( $translated_text, $text, $domain ) {
    if ( ! is_user_logged_in() && is_account_page() ) {
        $original_text = 'Log in';
        if ( $text === $original_text )
            $translated_text = esc_html__('Acessar conta', $domain );
    }
    return $translated_text;
}

add_filter('woocommerce_after_customer_login_form', 'bookinvideo_register_section');
function bookinvideo_register_section() {
    echo '<h2 class="register_title">'.'Cadastre-se'.'</h2>';
    echo '<div class="register_call_to_action">';
        echo '<p>'.'Inscreva-se para realizar seu cadastro e ter acesso ilimitado ao curso de Código Limpo.'.'</p>';
        echo '<div><a href="/" class="subscription_button">Inscreva-se</a></div>';
    echo '</div>';
}

add_filter('login_errors', 'bookinvideo_change_login_error_message', 10, 1);   
function bookinvideo_change_login_error_message( $error ) {
    if ($error) {
        $error = '<span>E-mail ou senha inválida</span>';
    }
    return $error;
}
?>