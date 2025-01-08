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

function toggleLike() {
    var likeIcon = document.getElementById("like-icon");
    var likedIcon = document.getElementById("liked-icon");
    
    if (likeIcon.style.display !== "none") {
        likeIcon.style.display = "none";
        likedIcon.style.display = "inline";
        localStorage.setItem("liked", "true");
    } else {
        likeIcon.style.display = "inline";
        likedIcon.style.display = "none";
        localStorage.setItem("liked", "false");
    }
}


window.onload = function() {
    var liked = localStorage.getItem("liked");
    var likeIcon = document.getElementById("like-icon");
    var likedIcon = document.getElementById("liked-icon");
    
    if (liked === "true") {
        likeIcon.style.display = "none";
        likedIcon.style.display = "inline";
    } else {
        likeIcon.style.display = "inline";
        likedIcon.style.display = "none";
    }
}


document.getElementById("like-button").addEventListener("click", toggleLike);
