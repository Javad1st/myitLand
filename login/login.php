<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ورود</title>
    <link rel="stylesheet" href="loginstyle.css"> <!-- ارجاع به فایل CSS -->
</head>
<body>
    <div class="wrapper">
        <h2>ورود</h2>
        <?php
        session_start(); // شروع جلسه

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
            include '../database/db.php';
            
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // جستجوی کاربر در پایگاه داده
            $insert = $conn->prepare("SELECT password FROM users WHERE email=?");
            $insert->bindValue(1, $email);
            $insert->execute();

            // بررسی وجود کاربر
            if ($insert->rowCount() > 0) {

                $user = $insert->fetch(PDO::FETCH_ASSOC);
                
                // تأیید رمز عبور
                if (password_verify($password, $user['password'])) {
                    // ورود موفق
                    $_SESSION['user_email'] = $email; // ذخیره ایمیل کاربر در جلسه
                    header('location:../index.php'); // آدرس صفحه مورد نظر خود را اینجا وارد کنید
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

            // بررسی تعداد تلاش‌های ناموفق
            if ($_SESSION['login_attempts'] >= 5) {
                // هدایت به صفحه دیگر
                header('location:error.php'); // آدرس صفحه مورد نظر خود را اینجا وارد کنید
                exit();
            }
        }
        ?>
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
        <div class="register">
            <p>هنوز ثبت‌نام نکرده‌اید؟ <a href="register.php">ثبت‌نام</a></p>
        </div>
    </div>

    
</body>
</html>
