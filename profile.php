<?php
require_once './database/db.php';
session_start(); // شروع سشن برای دریافت ایمیل کاربر
$email = $_SESSION['user_email']; // ایمیل کاربر را از سشن دریافت می‌کنید

// اگر فرم آپلود ارسال شده باشد
if (isset($_POST['upload'])) {
    $image = $_FILES['profile_image'];

    // بررسی نوع و اندازه فایل
    if ($image['error'] === 0 && in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
        $uploadDir = './profile/';
        $uploadFile = $uploadDir . time() . '_' . basename($image['name']); // برای جلوگیری از تداخل نام فایل‌ها، از timestamp استفاده می‌کنیم

        // اگر تصویری قبلاً در دیتابیس موجود بود، آن را از دایرکتوری حذف می‌کنیم
        $stmt = $conn->prepare("SELECT profile_image FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && file_exists($uploadDir . $user['profile_image'])) {
            unlink($uploadDir . $user['profile_image']); // حذف تصویر قبلی
        }

        // انتقال فایل به دایرکتوری آپلود
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // به روز رسانی مسیر تصویر پروفایل در دیتابیس
            $stmt = $conn->prepare("UPDATE users SET profile_image = :profile_image WHERE email = :email");
            $stmt->execute([
                ':profile_image' => basename($uploadFile), // فقط نام فایل را ذخیره می‌کنیم
                ':email' => $email
            ]);
            echo "عکس پروفایل با موفقیت بارگذاری شد!";
        } else {
            echo "خطا در آپلود فایل.";
        }
    } else {
        echo "لطفا یک فایل تصویر معتبر انتخاب کنید.";
    }
}
?>