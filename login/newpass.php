<?php
include '../database/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // شامل کتابخانه PHPMailer

session_start();

$emailError = '';
$successMessage = '';
$codeSent = false;
$generatedCode = '';
$timestamp = '';

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    
    // اعتبارسنجی ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'ایمیل معتبر نیست.';
    } else {
        // بررسی اینکه ایمیل در پایگاه داده وجود دارد یا نه
        $select = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $select->bindParam(':email', $email);
        $select->execute();
        $user = $select->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // تولید کد تأیید ۶ رقمی تصادفی
            $generatedCode = rand(100000, 999999);
            $timestamp = time();  // زمان ارسال کد تأیید

            // ارسال ایمیل با PHPMailer
            $mail = new PHPMailer(true);
            try {
                // تنظیمات SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'myitland.ir@gmail.com'; 
                $mail->Password = 'gcrz eyza pcox mpuq'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // فرستنده و گیرنده
                $mail->setFrom('myitland.ir@gmail.com', 'itland');
                $mail->addAddress($email);

                // محتوای ایمیل
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8'; // تنظیم UTF-8 برای ایمیل
                $mail->Subject = 'کد تأیید بازیابی رمز عبور'; // موضوع ایمیل
                $mail->Body = "
                    <div style='text-align: center;'>
                        <p><b>$email</b> سلام</p>
                        <p>به آیتی لند خوش آمدید</p>
                        <p>کد تأیید بازیابی رمز عبور شما: <b>$generatedCode</b></p>
                        <p>Welcome to ITLAND, $email</p>
                        <p>Your reset password code is: <b>$generatedCode</b></p>
                        <p><a href='http://myitland.ir/' style='color: blue;'>myitland.ir</a></p>
                    </div>
                ";

                // ارسال ایمیل
                $mail->send();
                $_SESSION['generatedCode'] = $generatedCode;  // ذخیره کد در session
                $_SESSION['email'] = $email;  // ذخیره ایمیل در session
                $_SESSION['timestamp'] = $timestamp;  // ذخیره زمان ارسال در session
                $codeSent = true;
            } catch (Exception $e) {
                echo "خطا در ارسال ایمیل: {$mail->ErrorInfo}";
            }
        } else {
            $emailError = 'ایمیل وارد شده در سیستم ثبت نشده است.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>بازیابی رمز عبور</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="wrapper">
        <h2>بازیابی رمز عبور</h2>
        <?php if (!$codeSent): ?>
        <form method="POST" action="">
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message"><?php echo $emailError; ?></div>
            <?php endif; ?>
            <button type="submit">ارسال کد تأیید</button>
        </form>
        <?php else: ?>
        <div class="success-message">کد تأیید بازیابی رمز عبور به ایمیل شما ارسال شد.</div>
        <a href="resetPassword.php">ادامه فرآیند تغییر رمز عبور</a>
        <?php endif; ?>
    </div>
</body>
</html>
