import MenuMobileControl from './classes/MenuMobileControl.js';

initMobileMenuControl();

function initMobileMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    
    if (menuButton && menuElement) {
        const menuMobileControl = new MenuMobileControl(menuButton, menuElement);
        menuMobileControl.execute();
    }
}