document.addEventListener('DOMContentLoaded', () => {
    const articles = document.querySelectorAll('.like-button'); // انتخاب همه مقالات

    articles.forEach((article, index) => {
        const likeIcon = article.querySelector(`#like-icon-${index}`);
        const likedIcon = article.querySelector(`#liked-icon-${index}`);
        const likeCount = article.querySelector(`#like-count-${index}`);

        // دریافت تعداد لایک‌ها از localStorage
        let count = parseInt(localStorage.getItem(`likeCount-${index}`)) || 0;
        let liked = localStorage.getItem(`liked-${index}`) === 'true';

        // نمایش آیکون‌ها و تعداد لایک‌ها بر اساس localStorage
        likeCount.textContent = count;
        if (liked) {
            likeIcon.style.display = 'none';
            likedIcon.style.display = 'inline';
        } else {
            likeIcon.style.display = 'inline';
            likedIcon.style.display = 'none';
        }

        // تنظیم event listener برای لایک کردن
        article.addEventListener('click', () => {
            toggleLike(index, likeIcon, likedIcon, likeCount);
        });
    });
});

function toggleLike(index, likeIcon, likedIcon, likeCount) {
    let count = parseInt(localStorage.getItem(`likeCount-${index}`)) || 0;
    let liked = localStorage.getItem(`liked-${index}`) === 'true';

    if (!liked) {
        // اگر قبلاً لایک نکرده بودیم، لایک می‌کنیم
        likeIcon.style.display = 'none';
        likedIcon.style.display = 'inline';
        count++;
        localStorage.setItem(`liked-${index}`, 'true');
    } else {
        // اگر قبلاً لایک کرده بودیم، لایک را لغو می‌کنیم
        likeIcon.style.display = 'inline';
        likedIcon.style.display = 'none';
        count--;
        localStorage.setItem(`liked-${index}`, 'false');
    }

    // به‌روزرسانی تعداد لایک در localStorage
    localStorage.setItem(`likeCount-${index}`, count);

    // به‌روزرسانی تعداد لایک‌ها در صفحه
    likeCount.textContent = count;

    // ارسال تعداد لایک جدید به دیتابیس
    updateLikeCountInDatabase(index, count);
}

function updateLikeCountInDatabase(index, count) {
    const blogId = index + 1; // فرض می‌کنیم شناسه هر مقاله برابر با index + 1 است

    fetch('update_like.php', {
        method: 'POST',
        body: new URLSearchParams({
            blog_id: blogId,
            like_count: count
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`تعداد لایک مقاله ${blogId} به ${count} به‌روزرسانی شد.`);
        } else {
            console.error('خطا در به‌روزرسانی لایک در دیتابیس');
        }
    })
    .catch(error => console.error('خطا در ارسال درخواست:', error));
}
