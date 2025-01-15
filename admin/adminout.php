<?php
session_start();

// پاک کردن سشن و کوکی‌ها برای خروج کاربر
session_destroy();
setcookie('logged_in', '', time() - 3600, '/'); // حذف کوکی

// تنظیم هدرهایی برای جلوگیری از کش شدن صفحه در مرورگر
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // تاریخ منقضی شده برای جلوگیری از کش شدن

// هدایت به صفحه ورود پس از خروج
header("Location: login.php"); 
exit();
?>
