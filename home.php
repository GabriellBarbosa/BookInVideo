<?php 
get_header(); 
$course = new \AppCourse\Course('codigo-limpo');
$totalLessons = $course->totalLessons();
$totalHours = $course->totalHours();
$template_directory =  get_template_directory_uri();
?>

<div id="page-home">
    <section class="banner">
        <div class="intro container">
            <div>
                <h1 class="title intro_title">Comece a codar limpo</h1>
                <p class="intro_quote">
                    Descubra as técnicas por trás de um código expressivo, que revela propósito 
                    e nunca mais passe horas perdido em um código confuso.
                </p>
                <div class="intro_call_to_action">
                    <?= displaySubscribeButton('Inscreva-se Agora', 'call_to_action'); ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container">
        <div class="course_info_wrapper">
            <ul>
                <li>Acesso Ilimitado</li>
                <li>Certificado (Para inscritos)</li>
                <li>Suporte às dúvidas</li>
                <li><?= $totalHours ?> horas de curso</li>
            </ul>
        </div>
    </section>

    <main class="course_section container">
        <h2 class="title title_separator">Curso</h2>
        <p class="subtitle">
            Aqui você vai aprender a diferenciar um código sujo de um código limpo e, claro, vou te passar as técnicas 
            para você conseguir limpar o código passo a passo sem alterar o comportamento observável dele.
        </p>
        <div class="course_wrapper">
            <a class="course_card" href="<?= getCourseLink(); ?>">
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
                    <p class="text">
                        Esse código até que não está difícil de entender, pois é só uma função, mas agora 
                        imagina um sistema grande com várias funções como essa, que não faz uso apropriado de 
                        abstrações. Caso você tenha que adicionar ou alterar alguma funcionalidade, você vai 
                        ter que ficar procurando onde você deve mexer no meio de vários detalhes.
                    </p>
                </div>
                <div class="code_description after">
                    <h3>Depois</h3>
                    <p class="text">
                        Agora cada responsabilidade foi separada na sua devida função. Então, por exemplo, se você 
                        tem que alterar as mensagens da rodada, você só mexe na função que exibe as mensagens, se 
                        você tem que incrementar os pontos em 2 em vez de 1, você só mexe na função que incrementa 
                        os pontos. Assim diminui o risco de outra funcionalidade quebrar quando você fizer alguma alteração.
                    </p>
                </div>
                <div class="code-img"><img src="<?= $template_directory . '/assets/images/home-code-after.jpg' ?>" alt="Função refatorada em mais funções com cada informação extraída para sua respectiva função"></div>
            </div>
        </div>
    </section>

    <section class="video_section gray_dark_section">
        <div class="container">
            <h2 class="title title_separator">Introdução</h2>
            <div class="video">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <iframe src="https://player.vimeo.com/video/997237426?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="0000-intro"></iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
        </div>
    </section>

    <section class="refactorings_section gray_light_section">
        <h2 class="title title_separator container">Mais Refatorações</h2>
        <p class="subtitle">Todas refatorações foram feitas durante as aulas.</p>

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
                    <p class="code_description">
                        Essa função está muito grande e possui variáveis de uma letra só, e isso é ruim porque 
                        você tem que ficar lembrando o significado dessas variáveis sempre que vê elas mais abaixo.
                    </p>
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
                    <p class="code_description">
                        Agora, com funções pequenas que fazem apenas uma coisa, consigo colocar um Nome Significativo em cada
                        uma delas, deixando a classe tão expressiva quanto uma prosa bem escrita.
                    </p>
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
                    <p class="code_description">
                        Esse código é de uma loja que atualiza o "quality" e "sellIn" dos itens no final de cada dia. 
                        Cada item tem uma regra diferente de atualização; por isso, tem esse monte de condicionais aí.
                    </p>
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
                    <p class="code_description">
                        Criamos uma classe para cada tipo de item e cada classe tem os métodos 
                        "updatedQuality" e "updatedSellIn", com implementação conforme a regra do item.
                    </p>
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
                    <p class="code_description">
                        Uma função relativamente grande com um nome que não reflete no que ela realmente faz.
                    </p>
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
                    <p class="code_description">
                        Fui refatorando o corpo da função até ficar tão claro o que ela faz que a escolha do nome ficou fácil. 
                        Como Kent Beck diz: "deixe fácil a mudança, então faça a mudança fácil".
                    </p>
                    <div class="github_link">
                        <a href="https://github.com/BookInVideo/codigo-limpo/blob/main/0201-nomes-significativos/depois/main.js" target="_blank">Ver no GitHub.</a>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section class="pricing_wrapper gray_dark_section">
        <div class="container">
            <h2 class="title title_separator">Inscreva-se</h2>
            <p class="subtitle">
                Não é apenas sobre ter um código esteticamente bonito, é sobre evitar horas de depuração, 
                ser flexível às mudanças e o mais importante, ter orgulho do seu trabalho.
            </p>
            <div class="pricing_card_wrapper"><?php displayPricingCard(); ?></div>
        </div>
    </section>

    <section class="home_contact gray_light_section">
        <div class="container">
            <h2 class="title title_separator">Alguma dúvida?</h2>
            <p class="subtitle">Me envie uma mensagem</p>
            <div class="message_btn_wrapper">
                <a class="call_to_action" href="/contato">Enviar mensagem</a>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>