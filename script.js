function toggleDropdown(id) {
    var dropdown = document.getElementById(id);
    if (dropdown.style.display === "grid") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "grid";
    }
}

// Optional: Close dropdowns if clicking outside
window.onclick = function (event) {
    if (!event.target.matches('.headerButton')) {
        var dropdowns = document.getElementsByClassName("dropdownContent");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}

////////////////////////////////
let Mcontent = document.getElementById("Mcontent")
let Mtexts = document.querySelector(".Mtexts")

Mcontent.addEventListener('click', () => {

    Mtexts.classList.toggle('show')

})


let Lcontent = document.getElementById("Lcontent")
let Ltexts = document.querySelector(".Ltexts")

Lcontent.addEventListener('click', () => {

    Ltexts.classList.toggle('show')

})
document.querySelector('.hamburger-icon').addEventListener('click', () => {
    const menu = document.getElementById('menu');
    menu.classList.toggle('menu-open');
});

document.getElementById('close-icon').addEventListener('click', () => {
    const menu = document.getElementById('menu');
    menu.classList.remove('menu-open');
});
// کنترل باز و بسته شدن منوی همبرگری

// کنترل باز و بسته شدن زیرمنوها
document.querySelectorAll('.menu-btn').forEach(button => {
    button.addEventListener('click', () => {
        const dropdownContent = button.nextElementSibling;
        const icon = button.querySelector('.icon');

        dropdownContent.classList.toggle('show');
        icon.classList.toggle('rotate');
    });
});


// پس از لود شدن صفحه، صفحه لودینگ محو شود
window.addEventListener('load', function() {
    const loading = document.getElementById('loading');
    loading.style.animation = 'fadeOut 1s forwards';
    
    // نمایش محتوای اصلی پس از محو شدن لودینگ
    loading.addEventListener('animationend', () => {
        loading.style.display = 'none';
        document.getElementById('content').style.display = 'block';
    });
});


