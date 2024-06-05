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

        <link rel="apple-touch-icon" sizes="180x180" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="48x48" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon/favicon-search-engine.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon/favicon-16x16.png">
        <link rel="mask-icon" href="<?= $stylesheetDirectoryUri; ?>/assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="manifest" href="<?= $stylesheetDirectoryUri; ?>/site.webmanifest">

        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#222222">
        <script type="module" crossorigin src="<?= $stylesheetDirectoryUri; ?>/react-app/index.js"></script>
        <link rel="stylesheet" href="<?= $stylesheetDirectoryUri; ?>/react-app/index.css">
        
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '7688025884576264'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=7688025884576264&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    </head>
    <body>
        <div id="root"></div>
    </body>
    <?php wp_footer(); ?>
</html>

