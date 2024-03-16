<?php get_header() ?>

<?php
$chapters = get_chapters('codigo-limpo');

foreach ($chapters as $chapter) {
    wp_reset_query();
    $lesson_posts = get_lesson_posts($chapter->slug);
    $course_content = array(
        'chapter' => $chapter->name,
        'lessons' => get_filled_lessons($lesson_posts)
    );
}

function get_chapters($course_slug) {
    return get_terms($course_slug);
}

function get_lesson_posts($slug) {
    $chapter_lessons_query = array(
        'post_type' => 'Aula',
        'tax_query' => array(
            array(
                'taxonomy' => 'codigo-limpo',
                'field' => 'slug',
                'terms' => $slug,
            ),
        ),
    );
    return new WP_Query($chapter_lessons_query);
}

function get_filled_lessons($lesson_posts) {
    global $post;
    $result = array();

    if ($lesson_posts->have_posts()) {
        while ($lesson_posts->have_posts()) : $lesson_posts->the_post();
            array_push($result, get_lesson_fields($post->ID));
        endwhile;
    }

    return $result;
}

function get_lesson_fields($post_id) {
    $lesson_meta_data = get_post_meta($post_id);
    return array(
        'name'      => $lesson_meta_data['name'][0],
        'slug'      => $lesson_meta_data['slug'][0],
        'sequence'  => $lesson_meta_data['sequence'][0],
        'video_src' => $lesson_meta_data['video_src'][0],
        'duration'  => $lesson_meta_data['duration'][0],
    );
}
?>

<div id="page-home">
    <section class="banner">
        <div class="intro container">
            <h1 class="title intro_title">Curso de Código Limpo</h1>
            <blockquote class="intro_quote">
                <p>"Um código limpo sempre parece ter sido escrito por alguém que se importava"</p>
            </blockquote>
            <cite class="intro_quoter">MICHAEL FEATHERS</cite>
            <div class="intro_subscription_button">
                <a href="/" class="subscription_button">Inscreva-se</a>
            </div>
        </div>
        <div class="course_info_wrapper">
            <ul>
                <li>Versão beta</li>
                <li>4.4 horas</li>
                <li>23 aulas</li>
            </ul>
        </div>
    </section>
    
    <main class="course_section container">
        <h2 class="title title_separator">Curso</h2>
        <div class="course_wrapper">
            <a class="course_link" href="/curso/codigo-limpo">
                <h3>Código Limpo</h3>
                <p>Baseado no livro de Robert C. Martin</p>
            </a>
            <ul class="keywords">
                <li>Nomes</li>
                <li>Funções</li>
                <li>Testes unitários</li>
                <li>Classes</li>
                <li>Single responsability principle</li>
                <li>Open-closed principle</li>
            </ul>
        </div>

    </main>

    <section class="video_wrapper">
        <div class="container">
            <h2 class="title title_separator">Vídeo de introdução</h2>
            <div class="video">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe src="https://player.vimeo.com/video/922895312?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="0000-intro"></iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>