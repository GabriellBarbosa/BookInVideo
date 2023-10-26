<?php get_header() ?>

<div id="page-home">
    <section class="intro">
        <div class="banner container">
            <h1 class="intro_title">Curso de Código Limpo</h1>
            <blockquote class="intro_quote">
                <p>"Atenção nas pequenas coisas não é uma coisa pequena."</p>
            </blockquote>
            <cite class="intro_quoter">Robert C. Martin</cite>
        </div>
    </section>
    
    <main class="course container">
        <div class="clean_code_course">
            <div>
                <img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/clean-code-cover.png" alt="">
            </div>
            <div class="clean_code_info">
                <h3 class="clean_code_title">Código Limpo</h3>
                <div class="clean_code_items">
                    <p class="clean_code_classes">50 aulas</p>
                    <p class="clean_code_hours">10 horas</p>
                    <p class="clean_code_certificate">Certificado</p>
                </div>
            </div>
        </div>
    
        <div class="clean_code_description">
            <h3>Para quem é esse curso?</h3>
            <p>Esse curso é voltado para pessoas que já sabem programar e desejam escrever códigos melhores.</p>
            <h3>Sobre o curso</h3>
            <p>O curso é baseado no livro mais vendido de programação: código limpo; escrito pelo experiente programador Robert C. Martin. São abordados diversos temas que te ajudará a escrever códigos mais fáceis de se entender. </p>
            <h3>Ressalvas</h3>
            <p>Os exemplos desse curso estão em JavaScript, porém os conceitos aprendidos aqui não se limitam a apenas uma linguagem de programação. </p>
        </div>
    </main>
</div>

<?php get_footer() ?>