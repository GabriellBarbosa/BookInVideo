import HamburguerMenu from './classes/HamburguerMenu.js';
import SlideNav from './classes/Slidenav.js';

hamburguerMenuControl();
initHomeSlide();

function hamburguerMenuControl() {
    const menuButton = document.querySelector('#header_menu #hamburguer_menu');
    const menuElement = document.querySelector('#header_menu');
    const hamburguerMenu = new HamburguerMenu(menuButton, menuElement);
    hamburguerMenu.toggleActiveOnClick();
}

function initHomeSlide() {
    const slide = new SlideNav('.slide', '.slide-wrapper');
    slide.init();
    slide.addControl('.custom-controls');
}