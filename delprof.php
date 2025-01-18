<?php
require_once './database/db.php';
session_start(); // اگر از سشن استفاده می‌کنید
$email = $_SESSION['user_email']; // ایمیل کاربر را از سشن دریافت می‌کنید

    // حذف تصویر از دیتابیس
    $stmt = $pdo->prepare("UPDATE users SET profile_image = NULL WHERE email = :email");
    $stmt->execute([':email' => $email]); // استفاده از ایمیل برای شناسایی کاربر

    // ارسال پاسخ به درخواست AJAX
    echo json_encode(['success' => true]);

?>
