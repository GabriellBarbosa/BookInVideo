<footer id="footer_component">
    <?php if ($pagename == 'checkout'): ?>
        <div class="bookinvideo_checkout_safe_purchase">
            <div class="container">
                <h1>A compra é segura?</h1>
                <p><?= getSafePurchageText(); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="footer_wrapper">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/conta">Minha Conta</a></li>
                <li><a href="/termos-de-uso">Termos</a></li>
                <li><a href="/politica-de-privacidade">Privacidade</a></li>
                <li><a href="mailto:gabriel@bookinvideo.com">gabriel@bookinvideo.com</a></li>
            </ul>
            <p class="copyright">BookInVideo © 2024. Todos os Direitos Reservados. <br /> CNPJ: 54.914.624/0001-43</p>
        </div>
    </div>

    <?php wp_footer(); ?>
</footer>
<script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/index.js" type="module"></script>
</body>
</html>