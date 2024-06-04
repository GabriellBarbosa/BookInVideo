<?php get_header(); ?>

<div id="page-home">
    <section class="banner">
        <div class="intro container">
            <div>
                <h1 class="title intro_title">Curso de Código Limpo</h1>
                <blockquote class="intro_quote">
                    "Um código limpo sempre parece ter sido escrito por alguém que se importava"
                </blockquote>
                <span class="intro_quoter">MICHAEL FEATHERS</span>
                <div class="intro_call_to_action">
                    <?= displaySubscribeButton('Inscreva-se', 'call_to_action'); ?>
                </div>
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
        <p class="subtitle">Domine as técnicas de código limpo para desenvolver programas mais fáceis de manter e compreender. Comece a construir softwares de qualidade.</p>
        <div class="course_wrapper">
            <a class="course_card" href="/curso/codigo-limpo/0101-configuracao">
                <p>Robert C. Martin</p>
                <h3>Código Limpo</h3>
                <ul>
                    <li>23 aulas</li>
                    <li>4.4 horas</li>
                    <li>5 capítulos</li>
                </ul>
                <span class="watch_icon">
                    <img src="<?= get_template_directory_uri() . '/assets/images/play.png' ?>" alt="Assistir">
                </span>
            </a>
            <ul class="keywords">
                <li>Nomes significativos</li>
                <li>Funções</li>
                <li>Testes unitários</li>
                <li>Classes</li>
                <li>Single responsability principle</li>
                <li>Open-closed principle</li>
            </ul>
        </div>
    </main>

    <section class="clean_code_example_section">
        <div class="container">
            <h2 class="title title_separator">Simplicidade</h2>
            <p class="subtitle">
                Um código limpo é simples e direto. Ele é tão bem legível quanto uma prosa bem escrita. 
                Ele jamais torna confuso o objetivo do desenvolvedor.
                <br>Citação de Grady Booch - Livro código limpo.
            </p>
            <div class="clean_code_example">
                <div><img src="<?= get_template_directory_uri() . '/assets/images/home-code-before.png' ?>" alt="Função grande com muita informação"></div>
                <div class="code_description before">
                    <h3>Antes</h3>
                    <p>Muita informação para entender de primeira.</p>
                </div>
                <div class="code_description after">
                    <h3>Depois</h3>
                    <p>Agora dá para entender tudo que está acontecendo.</p>
                </div>
                <div><img src="<?= get_template_directory_uri() . '/assets/images/home-code-after.png' ?>" alt="Função refatorada em mais funções com cada informação extraída para sua respectiva função"></div>
            </div>
            <p class="lesson_ref title_separator">Refatoramos esse código passo a passo no exercício de Nomes Significativos.</p>
        </div>
    </section>

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
            <div class="pricing_card_wrapper"><?php displayPricingCard(); ?></div>
            <ul class="payment_methods">
                <li>Pix</li>
                <li>Cartão de crédito</li>
                <li>Boleto</li>
            </ul>
        </div>
    </section>
</div>

<?php get_footer() ?>