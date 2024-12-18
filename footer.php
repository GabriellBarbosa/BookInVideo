<footer id="footer_component">
    <div class="container">
        <div class="footer_wrapper">
            <ul>
                <h3>Páginas do site</h3>
                <li><a class="link_highlight" href="/">Home</a></li>
                <li><a class="link_highlight" href="/contato">Contato</a></li>
                <li><a class="link_highlight" href="/conta">Minha Conta</a></li>
                <li><a class="link_highlight" href="<?= getCourseLink() ?>">Curso</a></li>
            </ul>
            <ul>
                <h3>Termos e Privacidade</h3>
                <li><a class="link_highlight" href="/termos-de-uso">Termos de uso</a></li>
                <li><a class="link_highlight" href="/politica-de-privacidade">Política de privacidade</a></li>
            </ul>
            <ul>
                <h3>Páginas oficiais</h3>
                <li>
                    <a class="link_highlight" target="_blank" href="https://www.youtube.com/@bookinvideo-courses">YouTube</a>
                </li>
                <li>
                    <a class="link_highlight" target="_blank" href="https://www.instagram.com/bookinvideo/">Instagram</a>
                </li>
                <li>
                    <a class="link_highlight" target="_blank" href="https://www.facebook.com/profile.php?id=61559032261972&locale=pt_BR">Facebook</a>
                </li>
                <li>
                    <a class="link_highlight" target="_blank" href="https://www.linkedin.com/company/bookinvideo/">LinkedIn</a>
                </li>
            </ul>
            <ul>
                <h3>Contato</h3>
                <li><p>gabriel@bookinvideo.com</p></li>
            </ul>
        </div>
        <div class="copyright">
            <p>BookInVideo © 2024 - CNPJ: 54.914.624/0001-43.</p>
            <p>Avenida Paulista, 171 - 4º andar, CEP: 01311-000, Bela Vista, São Paulo, SP.</p>
        </div>
    </div>

    <?php wp_footer(); ?>
</footer>
<script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/index.js" type="module"></script>
</body>
</html>