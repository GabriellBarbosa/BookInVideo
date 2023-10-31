<?php

$stylesheet_directory_uri = get_stylesheet_directory_uri(); 

?>    
    <footer id="footer_component">
        <div class="container">
            <div class="footer_wrapper">
                <div class="footer_logo">
                    <a href="/"><img src="<?= $stylesheet_directory_uri; ?>/assets/images/logo.svg" alt="bookinvideo"></a>
                </div>
                <div class="footer_links">
                    <div class="links_wrapper">
                        <p class="link_list_title">Mapa do site</p>
                        <ul>
                            <li class=""><a href="">Home</a></li>
                            <li class=""><a href="">Minha Conta</a></li>
                            <li class=""><a href="">Contato</a></li>
                            <li class=""><a href="">Termos</a></li>
                            <li class=""><a href="">Privacidade</a></li>
                        </ul>
                    </div>
                    <div class="links_wrapper">
                        <p class="link_list_title">Fique por dentro</p>
                        <ul>
                            <li class=""><a href="">instagram.com/bookinvideo</a></li>
                            <li class=""><a href="">facebook.com/bookinvideo</a></li>
                            <li class=""><a href="">linkedIn.com/bookinvideo</a></li>
                        </ul>
                    </div>
                    <div class="links_wrapper">
                        <p class="link_list_title">Ajuda</p>
                        <ul>
                            <li class=""><a href="">suporte@bookinvideo.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>BookInVideo © 2024. Alguns direitos reservados. CNPJ: 0001.5563/5563-00</p>
                <div class="footer_logo_mobile">
                    <a href="/"><img src="<?= $stylesheet_directory_uri; ?>/assets/images/logo.svg" alt="bookinvideo"></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?= $stylesheet_directory_uri; ?>/assets/js/index.js" type="module"></script>
</body>
</html>