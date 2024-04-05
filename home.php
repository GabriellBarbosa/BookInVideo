<?php 
get_header();
$product = getCourseProductData();
?>

<div id="page-home">
    <section class="banner">
        <div class="intro container">
            <h1 class="title intro_title">Curso de Código Limpo</h1>
            <blockquote class="intro_quote">
                <p>"Um código limpo sempre parece ter sido escrito por alguém que se importava"</p>
            </blockquote>
            <cite class="intro_quoter">MICHAEL FEATHERS</cite>
            <div class="intro_call_to_action">
                <?= displaySubscribeButton('Inscreva-se', 'call_to_action'); ?>
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
            <a class="course_link" href="/curso/codigo-limpo/0101-configuracao">
                <p>Robert C. Martin</p>
                <h3>Código Limpo</h3>
                <ul>
                    <li>23 aulas</li>
                    <li>4.4 horas</li>
                    <li>5 capítulos</li>
                </ul>
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
            <h2 class="title title_separator">Introdução</h2>
            <div class="video">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe src="https://player.vimeo.com/video/922895312?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="0000-intro"></iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </section>

    <section class="pricing_wrapper">
        <div class="container">
            <h2 class="title title_separator">Inscreva-se</h2>
            <div class="plan"> 
                <div class="price_info_wrapper">
                    <div class="price">
                        <p><?= $product['name']; ?></p>
                        <span>R$ <?= $product['price']; ?></span>
                    </div>
                    <div class="plan_info"><?= $product['description']; ?></div>
                </div>
                <div class="redirect">
                    <?= displaySubscribeButton('Assinar', 'subscribe_btn'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>