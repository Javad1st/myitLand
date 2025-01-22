document.addEventListener('DOMContentLoaded', () => {
    const articles1 = document.querySelectorAll('.save'); // انتخاب همه مقالات

    articles1.forEach((article1, index1) => {
        const saveIcon = article1.querySelector(`#saveIcon-${index1}`);
        const savedIcon = article1.querySelector(`#savedIcon-${index1}`);

        // بررسی وضعیت ذخیره‌سازی از localStorage
        let saved = localStorage.getItem(`saved-${index}`) === 'true';

        // نمایش آیکون‌ها بر اساس localStorage
        if (saved) {
            saveIcon.style.display = 'none';
            savedIcon.style.display = 'inline';
        } else {
            saveIcon.style.display = 'inline';
            savedIcon.style.display = 'none';
        }

        // تنظیم event listener برای ذخیره‌سازی
        article1.addEventListener('click', () => {
            toggleSave(index, saveIcon, savedIcon);
        });
    });
});

function toggleSave(index, saveIcon, savedIcon) {
    let saved = localStorage.getItem(`saved-${index}`) === 'true';

    if (!saved) {
        // اگر قبلاً ذخیره نکرده بودیم، ذخیره می‌کنیم
        saveIcon.style.display = 'none';
        savedIcon.style.display = 'inline';
        localStorage.setItem(`saved-${index}`, 'true');
    } else {
        // اگر قبلاً ذخیره کرده بودیم، ذخیره‌سازی را لغو می‌کنیم
        saveIcon.style.display = 'inline';
        savedIcon.style.display = 'none';
        localStorage.setItem(`saved-${index}`, 'false');
    }

    // ارسال وضعیت جدید به دیتابیس
    updateSaveStatusInDatabase(index, !saved);
}

function updateSaveStatusInDatabase(index, isSaved) {
    const blogId = index + 1; // فرض می‌کنیم شناسه هر مقاله برابر با index + 1 است

    fetch('update_save.php', {
        method: 'POST',
        body: new URLSearchParams({
            blog_id: blogId,
            saved: isSaved
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`وضعیت ذخیره‌سازی مقاله ${blogId} به ${isSaved} به‌روزرسانی شد.`);
        } else {
            console.error('خطا در به‌روزرسانی وضعیت ذخیره‌سازی در دیتابیس');
        }
    })
    .catch(error => console.error('خطا در ارسال درخواست:', error));
}
