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
    const slideElement = document.querySelector('.slide');
    const wrapperElement = document.querySelector('.slide-wrapper');
    const customControlsElement = document.querySelector('.custom-controls');
    if (
        slideElement &&
        wrapperElement &&
        customControlsElement
    ) {
        const slide = new SlideNav(slideElement, wrapperElement);
        slide.init();
        slide.addControl(customControlsElement);
    }
}