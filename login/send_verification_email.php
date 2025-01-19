 // اتصال به دیتابیس
 <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// بارگذاری PHPMailer


$email_to = $email; // ایمیل کاربر که از فرم گرفته شد
$verification_code = $verification_code; // کد تأیید که به طور تصادفی تولید شد

$mail = new PHPMailer(true);

try {
    // تنظیمات SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // آدرس سرور SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'myitland.ir@gmail.com'; // ایمیل فرستنده
    $mail->Password = 'amirsali13861399##'; // رمز عبور ایمیل
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // تنظیمات فرستنده و گیرنده
    $mail->setFrom('myitland.ir@gmail.com', 'ITLAND');
    $mail->addAddress($email_to); // ایمیل گیرنده

    // محتویات ایمیل
    $mail->isHTML(true);
    $mail->Subject = 'کد تأیید ایمیل';
    $mail->Body = "کد تأیید شما: <strong>$verification_code</strong>";

    // ارسال ایمیل
    $mail->send();
} catch (Exception $e) {
    echo "خطا در ارسال ایمیل: {$mail->ErrorInfo}";
}
?>