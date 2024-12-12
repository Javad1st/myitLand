<?php
session_start(); // شروع جلسه

// پاک کردن تمامی متغیرهای جلسه
session_unset();

// خاتمه دادن به جلسه
session_destroy();

// هدایت کاربر به صفحه اصلی یا صفحه ورود
header('Location:./index.php');
exit();
?>