document.getElementById('delete-btn').addEventListener('click', function() {
    if (confirm('آیا مطمئن هستید که می‌خواهید عکس پروفایل خود را حذف کنید؟')) {
        // حذف عکس از رابط کاربری
        document.getElementById('profile-img').src = 'default-avatar.jpg'; // مسیر عکس پیش‌فرض

        // ارسال درخواست به PHP برای حذف عکس از دیتابیس
        fetch('delprof.php', {
            method: 'POST',
            body: new FormData(),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('عکس پروفایل با موفقیت حذف شد.');
            } else {
                alert('خطا در حذف عکس پروفایل.');
            }
        })
       
    }
});

// تغییر عکس پروفایل در رابط کاربری
document.getElementById('file-input').addEventListener('change', function(e) {
    let file = e.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profile-img').src = event.target.result;
        };
        reader.readAsDataURL(file);

        // ارسال ایمیل به سرور برای ذخیره‌سازی تصویر پروفایل
        let formData = new FormData();
        formData.append('profile_image', file);
        formData.append('upload', true);

        // ایمیل کاربر را به سرور ارسال می‌کنیم
        let userEmail = 'user@example.com'; // اینجا باید ایمیل کاربر را از سشن یا متغیرهای جاوااسکریپت بگیرید
        formData.append('email', userEmail);

        fetch('profile.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // موفقیت یا خطا را نمایش می‌دهد
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
