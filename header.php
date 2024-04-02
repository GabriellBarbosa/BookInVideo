<?php
function getMyAccountButtonText() {
    $currentUser = wp_get_current_user();
    if ($currentUser->ID > 0) {
        $first_name = get_user_meta($currentUser->ID, 'first_name', true);
        return $first_name ? $first_name : 'Minha conta';
    } else {
        return'Login';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="header">
        <nav class="navigation container">
            <div>
                <a class="logo" href="/"><img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" alt="bookinvideo"></a>
            </div>
            </a>

            <div id="header_menu">
                <div id="hamburguer_menu">
                    <span class="line"></span>
                </div>

                <div class="links_container">
                    <div class="links_wrapper">
                        <a href="/curso/codigo-limpo/0101-configuracao" class="link">Curso</a>
                        <a href="plano" class="link">Inscreva-se</a>
                        <a href="contato" class="link contact">Contato</a>
                        <a href="conta" class="link login">
                            <?= getMyAccountButtonText(); ?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>