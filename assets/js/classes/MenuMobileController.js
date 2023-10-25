export default class MenuMobileController {
    _button;
    _menuElement;

    constructor(buttonQuerySelector, menuElementQuerySelector) {
        this._button = document.querySelector(buttonQuerySelector);
        this._menuElement = document.querySelector(menuElementQuerySelector);
        
        this._toggleActive = this._toggleActive.bind(this);
    }

    init() {
        console.log(this._menuElement)
        if (this._button && this._menuElement) {
            this._button.addEventListener('click', this._toggleActive);
        }
    }

    _toggleActive() {
        if (this._button) this._button.classList.toggle('active');
        if (this._menuElement) this._menuElement.classList.toggle('active');
    }
}

export { MenuMobileController };