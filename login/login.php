<?php
session_start(); // شروع جلسه

// اگر کاربر قبلاً وارد شده است، هدایت به صفحه اصلی
if (isset($_SESSION['user_email'])) {
    header("Location: ../index.php");
    exit();
}

// بررسی تعداد تلاش‌های ناموفق
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// بررسی زمان آخرین تلاش ناموفق
if (isset($_SESSION['last_attempt_time']) && (time() - $_SESSION['last_attempt_time'] > 60)) {
    // اگر یک دقیقه گذشته باشد، تعداد تلاش‌ها را ریست کنید
    $_SESSION['login_attempts'] = 0;
}

// متغیرهای خطا
$emailError = '';
$passwordError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    include '../database/db.php'; // اتصال به پایگاه داده
    
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // جستجوی کاربر در پایگاه داده
    $insert = $conn->prepare("SELECT id, password FROM users WHERE email=?");
    $insert->bindValue(1, $email);
    $insert->execute();

    // بررسی وجود کاربر
    if ($insert->rowCount() > 0) {
        $user = $insert->fetch(PDO::FETCH_ASSOC);
        
        // تأیید رمز عبور
        if (password_verify($password, $user['password'])) {
            // ورود موفق
            $_SESSION['user_email'] = $email; // ذخیره ایمیل کاربر در جلسه
            $_SESSION['user_id'] = $user['id']; // ذخیره شناسه کاربر در جلسه
            
            header('Location: ../index.php'); // هدایت به صفحه اصلی
            exit();
        } else {
            // افزایش تعداد تلاش‌های ناموفق
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time(); // زمان آخرین تلاش ناموفق
            $passwordError = 'رمز عبور نادرست است';
        }
    } else {
        // افزایش تعداد تلاش‌های ناموفق
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time(); // زمان آخرین تلاش ناموفق
        $emailError = 'کاربری با این ایمیل پیدا نشد';
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ورود</title>
    <link rel="stylesheet" href="loginstyle.css"> 
    <link rel="stylesheet" href="loginmobile.css">
    <link rel="stylesheet" href="pass.css">
</head>
<body>
    <div class="shape1"></div>
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
                <span class="toggle-password">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
            </div>

            <?php if ($passwordError): ?>
                <div class="error-message"><?php echo $passwordError; ?></div><br>
            <?php endif; ?>

            <button type="submit" name="login">ورود</button>
        </form>

        <div class="register">
            <p>هنوز ثبت‌نام نکرده‌اید؟ <a href="rgister.php">ثبت‌نام</a></p>
            <p>رمز عبور خود را فراموش کردید؟<a href="./newpass.php">بازیابی رمز </a></p>
        </div>
    </div>
    <script src="eyes.js"></script>
    <script src="../darkmode.js"></script>
</body>
</html>