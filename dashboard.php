<?php
require_once './database/db.php';
session_start();


$email = $_SESSION['user_email'];


    // دریافت نام کاربر بر اساس ایمیل
    $stmt = $conn->prepare("SELECT name FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $user_name = $user['name']; // ذخیره نام کاربر
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
        <button id="theme-switch">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path
            d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
          </svg>
        </button>
            <div class="profile-section">
                <div class="profile-image">
                    <img src="default-avatar.jpg" alt="پروفایل" id="profile-img">
                </div>
                <h2 id="user-name"><?= $user_name?></h2>
                <button class="upload-btn" onclick="document.getElementById('file-input').click();">بارگذاری عکس</button>
                <input type="file" id="file-input" accept="image/*" style="display: none;">
                <button class="delete-btn" id="delete-btn">حذف عکس</button>
            </div>

            <div class="nav-list">
                <ul>
                    <li><a href="password-recovery.php">بازیابی رمز عبور</a></li>
                    <li><a href="articles.php">مقالات سیو شده</a></li>
                    <li><a href="ai.php">بخش AI</a></li>
                    <li><a style="color: red;" href="ai.php">خروج از حساب</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="user-info">
                <h2>اطلاعات کاربر</h2>
                <p><strong>اسم کاربر:</strong> <span id="user-name"><?= $user_name?></span></p>
                <p><strong>ایمیل </strong> <span id="user-name"><?= $_SESSION['user_email'] ?></span></p>
            </div>
        
            <div class="ai-section">
                <h2>بخش AI</h2>
                <p>محتوای بخش هوش مصنوعی در اینجا </p>
            </div>
        </div>
    </div>
    
    <script src="delprof.js"></script>
    <script src="darkmode.js"></script>
</body>
</html>
