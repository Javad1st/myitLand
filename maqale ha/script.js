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

////////
function toggleLike(index) {
    var likeIcon = document.querySelector(`#like-icon${index}`);
    var likedIcon = document.querySelector(`#liked-icon${index}`);
    var likeCount = document.querySelector(`#like-count${index}`);
    
    // دریافت تعداد لایک‌ها از localStorage
    var count = parseInt(localStorage.getItem(`likeCount${index}`)) || 0;

    if (likeIcon.style.display !== "none") {
        likeIcon.style.display = "none";
        likedIcon.style.display = "inline";
        count++; // افزایش تعداد لایک
        localStorage.setItem(`likeCount${index}`, count); // ذخیره تعداد لایک
    } else {
        likeIcon.style.display = "inline";
        likedIcon.style.display = "none";
        count--; // کاهش تعداد لایک
        localStorage.setItem(`likeCount${index}`, count); // ذخیره تعداد لایک
    }

    // به‌روزرسانی نمایش تعداد لایک‌ها
    likeCount.textContent = count;
}

window.onload = function() {
    var articles = document.querySelectorAll("like");
    articles.forEach((article, index) => {
        var likeIcon = article.querySelector(`#like-icon${index}`);
        var likedIcon = article.querySelector(`#liked-icon${index}`);
        var likeCount = article.querySelector(`#like-count${index}`);
        
        // دریافت وضعیت لایک و تعداد لایک از localStorage
        var liked = localStorage.getItem(`liked${index}`);
        var count = parseInt(localStorage.getItem(`likeCount${index}`)) || 0;

        if (liked === "true") {
            likeIcon.style.display = "none";
            likedIcon.style.display = "inline";
        } else {
            likeIcon.style.display = "inline";
            likedIcon.style.display = "none";
        }

        // به‌روزرسانی نمایش تعداد لایک‌ها
        likeCount.textContent = count;

        // اضافه کردن رویداد کلیک به دکمه لایک
        article.querySelector(".like-button").addEventListener("click", () => toggleLike(index));
    });
}
