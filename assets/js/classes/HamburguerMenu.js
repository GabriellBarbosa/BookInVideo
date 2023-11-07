class HamburguerMenu {
    _buttonElement;
    _menuElement;

    constructor(buttonElement, menuElement) {
        this._buttonElement = buttonElement;
        this._menuElement = menuElement;

        if (!buttonElement || !menuElement)
            throw new Error('HamburguerMenu has invalid args');
    }

    toggleActiveOnClick() {
        this._buttonElement.addEventListener('click', () => {
            this._menuElement.classList.toggle('active');
        });
    }
}

export default HamburguerMenu;