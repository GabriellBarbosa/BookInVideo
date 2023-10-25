import MenuControl from './classes/MenuControl.js';

initMenuControl();

function initMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    
    if (menuButton && menuElement) {
        const menuControl = new MenuControl(menuButton, menuElement);
        menuControl.init();
    }
}