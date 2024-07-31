<?php 
get_header(); 
$course = new \AppCourse\Course('codigo-limpo');
$totalLessons =$course->totalLessons();
$totalHours =$course->totalHours();
$template_directory =  get_template_directory_uri();
?>

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
    </section>
    
    <section class="container">
        <div class="course_info_wrapper">
            <ul>
                <li>Acesso Vitalício Ilimitado</li>
                <li>Certificado de Conclusão</li>
                <li><?= $totalHours ?> Horas de Curso</li>
                <li><?= $totalLessons ?> Aulas</li>
            </ul>
        </div>
    </section>

    <main class="course_section container">
        <h2 class="title title_separator">Curso</h2>
        <p class="subtitle">Escreva um código que você olhe com orgulho e diga: Caraca, esse fui eu que fiz.</p>
        <div class="course_wrapper">
            <a class="course_card" href="/curso/codigo-limpo/0101-configuracao">
                <p>Robert C. Martin</p>
                <h3>Código Limpo</h3>
                <ul>
                    <li><?= $totalLessons ?> Aulas</li>
                    <li><?= $totalHours ?> Horas de Curso</li>
                </ul>
                <span class="watch_icon">
                    <img src="<?= $template_directory . '/assets/images/play.png' ?>" alt="Assistir">
                </span>
            </a>
            <ul class="keywords">
                <li>Introdução</li>
                <li>Nomes significativos</li>
                <li>Funções</li>
                <li>Testes unitários</li>
                <li>Classes</li>
                <li>Mais código limpo...</li>
            </ul>
        </div>
    </main>

    <section class="clean_code_example_section gray_light_section">
        <div class="container">
            <h2 class="title title_separator">Simplicidade</h2>
            <p class="subtitle">
                "Um código limpo é simples e direto. Ele é tão bem legível quanto uma prosa bem escrita. 
                Ele jamais torna confuso o objetivo do desenvolvedor."
                <br>Grady Booch - Livro código limpo.
            </p>
            <div class="clean_code_example">
                <div class="code-img"><img src="<?= $template_directory . '/assets/images/home-code-before.jpg' ?>" alt="Função grande com muita informação"></div>
                <div class="code_description before">
                    <h3>Antes</h3>
                    <p class="text">Muita informação para entender de primeira. Isso gera uma sobrecarga mental.</p>
                </div>
                <div class="code_description after">
                    <h3>Depois</h3>
                    <p class="text">Cada responsabilidade separada na sua devida função. Agora dá para entender tudo.</p>
                </div>
                <div class="code-img"><img src="<?= $template_directory . '/assets/images/home-code-after.jpg' ?>" alt="Função refatorada em mais funções com cada informação extraída para sua respectiva função"></div>
            </div>
            <p class="home_text title_separator">
                Essas duas versões possuem o mesmo comportamento observável. A diferença é que uma é muito 
                mais expressiva. Refatoramos esse código passo a passo no exercício de Nomes Significativos.
            </p>
        </div>
    </section>

    <section class="video_section gray_dark_section">
        <div class="container">
            <h2 class="title title_separator">Introdução</h2>
            <div class="video">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe src="https://player.vimeo.com/video/989775623?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="0000-intro"></iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </section>

    <section class="refactorings_section gray_light_section">
        <h2 class="title title_separator container">Mais Refatorações</h2>
        <p class="subtitle">Essas refatorações foram feitas durante as aulas.</p>

        <div class="slide-wrapper">
            <ul class="custom-controls">
                <li>Bef</li>
                <li>Aft</li>
                <li>Bef</li>
                <li>Aft</li>
                <li>Bef</li>
                <li>Aft</li>
            </ul>
            <ul class="slide">
                <li>
                    <p class="slide_name">PrimeGenerator</p>
                    <p class="slide_title">Antes</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/PrimeGenerator-before.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0607-comentarios/antes/PrimeGenerator.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
                <li>
                    <p class="slide_name">PrimeGenerator</p>
                    <p class="slide_title">Depois</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/PrimeGenerator-after.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0607-comentarios/depois/PrimeGenerator.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
                <li>
                    <p class="slide_name">GildedRose Kata</p>
                    <p class="slide_title">Antes</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/GildedRose-before.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0506-exercicio/antes/src/gilded_rose.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
                <li>
                    <p class="slide_name">GildedRose Kata</p>
                    <p class="slide_title">Depois</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/GildedRose-after.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0507-exercicio-continuacao/depois/src/gilded_rose.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
                <li>
                    <p class="slide_name">ClientsSummary</p>
                    <p class="slide_title">Antes</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/SumarizedClients-before.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0201-nomes-significativos/antes/main.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
                <li>
                    <p class="slide_name">ClientsSummary</p>
                    <p class="slide_title">Depois</p>
                    <div class="img">
                        <img src="<?= $template_directory . '/assets/images/SumarizedClients-after.jpg' ?>">
                    </div>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0201-nomes-significativos/depois/main.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
            </ul>
        </div>

        <p class="home_text title_separator container">
            Não é apenas sobre ter um código esteticamente bonito, é sobre evitar horas de depuração, 
            ser mais flexível às mudanças e talvez o mais importante, ter orgulho do seu trabalho.
        </p>
    </section>

    <section class="pricing_wrapper gray_dark_section">
        <div class="container">
            <h2 class="title title_separator">Inscreva-se</h2>
            <p class="subtitle">Achou o seu código parecido com algum dos exemplos ruins? Ainda bem que você descobriu que a solução está aqui.</p>
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