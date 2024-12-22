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
    if (darkmode === 'active') {
        moon.classList.add('hidden'); // ماه به سمت راست می‌رود و ناپدید می‌شود
        moon2.classList.remove('hidden'); // ماه 2 از سمت چپ می‌آید
        moon2.classList.add('unhide'); // ماه 2 نمایان می‌شود

        isLand1.classList.remove('disOn')
        isLand1.classList.add('disNone')
        isLand2.classList.remove('disNone');
        isLand2.classList.add('disOn')
    } else {
        moon.classList.remove('hidden'); // ماه به حالت عادی برمی‌گردد
        moon.classList.add('unhide'); // ماه نمایان می‌شود
        moon2.classList.add('hidden'); // ماه 2 به سمت چپ می‌رود و ناپدید می‌شود
        moon2.classList.remove('unhide'); // ماه 2 ناپدید می‌شود

        isLand1.classList.remove('disNone')
        isLand1.classList.add('disOn')
        isLand2.classList.add('disNone');
        isLand2.classList.remove('disOn')
    }

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
