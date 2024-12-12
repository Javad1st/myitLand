document.addEventListener('DOMContentLoaded', () => {
    const cats = document.querySelectorAll('.cat1, .cat2, .cat3, .cat4, .cat5');

    cats.forEach(cat => {
        cat.addEventListener('click', () => {
            // حذف کلاس 'click' از همه کت‌ها
            cats.forEach(c => c.classList.remove('click'));
            // اضافه کردن کلاس 'click' به کت کلیک شده
            cat.classList.add('click');
        });
    });
});
