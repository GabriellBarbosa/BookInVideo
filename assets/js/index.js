import MenuMobileController from './classes/MenuMobileController.js';

const menuMobileController = new MenuMobileController(
    ".menu #hamburguer_menu", 
    ".menu .links_container"
);
menuMobileController.init();
