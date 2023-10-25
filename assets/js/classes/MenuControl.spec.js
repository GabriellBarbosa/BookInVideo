import MenuControl from './MenuControl';

describe('MenuControl class', () => {
    let button;
    let menuElement;

    beforeEach(() => {
        button = document.createElement('button');
        menuElement = document.createElement('menuElement');
    });

    it('add active class to menuElement on button click', () => {
        const menuControl = new MenuControl(button, menuElement);

        menuControl.execute();
        button.click();
    
        expect([ ...menuElement.classList ]).toContain("active");
    });

    it('remove active class to menuElement on button click', () => {
        const menuControl = new MenuControl(button, menuElement);

        menuElement.classList.add('active');
        menuControl.execute();
        button.click();
    
        expect([ ...menuElement.classList ]).not.toContain("active");
    });
})
