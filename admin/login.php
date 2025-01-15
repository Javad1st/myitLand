<?php
session_start();

// تنظیمات اتصال به پایگاه داده
include '../database/db.php'; // اطمینان حاصل کنید که فایل db.php به درستی تنظیم شده است

// ایمیل و رمز عبور صحیح (رمز عبور باید هش شده باشد)
$correct_email = "itlandmy.panel.ir@gmail.com";
$correct_password_hash = password_hash("itland.ir-admin-91##", PASSWORD_DEFAULT); // هش کردن رمز عبور

// متغیر برای نمایش پیام خطا
$emailError = $passwordError = "";

// بررسی ارسال فرم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت و فیلتر کردن اطلاعات وارد شده توسط کاربر
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // بررسی صحت ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "ایمیل وارد شده معتبر نیست.";
    }

    // بررسی صحت رمز عبور
    if (empty($password)) {
        $passwordError = "رمز عبور وارد نشده است.";
    }

    // بررسی صحت ایمیل و رمز عبور
    if ($email === $correct_email && password_verify($password, $correct_password_hash)) {
        // ذخیره‌سازی وضعیت ورود در سشن
        $_SESSION['logged_in'] = true;

        // تنظیم کوکی برای ورود (1 ساعت اعتبار)
        setcookie('logged_in', 'true', time() + 3600, '/');  // اعتبار 1 ساعت برای کوکی

        // هدایت به صفحه پنل ادمین
        header("Location: index.php");
        exit();
    } else {
        // اگر اطلاعات درست نبود
        $emailError = "ایمیل یا رمز عبور اشتباه است.";
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ورود</title>
    <link rel="stylesheet" href="../login/loginstyle.css">
    <link rel="stylesheet" href="../login/pass.css">
</head>
<body>
    <div class="wrapper">
        <h2>ورود</h2>

        <form method="POST" action="">
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message"><?php echo $emailError; ?></div><br>
            <?php endif; ?>

            <div class="input-field">
                <input type="password" id="password" name="password" required minlength="8">
                <label for="password">رمز عبور</label>
            </div>
            <?php if ($passwordError): ?>
                <div class="error-message"><?php echo $passwordError; ?></div><br>
            <?php endif; ?>

            <button type="submit" name="login">ورود</button>
        </form>
    </div>
</body>
</html>
