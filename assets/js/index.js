import HamburguerMenu from './classes/HamburguerMenu.js';

initMenuControl();

function initMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    
    if (menuButton && menuElement) {
        const hamburguerMenu = new HamburguerMenu(menuButton, menuElement);
        hamburguerMenu.toggleActiveOnClick();
    }
}