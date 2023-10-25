import MenuMobileController from './classes/MenuMobileController.js';

const menuMobileController = new MenuMobileController(
    "#header_menu #hamburguer_menu", 
    "#header_menu"
);
menuMobileController.init();
