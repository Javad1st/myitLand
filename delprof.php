<?php
require_once './database/db.php';
session_start(); // اگر از سشن استفاده می‌کنید
$email = $_SESSION['user_email']; // ایمیل کاربر را از سشن دریافت می‌کنید

try {
    // دریافت مسیر تصویر از دیتابیس
    $stmt = $conn->prepare("SELECT profile_image FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['profile_image']) {
        $profileImagePath = './profile/' . $user['profile_image'];

        // حذف فایل از فولدر
        if (file_exists($profileImagePath)) {
            unlink($profileImagePath);
        }
    }

    // حذف تصویر از دیتابیس
    $stmt = $conn->prepare("UPDATE users SET profile_image = NULL WHERE email = :email");
    $stmt->execute([':email' => $email]);

    // ارسال پاسخ به درخواست AJAX
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // در صورت خطا، پاسخ خطا ارسال می‌شود
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
