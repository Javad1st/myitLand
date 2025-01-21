<?php
session_start();
include '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = $_POST['blog_id'];
    $user_email = $_POST['user_email']; // ایمیل کاربر که باید از جلسه یا متغیرهای دیگر گرفته شود

    // بررسی اینکه آیا این کاربر قبلاً لایک کرده است
    $checkLike = $conn->prepare("SELECT * FROM likes WHERE blog_id = :blog_id AND user_email = :user_email");
    $checkLike->bindParam(':blog_id', $blog_id);
    $checkLike->bindParam(':user_email', $user_email);
    $checkLike->execute();

    if ($checkLike->rowCount() > 0) {
        // اگر کاربر قبلاً لایک کرده بود، حذف لایک
        $deleteLike = $conn->prepare("DELETE FROM likes WHERE blog_id = :blog_id AND user_email = :user_email");
        $deleteLike->bindParam(':blog_id', $blog_id);
        $deleteLike->bindParam(':user_email', $user_email);
        $deleteLike->execute();

        // کاهش تعداد لایک‌ها در جدول بلاگ‌ها
        $updateBlog = $conn->prepare("UPDATE blogs SET like_count = like_count - 1 WHERE id = :blog_id");
        $updateBlog->bindParam(':blog_id', $blog_id);
        $updateBlog->execute();

        $response = ['success' => true, 'liked' => false];
    } else {
        // اگر کاربر لایک نکرده بود، اضافه کردن لایک
        $insertLike = $conn->prepare("INSERT INTO likes (blog_id, user_email) VALUES (:blog_id, :user_email)");
        $insertLike->bindParam(':blog_id', $blog_id);
        $insertLike->bindParam(':user_email', $user_email);
        $insertLike->execute();

        // افزایش تعداد لایک‌ها در جدول بلاگ‌ها
        $updateBlog = $conn->prepare("UPDATE blogs SET like_count = like_count + 1 WHERE id = :blog_id");
        $updateBlog->bindParam(':blog_id', $blog_id);
        $updateBlog->execute();

        $response = ['success' => true, 'liked' => true];
    }

    echo json_encode($response);
}
?>
