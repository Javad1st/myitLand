// بازیابی وضعیت دارک مود از localStorage
let darkmode = localStorage.getItem('darkmode') || 'light';

const themeSwitch = document.getElementById('theme-switch');

// تابع برای فعال یا غیرفعال کردن دارک مود
const toggleDarkmode = (mode) => {
    if (mode === 'active') {
        document.body.classList.add('darkmode');
        themeSwitch.textContent = "تغییر به لایت مود"; // تغییر متن دکمه
    } else {
        document.body.classList.remove('darkmode');
        themeSwitch.textContent = "تغییر به دارک مود"; // تغییر متن دکمه
    }
    localStorage.setItem('darkmode', mode);
};

// فعال کردن دارک مود در بارگذاری صفحه
toggleDarkmode(darkmode);

// افزودن رویداد کلیک برای تغییر تم
themeSwitch.addEventListener("click", () => {
    darkmode = darkmode === 'light' ? 'active' : 'light';
    toggleDarkmode(darkmode);

    const moon = document.querySelector('.moon');
    const moon2 = document.querySelector('.moon2');
    const isLand1 = document.querySelector('.img1');
    const isLand2 = document.querySelector('.img2');

    moon.classList.toggle('unhide', darkmode === 'active');
    moon2.classList.toggle('unhide', darkmode !== 'active');
    isLand1.classList.toggle('hidden', darkmode === 'active');
    isLand2.classList.toggle('unhide', darkmode === 'active');

    const down = document.getElementById('down');
    down.classList.toggle('rotate180', darkmode === 'active');
});
