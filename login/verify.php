<?php
include '../database/db.php';
require 'vendor/autoload.php'; // مسیر autoload کامپوزر

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$codeError = '';
$successMessage = '';
$currentTimestamp = time();

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['resend'])) {
        // تولید کد جدید
        $_SESSION['generatedCode'] = rand(100000, 999999);
        $_SESSION['timestamp'] = $currentTimestamp;

        // ارسال کد به ایمیل
        try {
            $email = $_SESSION['email']; // ایمیل کاربر از session
            $name = $_SESSION['name']; // ایمیل کاربر از session
            $generatedCode = $_SESSION['generatedCode'];

            // تنظیمات PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'myitland.ir@gmail.com'; // ایمیل شما
            $mail->Password = 'gcrz eyza pcox mpuq'; // رمز عبور ایمیل (App Password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // تنظیمات گیرنده
            $mail->setFrom('myitland.ir@gmail.com', 'ITLAND');
            $mail->addAddress($email);

            // تنظیمات محتوا
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'کد تأیید ثبت‌نام در سایت ITLAND'; // موضوع ایمیل
            $mail->Body = "
                <div style='text-align: center;'>
                    <p><b>$name</b>  سلام مجدد</p>
                    <p>به آیتی لند خوش آمدید</p>
                    <p>کد تأیید شما: <b>$generatedCode</b></p>
                    <p>Welcome to ITLAND, $name</p>
                    <p>Your verify code: <b>$generatedCode</b></p>
                    <p><a href='http://myitland.ir/' style='color: blue;'>myitland.ir</a></p>
                </div>
            ";

            // ارسال ایمیل
            $mail->send();
            $successMessage = 'کد جدید ارسال شد.';
        } catch (Exception $e) {
            $codeError = 'خطا در ارسال کد: ' . $mail->ErrorInfo;
        }
    } else {
        $userInput = htmlspecialchars($_POST['userInput']);

        // بررسی زمان انقضا (۳ دقیقه)
        if (!isset($_SESSION['timestamp']) || $currentTimestamp - $_SESSION['timestamp'] > 180) {
            $codeError = 'کد منقضی شده است.';
        } elseif ($userInput != $_SESSION['generatedCode']) {
            $codeError = 'کد تأیید نادرست است';
        } else {
            // ذخیره اطلاعات در دیتابیس
            $name = $_SESSION['name'];  // دریافت نام از session
            $email = $_SESSION['email'];  // دریافت ایمیل از session
            $password = $_SESSION['password'];  // دریافت رمز عبور از session
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $insert->bindValue(1, $name, PDO::PARAM_STR);
            $insert->bindValue(2, $email, PDO::PARAM_STR);
            $insert->bindValue(3, $hashedPassword, PDO::PARAM_STR);

            if ($insert->execute()) {
                $successMessage = 'ثبت‌نام با موفقیت انجام شد!';
                // پاک کردن داده‌های جلسه پس از ثبت‌نام
                session_unset();
                session_destroy();
                header("Location: login.php");
                exit;
            } else {
                $codeError = 'خطا در ثبت‌نام. لطفاً دوباره تلاش کنید.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تایید کد</title>
    <link rel="stylesheet" href="loginstyle.css">
    <style>
        #resend {
            display: none; /* پنهان کردن دکمه ارسال مجدد کد در ابتدا */
        }
        #verifyCodeButton {
            display: block; /* دکمه تایید کد به طور پیش‌فرض نمایش داده شود */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>تایید کد</h2>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" id="userInput" name="userInput" required>
                <label for="userInput">کد تأیید</label>
            </div>
            <h2 id="count">3:00</h2>
            <?php if ($codeError): ?>
                <div class="error-message"><?php echo $codeError; ?></div>
            <?php endif; ?>
            <?php if ($successMessage): ?>
                <div class="success-message"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <button type="submit" id="verifyCodeButton">تأیید کد و ثبت‌نام</button>
            <button type="button" id="resend" onclick="sendCodeAgain()">ارسال مجدد کد</button>
        </form>
    </div>

    <script>
        let time = <?php echo isset($_SESSION['timestamp']) ? 180 - ($currentTimestamp - $_SESSION['timestamp']) : 180; ?>; // 3 دقیقه به ثانیه
        const countElement = document.getElementById('count');
        const resendButton = document.getElementById('resend');
        const verifyButton = document.getElementById('verifyCodeButton');
        let codeExpired = false; // متغیر برای وضعیت انقضای کد

        const timer = setInterval(() => {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;

            // فرمت زمان به صورت دو رقمی
            countElement.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (time <= 0) {
                clearInterval(timer);
                codeExpired = true; // کد منقضی شده
                resendButton.style.display = 'block'; // نمایش دکمه ارسال مجدد کد
                verifyButton.style.display = 'none'; // پنهان کردن دکمه تایید کد
                countElement.innerText = "کد منقضی شده است.";
            }

            time--;
        }, 1000);

        function sendCodeAgain() {
            // ارسال درخواست برای ارسال مجدد کد
            const form = document.forms[0];
            const input = document.getElementById('userInput');
            input.removeAttribute('required'); // غیرفعال کردن required برای ارسال مجدد
            const resendInput = document.createElement('input');
            resendInput.type = 'hidden';
            resendInput.name = 'resend';
            resendInput.value = '1';
            form.appendChild(resendInput);
            form.submit();
        }

        // جلوگیری از ارسال فرم وقتی کد منقضی شده است
        document.querySelector('form').addEventListener('submit', function (event) {
            if (codeExpired) {
                event.preventDefault(); // جلوگیری از ارسال فرم
                alert('کد منقضی شده است. لطفاً کد جدیدی درخواست کنید.');
            }
        });
    </script>

</body>
</html>
