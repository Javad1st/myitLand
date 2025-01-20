document.addEventListener('DOMContentLoaded', () => {
    const cats = document.querySelectorAll('.cat1, .cat2, .cat3, .cat4, .cat5');

    cats.forEach(cat => {
        cat.addEventListener('click', () => {
            
            cats.forEach(c => c.classList.remove('click'));
            
            cat.classList.add('click');
        });
    });
});

////////
function toggleLike(index) {
    var likeIcon = document.querySelector(`#like-icon-${index}`);
    var likedIcon = document.querySelector(`#liked-icon-${index}`);
    var likeCount = document.querySelector(`#like-count-${index}`);
    
    
    var count = parseInt(localStorage.getItem(`likeCount-${index}`)) || 0;

    if (likeIcon.style.display !== "none") {
        likeIcon.style.display = "none";
        likedIcon.style.display = "inline";
        count++;
        localStorage.setItem(`likeCount-${index}`, count); 
        localStorage.setItem(`liked-${index}`, "true"); 
    } else {
        likeIcon.style.display = "inline";
        likedIcon.style.display = "none";
        count--; 
        localStorage.setItem(`likeCount-${index}`, count); 
        localStorage.setItem(`liked-${index}`, "false"); 
    }

   
    likeCount.textContent = count;
}

window.onload = function() {
    var articles = document.querySelectorAll(".blog"); 
    articles.forEach((article, index) => {
        var likeIcon = article.querySelector(`#like-icon-${index}`);
        var likedIcon = article.querySelector(`#liked-icon-${index}`);
        var likeCount = article.querySelector(`#like-count-${index}`);
        
        
        var liked = localStorage.getItem(`liked-${index}`);
        var count = parseInt(localStorage.getItem(`likeCount-${index}`)) || 0;

        if (liked === "true") {
            likeIcon.style.display = "none";
            likedIcon.style.display = "inline";
        } else {
            likeIcon.style.display = "inline";
            likedIcon.style.display = "none";
        }

       
        likeCount.textContent = count;

       
        article.addEventListener("click", () => toggleLike(index));
    });
}
