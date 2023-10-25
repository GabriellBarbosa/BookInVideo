const MenuMobileControl = require('./MenuMobileControl');

describe('MenuMobileControl', () => {
    let button;
    let menuElement;

    beforeEach(() => {
        button = document.createElement('button');
        menuElement = document.createElement('menuElement');
    });

    // it('add active class to button and menuElement', () => {
    //     const menuMobileControl = new MenuMobileControl(button, menuElement);

    //     menuMobileControl.execute();
    //     button.click();
    
    //     expect([ ...button.classList ]).toContain("active");
    //     expect([ ...menuElement.classList ]).toContain("active");
    // });

    it('button and menuElement active class should be equal', () => {
        const menuMobileControl = new MenuMobileControl(button, menuElement);
        
        menuElement.classList.add('active');
        
        menuMobileControl.execute();
        button.click();
    
        expect([ ...button.classList ]).toContain("active");
        expect([ ...menuElement.classList ]).toContain("active");
    });
})
