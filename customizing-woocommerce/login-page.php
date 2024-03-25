<?php
add_filter( 'gettext', 'bookinvideo_change_text_login', 10, 3 );
function bookinvideo_change_text_login( $translated_text, $text, $domain ) {
    if ( ! is_user_logged_in() && is_account_page() ) {
        $original_text = 'Username or email address';
        if ( $text === $original_text )
            $translated_text = esc_html__('Email', $domain );
    }
    return $translated_text;
}
?>