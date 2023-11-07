import HamburguerMenu from './classes/HamburguerMenu.js';

hamburguerMenuControl();

function hamburguerMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    const hamburguerMenu = new HamburguerMenu(menuButton, menuElement);
    hamburguerMenu.toggleActiveOnClick();
}