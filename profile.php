<?php
require_once './database/db.php';
session_start(); // شروع سشن برای دریافت ایمیل کاربر
$email = $_SESSION['user_email']; // ایمیل کاربر را از سشن دریافت می‌کنید

    // اگر فرم آپلود ارسال شده باشد
    if (isset($_POST['upload'])) {
        $image = $_FILES['profile_image'];

        // بررسی نوع و اندازه فایل
        if ($image['error'] === 0 && in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            $uploadDir = 'profile/';
            $uploadFile = $uploadDir . basename($image['name']);
            
            // انتقال فایل به دایرکتوری آپلود
            move_uploaded_file($image['tmp_name'], $uploadFile);

            // به روز رسانی مسیر تصویر پروفایل در دیتابیس
            $stmt = $pdo->prepare("UPDATE users SET profile_image = :profile_image WHERE email = :email");
            $stmt->execute([
                ':profile_image' => $uploadFile,
                ':email' => $email
            ]);
            echo "عکس پروفایل با موفقیت بارگذاری شد!";
        } else {
            echo "لطفا یک فایل تصویر معتبر انتخاب کنید.";
        }
    }

?>
