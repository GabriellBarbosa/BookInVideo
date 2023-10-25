class MenuMobileControl {
    _buttonElement;
    _menuElement;

    constructor(buttonElement, menuElement) {
        this._buttonElement = buttonElement;
        this._menuElement = menuElement;

        this._toggleActive = this._toggleActive.bind(this);
    }

    execute() {
        this._buttonElement.addEventListener('click', this._toggleActive);
    }

    _toggleActive() {
        this._buttonElement.classList.toggle('active');

        if (
            (this._buttonElement.classList.contains('active') && this._menuElement.classList.contains('active')) ||
            (!this._buttonElement.classList.contains('active') && !this._menuElement.classList.contains('active'))
        ) {
            console.log(`chamou`)
            this._menuElement.classList.toggle('active');
        }
    }
}

export default MenuMobileControl;