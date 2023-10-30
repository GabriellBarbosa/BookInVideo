<?php get_header() ?>

<div id="page-home">
    <section class="intro">
        <div class="banner container">
            <h1 class="intro_title">Curso de Código Limpo</h1>
            <blockquote class="intro_quote">
                <p>"Código limpo sempre parece ter sido escrito por alguém que se importa."</p>
            </blockquote>
            <cite class="intro_quoter">Robert C. Martin</cite>
        </div>
    </section>
    
    <main class="course container">
        <div class="clean_code_course">
            <div class="clean_code_cover">
                <img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/clean-code-cover.png" alt="Código Limpo: habilidades práticas do Agile Software">
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

    <section class="plan">
        <div class="container">
            <h2 class="plan_subscription_title">Assinatura</h2>
            <p class="plan_subscription_subtitle">Tenha acesso vitalício ao BookInVideo</p>
            <div class="plan_card">
                <h2>Vitalício</h2>
                <ul class="plan_benefits">
                    <li>Acesso Ilimitado</li>
                    <li>Suporte</li>
                    <li>Certificado de Conclusão</li>
                </ul>
                <span class="plan_price">R$ 70</span>
                <a class="plan_subscription_btn">Assinar</a>
            </div>
            <div class="payment_methods_wrapper">
                <ul class="payment_methods_list">
                    <li>Crédito</li>
                    <li>Pix</li>
                    <li>Boleto</li>
                </ul>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>