const saveIcon = document.getElementById('saveIcon');
const savedIcon = document.getElementById('savedIcon');

// تابعی برای به‌روزرسانی وضعیت آیکون‌ها بر اساس localStorage
function updateIcons() {
    const isSaved = localStorage.getItem('isSaved') === 'true';
    if (isSaved) {
        saveIcon.style.display = "none";
        savedIcon.style.display = "flex";
    } else {
        saveIcon.style.display = "flex";
        savedIcon.style.display = "none";
    }
}

// به‌روزرسانی وضعیت آیکون‌ها در بارگذاری صفحه
updateIcons();

saveIcon.addEventListener("click", () => {
    saveIcon.style.display = "none";
    savedIcon.style.display = "flex";
    localStorage.setItem('isSaved', 'true'); // ذخیره وضعیت
});

savedIcon.addEventListener("click", () => {
    savedIcon.style.display = "none";
    saveIcon.style.display = "flex";
    localStorage.setItem('isSaved', 'false'); // ذخیره وضعیت
});
