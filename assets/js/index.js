import MenuMobileController from './classes/MenuMobileController.js';

const menuMobileController = new MenuMobileController(
    ".menu_links #hamburguer_menu", 
    ".menu_links .links_container"
);
menuMobileController.init();
