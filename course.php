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
    <link rel="icon" type="image/x-icon" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon.png">
        <script type="module" crossorigin src="<?= $stylesheetDirectoryUri; ?>/react-app/index.js"></script>
        <link rel="stylesheet" href="<?= $stylesheetDirectoryUri; ?>/react-app/index.css">
    </head>
    <body>
        <div id="root"></div>
    </body>
    <?php wp_footer(); ?>
</html>

