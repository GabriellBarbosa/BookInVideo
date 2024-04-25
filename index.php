<?php get_header() ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <div class="page_title_wrapper">
        <h1 class="page_title container"><?= the_title(); ?></h1>
    </div>
    <div class="container content">
        <?php the_content(); ?>
    </div>
<?php endwhile; else: ?>
    <blockquote>
        Qualquer tolo escreve um código que um computador possa entender. <br>
        Bons programadores escrevem códigos que os seres humanos podem entender.
        <cite>Martin Fowler</cite>
    </blockquote>
<?php endif; ?>

<?php get_footer() ?>