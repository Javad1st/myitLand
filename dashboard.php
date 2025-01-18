<?php
require_once './database/db.php';
session_start();

$email = $_SESSION['user_email'];

// دریافت نام و تصویر پروفایل کاربر از دیتابیس
$stmt = $conn->prepare("SELECT name, profile_image FROM users WHERE email = :email");
$stmt->execute([':email' => $email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $user_name = $user['name'];
    $profile_image = $user['profile_image']; // نام فایل تصویر پروفایل
} else {
    echo "کاربر یافت نشد!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کاربری</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-image">
                    <!-- اگر تصویر پروفایل وجود داشت، آن را نمایش بده، در غیر این صورت آواتار پیش‌فرض را نمایش بده -->
                    <?php if ($profile_image): ?>
                        <img src="./profile/<?=$profile_image ?>" alt="پروفایل" id="profile-img">
                    <?php else: ?>
                        <img src="default-avatar.jpg" alt="پروفایل" id="profile-img">
                    <?php endif; ?>
                </div>
                <button class="upload-btn" onclick="document.getElementById('file-input').click();">بارگذاری عکس</button>
                <input type="file" id="file-input" accept="image/*" style="display: none;">
                <button class="delete-btn" id="delete-btn">حذف عکس</button>
            </div>

            <div class="nav-list">
                <ul>
                    <li><a href="password-recovery.php">بازیابی رمز عبور</a></li>
                    <li><a href="articles.php">مقالات سیو شده</a></li>
                    <li><a href="ai.php">بخش AI</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="user-info">
                <h2>اطلاعات کاربر</h2>
                <p><strong>اسم کاربر:</strong> <span id="user-name"><?= $user_name?></span></p>
                <p><strong>ایمیل:</strong> <span id="user-name"><?= $_SESSION['user_email'] ?></span></p>
            </div>
        
            <div class="ai-section">
                <h2>بخش AI</h2>
                <p>محتوای بخش هوش مصنوعی در اینجا خواهد بود.</p>
            </div>
        </div>
    </div>
    
    <script src="delprof.js"></script>
</body>
</html>
