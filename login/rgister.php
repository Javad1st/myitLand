<?php
include '../database/db.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // شامل کتابخانه PHPMailer

session_start();

$emailError = '';
$passwordError = '';
$successMessage = '';
$generatedCode = '';
$timestamp = '';
$codeSent = false;

// بررسی درخواست POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $currentTimestamp = time();

    // اعتبارسنجی ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'ایمیل وارد شده معتبر نیست. لطفاً یک ایمیل صحیح وارد کنید.';
    }
    // چک کردن وجود ایمیل در دیتابیس
    else {
        $checkEmailQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmailQuery->bindValue(1, $email, PDO::PARAM_STR);
        $checkEmailQuery->execute();

        if ($checkEmailQuery->rowCount() > 0) {
            $emailError = 'این ایمیل قبلاً ثبت شده است. لطفاً از ایمیل دیگری استفاده کنید.';
        }
    }

    // اعتبارسنجی رمز عبور
    if (!$emailError && strlen($password) < 8) {
        $passwordError = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    // ارسال ایمیل و کد تأیید
    if (!$emailError && !$passwordError && isset($_POST['sendCode'])) {
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
            $mail->Subject = 'کد تأیید ثبت‌نام در سایت ITLAND'; // موضوع ایمیل
            $mail->Body = "
                <div style='text-align: center;'>
                    <p><b>$name</b> سلام</p>
                    <p>به آیتی لند خوش آمدید</p>
                    <p>کد تأیید شما: <b>$generatedCode</b></p>
                    <p>Welcome to ITLAND, $name</p>
                    <p>Your verify code: <b>$generatedCode</b></p>
                    <p><a href='http://myitland.ir/' style='color: blue;'>myitland.ir</a></p>
                </div>
            ";
            
            // ارسال ایمیل
            $mail->send();
            $_SESSION['generatedCode'] = $generatedCode;  // ذخیره کد در session
            $_SESSION['email'] = $email;  // ذخیره ایمیل در session
            $_SESSION['timestamp'] = $timestamp;  // ذخیره زمان ارسال در session
            $_SESSION['name'] = $name; // ذخیره نام کاربر در session
            $_SESSION['password'] = $password; // ذخیره رمز عبور کاربر در session
            $successMessage = 'کد تأیید به ایمیل شما ارسال شد. لطفاً آن را وارد کنید.';
            header("Location: verify.php");
            exit;

        } catch (Exception $e) {
            $emailError = "خطا در ارسال ایمیل: {$mail->ErrorInfo}. لطفاً دوباره تلاش کنید.";
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
    <link rel="stylesheet" href="pass.css">
</head>
<body>
<div class="shape1"></div>
    <div class="wrapper">
        <h2>ثبت‌نام</h2>
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" id="name" name="name" required>
                <label for="name">نام</label>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">ایمیل</label>
            </div>
            <?php if ($emailError): ?>
                <div class="error-message"><?php echo $emailError; ?></div>
            <?php endif; ?>
            <div class="input-field">
                <input type="password" id="password" name="password" required minlength="8">
                <label for="password">رمز عبور</label>
            </div>
            
            <?php if ($passwordError): ?>
                <div class="error-message"><?php echo $passwordError; ?></div>
            <?php endif; ?>
            <button type="submit" name="sendCode">ارسال کد تأیید به ایمیل</button>
        </form>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
    </div>
<<<<<<< HEAD
    <style>
    
    @media screen and (max-width: 1100px) {
      .wrapper{
        width: 50%;
        font-size: xx-large;
        padding: 4rem 3rem;
        gap: 2rem;
      }
      h2{
        font-size: xxx-large;
      }
      .input-field{
        margin-top: 2rem;
        padding: 1rem;
        font-size: xx-large;
      }
      .input-field{
        font-size: xx-large;
      }
      button {
        font-size: x-large;
      }
      .shape1{
        right: 15%;
        top: 30%;
      }
      .input-field input {
        font-size: 1.8rem;
      }
      .input-field label{
        font-size: 28px;
      }
    }
    
    @media screen and (max-width: 750px){
       
    .shape1{
      right: 15%;
      top: 40%;
    }
    
    }
    
    
    @media screen and (max-width: 700px) {
        .wrapper {
          width: 60%;
          font-size: xxx-large;
          padding: 6rem 3rem;
          gap: 2rem;
          /* margin-top: auto; */
          /* gap: 2rem; */
      }
      
      }
    </style>
=======
>>>>>>> 345132f1cf9f57de538c486cbc06ed3ebd60f9d4
</body>
</html>
