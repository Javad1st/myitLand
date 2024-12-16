
let darkmode = localStorage.getItem('darkmode') || 'light';

const themeSwitch = document.getElementById('theme-switch');


const toggleDarkmode = (mode) => {
    if (mode === 'active') {
        document.body.classList.add('darkmode');
    } else {
        document.body.classList.remove('darkmode');
    }
    localStorage.setItem('darkmode', mode);
};


toggleDarkmode(darkmode);


themeSwitch.addEventListener("click", () => {
    darkmode = darkmode === 'light' ? 'active' : 'light';
    toggleDarkmode(darkmode);
    updateDisplay(); 
});


const moon = document.querySelector('.moon');
const moon2 = document.querySelector('.moon2');
const isLand1 = document.querySelector('.img1');
const isLand2 = document.querySelector('.img2');
const down = document.getElementById('down');


function updateDisplay() {
    moon.classList.toggle('unhide', darkmode === 'active');
    moon2.classList.toggle('unhide', darkmode !== 'active');
    isLand1.classList.toggle('hidden', darkmode === 'active');
    isLand2.classList.toggle('unhide', darkmode === 'active');
    down.classList.toggle('rotate180', darkmode === 'active');

  
    const displayState = {
        moon: moon.classList.contains('unhide'),
        moon2: moon2.classList.contains('unhide'),
        isLand1: isLand1.classList.contains('hidden'),
        isLand2: isLand2.classList.contains('unhide'),
        down: down.classList.contains('rotate180')
    };
    localStorage.setItem('displayState', JSON.stringify(displayState));
}


const savedDisplayState = JSON.parse(localStorage.getItem('displayState'));
if (savedDisplayState) {
    moon.classList.toggle('unhide', savedDisplayState.moon);
    moon2.classList.toggle('unhide', savedDisplayState.moon2);
    isLand1.classList.toggle('hidden', savedDisplayState.isLand1);
    isLand2.classList.toggle('unhide', savedDisplayState.isLand2);
    down.classList.toggle('rotate180', savedDisplayState.down);
}


updateDisplay();
