class HamburguerMenu {
    _buttonElement;
    _menuElement;

    constructor(buttonElement, menuElement) {
        this._buttonElement = buttonElement;
        this._menuElement = menuElement;

        this._toggleActive = this._toggleActive.bind(this);

        if (!buttonElement || !menuElement)
            throw new Error('HamburguerMenu has invalid args');
    }

    toggleActiveOnClick() {
        this._buttonElement.addEventListener('click', this._toggleActive);
    }

    _toggleActive() {
        this._menuElement.classList.toggle('active');
    }
}

export default HamburguerMenu;