<?php 
/* Template Name: Course */ 
$stylesheetDirectoryUri = get_stylesheet_directory_uri();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php wp_head(); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php bloginfo('name'); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $stylesheetUri; ?>/assets/images/favicon/apple-touch-icon.png">
        
        <link rel="icon" type="image/png" sizes="48x48" href="<?= $stylesheetUri; ?>/assets/images/favicon/favicon-search-engine.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $stylesheetUri; ?>/assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $stylesheetUri; ?>/assets/images/favicon/favicon-16x16.png">
        <link rel="mask-icon" href="<?= $stylesheetUri; ?>/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="manifest" href="<?= $stylesheetUri; ?>/site.webmanifest">
        
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#222222">
        <script type="module" crossorigin src="<?= $stylesheetDirectoryUri; ?>/react-app/index.js"></script>
        <link rel="stylesheet" href="<?= $stylesheetDirectoryUri; ?>/react-app/index.css">
    </head>
    <body>
        <div id="root"></div>
    </body>
    <?php wp_footer(); ?>
</html>

