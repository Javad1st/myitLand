<?php
session_start();

$emailError = '';
$passwordError = '';
$codeError = '';
$successMessage = '';

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../database/db.php'; // اتصال به دیتابیس (در صورتی که لازم باشد)

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $userInput = htmlspecialchars($_POST['userInput']);
    $generatedCode = htmlspecialchars($_POST['message']);
    $timestamp = intval($_POST['timestamp']);
    $currentTimestamp = time();

    // بررسی ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'ایمیل معتبر نیست.';
    }

    // بررسی رمز عبور
    elseif (strlen($password) < 8) {
        $passwordError = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    // بررسی کد منقضی بودن
    elseif ($currentTimestamp - $timestamp > 180) { // 180 ثانیه = 3 دقیقه
        $codeError = 'کد منقضی شده است.';
    }

    // بررسی صحیح بودن کد
    elseif ($generatedCode !== $userInput) {
        $codeError = 'کد تأیید نادرست است.';
    }

    // اگر همه بررسی‌ها موفق باشند، ثبت‌نام انجام می‌شود
    else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ذخیره در دیتابیس (در اینجا فرض کردیم که جدول users وجود دارد)
        $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insert->bindValue(1, $name, PDO::PARAM_STR);
        $insert->bindValue(2, $email, PDO::PARAM_STR);
        $insert->bindValue(3, $hashedPassword, PDO::PARAM_STR);

        if ($insert->execute()) {
            $successMessage = 'ثبت‌نام با موفقیت انجام شد!';
        } else {
            $emailError = 'خطا در ثبت‌نام.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>فرم ثبت‌نام</title>
    <link rel="stylesheet" href="loginstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function(){
            emailjs.init('P8S6N0vq6E2OOtxYh'); // User ID از EmailJS
        })();
    </script>
</head>
<body>
    <div class="wrapper">
        <h2>ثبت‌نام</h2>
     
        <form id="form" method="POST" action="">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">نام</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message" style="color: red;"> <?php echo $emailError; ?> </div>
            <?php endif; ?>
            <div class="input-field">
                <input type="password" id="password" name="password" required minlength="8">
                <label for="password">رمز عبور</label>
            </div>
            <?php if ($passwordError): ?>
                <div class="error-message" style="color: red;"> <?php echo $passwordError; ?> </div>
            <?php endif; ?>
            <input type="hidden" id="generatedCode" name="message">
            <input type="hidden" id="to_email" name="to_email">
            <input type="hidden" id="to_name" name="to_name" value="">
            <input type="hidden" id="reply_to" name="reply_to" value="noreply@example.com">
            <input type="hidden" id="timestamp" name="timestamp">
            <button id="sendEmailButton" type="button">ارسال ایمیل</button>
            <div class="input-field" id="codeInputField" style="display:none;">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <?php if ($codeError): ?>
                <div id="messageBox"></div> <!-- برای نمایش پیام‌ها -->
                <?php endif; ?>
            <button id="registerButton" type="submit" style="display:none;" name="sub">ثبت‌نام</button>
        </form>
        <?php if ($successMessage): ?>
            <div id="messageBox"></div> <!-- برای نمایش پیام‌ها -->
            <?php endif; ?>
        <div class="register">
            <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="#">ورود</a></p>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
