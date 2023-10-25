import MenuMobileControl from './MenuMobileControl';

describe('MenuMobileControl', () => {
    let button;
    let menuElement;

    beforeEach(() => {
        button = document.createElement('button');
        menuElement = document.createElement('menuElement');
    });

    it('add active class to menuElement on button click', () => {
        const menuMobileControl = new MenuMobileControl(button, menuElement);

        menuMobileControl.execute();
        button.click();
    
        expect([ ...menuElement.classList ]).toContain("active");
    });
})
