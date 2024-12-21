<?php
// بررسی اینکه آیا شناسه (id) ارسال شده است یا خیر
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // اتصال به پایگاه داده
    include '../database/db.php';

    // آماده‌سازی و اجرای دستور حذف
    $delete = $conn->prepare("DELETE FROM writers WHERE id = ?");
    $delete->bindValue(1, $id, PDO::PARAM_INT); // استفاده از PDO::PARAM_INT برای اطمینان از نوع داده

    // اجرای دستور حذف
    $delete->execute();
}

// در هر صورت، کاربر را به صفحه نویسندگان هدایت کنید
header('Location: writers.php');
exit(); // اطمینان از اینکه هیچ کدی بعد از header اجرا نشود
?>
