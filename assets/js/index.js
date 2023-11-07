import HamburguerMenu from './classes/HamburguerMenu.js';

initMenuControl();

function initMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    
    if (menuButton && menuElement) {
        const menuControl = new HamburguerMenu(menuButton, menuElement);
        menuControl.init();
    }
}